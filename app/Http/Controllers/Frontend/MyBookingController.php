<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyBookingController extends Controller
{
    public function index() {

        $myBooking = getBookingDetail();

        return view('front.myBooking',compact( 'myBooking'));
    }
}
