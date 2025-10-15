<?php

namespace App\Models\Booking;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingGuest extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'age' => 'integer',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
