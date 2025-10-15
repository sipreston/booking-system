<?php

namespace App\Models\Property;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    protected $casts = [

    ];

    protected $guarded = [];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'unit_id');
    }
}
