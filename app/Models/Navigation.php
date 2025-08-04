<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;

    protected $table = 'navigation';

    protected $fillable = [
        'sort_order',
        'name_en',
        'name_es',
        'path',
        'component_name',
        'source',
        'visible',
        'parent_id',
        'external',
        'external_blank',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'visible' => 'boolean',
        'parent_id' => 'integer',
        'external' => 'boolean',
        'external_blank' => 'boolean',
    ];

    /**
     * Get the parent navigation item.
     */
    public function parent()
    {
        return $this->belongsTo(Navigation::class, 'parent_id');
    }

    /**
     * Get the child navigation items.
     */
    public function children()
    {
        return $this->hasMany(Navigation::class, 'parent_id');
    }

    /**
     * Scope to get only visible navigation items.
     */
    public function scopeVisible($query)
    {
        return $query->where('visible', true);
    }

    /**
     * Scope to get navigation items ordered by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Scope to get top-level navigation items (no parent).
     */
    public function scopeTopLevel($query)
    {
        return $query->where(function ($q) {
            $q->where('parent_id', 0)
                ->orWhereNull('parent_id');
        });
    }
}
