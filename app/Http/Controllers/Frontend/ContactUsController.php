<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index() {

        $contactUs   = getContactUsDetail();
        $page        = getSilwanaPages('contactus_intrest');

        return view('front.contactUs',compact('contactUs','page'));
    }
}
