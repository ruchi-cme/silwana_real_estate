<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\{User,Inquiry};
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;

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

        //Error messages
        $messages = [
            "email.required" => "Email is required",
            "email.email" => "Email is not valid",
            "email.exists" => "Email doesn't exists",
            "password.required" => "Password is required",
            "password.min" => "Password must be at least 6 characters"
        ];
        // validate the form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            // attempt to log
            if (Auth::guard('front')->attempt(['email' => $request->email, 'password' =>  $request->password], $request->get('remember'))) {
                // if successful -> redirect forward
                return redirect()->intended(route('home'));
            }

            // if unsuccessful -> redirect back
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'approve' => 'These credentials do not match our records. ',
            ]);
        }

      /*  if (Auth::guard('front')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return view('front.home' );
        }
        else{

            return view('front.home' );
        }*/

    }

    public function logout()
    {
        Session::flush();

         Auth::guard('front')->logout();

        return redirect('/');
    }

    public function signup(Request $request){

        $validatedData =  $request->validate([
            'name'   => 'required',
            'phone'   => 'required',
            'email'   => 'required',
            'password' => 'required|min:6'
        ]);

        //Error messages
        $messages = [
            "email.required" => "Email is required",
            "email.email" => "Email is not valid",
            "email.exists" => "Email doesn't exists",
            "password.required" => "Password is required",
            "password.min" => "Password must be at least 6 characters"
        ];
        // validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|email|exists:users,email',
            'phone' => 'required|min:9',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else{

            User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->intended(route('home'));
        }

        return view('front.home' );


    }

    public function submitInquiry(Request $request)
    {

        $request->validate([
            'first_name'   => 'required',
            'last_name'    => 'required',
            'email_id'     => 'required|email',
            'phone_no'     => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message'      => 'required',
        ]);

        $insertData = [

                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone'     => $request->phone_no,
                'email'     => $request->email_id,
                'message'   => $request->message,
                'status'    => 1, //Booking Price Paid

            ];

            $bookingId = Inquiry::create($insertData);

        return response()->json(['success'=>'Successfully']);


    }
}
