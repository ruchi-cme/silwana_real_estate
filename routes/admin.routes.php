<?php

use Illuminate\Support\Facades\Route;

//Dashboard
Route::name('admin')->get('/', 'App\Http\Controllers\Admin\DashboardController@index');

//User Management
Route::name('user')->get('/user', 'App\Http\Controllers\Admin\UserController@index')->middleware(['permission:user-view']);
Route::name('user.create')->get('/user/create', 'App\Http\Controllers\Admin\UserController@create')->middleware(['permission:user-create']);
Route::name('user.store')->post('/user/store', 'App\Http\Controllers\Admin\UserController@store')->middleware(['permission:user-create']);
Route::name('user.profile')->get('/user/profile/{id}', 'App\Http\Controllers\Admin\UserController@profile')->middleware(['permission:user-profile']);
Route::name('user.update.email')->post('/user/update/email', 'App\Http\Controllers\Admin\UserController@updateEmail')->middleware(['permission:user-update']);
Route::name('user.check.email')->get('/user/check/email', 'App\Http\Controllers\Admin\UserController@checkEmail');
Route::name('user.delete')->get('/user/delete/{id}', 'App\Http\Controllers\Admin\UserController@destroy');

Route::name('user.profile')->get('/user/viewProfile', 'App\Http\Controllers\Admin\UserController@viewProfile')->middleware(['permission:user-profile']);;
Route::name('user.editProfile')->get('/user/editProfile', 'App\Http\Controllers\Admin\UserController@editProfile')->middleware(['permission:user-editProfile']);;
Route::name('user.updateProfile')->post('/user/updateProfile', 'App\Http\Controllers\Admin\UserController@updateProfile')->middleware(['permission:user-updateProfile']);;
Route::name('user.updatePassword')->post('/user/updatePassword', 'App\Http\Controllers\Admin\UserController@updatePassword')->middleware(['permission:user-updatePassword']);;

//Roles
Route::name('role')->get('/role', 'App\Http\Controllers\Admin\RoleController@index');
Route::name('role.create')->get('/role/create', 'App\Http\Controllers\Admin\RoleController@create');
Route::name('role.store')->post('/role/store', 'App\Http\Controllers\Admin\RoleController@store');
Route::name('role.edit')->get('/role/edit/{id}', 'App\Http\Controllers\Admin\RoleController@edit');
Route::name('role.view')->get('/role/view/{id}', 'App\Http\Controllers\Admin\RoleController@view');
Route::name('role.update')->post('/role/update', 'App\Http\Controllers\Admin\RoleController@update');
Route::name('role.delete')->get('/role/delete/{id}', 'App\Http\Controllers\Admin\RoleController@delete');

//Permission
Route::name('permission')->get('/permission', 'App\Http\Controllers\Admin\PermissionController@index');
Route::name('permission.check')->get('/permission/check', 'App\Http\Controllers\Admin\PermissionController@check');
Route::name('permission.store')->post('/permission/store', 'App\Http\Controllers\Admin\PermissionController@store');
Route::name('permission.delete')->get('/permission/store/delete/{id}', 'App\Http\Controllers\Admin\PermissionController@delete');

// Property/Category Type
Route::name('category')->get('/category', 'App\Http\Controllers\Admin\CategoryController@index')->middleware(['permission:category-view']);
Route::name('category.create')->get('/category/create', 'App\Http\Controllers\Admin\CategoryController@create')->middleware(['permission:category-create']);
Route::name('category.create/{id}')->get('/category/create/{id}', 'App\Http\Controllers\Admin\CategoryController@create')->middleware(['permission:category-create']);
Route::name('category.store')->post('/category/store', 'App\Http\Controllers\Admin\CategoryController@store')->middleware(['permission:category-create']);
 Route::name('category.update')->post('/category/update', 'App\Http\Controllers\Admin\CategoryController@update')->middleware(['permission:category-update']);
 Route::name('category.delete')->get('/category/delete/{id}', 'App\Http\Controllers\Admin\CategoryController@delete')->middleware(['permission:category-delete']);
Route::name('category.delete')->get('/category/changeStatus/{id}', 'App\Http\Controllers\Admin\CategoryController@changeStatus')->middleware(['permission:category-changeStatus']);



