<?php

namespace App\Http\Controllers\API\Booking;

use App\Http\Controllers\API\BaseAPIController;
use App\Models\Booking\Booking;
use Illuminate\Http\Request;

class BookingController extends BaseAPIController
{
    public function create(Request $request)
    {
        $request->validate([]);

        return $this->store($request, new Booking);
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([]);

        return $this->store($request, new Booking);
    }

    protected function store(Request $request, Booking $booking)
    {
        $request->validate([]);



        return $this->successResponse([]);
    }
}
