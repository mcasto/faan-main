<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Adoptee extends Model
{
    protected $fillable = [
        'monday_id',
        'name',
        'image',
        'description',
        'language'
    ];

    protected $appends = ['description_text'];

    public function getDescriptionTextAttribute()
    {
        $locale = app()->getLocale();
        $filename = $this->attributes['description'] ?? null;

        if (!$filename) {
            return null;
        }

        $filePath = resource_path("lang/{$locale}/adoptions/adoptees/{$filename}");

        if (File::exists($filePath)) {
            return File::get($filePath);
        }

        return null;
    }
}
