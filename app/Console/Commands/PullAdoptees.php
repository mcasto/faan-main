<?php

namespace App\Console\Commands;

use App\Models\Adoptee;
use App\Services\MondayService;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PullAdoptees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pull-adoptees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    function parseMondayRecord(array $record): array
    {
        // Map column titles to their values
        $columnMap = [];
        foreach ($record['column_values'] as $column) {
            $title = strtolower($column['column']['title']);
            $columnMap[$title] = $column;
        }

        $description = isset($columnMap['description']) ?
            json_decode($columnMap['description']['value']) : null;

        $description = $description ? $description->text : null;

        return [
            'monday_id' => $record['id'],
            'name' => $record['name'],
            'image' => isset($columnMap['image']) ?
                json_decode($columnMap['image']['value'])->files[0]->assetId : null,
            'language' => isset($columnMap['language']) ?
                trim($columnMap['language']['value'], '"') : null,
            'description' => $description,
        ];
    }

    // Usage example:
    // $parsedRecord = parseMondayRecord($mondayApiRecord);

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $imagePath = dirname(__DIR__, 3) . '/public/adoptee-images/';

        $monday = new MondayService();

        $adoptees = $monday->getItems('Adoptees');

        $adoptees = collect($adoptees)->map(function ($adoptee) use ($monday) {
            $rec = $this->parseMondayRecord($adoptee);
            return [
                'rec' => $rec,
                'image_url' => $monday->getAssetUrl($rec['image'])
            ];
        })
            ->toArray();

        // foreach adoptees, write $adoptee['rec'] to database
        foreach ($adoptees as $adoptee) {
            $rec = $adoptee['rec'];
            $rec['image'] = "/adoptee-images/" . $rec['image'];
            Adoptee::updateOrCreate(
                ['monday_id' => $adoptee['rec']['monday_id']],
                $rec
            );

            // fetch image_url to a temp directory
            $asset = $monday->getAssetUrl($adoptee['rec']['image']);
            $imageUrl = $asset->public_url;
            $extension = pathinfo($asset->name, PATHINFO_EXTENSION);
            $tempImagePath = tempnam(sys_get_temp_dir(), 'adoptee_image_');

            file_put_contents($tempImagePath, file_get_contents($imageUrl));

            // create permanent filename with $rec['image'] . "." extension
            $permanentImagePath = $imagePath . $adoptee['rec']['image'] . '.' . $extension;

            // move file from temp path to permanent location
            rename($tempImagePath, $permanentImagePath);
        }
    }
}
