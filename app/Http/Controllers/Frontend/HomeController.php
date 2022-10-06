<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
