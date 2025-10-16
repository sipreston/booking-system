<?php

namespace Database\Seeders;

use App\Models\Property\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $room_types_array = [
            ['type' => 'Double', 'code' => 'DBL', 'description' => 'Double Bedroom'],
            ['type' => 'Single', 'code' => 'SNG', 'description' => 'Single Bedroom'],
            ['type' => 'Living room', 'code' => 'LVG', 'description' => 'Living room / communal area'],
            ['type' => 'Kitchen', 'code' => 'KIT', 'description' => 'Kitchen'],
            ['type' => 'Bathroom', 'code' => 'BTH', 'description' => 'Bathroom'],
            ['type' => 'Shower room', 'code' => 'SHW', 'description' => 'Separate shower room'],
            ['type' => 'Toilet', 'code' => 'TLT', 'description' => 'Separate toilet'],
            ['type' => 'Studio', 'code' => 'SDO', 'description' => 'Studio apartment'],
            ['type' => 'En-suite', 'code' => 'ENS', 'description' => 'Ensuite'],
        ];

        foreach ($room_types_array as $room_type_data) {
            $room_type = new RoomType();
            $room_type->type = $room_type_data['type'];
            $room_type->description = $room_type_data['description'];
            $room_type->code = $room_type_data['code'];

            $room_type->save();
        }
    }
}
