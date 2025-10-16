<?php

namespace App\Models\Property;

use App\Models\Model;

class AvailabilityStatus extends Model
{
    protected $table = 'availability_statuses';

    protected $guarded = [];

    public static function exists(string $status): bool
    {
        return in_array($status, self::getAllStatuses());
    }

    public static function getAllStatuses(): array
    {
        return self::all()->pluck('status')->toArray();
    }
}
