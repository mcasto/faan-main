<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_heartbeat',
        'data',
        'anonymous_id',
        '_id',
    ];

    protected $casts = [
        'last_heartbeat' => 'integer',
        'data' => 'array', // Automatically cast JSON to array
    ];
}