// About Silwana
Route::name('silwana')->get('/silwana', 'App\Http\Controllers\Admin\SilwanaController@index')->middleware(['permission:silwana-view']);
Route::name('silwana.create')->get('/silwana/create', 'App\Http\Controllers\Admin\SilwanaController@create')->middleware(['permission:silwana-create']);
Route::name('silwana.create/{id}')->get('/silwana/create/{id}', 'App\Http\Controllers\Admin\SilwanaController@create')->middleware(['permission:silwana-create']);
Route::name('silwana.store')->post('/silwana/store', 'App\Http\Controllers\Admin\SilwanaController@store')->middleware(['permission:silwana-create']);
Route::name('silwana.update')->post('/silwana/update', 'App\Http\Controllers\Admin\SilwanaController@update')->middleware(['permission:silwana-update']);
Route::name('silwana.delete')->get('/silwana/delete/{id}', 'App\Http\Controllers\Admin\SilwanaController@delete')->middleware(['permission:silwana-delete']);
Route::name('silwana.delete')->get('/silwana/changeStatus/{id}', 'App\Http\Controllers\Admin\SilwanaController@changeStatus')->middleware(['permission:silwana-changeStatus']);


// Aminities
Route::name('amenities')->get('/amenities', 'App\Http\Controllers\Admin\AmenitiesController@index')->middleware(['permission:amenities-view']);
Route::name('amenities.create')->get('/amenities/create', 'App\Http\Controllers\Admin\AmenitiesController@create')->middleware(['permission:amenities-create']);
Route::name('amenities.edit/{id}')->get('/amenities/edit/{id}', 'App\Http\Controllers\Admin\AmenitiesController@edit')->middleware(['permission:amenities-create']);
Route::name('amenities.store')->post('/amenities/store', 'App\Http\Controllers\Admin\AmenitiesController@store')->middleware(['permission:amenities-create']);
Route::name('amenities.update')->post('/amenities/update', 'App\Http\Controllers\Admin\AmenitiesController@update')->middleware(['permission:amenities-update']);
Route::name('amenities.delete')->get('/amenities/delete/{id}', 'App\Http\Controllers\Admin\AmenitiesController@destroy')->middleware(['permission:amenities-delete']);
Route::name('amenities.delete')->get('/amenities/changeStatus/{id}', 'App\Http\Controllers\Admin\AmenitiesController@changeStatus')->middleware(['permission:amenities-changeStatus']);


// Builder Details
Route::name('builder')->get('/builder', 'App\Http\Controllers\Admin\BuilderController@index')->middleware(['permission:builder-view']);
Route::name('builder.create')->get('/builder/create', 'App\Http\Controllers\Admin\BuilderController@create')->middleware(['permission:builder-create']);
Route::name('builder.edit/{id}')->get('/builder/edit/{id}', 'App\Http\Controllers\Admin\BuilderController@edit')->middleware(['permission:builder-create']);
Route::name('builder.store')->post('/builder/store', 'App\Http\Controllers\Admin\BuilderController@store')->middleware(['permission:builder-create']);
Route::name('builder.update')->post('/builder/update', 'App\Http\Controllers\Admin\BuilderController@update')->middleware(['permission:builder-update']);
Route::name('builder.delete')->get('/builder/delete/{id}', 'App\Http\Controllers\Admin\BuilderController@destroy')->middleware(['permission:builder-delete']);
Route::name('builder.delete')->get('/builder/changeStatus/{id}', 'App\Http\Controllers\Admin\BuilderController@changeStatus')->middleware(['permission:builder-changeStatus']);

// Project Details
Route::name('project')->get('/project', 'App\Http\Controllers\Admin\ProjectController@index')->middleware(['permission:project-view']);
Route::name('project.create')->get('/project/create', 'App\Http\Controllers\Admin\ProjectController@create')->middleware(['permission:project-create']);
Route::name('project.edit/{id}')->get('/project/edit/{id}', 'App\Http\Controllers\Admin\ProjectController@edit')->middleware(['permission:project-create']);
Route::name('project.store')->post('/project/store', 'App\Http\Controllers\Admin\ProjectController@store')->middleware(['permission:project-create']);
Route::name('project.update')->post('/project/update', 'App\Http\Controllers\Admin\ProjectController@update')->middleware(['permission:project-update']);
Route::name('project.delete')->get('/project/delete/{id}', 'App\Http\Controllers\Admin\ProjectController@destroy')->middleware(['permission:project-delete']);
Route::name('project.delete')->get('/project/changeStatus/{id}', 'App\Http\Controllers\Admin\ProjectController@changeStatus')->middleware(['permission:project-changeStatus']);

