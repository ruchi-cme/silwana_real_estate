<?php

use Illuminate\Support\Facades\Route;

//Dashboard
Route::name('admin')->get('/', 'App\Http\Controllers\Admin\DashboardController@index');

//Booking
Route::name('booking')->get('/booking', 'App\Http\Controllers\Admin\BookingController@index');
Route::name('booking.view')->get('/booking/view/{id}', 'App\Http\Controllers\Admin\BookingController@view');
Route::name('booking/update/{id}')->post('/booking/update/{id}', 'App\Http\Controllers\Admin\BookingController@updateBooking');


//User Management
Route::name('user')->get('/user', 'App\Http\Controllers\Admin\UserController@index')->middleware(['permission:user-view']);
Route::name('user.create')->get('/user/create', 'App\Http\Controllers\Admin\UserController@create')->middleware(['permission:user-create']);
Route::name('user.store')->post('/user/store', 'App\Http\Controllers\Admin\UserController@store')->middleware(['permission:user-create']);
Route::name('user.profile')->get('/user/profile/{id}', 'App\Http\Controllers\Admin\UserController@profile')->middleware(['permission:user-profile']);
Route::name('user.update.email')->post('/user/update/email', 'App\Http\Controllers\Admin\UserController@updateEmail')->middleware(['permission:user-update']);
Route::name('user.check.email')->get('/user/check/email', 'App\Http\Controllers\Admin\UserController@checkEmail');
Route::name('user.delete')->get('/user/delete/{id}', 'App\Http\Controllers\Admin\UserController@destroy');

Route::name('user.profile')->get('/user/viewProfile', 'App\Http\Controllers\Admin\UserController@viewProfile')->middleware(['permission:user-profile']);;
Route::name('user.editProfile')->get('/user/editProfile/{id}', 'App\Http\Controllers\Admin\UserController@editProfile')->middleware(['permission:user-editProfile']);;
Route::name('user.updateProfile')->post('/user/updateProfile', 'App\Http\Controllers\Admin\UserController@updateProfile')->middleware(['permission:user-updateProfile']);;
Route::name('user.updatePassword')->post('/user/updatePassword', 'App\Http\Controllers\Admin\UserController@updatePassword')->middleware(['permission:user-updatePassword']);;
Route::name('user.userEdit')->get('/user/userEdit/{id}', 'App\Http\Controllers\Admin\UserController@userEdit')->middleware(['permission:user-editProfile']);;

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
Route::name('project.imageUpload/{id}')->get('/project/imageUpload/{id}', 'App\Http\Controllers\Admin\ProjectController@imageUpload')->middleware(['permission:project-imageUpload']);
Route::name('project.imageUpdate')->post('/project/imageUpdate', 'App\Http\Controllers\Admin\ProjectController@imageUpdate')->middleware(['permission:project-imageUpdate']);
Route::name('project.imageStore')->post('/project/imageStore', 'App\Http\Controllers\Admin\ProjectController@imageStore')->middleware(['permission:project-imageStore']);


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

// FAQ cms
Route::name('faq')->get('/faq', 'App\Http\Controllers\Admin\FaqController@index')->middleware(['permission:faq-view']);
Route::name('faq.create')->get('/faq/create', 'App\Http\Controllers\Admin\FaqController@create')->middleware(['permission:faq-create']);
Route::name('faq.create/{id}')->get('/faq/edit/{id}', 'App\Http\Controllers\Admin\FaqController@edit')->middleware(['permission:faq-create']);
Route::name('faq.store')->post('/faq/store', 'App\Http\Controllers\Admin\FaqController@store')->middleware(['permission:faq-create']);
Route::name('faq.update')->post('/faq/update', 'App\Http\Controllers\Admin\FaqController@update')->middleware(['permission:faq-update']);
Route::name('faq.delete')->get('/faq/delete/{id}', 'App\Http\Controllers\Admin\FaqController@destroy')->middleware(['permission:faq-delete']);
Route::name('faq.delete')->get('/faq/changeStatus/{id}', 'App\Http\Controllers\Admin\FaqController@changeStatus')->middleware(['permission:faq-changeStatus']);

