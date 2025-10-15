<?php

namespace App\Models\Property;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyAmenity extends Model
{
    public $timestamps = false;

    public $table = 'property_amenities';
    protected $guarded = [];

    protected $casts = [
        'cost_in_pence' => 'integer',
        'is_active' => 'boolean',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function amenity(): BelongsTo
    {
        return $this->belongsTo(Amenity::class);
    }
}
