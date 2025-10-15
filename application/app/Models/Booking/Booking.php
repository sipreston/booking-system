<?php

namespace App\Models\Booking;

use App\Models\Customer;
use App\Models\Model;
use App\Models\Property\Property;
use App\Models\Property\Room;
use App\Models\Property\Unit;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date_from' => 'date',
        'date_to' => 'date',
        'contact_email' => 'email',
        'check_in_time' => 'integer',
        'check_out_time' => 'integer',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function guests(): HasMany
    {
        return $this->hasMany(BookingGuest::class, 'booking_id');
    }
}
