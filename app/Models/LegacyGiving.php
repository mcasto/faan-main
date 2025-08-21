<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegacyGiving extends Model
{
    protected $fillable = [
        'legal_name_of_donor',
        'phone',
        'cedula_passport',
        'email',
        'address',
        'special_instructions',
        'recognized',
        'donation_type'
    ];
}
