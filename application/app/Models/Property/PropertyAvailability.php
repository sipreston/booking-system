<?php

namespace App\Models\Property;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyAvailability extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
