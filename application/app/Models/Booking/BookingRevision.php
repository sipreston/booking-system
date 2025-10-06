<?php

namespace App\Models\Booking;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingRevision extends Model
{
    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
        'flattened_data' => 'array',
    ];

    protected $guarded = [];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
