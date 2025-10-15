<?php

namespace App\Http\Resources\Property;

use Illuminate\Http\Resources\Json\JsonResource;

class AvailabilityResource extends JsonResource
{
    public function toArray($request)
    {
        $property = $this->resource;

        $data = [
            'property_id' => $property->id,
        ];

        return $data;
    }
}
