<?php

namespace App\Models\Property;

use App\Models\Country;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'standard_check_in_time' => 'integer',
        'standard_check_out_time' => 'integer',
    ];

    protected $guarded = [];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function extras(): HasMany
    {
        return $this->hasMany(PropertyExtra::class, 'property_id');
    }

    public function amenities(): HasMany
    {
        return $this->hasMany(PropertyAmenity::class, 'property_id');
    }
}
