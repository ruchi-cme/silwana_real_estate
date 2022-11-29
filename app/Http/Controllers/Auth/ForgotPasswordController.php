<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use Hash;
use Illuminate\Support\Str;
use Validator;
use Auth;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function index()
    {
        return view('auth.passwords.email');
    }


    public function submitForgetPasswordForm(Request $request)
    {
         $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgetPassword', ['token' => $token,'link' => 'reset-password/'], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('inserted', 'We have e-mailed your password reset link!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function showResetPasswordForm($token='') {

        $currentURL    =   (request()->segments());
         if($currentURL[0] == 'reset-password-front'){
             return view('front.resetPassword', ['token' => $token]);
         } else {
             return view('auth.passwords.reset', ['token' => $token]);
         }

    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function submitResetPasswordForm(Request $request)
    {
        $flag =  $request->flag;
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){

            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        if(isset($flag) && !empty($flag)){
            return redirect()->route('home')->with('success','Your password has been changed! 👍');

        } else {
            return redirect('/login')->with('updated', 'Your password has been changed!');
        }

    }


    public function submitForgetPasswordFormFront(Request $request)
    {
            $messages = [
                "email.required" => "Email is required",
                "email.email" => "Email is not valid",
                "email.exists" => "Email doesn't exists",

            ];
            // validate the form data
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ], $messages);

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'error' => $validator->errors()->all()
                ]);

            } else {

                $token = Str::random(64);
                $list = new User();
                $user = $list->where('email', '=', $request->email)->first();

                if (!empty($user->email)) {

                    DB::table('password_resets')->insert([
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => Carbon::now()
                    ]);

                    Mail::send('email.forgetPassword', ['token' => $token,'link' => 'reset-password-front/'], function($message) use($request){
                        $message->to($request->email);
                        $message->subject('Reset Password');
                    });

                    return response()->json(['success' => 'We have e-mailed your password reset link!','error' => '']);

                }
                else {
                    return response()->json(['success' => false,'error' => 'These credentials do not match our records.']);

                }
            }
    }
}
