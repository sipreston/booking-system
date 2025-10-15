<?php

namespace App\Models\Property;

use App\Models\Country;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Property extends Model
{
    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'standard_check_in_time' => 'integer',
        'standard_check_out_time' => 'integer',
    ];

    protected $guarded = [];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function extras(): HasMany
    {
        return $this->hasMany(PropertyExtra::class, 'property_id');
    }

    public function amenities(): HasMany
    {
        return $this->hasMany(PropertyAmenity::class, 'property_id');
    }

    public function createSlugAndSave()
    {
        if (empty($this->name)) {
            throw new \Exception('Cannot create slug with empty name');
        }

        $slug = Str::slug($this->name);

        $slug_created = false;
        $count = 0;
        do {
            if ($count >= 20) {
                throw new \Exception('Unable to create slug after 20 attempts. Has something gone wrong?');
            }

            if ($count > 0) {
                $slug = Str::slug($slug . '-' . $count);
            }

            $this->slug = $slug;

            if (! DB::table('properties')->where('slug', $slug)->exists()) {
                $this->save();
                $slug_created = true;
            } else {
                $count++;
            }
        } while ($slug_created == false);

    }
}