// OUR TEAM cms
Route::name('ourTeam')->get('/ourTeam', 'App\Http\Controllers\Admin\OurTeamController@index')->middleware(['permission:ourTeam-view']);
Route::name('ourTeam.create')->get('/ourTeam/create', 'App\Http\Controllers\Admin\OurTeamController@create')->middleware(['permission:ourTeam-create']);
Route::name('ourTeam.create/{id}')->get('/ourTeam/edit/{id}', 'App\Http\Controllers\Admin\OurTeamController@edit')->middleware(['permission:ourTeam-create']);
Route::name('ourTeam.store')->post('/ourTeam/store', 'App\Http\Controllers\Admin\OurTeamController@store')->middleware(['permission:ourTeam-create']);
Route::name('ourTeam.update')->post('/ourTeam/update', 'App\Http\Controllers\Admin\OurTeamController@update')->middleware(['permission:ourTeam-update']);
Route::name('ourTeam.delete')->get('/ourTeam/delete/{id}', 'App\Http\Controllers\Admin\OurTeamController@destroy')->middleware(['permission:ourTeam-delete']);
Route::name('ourTeam.delete')->get('/ourTeam/changeStatus/{id}', 'App\Http\Controllers\Admin\OurTeamController@changeStatus')->middleware(['permission:ourTeam-changeStatus']);

// About Us cms
Route::name('aboutUs')->get('/aboutUs', 'App\Http\Controllers\Admin\AboutUsController@index')->middleware(['permission:aboutus-view']);
Route::name('aboutUs.create')->get('/aboutUs/create', 'App\Http\Controllers\Admin\AboutUsController@create')->middleware(['permission:aboutus-create']);
Route::name('aboutUs.create/{id}')->get('/aboutUs/edit/{id}', 'App\Http\Controllers\Admin\AboutUsController@edit')->middleware(['permission:aboutus-create']);
Route::name('aboutUs.store')->post('/aboutUs/store', 'App\Http\Controllers\Admin\AboutUsController@store')->middleware(['permission:aboutus-create']);
Route::name('aboutUs.update')->post('/aboutUs/update', 'App\Http\Controllers\Admin\AboutUsController@update')->middleware(['permission:aboutus-update']);
Route::name('aboutUs.delete')->get('/aboutUs/delete/{id}', 'App\Http\Controllers\Admin\AboutUsController@destroy')->middleware(['permission:aboutus-delete']);
Route::name('aboutUs.delete')->get('/aboutUs/changeStatus/{id}', 'App\Http\Controllers\Admin\AboutUsController@changeStatus')->middleware(['permission:aboutus-changeStatus']);

// News cms
Route::name('news')->get('/news', 'App\Http\Controllers\Admin\NewsController@index')->middleware(['permission:news-view']);
Route::name('news.create')->get('/news/create', 'App\Http\Controllers\Admin\NewsController@create')->middleware(['permission:news-create']);
Route::name('news.create/{id}')->get('/news/edit/{id}', 'App\Http\Controllers\Admin\NewsController@edit')->middleware(['permission:news-create']);
Route::name('news.store')->post('/news/store', 'App\Http\Controllers\Admin\NewsController@store')->middleware(['permission:news-create']);
Route::name('news.update')->post('/news/update', 'App\Http\Controllers\Admin\NewsController@update')->middleware(['permission:news-update']);
Route::name('news.delete')->get('/news/delete/{id}', 'App\Http\Controllers\Admin\NewsController@destroy')->middleware(['permission:news-delete']);
Route::name('news.delete')->get('/news/changeStatus/{id}', 'App\Http\Controllers\Admin\NewsController@changeStatus')->middleware(['permission:news-changeStatus']);

// Media cms
Route::name('media')->get('/media', 'App\Http\Controllers\Admin\MediaController@index')->middleware(['permission:media-view']);
Route::name('media.create')->get('/media/create', 'App\Http\Controllers\Admin\MediaController@create')->middleware(['permission:media-create']);
Route::name('media.create/{id}')->get('/media/edit/{id}', 'App\Http\Controllers\Admin\MediaController@edit')->middleware(['permission:media-create']);
Route::name('media.store')->post('/media/store', 'App\Http\Controllers\Admin\MediaController@store')->middleware(['permission:media-create']);
Route::name('media.update')->post('/media/update', 'App\Http\Controllers\Admin\MediaController@update')->middleware(['permission:media-update']);
Route::name('media.delete')->get('/media/delete/{id}', 'App\Http\Controllers\Admin\MediaController@destroy')->middleware(['permission:media-delete']);
Route::name('media.delete')->get('/media/changeStatus/{id}', 'App\Http\Controllers\Admin\MediaController@changeStatus')->middleware(['permission:media-changeStatus']);

