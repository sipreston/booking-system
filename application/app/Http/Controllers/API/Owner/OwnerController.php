<?php

namespace App\Http\Controllers\API\Owner;

use App\Http\Controllers\API\BaseAPIController;
use App\Http\Resources\Owner\OwnerResource;
use App\Models\Country;
use App\Models\Property\Owner;
use Illuminate\Http\Request;

class OwnerController extends BaseAPIController
{
    public function get(Request $request, Owner $owner)
    {
        $request->validate([

        ]);

        return response()->json([
            'resource' => new OwnerResource($owner),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([

        ]);

        if (Owner::where('email', '=', $request->email)->exists()) {
            return $this->errorResponse('User with email '. $request->email . ' already exists');
        }

        $owner = new Owner();

        return $this->store($request, $owner);
    }

    public function update(Request $request, Owner $owner)
    {
        $request->validate([]);



        return $this->store($request, $owner);
    }

    protected function store(Request $request, Owner $owner)
    {
        $request->validate([

        ]);

        $owner->fill($request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'address_line_1',
            'address_line_2',
            'city',
            'county',
            'state',
            'post_code',
        ]));

        if ($country = Country::where('iso', '=', $request->country_code)->first()) {
            $owner->country_id = $country->id;
        }

        $owner->save();

        return response()->json([
            'resource' => new OwnerResource($owner),
        ]);
    }
}
