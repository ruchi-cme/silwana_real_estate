<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class MyProfileController extends Controller
{
    public function index(){

            $image = asset('images/front').'/noProfile.jpeg' ;
            if(Auth::guard('front')->user()->image)
             $image = asset('images/user') . Auth::guard('front')->user()->image;

        $userData = ['name' => Auth::guard('front')->user()->name,
                'email' => Auth::guard('front')->user()->email,
                'phone' => Auth::guard('front')->user()->phone,
                'image' => $image];
        return view('front.myProfile',compact('userData') );
    }

    public function update() {
        $user = User::find($request->user_id);

        $image = $request->file('image');
        $editImage = $request->edit_image;
        if (!empty($image) ) {

            $destinationPath = 'images/user';
            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
            if (!empty($editImage)) {
                unlink("images/user/" . $editImage);
            }
        }
        elseif (!empty($editImage)) {
            $Image = $editImage;
        }
        else
        {
            $Image = null;
        }

        $user->image = $Image;
        $user->firstname = $request->first_name;
        $user->lastname = $request->last_name;
        $user->name = $request->first_name. ' '.$request->last_name;
        $user->phone = $request->phone;
        $user->save();

        // return redirect()->back()->with('success','User Updated Successsfully`');
        return view('admin.user.profile',compact('user', 'editUser'));
    }
}
