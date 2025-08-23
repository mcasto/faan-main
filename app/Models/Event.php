<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'starts',
        'expires',
        'hide_dates',
        'is_active',
        'slug'
    ];

    protected $casts = [
        'starts' => 'date',
        'expires' => 'date',
        'hide_dates' => 'boolean',
        'is_active' => 'boolean',
    ];
}
