<?php

namespace App\Models\Finance;

use App\Models\Booking\Booking;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $casts = [
        'payment_due_date' => 'date',
        'cost_in_pence' => 'integer',
        'vat_rate' => 'double',
        'lines' => 'array',
    ];

    protected $guarded = [];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }
}
