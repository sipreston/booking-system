<?php

namespace App\Models\Property;

use App\Models\Model;

class RoomType extends Model
{
    protected $casts = [];

    protected $guarded = [];

    public static function getAllTypeCodes(): array
    {
        return self::all()->pluck('code')->toArray();
    }
}
