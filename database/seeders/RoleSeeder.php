<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // By default admin will inherit all the permissions
        $superRole = Role::create(['name' => 'admin']);
        $superRole->givePermissionTo(Permission::all());

        // Create Admin Role Without Delete Permission
        $role = Role::create(['name' => 'employee']);
        $role->givePermissionTo([
            'user-view',
        ]);

        // Create Admin Role Without Delete Permission
        $role = Role::create(['name' => 'broker']);
        $role->givePermissionTo([
            'user-view',
        ]);

        // Create Admin Role Without Delete Permission
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo([
            'user-view',
        ]);

    }
}
