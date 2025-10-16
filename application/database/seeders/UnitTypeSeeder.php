<?php

namespace Database\Seeders;

use App\Models\Property\UnitType;
use Illuminate\Database\Seeder;

class UnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unit_types_array = [
            ['type' => 'Entire Property', 'code' => 'PRP', 'description' => 'Entire property'],
            ['type' => 'Unit', 'code' => 'UNT', 'description' => 'Unit in property'],
            ['type' => 'Apartment', 'code' => 'APT', 'description' => 'Apartment'],
        ];

        foreach ($unit_types_array as $unit_type_data) {
            $unit_type = new UnitType();
            $unit_type->type = $unit_type_data['type'];
            $unit_type->code = $unit_type_data['code'];
            $unit_type->description = $unit_type_data['description'];

            $unit_type->save();
        }
    }
}
