<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $homeBanner = getSilwanaPages('home_banner');
        $aboutus    = getSilwanaPages('about_us');
        $investment = getSilwanaPages('investment');
        $amenities  = getAmenities();
        $categories = getCategory();

        return view('front.home',compact('homeBanner','aboutus','investment', 'amenities','categories'));
    }
    public function login(Request $request)
    {
        $validatedData =  $request->validate([
            'email'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('front')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return view('front.home' );
        }
        else{
           
            return view('front.home' );
        }

    }

    public function logout()
    {
        Session::flush();

         Auth::guard('front')->logout();

        return redirect('/');
    }
}
