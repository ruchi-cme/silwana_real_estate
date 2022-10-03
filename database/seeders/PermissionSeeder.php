<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // User
        Permission::create(['name' => 'user-view']);
        Permission::create(['name' => 'user-create']);
        Permission::create(['name' => 'user-delete']);
        Permission::create(['name' => 'user-profile']);
        Permission::create(['name' => 'user-update']);

        // Permission
        Permission::create(['name' => 'permission-view']);

        // Role
        Permission::create(['name' => 'role-view']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-update']);
        Permission::create(['name' => 'role-delete']);

    }
}
