<?php

namespace App\Models\Finance;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Refund extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date',
        'amount_in_pence' => 'integer',
        'notes' => 'array',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
