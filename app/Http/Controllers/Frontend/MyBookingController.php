<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class MyBookingController extends Controller
{
    public function index() {

        $user_id =  Auth::guard('front')->user()->id;
        $myBooking = getBookingDetail($user_id);
        return view('front.myBooking',compact( 'myBooking'));
    }

}
