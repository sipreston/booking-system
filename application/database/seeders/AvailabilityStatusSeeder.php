<?php

namespace Database\Seeders;

use App\Models\Property\AvailabilityStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvailabilityStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_array = [
            ['status' => 'booked'], // Property has been booked and paid for
            ['status' => 'available'], // Property is available for booking
            ['status' => 'blocked'], // Property is not available for booking
            ['status' => 'reserved'], // Booking has been created, but no payment taken
        ];

        foreach ($status_array as $status) {
            AvailabilityStatus::create($status);
        }
    }
}
