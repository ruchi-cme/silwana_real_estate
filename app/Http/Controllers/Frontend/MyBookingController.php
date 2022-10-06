<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyBookingController extends Controller
{
    public function index() {
        $aboutus    = getSilwanaPages('about_us');
        $owner_message = getSilwanaPages('owner_message');

        return view('front.myBooking.blade',compact('aboutus','owner_message'));
    }
}
