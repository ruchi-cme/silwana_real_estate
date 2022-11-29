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

        // Create employee Without Delete Permission
        $role = Role::create(['name' => 'employee']);
        //$per =  ['user-view','role-view','role-create','role-update','role-delete','permission-view'];
        //$permission  = Permission::whereNotIn('name',$per)->get();
      //  $role->givePermissionTo($permission);

        $role->givePermissionTo([
                'user-create',
                'user-delete',
                'user-profile',
                'user-update',
               'category-view',
                'category-create',
                'category-update',
                'category-delete',
                'category-changeStatus',
                'amenities-view',
                'amenities-create',
                'amenities-update',
                'amenities-delete',
                'amenities-changeStatus',
                'amenities-edit',
                'project-view',
                'project-create',
                'project-update',
                'project-delete',
                'project-changeStatus',
                'project-edit',
                'block-view',
                'block-create',
                'block-update',
                'block-delete',
                'block-changeStatus',
                'block-edit',
                'unit-view',
                'unit-create',
                'unit-update',
                'unit-delete',
                'unit-changeStatus',
                'unit-edit',
                'floor-view',
                'floor-create',
                'floor-update',
                'floor-delete',
                'floor-changeStatus',
                'floor-edit',
                'user-editProfile',
                'user-updatePassword',
                'user-updateProfile',
                'project-imageUpload',
                'project-imageUpdate',
                'project-imageStore',
                'projectAssign-view',
                'projectAssign-create',
                'projectAssign-update',
                'projectAssign-delete',
                'projectAssign-changeStatus',
                'projectAssign-edit',
                'bookMeeting-view',
                'bookMeeting-create',
                'bookMeeting-update',
                'bookMeeting-delete',
                'bookMeeting-changeStatus',
                'bookMeeting-edit',
                'propertyBooking-list',
                'propertyBooking-view',
                'propertyBooking-update',
                'inquiry-list',
                 'inquiry-view',
                'projectDetail-view'
        ]);



        // Create [ Without Delete Permission
        $role = Role::create(['name' => 'broker']);
        $role->givePermissionTo([
            'project-view',
            'projectDetail-view',
            'projectDetail-view'
        ]);

        // Create user Without Delete Permission
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo([
            'user-profile',
            'user-update',
            'user-editProfile',
            'user-updatePassword',
            'user-updateProfile'
        ]);

    }
}
