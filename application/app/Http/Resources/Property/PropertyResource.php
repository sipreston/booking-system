<?php

namespace App\Http\Resources\Property;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    public function toArray($request): array
    {
        $property = $this->resource;

        $data = [
            'property' => [
                'id' => $property->id,
                'name' => $property->name,
                'slug' => $property->slug,
                'active' => $property->is_active,
                'address_line_1' => $property->address,
                'address_line_2' => $property->address,
                'city' => $property->city,
                'state' => $property->state,
                'post_code' => $property->post_code,
                'country' => $property->country->name,
                'description' => $property->description,
                'latitude' => $property->latitude,
                'longitude' => $property->longitude,
                'what_three_words' => $property->what_three_words_location,
                'standard_check_in_time' => $property->standard_check_in_time,
                'standard_check_out_time' => $property->standard_check_out_time,
                'images' => $property->images,
            ],
            'owner' => [
                'id' => $property->owner->id,
                'first_name' => $property->owner->first_name,
                'last_name' => $property->owner->last_name,
                'email' => $property->owner->email,
                'phone' => $property->owner->phone,
            ]
        ];

        return $data;
    }
}
