<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $user = User::where('is_admin',1)->orderBy("id",'DESC')->get(['id','name','email','created_at']);
            $data = $user->map(function ($data){
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'email' => $data->email,
                    'created' => $data->created_at->diffForHumans(),
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.user.index');
    }

    public function create(Request $request)
    {
        $roles = Role::whereIn('name', array('employee','broker','user'))->get();
        return view('admin.user.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required | unique:users',
            'password' => 'required',
        ]);

        $user = new User();

        $user->fill($request->all());

        $user->is_admin = '1';
         if(!empty($request->role) && $request->role == 4) {
             $user->is_admin = '0';
         }

        $user->password = Hash::make($request->password);
         $user->save();
        //retrieve intance for role assignment
        $obj = User::where('id',$user->id)->first();
        $guard = null;

        $role = Role::findById($request->role,$guard);

        $obj->assignRole($role->name);

        return redirect()->route('admin.user')->with('inserted','User Created & Role Assigned 👍');
    }

    public function profile(Request $request)
    {
        $user = User::find($request->id);
        return view('admin.user.profile',compact('user'));
    }

    public function checkEmail(Request $request)
    {
        if($request->email){
            $request->validate([
                'email' => 'email | required | unique:users',
            ]);
        }else{
            return false;
        }
    }

    public function updateEmail(Request $request)
    {

        $request->validate([
            'emailaddress' => 'email | required | unique:users,email'
        ]);

        $user = User::find($request->user_id);

        $user->email = $request->emailaddress;
        $user->save();

        return redirect()->back()->with('success','Email Updated Successsfully 👍');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.user')->with('Deleted','User Deleted 👍');
    }

    public  function viewProfile() {
        $user = User::find(auth()->user()->id);
        return view('admin.user.profile',compact('user'));
    }
    public  function editProfile( $id) {

        $user = User::find($id);

        $editUser = 1;
        return view('admin.user.profile',compact('user', 'editUser'));
    }
    public function userEdit(  $id)
    {
        $user = User::find($id);
        return view('admin.user.profile',compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $editUser = 1;
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $user = User::find($request->user_id);

        $image = $request->file('image');
        $editImage = $request->edit_image;
        if (!empty($image) ) {

            $destinationPath = public_path('images/user');
            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
            if (!empty($editImage)) {
                @unlink(public_path("images/user/") . $editImage);
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

        if($request->user_id == auth()->user()->id){

            return redirect()->route('admin.user.profile')->with('Updated','User Updated👍');
        }
        else {
            return redirect()->route('admin.user')->with('Updated','User Updated👍');
        }

    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'currentpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required'
        ]);

        $user = User::find($request->user_id);

        $user->password = Hash::make($request->newpassword);;
        $user->save();

        return redirect()->back()->with('success','Password Updated Successsfully 👍');
    }
}
