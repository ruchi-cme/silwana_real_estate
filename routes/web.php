<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

Auth::routes(); // Auth routes

Route::name('home')->get('/', 'App\Http\Controllers\Frontend\HomeController@index');
Route::name('about')->get('/about', 'App\Http\Controllers\Frontend\AboutController@index');
Route::name('ourProject')->get('/ourProject', 'App\Http\Controllers\Frontend\OurProjectController@index');
Route::name('propertyList')->get('/propertyList', 'App\Http\Controllers\Frontend\HomeController@index');
Route::name('myBooking')->get('/myBooking', 'App\Http\Controllers\Frontend\MyBookingController@index');
Route::name('contactUs')->get('/contact', 'App\Http\Controllers\Frontend\ContactUsController@index');

Route::get('/dashboard', function () {
    if(Auth::check()) {
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
Route::name('state.fetch')->get('/state/fetch', 'App\Http\Controllers\CountryStateCityController@fetchState');
Route::name('city.fetch')->get('/city/fetch', 'App\Http\Controllers\CountryStateCityController@fetchCity');

// Config Routes
Route::get('/permission/create', function () {
    $permission = request()->query('name');
    Permission::create(['name' => $permission]);
    dd('created');
});//  permission creation route ( remove from production application )