// Block Details
Route::name('block')->get('/block', 'App\Http\Controllers\Admin\BlockController@index')->middleware(['permission:block-view']);
Route::name('block.create')->get('/block/create', 'App\Http\Controllers\Admin\BlockController@create')->middleware(['permission:block-create']);
Route::name('block.edit/{id}')->get('/block/edit/{id}', 'App\Http\Controllers\Admin\BlockController@edit')->middleware(['permission:block-create']);
Route::name('block.store')->post('/block/store', 'App\Http\Controllers\Admin\BlockController@store')->middleware(['permission:block-create']);
Route::name('block.update')->post('/block/update', 'App\Http\Controllers\Admin\BlockController@update')->middleware(['permission:block-update']);
Route::name('block.delete')->get('/block/delete/{id}', 'App\Http\Controllers\Admin\BlockController@destroy')->middleware(['permission:block-delete']);
Route::name('block.delete')->get('/block/changeStatus/{id}', 'App\Http\Controllers\Admin\BlockController@changeStatus')->middleware(['permission:block-changeStatus']);


// Floor Details
Route::name('floor')->get('/floor', 'App\Http\Controllers\Admin\BlockFloorMappingController@index')->middleware(['permission:floor-view']);
Route::name('floor.create')->get('/floor/create', 'App\Http\Controllers\Admin\BlockFloorMappingController@create')->middleware(['permission:floor-create']);
Route::name('floor.edit/{id}')->get('/floor/edit/{id}', 'App\Http\Controllers\Admin\BlockFloorMappingController@edit')->middleware(['permission:floor-create']);
Route::name('floor.store')->post('/floor/store', 'App\Http\Controllers\Admin\BlockFloorMappingController@store')->middleware(['permission:floor-create']);
Route::name('floor.update')->post('/floor/update', 'App\Http\Controllers\Admin\BlockFloorMappingController@update')->middleware(['permission:floor-update']);
Route::name('floor.delete')->get('/floor/delete/{id}', 'App\Http\Controllers\Admin\BlockFloorMappingController@destroy')->middleware(['permission:floor-delete']);
Route::name('floor.delete')->get('/floor/changeStatus/{id}', 'App\Http\Controllers\Admin\BlockFloorMappingController@changeStatus')->middleware(['permission:floor-changeStatus']);


// Unit Details
Route::name('unit')->get('/unit', 'App\Http\Controllers\Admin\FloorUnitMappingController@index')->middleware(['permission:unit-view']);
Route::name('unit.create')->get('/unit/create', 'App\Http\Controllers\Admin\FloorUnitMappingController@create')->middleware(['permission:unit-create']);
Route::name('unit.edit/{id}')->get('/unit/edit/{id}', 'App\Http\Controllers\Admin\FloorUnitMappingController@edit')->middleware(['permission:unit-create']);
Route::name('unit.store')->post('/unit/store', 'App\Http\Controllers\Admin\FloorUnitMappingController@store')->middleware(['permission:unit-create']);
Route::name('unit.update')->post('/unit/update', 'App\Http\Controllers\Admin\FloorUnitMappingController@update')->middleware(['permission:unit-update']);
Route::name('unit.delete')->get('/unit/delete/{id}', 'App\Http\Controllers\Admin\FloorUnitMappingController@destroy')->middleware(['permission:unit-delete']);
Route::name('unit.delete')->get('/unit/changeStatus/{id}', 'App\Http\Controllers\Admin\FloorUnitMappingController@changeStatus')->middleware(['permission:unit-changeStatus']);


// Unit Details
Route::name('contactus')->get('/contactus', 'App\Http\Controllers\Admin\ContactUsController@index')->middleware(['permission:contactus-view']);
Route::name('contactus.create')->get('/contactus/create', 'App\Http\Controllers\Admin\ContactUsController@create')->middleware(['permission:contactus-create']);
Route::name('contactus.edit/{id}')->get('/contactus/edit/{id}', 'App\Http\Controllers\Admin\ContactUsController@edit')->middleware(['permission:contactus-create']);
Route::name('contactus.store')->post('/contactus/store', 'App\Http\Controllers\Admin\ContactUsController@store')->middleware(['permission:contactus-create']);
Route::name('contactus.update')->post('/contactus/update', 'App\Http\Controllers\Admin\ContactUsController@update')->middleware(['permission:contactus-update']);
Route::name('contactus.delete')->get('/contactus/delete/{id}', 'App\Http\Controllers\Admin\ContactUsController@destroy')->middleware(['permission:contactus-delete']);
Route::name('contactus.delete')->get('/contactus/changeStatus/{id}', 'App\Http\Controllers\Admin\ContactUsController@changeStatus')->middleware(['permission:contactus-changeStatus']);

?>
