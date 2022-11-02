<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request)
    {
       // $aboutus = getSilwanaPages('about_us');
      //  $rental  = getSilwanaPages('aboutus_rental');

       // $sales   = getSilwanaPages('aboutus_sales');
        $mission = getSilwanaPages('aboutus_mission');
        $vision  = getSilwanaPages('aboutus_vision');

        return view('front.about',compact('mission','vision'));
    }

    public function ourTeam(Request $request)
    {

        $sales   = getSilwanaPages('aboutus_sales');
        $mission = getSilwanaPages('aboutus_mission');
        $vision  = getSilwanaPages('aboutus_vision');

        return view('front.about',compact( 'sales','mission','vision'));
    }

    public function aboutusOurTeam(Request $request)
    {

        $sales   = getSilwanaPages('aboutus_sales');
        $mission = getSilwanaPages('aboutus_mission');
        $vision  = getSilwanaPages('aboutus_vision');

        return view('front.about',compact( 'sales','mission','vision'));
    }

    public function aboutusFaq(Request $request)
    {

        $sales   = getSilwanaPages('aboutus_sales');
        $mission = getSilwanaPages('aboutus_mission');
        $vision  = getSilwanaPages('aboutus_vision');

        return view('front.about',compact( 'sales','mission','vision'));
    }

    public function newsMedia(Request $request)
    {

        $sales   = getSilwanaPages('aboutus_sales');
        $mission = getSilwanaPages('aboutus_mission');
        $vision  = getSilwanaPages('aboutus_vision');

        return view('front.about',compact( 'sales','mission','vision'));
    }

    public function blogs(Request $request)
    {

        $sales   = getSilwanaPages('aboutus_sales');
        $mission = getSilwanaPages('aboutus_mission');
        $vision  = getSilwanaPages('aboutus_vision');

        return view('front.about',compact( 'sales','mission','vision'));
    }
}
