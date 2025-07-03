<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = new User([
            'name' => 'simon',
            'email' => 'simon@bookingsystem.in',
            'password' => Hash::make('password456'),
            'email_verified_at' => Carbon::now(),
        ]);

        $super_admin->save();

        $super_admin->assignRole('Super Admin');
        $super_admin->assignRole('Admin');

        $user = new User([
            'name' => 'Yu Zer',
            'email' => 'user@bookingsystem.in',
            'password' => Hash::make('password456'),
            'email_verified_at' => Carbon::now(),
        ]);

        $user->save();
        $user->assignRole('User');

        $owner = new User([
            'name' => 'Oh Ner',
            'email' => 'owner@bookingsystem.in',
            'password' => Hash::make('password456'),
            'email_verified_at' => Carbon::now(),
        ]);

        $owner->save();
        $owner->assignRole('Owner');
    }/**/
}
