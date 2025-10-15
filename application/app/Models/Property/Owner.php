<?php

namespace App\Models\Property;

use App\Models\Country;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Owner extends Model
{
    protected $guarded = [];

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'address_line_1' => 'string',
        'address_line_2' => 'string',
        'city' => 'string',
        'state' => 'string',
        'county' => 'string',
        'post_code' => 'string',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
