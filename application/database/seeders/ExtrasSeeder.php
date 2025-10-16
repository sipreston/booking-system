<?php

namespace Database\Seeders;

use App\Models\Property\Extra;
use Illuminate\Database\Seeder;

class ExtrasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extras = [
            ['code' => 'HIRE', 'name' => 'Car hire'],
            ['code' => 'CLNG', 'name' => 'Cleaning'],
            ['code' => 'FDVY', 'name' => 'Food delivery'],
        ];

        foreach ($extras as $extra) {
            Extra::create($extra);
        }
    }
}
