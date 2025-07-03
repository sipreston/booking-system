<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'manage-website'],
            ['name' => 'manage-content'],
            ['name' => 'manage-bookings'],
            ['name' => 'create-bookings'],
            ['name' => 'manage-users'],
            ['name' => 'create-comments'],
            ['name' => 'create-properties'],
            ['name' => 'manage-properties'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // super admin
        $super_admin_role = Role::create([
            'name' => 'Super Admin'
        ]);

        $super_admin_role->givePermissionTo([
            'manage-website',
            'manage-content',
            'create-bookings',
            'manage-bookings',
            'manage-users',
            'create-comments',
            'create-properties',
            'manage-properties',
        ]);

        // Admin
        $admin_role = Role::create(
            ['name' => 'Admin']
        );

        $admin_role->givePermissionTo([
            'manage-content',
            'manage-bookings',
            'create-bookings',
            'manage-users',
            'create-comments',
            'create-properties',
            'manage-properties',
        ]);

        // Owner
        $owner_role = Role::create([
            'name' => 'Owner'
        ]);

        $owner_role->givePermissionTo([
            'create-properties',
            'manage-properties',
            'manage-bookings',
        ]);

        // Users
        $user_role = Role::create([
            'name' => 'User',
        ]);

        $user_role->givePermissionTo([
            'create-bookings',
            'create-comments',
        ]);
    }
}
