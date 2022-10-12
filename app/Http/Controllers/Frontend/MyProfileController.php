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
             $image = asset('images/user').'/' . Auth::guard('front')->user()->image;

        $userData = ['id'   => Auth::guard('front')->user()->id,
                 'name'      => Auth::guard('front')->user()->name,
                'firstname'      => Auth::guard('front')->user()->firstname,
                'lastname'      => Auth::guard('front')->user()->lastname,
                'email'     => Auth::guard('front')->user()->email,
                'phone'     => Auth::guard('front')->user()->phone,
                'imageSrc'  => $image,
                'image'     => Auth::guard('front')->user()->image ];
        return view('front.myProfile',compact('userData') );
    }

    public function update(Request $request) {
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


        $user->firstname = $request->firstname;
        $user->lastname  = $request->lastname;
        $user->name      = $request->firstname. ' '.$request->lastname;
        $user->email     = $request->email;
        $user->phone     = $request->phone;
        $user->image     = $Image;
        $user->save();

        $imageSrc = asset('images/front').'/noProfile.jpeg' ;
        if( !empty($Image))
            $imageSrc = asset('images/user') .'/'.$Image;

        $userData = ['name' =>  $user->name,
            'email' => $user->email ,
            'phone' =>   $user->phone,
            'image' => $image ,
            'imageSrc'  => $imageSrc
        ];
        return redirect('myProfile');


    }
}
