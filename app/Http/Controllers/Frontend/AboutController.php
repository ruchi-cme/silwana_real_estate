<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        $aboutus = getSilwanaPages('about_us');
        $rental  = getSilwanaPages('aboutus_rental');

        $sales   = getSilwanaPages('aboutus_sales');
        $mission = getSilwanaPages('aboutus_mission');
        $vision  = getSilwanaPages('aboutus_vision');

        return view('front.about',compact('aboutus','rental','sales','mission','vision'));
    }
}
