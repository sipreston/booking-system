<?php

namespace App\Models\Property;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyExtra extends Model
{
    protected $casts = [
        'cost_in_pence' => 'integer',
        'is_active' => 'boolean',
        'quantity_available' => 'integer',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function extra(): BelongsTo
    {
        return $this->belongsTo(Extra::class);
    }
}
