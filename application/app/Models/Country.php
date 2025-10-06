<?php

namespace App\Models;

class Country extends Model
{
    protected $casts = [
        'name' => 'string',
        'code' => 'string',
        'iso' => 'string',
        'nice_name' => 'string',
        'iso3' => 'string',
        'num_code' => 'string',
        'phone_code' => 'string',
    ];

    protected $guarded = [];
}
