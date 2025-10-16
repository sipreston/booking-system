<?php

namespace App\Http\Controllers\API\Property;

use App\Exceptions\API\Property\PropertyException;
use App\Http\Controllers\API\BaseAPIController;
use App\Http\Resources\Property\AvailabilityResource;
use App\Models\Property\Property;
use App\Models\Property\PropertyAvailability;
use App\Models\Property\Unit;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\Exceptions\UnitException;
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
        if (! $property->id) {
            throw new PropertyException("Property not found");
        }

        $request->validate([]);

        if (! empty($request->units)) {
            foreach ($request->units as $unit_data) {
                if (empty($unit_data['identifier'])) {
                    throw new UnitException("No unit identifier provided");
                }

                $date_format = config('app.date_format');

                $unit = Unit::where('property_id', $property->id)
                    ->where('identifier', $unit_data['identifier'])
                    ->first();

                if (! $unit) {
                    throw new UnitException("Did not find unit with identifier " . $unit_data['identifier']);
                }

                foreach ($unit_data['dates'] as $date_data) {
                    $date_from = Carbon::createFromFormat($date_format, $date_data['date_from'])->startOfDay();
                    $date_to = Carbon::createFromFormat($date_format, $date_data['date_to'])->startOfDay();
                    $status = $date_data['status'] ?? 'blocked'; // fallback if no status provided

                    $date_period = new CarbonPeriod($date_from, $date_to);

                    foreach ($date_period as $date) {
                        $property_availability = PropertyAvailability::where('property_id', $property->id)
                            ->firstOrNew([
                                'property_id' => $property->id,
                                'unit_id' => $unit->id,
                                'date' => $date->format($date_format)
                            ]);

                        if (array_key_exists('price', $date_data)) {
                            $property_availability->cost_in_pence = (int)$date_data['price'];
                        } else {
                            $status = 'blocked'; // If no price is provided. Block it from sale.
                        }

                        $property_availability->status = $status;
                        $property_availability->save();
                    }
                }
            }

        }

        if (! empty($request->units)) {
            // Unit availability

        }

        return response()->json([
            'resource' => new AvailabilityResource($property),
        ]);
    }
}
