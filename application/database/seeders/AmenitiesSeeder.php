<?php

namespace Database\Seeders;

use App\Models\Property\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            ['code' => 'SHWR', 'name' => 'Shower'],
            ['code' => 'KCHN', 'name' => 'Kitchen'],
            ['code' => 'TELE', 'name' => 'Television'],
            ['code' => 'CBLE', 'name' => 'Cable/Satellite TV'],
            ['code' => 'INTR', 'name' => 'Internet'],
            ['code' => 'WLSS', 'name' => 'Wireless'],
            ['code' => 'DVD', 'name' => 'DVD Player'],
            ['code' => 'GRGE', 'name' => 'Garage'],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}
