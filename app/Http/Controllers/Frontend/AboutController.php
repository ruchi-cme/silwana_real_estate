<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        $aboutus    = getSilwanaPages('about_us');
        $owner_message = getSilwanaPages('owner_message');

        return view('front.about',compact('aboutus','owner_message'));
    }
}
