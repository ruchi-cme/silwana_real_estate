<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

Auth::routes(); // Auth routes

Route::name('home')->get('/', 'App\Http\Controllers\Frontend\HomeController@index');
Route::name('home/signup')->post('/home/signup', 'App\Http\Controllers\Frontend\HomeController@signup');
Route::name('home/login')->post('/home/login', 'App\Http\Controllers\Frontend\HomeController@login');
Route::name('home/logout')->post('/home/logout', 'App\Http\Controllers\Frontend\HomeController@logout');
Route::name('home/submitInquiry')->post('/home/submitInquiry', 'App\Http\Controllers\Frontend\HomeController@submitInquiry');

Route::name('about')->get('/about', 'App\Http\Controllers\Frontend\AboutController@index');
Route::name('ourTeam')->get('/about/ourTeam', 'App\Http\Controllers\Frontend\AboutController@ourTeam');
Route::name('aboutusFaq')->get('/about/aboutusFaq', 'App\Http\Controllers\Frontend\AboutController@aboutusFaq');
Route::name('newsMedia')->get('/about/newsMedia', 'App\Http\Controllers\Frontend\AboutController@newsMedia');

Route::name('ourProject')->get('/ourProject', 'App\Http\Controllers\Frontend\OurProjectController@index');
Route::name('ourProject/ongoing')->get('/ourProject/ongoing', 'App\Http\Controllers\Frontend\OurProjectController@projectType');
Route::name('ourProject/upcoming')->get('/ourProject/upcoming', 'App\Http\Controllers\Frontend\OurProjectController@projectType');
Route::name('ourProject/completed')->get('/ourProject/completed', 'App\Http\Controllers\Frontend\OurProjectController@projectType');

Route::name('ourProject/projectSearch')->post('/ourProject/projectSearch', 'App\Http\Controllers\Frontend\OurProjectController@projectSearch');
Route::name('ourProject/category/{id}')->get('/ourProject/category/{id}', 'App\Http\Controllers\Frontend\OurProjectController@getProjectByCategory');



Route::name('projectDetail/{id}')->get('/projectDetail/{id}', 'App\Http\Controllers\Frontend\OurProjectController@projectDetail');

Route::name('propertyList')->get('/propertyList', 'App\Http\Controllers\Frontend\PropertyListController@index');
Route::name('propertydetail/{id}')->get('/propertydetail/{id}', 'App\Http\Controllers\Frontend\PropertyListController@propertydetail');
Route::name('getFloor')->get('/getFloor', 'App\Http\Controllers\Frontend\OurProjectController@getFloor');
Route::name('getUnit')->get('/getUnit', 'App\Http\Controllers\Frontend\OurProjectController@getUnit');
Route::name('searchProperty')->post('/searchProperty', 'App\Http\Controllers\Frontend\PropertyListController@searchProperty');
Route::name('getUnitData')->get('/getUnitData', 'App\Http\Controllers\Frontend\OurProjectController@getUnitData');


Route::name('booking/{id}')->get('/booking/{id}', 'App\Http\Controllers\Frontend\BookingController@index');
Route::name('booking/store')->post('/booking/store', 'App\Http\Controllers\Frontend\BookingController@store');


Route::name('myBooking')->get('/myBooking', 'App\Http\Controllers\Frontend\MyBookingController@index');
Route::name('booking/cancel')->post('/booking/cancel', 'App\Http\Controllers\Frontend\BookingController@cancelBooking');

Route::name('contactUs')->get('/contact', 'App\Http\Controllers\Frontend\ContactUsController@index');
Route::name('myProfile')->get('/myProfile', 'App\Http\Controllers\Frontend\MyProfileController@index');
Route::name('myProfile/update')->post('/myProfile/update', 'App\Http\Controllers\Frontend\MyProfileController@update');

Route::get('/dashboard', function () {

    if(Auth::guard('web')->check()) {
        if(auth()->user()->is_admin){
            return redirect('/admin/');
        }else{
            return redirect('/user/');
        }
    }else{
        return Redirect::to('login');
    }
}); //  Role based separation upon login

Route::middleware(['auth'])->group(function () {
    Route::group([ 'middleware' => 'is_admin', 'prefix' => 'admin','as' => 'admin.'], function () {
        include_once 'admin.routes.php'; // separated admin routes
    });
    Route::group([ 'middleware' => 'is_user', 'prefix' => 'user','as' => 'user.'], function () {
        include_once 'user.routes.php'; // separated user routes
    });
});

// Common Routes
Route::name('country.fetch')->get('/country/fetch', 'App\Http\Controllers\CountryStateCityController@fetchCountry');
Route::name('selectState.fetch')->get('/country/selectState', 'App\Http\Controllers\CountryStateCityController@selectState');
Route::name('selectCity.fetch')->get('/country/selectCity', 'App\Http\Controllers\CountryStateCityController@selectCity');

Route::name('state.fetch')->get('/state/fetch', 'App\Http\Controllers\CountryStateCityController@fetchState');
Route::name('city.fetch')->get('/city/fetch', 'App\Http\Controllers\CountryStateCityController@fetchCity');
Route::name('block.fetch')->get('/block/fetch', 'App\Http\Controllers\CountryStateCityController@fetchBlock');
Route::name('user.fetch')->get('/user/fetch', 'App\Http\Controllers\Admin\BookMeetingController@fetchUser');

// Config Routes
Route::get('/permission/create', function () {
    $permission = request()->query('name');
    Permission::create(['name' => $permission]);
    dd('created');
});//  permission creation route ( remove from production application )
