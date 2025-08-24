<?php

namespace App\Services;

use CURLFile;
use Illuminate\Support\Str;

class MondayService
{
    private $token;
    private $apiUrl = 'https://api.monday.com/v2';
    private $columns;

    /**
     * MondayService constructor.
     * Initialize API token.
     */
    public function __construct()
    {
        $this->token = env('MONDAY_API_TOKEN');
    }

    public function getAssetUrl($asset_id)
    {
        // build the query
        $query = $this->getQuery('get-image-url');
        $query = str_replace('ASSET_ID', $asset_id, $query);

        $data = @file_get_contents($this->apiUrl, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", $this->headers()),
                'content' => json_encode(['query' => $query]),
            ]
        ]));

        return json_decode($data)->data->assets[0] ?? null;
    }

    public function getItems($boardName)
    {
        $boardId = $this->getBoardIdByName($boardName);

        // build the query
        $query = $this->getQuery('get-items');
        $query = str_replace('BOARD_ID', $boardId, $query);

        $data = @file_get_contents($this->apiUrl, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", $this->headers()),
                'content' => json_encode(['query' => $query]),
            ]
        ]));
        $result = json_decode($data, true);
        $items = $result['data']['boards'][0]['items_page']['items'] ?? [];

        return $items;
    }

    /**
     * Get headers for API request
     * @return array
     */
    private function headers(): array
    {
        return [
            'Content-Type: application/json',
            'Authorization: ' . $this->token,
            'API-Version: 2024-04'
        ];
    }

    /**
     * Get GraphQL query from file
     * @param string $queryFile
     * @return string
     */
    private function getQuery($queryFile): string
    {
        return file_get_contents(__DIR__ . '/monday-queries/' . $queryFile . '.graphql');
    }

    /**
     * Get boards from Monday.com
     *
     * @return mixed
     */
    private function getBoards(): mixed
    {
        $query = $this->getQuery('get-boards');

        $data = [
            'query' => $query
        ];

        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => implode("\r\n", $this->headers()),
                'content' => json_encode($data),
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($this->apiUrl, false, $context);

        if ($result === FALSE) {
            // Handle error
            return false;
        } else {
            return json_decode($result)->data;
        }
    }

    /**
     * Get board info with columns
     * @param int $boardId
     * @return mixed
     */
    private function getBoardInfo($boardId): mixed
    {
        $query = $this->getQuery('get-board-info');
        $query = str_replace('FIELD_ID', $boardId, $query);

        $data = [
            'query' => $query
        ];

        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => implode("\r\n", $this->headers()),
                'content' => json_encode($data),
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($this->apiUrl, false, $context);

        if ($result === FALSE) {
            // Handle error
            return false;
        } else {
            return json_decode($result)->data->boards[0];
        }
    }

    /**
     * Get board id by name
     * @param string $name
     * @return mixed
     */
    private function getBoardIdByName($name): mixed
    {
        $boards = collect($this->getBoards());

        if (!$boards) {
            return false;
        }

        // get board name
        $board = collect($boards['boards'])->firstWhere('name', $name);

        return $board ? $board->id : false;
    }

    /**
     * Add item to board
     * @param string $boardName
     * @param array $item
     * @return mixed
     *
     * email fields get handled automatically
     * date fields should be TEXT in monday board
     * phone fields should be TEXT in monday board
     * boolean fields should be NUMBERS in monday board
     */
    public function addItem($boardName, $item): mixed
    {
        $boardId = $this->getBoardIdByName($boardName);

        if (!$boardId) {
            return ['status' => 'error', 'message' => 'Board not found'];
        }

        $info = $this->getBoardInfo($boardId);
        $this->columns = collect($info->columns);

        $column_builder = $this->columns
            ->map(function ($column) {
                return [
                    'id' => $column->id,
                    'field' => $column->id == 'name' ? 'id' : Str::snake($column->title)
                ];
            })->filter(function ($column) use ($item) {
                return $column['field'] != 'id' && in_array($column['field'], array_keys($item));
            })
            ->toArray();

        $column_values = [];
        foreach ($column_builder as $column) {
            if (substr($column['id'], 0, 5) == 'email') {
                $column_values[$column['id']] = [
                    'email' => $item[$column['field']],
                    'text' => $item[$column['field']]
                ];
                continue;
            }
            $column_values[$column['id']] = $item[$column['field']] ?? null;
        }

        $column_values_json = json_encode($column_values, JSON_UNESCAPED_UNICODE);
        $column_values_escaped = addslashes($column_values_json); // Escapes inner quotes for GraphQL

        // build the query
        $query = $this->getQuery('add-item');
        $query = str_replace('BOARD_ID', $boardId, $query);
        $query = str_replace('ITEM_NAME', '"' . $item['id'] . '"', $query);
        $query = str_replace('ITEM_COLUMN_VALUES', "\"$column_values_escaped\"", $query);

        $data = ['query' => $query];
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", $this->headers()),
                'content' => json_encode($data),
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($this->apiUrl, false, $context);

        if ($result === false) {
            return [
                'status' => 'error',
                'message' => 'API connection failed',
                'error' => error_get_last()
            ];
        }

        $response = json_decode($result);

        if (isset($response->errors)) {
            return [
                'status' => 'error',
                'message' => 'Monday.com API error',
                'errors' => $response->errors,
                'query' => $query
            ];
        }

        if (!isset($response->data->create_item)) {
            return [
                'status' => 'error',
                'message' => 'Unexpected response format',
                'response' => $response
            ];
        }

        return $response->data->create_item;
    }

    public function attachFile($itemId, $fieldName, $filePath)
    {
        $fileMime = mime_content_type($filePath);

        $columnId = $this->columns->firstWhere('title', $fieldName)->id ?? null;

        // build the query
        $query = $this->getQuery('upload-file');
        $query = str_replace('ITEM_ID', $itemId, $query);
        $query = str_replace('COLUMN_ID', $columnId, $query);

        $variables = '{}'; // The file will be mapped in the next step
        $map = '{"file":"variables.file"}';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "$this->apiUrl/file",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: ' . $this->token,
                'API-Version: 2024-04'
            ],
            CURLOPT_POSTFIELDS => [
                'query' => $query,
                'variables' => $variables,
                'map' => $map,
                'file' => new CURLFile($filePath, $fileMime)
            ]
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }
}
