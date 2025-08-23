<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'contact_name',
        'email',
        'phone',
        'subject',
        'message',
        'join_mailing_list',
        'recaptcha_score',
    ];
}
