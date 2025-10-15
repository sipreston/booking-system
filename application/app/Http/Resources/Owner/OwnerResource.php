<?php

namespace App\Http\Resources\Owner;

use Illuminate\Http\Resources\Json\JsonResource;

class OwnerResource extends JsonResource
{
    public function toArray($request)
    {
        $owner = $this->resource;

        return $owner->toArray();
    }
}