// Home  cms
Route::name('aboutUsHome')->get('/aboutUsHome', 'App\Http\Controllers\Admin\AboutUsHomeController@index')->middleware(['permission:aboutUsHome-view']);
Route::name('aboutUsHome.create')->get('/aboutUsHome/create', 'App\Http\Controllers\Admin\AboutUsHomeController@create')->middleware(['permission:aboutUsHome-create']);
Route::name('aboutUsHome.create/{id}')->get('/aboutUsHome/edit/{id}', 'App\Http\Controllers\Admin\AboutUsHomeController@edit')->middleware(['permission:aboutUsHome-create']);
Route::name('aboutUsHome.store')->post('/aboutUsHome/store', 'App\Http\Controllers\Admin\AboutUsHomeController@store')->middleware(['permission:aboutUsHome-create']);
Route::name('aboutUsHome.update')->post('/aboutUsHome/update', 'App\Http\Controllers\Admin\AboutUsHomeController@update')->middleware(['permission:aboutUsHome-update']);
Route::name('aboutUsHome.delete')->get('/aboutUsHome/delete/{id}', 'App\Http\Controllers\Admin\AboutUsHomeController@destroy')->middleware(['permission:aboutUsHome-delete']);
Route::name('aboutUsHome.delete')->get('/aboutUsHome/changeStatus/{id}', 'App\Http\Controllers\Admin\AboutUsHomeController@changeStatus')->middleware(['permission:aboutUsHome-changeStatus']);

// Home  cms
Route::name('investmentHome')->get('/investmentHome', 'App\Http\Controllers\Admin\InvestmentHomeController@index')->middleware(['permission:investmentHome-view']);
Route::name('investmentHome.create')->get('/investmentHome/create', 'App\Http\Controllers\Admin\InvestmentHomeController@create')->middleware(['permission:investmentHome-create']);
Route::name('investmentHome.create/{id}')->get('/investmentHome/edit/{id}', 'App\Http\Controllers\Admin\InvestmentHomeController@edit')->middleware(['permission:investmentHome-create']);
Route::name('investmentHome.store')->post('/investmentHome/store', 'App\Http\Controllers\Admin\InvestmentHomeController@store')->middleware(['permission:investmentHome-create']);
Route::name('investmentHome.update')->post('/investmentHome/update', 'App\Http\Controllers\Admin\InvestmentHomeController@update')->middleware(['permission:investmentHome-update']);
Route::name('investmentHome.delete')->get('/investmentHome/delete/{id}', 'App\Http\Controllers\Admin\InvestmentHomeController@destroy')->middleware(['permission:investmentHome-delete']);
Route::name('investmentHome.delete')->get('/investmentHome/changeStatus/{id}', 'App\Http\Controllers\Admin\InvestmentHomeController@changeStatus')->middleware(['permission:investmentHome-changeStatus']);

// Home  cms
Route::name('ourProjectHome')->get('/ourProjectHome', 'App\Http\Controllers\Admin\OurProjectHomeController@index')->middleware(['permission:ourProjectHome-view']);
Route::name('ourProjectHome.create')->get('/ourProjectHome/create', 'App\Http\Controllers\Admin\OurProjectHomeController@create')->middleware(['permission:ourProjectHome-create']);
Route::name('ourProjectHome.create/{id}')->get('/ourProjectHome/edit/{id}', 'App\Http\Controllers\Admin\OurProjectHomeController@edit')->middleware(['permission:ourProjectHome-create']);
Route::name('ourProjectHome.store')->post('/ourProjectHome/store', 'App\Http\Controllers\Admin\OurProjectHomeController@store')->middleware(['permission:ourProjectHome-create']);
Route::name('ourProjectHome.update')->post('/ourProjectHome/update', 'App\Http\Controllers\Admin\OurProjectHomeController@update')->middleware(['permission:ourProjectHome-update']);
Route::name('ourProjectHome.delete')->get('/ourProjectHome/delete/{id}', 'App\Http\Controllers\Admin\OurProjectHomeController@destroy')->middleware(['permission:ourProjectHome-delete']);
Route::name('ourProjectHome.delete')->get('/ourProjectHome/changeStatus/{id}', 'App\Http\Controllers\Admin\OurProjectHomeController@changeStatus')->middleware(['permission:ourProjectHome-changeStatus']);

