<?php

namespace App\Models\Property;

use App\Models\Model;

class UnitType extends Model
{
    protected $casts = [];

    protected $guarded = [];

    public static function getAllTypeCodes(): array
    {
        return self::all()->pluck('type_code')->toArray();
    }
}
