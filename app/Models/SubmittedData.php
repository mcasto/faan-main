<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmittedData extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        '_id',
        'rec',
        'send_response',
    ];

    protected $casts = [
        'send_response' => 'array', // Automatically cast JSON to array
    ];

    /**
     * Scope to filter by data type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to get donations.
     */
    public function scopeDonations($query)
    {
        return $query->where('type', 'donations');
    }

    /**
     * Scope to get contacts.
     */
    public function scopeContacts($query)
    {
        return $query->where('type', 'contacts');
    }

    /**
     * Scope to get legacy giving records.
     */
    public function scopeLegacyGiving($query)
    {
        return $query->where('type', 'legacy_giving');
    }

    /**
     * Check if the record has a response.
     */
    public function hasResponse()
    {
        return !is_null($this->send_response);
    }

    /**
     * Check if the response was successful (status code 202).
     */
    public function wasSuccessful()
    {
        if (!$this->hasResponse()) {
            return false;
        }

        $response = $this->send_response;
        return isset($response['send_response']['statusCode']) &&
            $response['send_response']['statusCode'] === 202;
    }
}
