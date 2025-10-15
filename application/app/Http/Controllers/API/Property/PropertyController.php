<?php

namespace App\Http\Controllers\API\Property;

use App\Http\Controllers\API\BaseAPIController;
use App\Http\Resources\Property\PropertyResource;
use App\Models\Country;
use App\Models\Property\Amenity;
use App\Models\Property\Extra;
use App\Models\Property\Owner;
use App\Models\Property\Property;
use App\Models\Property\Room;
use App\Models\Property\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends BaseAPIController
{
    public function get(Request $request, Property $property)
    {
        $request->validate([

        ]);

        return response()->json([
            'resource' => new PropertyResource($property),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([

        ]);

        $property = new Property();

        return $this->store($request, $property);
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([

        ]);

        return $this->store($request, $property);
    }

    protected function store(Request $request, Property $property)
    {
        $request->validate([

        ]);

        $property->fill($request->only([
            'name',
            'address_line_1',
            'address_line_2',
            'city',
            'county',
            'state',
            'post_code',
            'latitude',
            'longitude',
            'description',
            'standard_check_in_time',
            'standard_check_out_time',
        ]));

        $property->what_three_words_location = $request->what_three_words;

        $property_country = Country::where('iso', '=', $request->country_code)->first();
        $property->country_id = $property_country?->id;

        if (! $owner = Owner::where('email', '=', $request->owner['email'])->first()) {
            $owner = new Owner();

            $owner_details = $request->owner;

            $owner->first_name = $owner_details['first_name'];
            $owner->last_name = $owner_details['last_name'];
            $owner->email = $owner_details['email'];
            $owner->phone = $owner_details['phone'] = !empty($owner_details['phone']) ? $owner_details['phone'] : null;
            $owner->address_line_1 = !empty($owner_details['address_line_1']) ? $owner_details['address_line_1'] : null;
            $owner->address_line_2 = !empty($owner_details['address_line_2']) ? $owner_details['address_line_2'] : null;
            $owner->city = $owner_details['city'] = !empty($owner_details['city']) ? $owner_details['city'] : null;
            $owner->county = $owner_details['county'] = !empty($owner_details['county']) ? $owner_details['county'] : null;
            $owner->state = $owner_details['state'] = !empty($owner_details['state']) ? $owner_details['state'] : null;
            $owner->post_code = $owner_details['post_code'] = !empty($owner_details['post_code']) ? $owner_details['post_code'] : null;

            if (!empty ($owner_details['country_code'])) {
                $owner_country = Country::where('iso', '=', $owner_details['country_code'])->first();

                $owner->country_id = $owner_country?->id;
            }

            $owner->save();
        }

        $property->owner_id = $owner->id;

        $property->save();

        if (empty($property->slug)) {
            $property->createSlugAndSave();
        }

        if (! empty($request->units)) {
            foreach ($request->units as $unit) {
                $unitModel = Unit::where('property_id', '=', $property->id)
                    ->where('identifier', '=', $unit['identifier'])
                    ->first();

                if(! $unitModel) {
                    $unitModel = new Unit();
                    $unitModel->property_id = $property->id;
                    $unitModel->identifier = $unit['identifier'];
                    $unitModel->save();
                }

                if (! empty($unit['rooms'])) {
                    foreach ($unit['rooms'] as $room) {
                        $roomModel = Room::where('unit_id' , '=', $unitModel->id)
                            ->where('identifier', '=', $room['identifier'])
                            ->first();

                        if (! $roomModel) {
                            $roomModel = new Room();
                            $roomModel->unit_id = $unitModel->id;
                            $roomModel->identifier = $room['identifier'];
                        }

                        $roomModel->save();
                    }
                }
            }
        }

        DB::table('property_extra')->where('property_id', $property->id)->delete();

        if (! empty($request->extras)) {
            $inserts = [];
            foreach ($request->extras as $extra) {
                if (! $extraModel = Extra::where('code', $extra['code'])->first()) {
                    continue;
                }

                $inserts[] = [
                    'property_id' => $property->id,
                    'extra_id' => $extraModel->id,
                    'cost_in_pence' => $extra['price'],
                    'quantity_available' => $extra['quantity_available'],
                    'details' => $extra['details'],
                    'is_active' => $extra['available'],
                ];
            }

            DB::table('property_extra')->insert($inserts);
        }

        DB::table('property_amenities')->where('property_id', $property->id)->delete();

        if (! empty($request->amenities)) {
            $inserts = [];

            foreach ($request->amenities as $amenity) {
                if (! $amenityModel = Amenity::where('code', $amenity['code'])->first()) {
                    continue;
                }

                $inserts[] = [
                    'property_id' => $property->id,
                    'amenity_id' => $amenityModel->id,
                    'cost_in_pence' => $amenity['price'],
                    'details' => $amenity['details'],
                    'is_active' => $amenity['available'],
                ];
            }

            DB::table('property_amenities')->insert($inserts);
        }

        return response()->json([
            'resource' => new PropertyResource($property)
        ]);
    }

    public function delete(Request $request, Property $property)
    {
        $request->validate([

        ]);

        $property->is_active = false;

        $property->save();

        return response()->json([
            'success' => true,
        ]);
    }
}
