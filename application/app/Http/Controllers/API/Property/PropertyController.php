<?php

namespace App\Http\Controllers\API\Property;

use App\Http\Controllers\API\BaseAPIController;
use App\Http\Resources\Property\PropertyResource;
use App\Models\Country;
use App\Models\Property\Owner;
use App\Models\Property\Property;
use Illuminate\Http\Request;

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

        if (empty ($property)) {
            $property->createSlugAndSave();
        }

        return response()->json([
            'property' => new PropertyResource($property)
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
