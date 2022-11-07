<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        $aboutUs = getAboutUs();
        return view('front.about',compact( 'aboutUs'));
    }

    public function ourTeam(Request $request)
    {
        $ourTeam   = getOurTeam();

        return view('front.ourTeam',compact( 'ourTeam'  ));
    }

    public function aboutusFaq(Request $request)
    {
        $faq   = getFaq();
        return view('front.faq',compact( 'faq'));
    }

    public function newsMedia(Request $request)
    {
        $news   = getNews();
        $media  = getMedia();


        return view('front.newsMedia',compact( 'news','media'));
    }

    public function blogs(Request $request)
    {

        $sales   = getSilwanaPages('aboutus_sales');
        $mission = getSilwanaPages('aboutus_mission');
        $vision  = getSilwanaPages('aboutus_vision');

        return view('front.blogs',compact( 'sales','mission','vision'));
    }

    public function sales(Request $request)
    {

        $sales   = getSilwanaPages('aboutus_sales');
        $mission = getSilwanaPages('aboutus_mission');
        $vision  = getSilwanaPages('aboutus_vision');

        return view('front.sales',compact( 'sales','mission','vision'));
    }

}
