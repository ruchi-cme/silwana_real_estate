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

        // Project Image Upload
        Permission::create(['name' => 'project-imageUpload']);
        Permission::create(['name' => 'project-imageUpdate']);
        Permission::create(['name' => 'project-imageStore']);

        // FAQ
        Permission::create(['name' => 'faq-view']);
        Permission::create(['name' => 'faq-create']);
        Permission::create(['name' => 'faq-update']);
        Permission::create(['name' => 'faq-delete']);
        Permission::create(['name' => 'faq-changeStatus']);
        Permission::create(['name' => 'faq-edit']);

        // Our Team
        Permission::create(['name' => 'ourTeam-view']);
        Permission::create(['name' => 'ourTeam-create']);
        Permission::create(['name' => 'ourTeam-update']);
        Permission::create(['name' => 'ourTeam-delete']);
        Permission::create(['name' => 'ourTeam-changeStatus']);
        Permission::create(['name' => 'ourTeam-edit']);

        // aboutus
        Permission::create(['name' => 'aboutus-view']);
        Permission::create(['name' => 'aboutus-create']);
        Permission::create(['name' => 'aboutus-update']);
        Permission::create(['name' => 'aboutus-delete']);
        Permission::create(['name' => 'aboutus-changeStatus']);
        Permission::create(['name' => 'aboutus-edit']);

        // News
        Permission::create(['name' => 'news-view']);
        Permission::create(['name' => 'news-create']);
        Permission::create(['name' => 'news-update']);
        Permission::create(['name' => 'news-delete']);
        Permission::create(['name' => 'news-changeStatus']);
        Permission::create(['name' => 'news-edit']);

        // media
        Permission::create(['name' => 'media-view']);
        Permission::create(['name' => 'media-create']);
        Permission::create(['name' => 'media-update']);
        Permission::create(['name' => 'media-delete']);
        Permission::create(['name' => 'media-changeStatus']);
        Permission::create(['name' => 'media-edit']);

        // aboutUsHome
        Permission::create(['name' => 'aboutUsHome-view']);
        Permission::create(['name' => 'aboutUsHome-update']);
        Permission::create(['name' => 'aboutUsHome-create']);

        // investmentHome
        Permission::create(['name' => 'investmentHome-view']);
        Permission::create(['name' => 'investmentHome-create']);
        Permission::create(['name' => 'investmentHome-update']);
        Permission::create(['name' => 'investmentHome-edit']);

        // ourProjectHome
        Permission::create(['name' => 'ourProjectHome-view']);
        Permission::create(['name' => 'ourProjectHome-create']);
        Permission::create(['name' => 'ourProjectHome-update']);
        Permission::create(['name' => 'ourProjectHome-delete']);
        Permission::create(['name' => 'ourProjectHome-changeStatus']);
        Permission::create(['name' => 'ourProjectHome-edit']);

        // featureProjectHome
        Permission::create(['name' => 'featureProjectHome-view']);
        Permission::create(['name' => 'featureProjectHome-create']);
        Permission::create(['name' => 'featureProjectHome-update']);
        Permission::create(['name' => 'featureProjectHome-delete']);
        Permission::create(['name' => 'featureProjectHome-changeStatus']);
        Permission::create(['name' => 'featureProjectHome-edit']);

        // projectAssign
        Permission::create(['name' => 'projectAssign-view']);
        Permission::create(['name' => 'projectAssign-create']);
        Permission::create(['name' => 'projectAssign-update']);
        Permission::create(['name' => 'projectAssign-delete']);
        Permission::create(['name' => 'projectAssign-changeStatus']);
        Permission::create(['name' => 'projectAssign-edit']);

        // bookMeeting
        Permission::create(['name' => 'bookMeeting-view']);
        Permission::create(['name' => 'bookMeeting-create']);
        Permission::create(['name' => 'bookMeeting-update']);
        Permission::create(['name' => 'bookMeeting-delete']);
        Permission::create(['name' => 'bookMeeting-changeStatus']);
        Permission::create(['name' => 'bookMeeting-edit']);

        // propertyBooking
        Permission::create(['name' => 'propertyBooking-list']);
        Permission::create(['name' => 'propertyBooking-view']);
        Permission::create(['name' => 'propertyBooking-update']);

        //footer
        Permission::create(['name' => 'footer-view']);
        Permission::create(['name' => 'footer-store']);
        Permission::create(['name' => 'footer-update']);

        //investService
        Permission::create(['name' => 'investService-view']);
        Permission::create(['name' => 'investService-store']);
        Permission::create(['name' => 'investService-update']);

        //buildingService
        Permission::create(['name' => 'buildingService-view']);
        Permission::create(['name' => 'buildingService-store']);
        Permission::create(['name' => 'buildingService-update']);

        //rentalService
        Permission::create(['name' => 'rentalService-view']);
        Permission::create(['name' => 'rentalService-store']);
        Permission::create(['name' => 'rentalService-update']);

        //salesService
        Permission::create(['name' => 'salesService-view']);
        Permission::create(['name' => 'salesService-store']);
        Permission::create(['name' => 'salesService-update']);

        //salesService
        Permission::create(['name' => 'inquiry-list']);
        Permission::create(['name' => 'inquiry-view']);

    }
}
