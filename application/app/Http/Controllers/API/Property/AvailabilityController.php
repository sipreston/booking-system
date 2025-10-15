<?php

namespace App\Http\Controllers\API\Property;

use App\Http\Controllers\API\BaseAPIController;
use App\Http\Resources\Property\AvailabilityResource;
use App\Models\Property\Property;
use Illuminate\Http\Request;

class AvailabilityController extends BaseAPIController
{
    public function getForProperty(Request $request, Property $property)
    {
        $request->validate([]);

        return response()->json([
            'resource' => new AvailabilityResource($property),
        ]);
    }
    public function setForProperty(Request $request, Property $property)
    {
        $request->validate([]);



        return response()->json([
            'resource' => new AvailabilityResource($property),
        ]);
    }
}