// Home  cms
Route::name('featureProjectHome')->get('/featureProjectHome', 'App\Http\Controllers\Admin\FeatureProjectHomeController@index')->middleware(['permission:featureProjectHome-view']);
Route::name('featureProjectHome.create')->get('/featureProjectHome/create', 'App\Http\Controllers\Admin\FeatureProjectHomeController@create')->middleware(['permission:featureProjectHome-create']);
Route::name('featureProjectHome.create/{id}')->get('/featureProjectHome/edit/{id}', 'App\Http\Controllers\Admin\FeatureProjectHomeController@edit')->middleware(['permission:featureProjectHome-create']);
Route::name('featureProjectHome.store')->post('/featureProjectHome/store', 'App\Http\Controllers\Admin\FeatureProjectHomeController@store')->middleware(['permission:featureProjectHome-create']);
Route::name('featureProjectHome.update')->post('/featureProjectHome/update', 'App\Http\Controllers\Admin\FeatureProjectHomeController@update')->middleware(['permission:featureProjectHome-update']);
Route::name('featureProjectHome.delete')->get('/featureProjectHome/delete/{id}', 'App\Http\Controllers\Admin\FeatureProjectHomeController@destroy')->middleware(['permission:featureProjectHome-delete']);
Route::name('featureProjectHome.delete')->get('/featureProjectHome/changeStatus/{id}', 'App\Http\Controllers\Admin\FeatureProjectHomeController@changeStatus')->middleware(['permission:featureProjectHome-changeStatus']);

Route::name('bookMeeting')->get('/bookMeeting', 'App\Http\Controllers\Admin\BookMeetingController@index')->middleware(['permission:bookMeeting-view']);
Route::name('bookMeeting.create')->get('/bookMeeting/create', 'App\Http\Controllers\Admin\BookMeetingController@create')->middleware(['permission:bookMeeting-create']);
Route::name('bookMeeting.create/{id}')->get('/bookMeeting/edit/{id}', 'App\Http\Controllers\Admin\BookMeetingController@edit')->middleware(['permission:bookMeeting-create']);
Route::name('bookMeeting.store')->post('/bookMeeting/store', 'App\Http\Controllers\Admin\BookMeetingController@store')->middleware(['permission:bookMeeting-create']);
Route::name('bookMeeting.update')->post('/bookMeeting/update', 'App\Http\Controllers\Admin\BookMeetingController@update')->middleware(['permission:bookMeeting-update']);
Route::name('bookMeeting.delete')->get('/bookMeeting/delete/{id}', 'App\Http\Controllers\Admin\BookMeetingController@destroy')->middleware(['permission:bookMeeting-delete']);
Route::name('bookMeeting.delete')->get('/bookMeeting/changeStatus/{id}', 'App\Http\Controllers\Admin\BookMeetingController@changeStatus')->middleware(['permission:bookMeeting-changeStatus']);

Route::name('projectAssign')->get('/projectAssign', 'App\Http\Controllers\Admin\ProjectAssignController@index')->middleware(['permission:projectAssign-view']);
Route::name('projectAssign.create')->get('/projectAssign/create', 'App\Http\Controllers\Admin\ProjectAssignController@create')->middleware(['permission:projectAssign-create']);
Route::name('projectAssign.create/{id}')->get('/projectAssign/edit/{id}', 'App\Http\Controllers\Admin\ProjectAssignController@edit')->middleware(['permission:projectAssign-create']);
Route::name('projectAssign.store')->post('/projectAssign/store', 'App\Http\Controllers\Admin\ProjectAssignController@store')->middleware(['permission:projectAssign-create']);
Route::name('projectAssign.update')->post('/projectAssign/update', 'App\Http\Controllers\Admin\ProjectAssignController@update')->middleware(['permission:projectAssign-update']);
Route::name('projectAssign.delete')->get('/projectAssign/delete/{id}', 'App\Http\Controllers\Admin\ProjectAssignController@destroy')->middleware(['permission:projectAssign-delete']);
Route::name('projectAssign.delete')->get('/projectAssign/changeStatus/{id}', 'App\Http\Controllers\Admin\ProjectAssignController@changeStatus')->middleware(['permission:projectAssign-changeStatus']);

?>
