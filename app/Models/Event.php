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

    /**
     * Get the HTML content for this event based on its ID
     */
    public function getContentAttribute()
    {
        $htmlPath = "events/{$this->id}.html";

        if (Storage::disk('public')->exists($htmlPath)) {
            return Storage::disk('public')->get($htmlPath);
        }

        return null;
    }

    /**
     * Save HTML content for this event
     */
    public function saveContent($content)
    {
        $htmlPath = "events/{$this->id}.html";
        Storage::disk('public')->put($htmlPath, $content);
    }

    /**
     * Delete HTML content file when model is deleted
     */
    protected static function booted()
    {
        static::deleting(function ($event) {
            $htmlPath = "events/{$event->id}.html";
            if (Storage::disk('public')->exists($htmlPath)) {
                Storage::disk('public')->delete($htmlPath);
            }
        });
    }

    /**
     * Scope for active events
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for current events (within date range)
     */
    public function scopeCurrent($query)
    {
        $today = Carbon::today();
        return $query->where('starts', '<=', $today)
            ->where('expires', '>=', $today);
    }

    /**
     * Scope for upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('starts', '>', Carbon::today());
    }

    /**
     * Get events suitable for "Latest News" display
     */
    public function scopeLatestNews($query)
    {
        return $query->active()->current()->orderBy('starts', 'desc');
    }
}
