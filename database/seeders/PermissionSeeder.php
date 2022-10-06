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

        // Category
        Permission::create(['name' => 'category-view']);
        Permission::create(['name' => 'category-create']);
        Permission::create(['name' => 'category-update']);
        Permission::create(['name' => 'category-delete']);
        Permission::create(['name' => 'category-changeStatus']);

        // Silwana
        Permission::create(['name' => 'silwana-view']);
        Permission::create(['name' => 'silwana-create']);
        Permission::create(['name' => 'silwana-update']);
        Permission::create(['name' => 'silwana-delete']);
        Permission::create(['name' => 'silwana-changeStatus']);

        // Amenities
        Permission::create(['name' => 'amenities-view']);
        Permission::create(['name' => 'amenities-create']);
        Permission::create(['name' => 'amenities-update']);
        Permission::create(['name' => 'amenities-delete']);
        Permission::create(['name' => 'amenities-changeStatus']);
        Permission::create(['name' => 'amenities-edit']);

        // Builder
        Permission::create(['name' => 'builder-view']);
        Permission::create(['name' => 'builder-create']);
        Permission::create(['name' => 'builder-update']);
        Permission::create(['name' => 'builder-delete']);
        Permission::create(['name' => 'builder-changeStatus']);
        Permission::create(['name' => 'builder-edit']);

        // Project
        Permission::create(['name' => 'project-view']);
        Permission::create(['name' => 'project-create']);
        Permission::create(['name' => 'project-update']);
        Permission::create(['name' => 'project-delete']);
        Permission::create(['name' => 'project-changeStatus']);
        Permission::create(['name' => 'project-edit']);

        // Block
        Permission::create(['name' => 'block-view']);
        Permission::create(['name' => 'block-create']);
        Permission::create(['name' => 'block-update']);
        Permission::create(['name' => 'block-delete']);
        Permission::create(['name' => 'block-changeStatus']);
        Permission::create(['name' => 'block-edit']);


        // Unit
        Permission::create(['name' => 'unit-view']);
        Permission::create(['name' => 'unit-create']);
        Permission::create(['name' => 'unit-update']);
        Permission::create(['name' => 'unit-delete']);
        Permission::create(['name' => 'unit-changeStatus']);
        Permission::create(['name' => 'unit-edit']);

        // Floor
        Permission::create(['name' => 'floor-view']);
        Permission::create(['name' => 'floor-create']);
        Permission::create(['name' => 'floor-update']);
        Permission::create(['name' => 'floor-delete']);
        Permission::create(['name' => 'floor-changeStatus']);
        Permission::create(['name' => 'floor-edit']);


        // User profile
        Permission::create(['name' => 'user-editProfile']);
        Permission::create(['name' => 'user-updatePassword']);
        Permission::create(['name' => 'user-updateProfile']);

        // contactus
        Permission::create(['name' => 'contactus-view']);
        Permission::create(['name' => 'contactus-create']);
        Permission::create(['name' => 'contactus-update']);
        Permission::create(['name' => 'contactus-delete']);
        Permission::create(['name' => 'contactus-changeStatus']);
        Permission::create(['name' => 'contactus-edit']);
    }
}
