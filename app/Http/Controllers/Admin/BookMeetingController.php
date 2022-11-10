<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookMeeting;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Config;
class BookMeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            /* Current Login User ID */
            $userID = auth()->user()->id;

            $dbData = BookMeeting::select([ 'id','name','phone','email','date','time','status' ])
                ->where('deleted',0)
                ->orderBy("id",'DESC')
                ->get();
            $data = $dbData->map(function ($data){

                return [
                    'id'             => $data->id,
                    'name'           => $data->name,
                    'phone'          => $data->phone,
                    'email'          => $data->email,
                    'date'           => $data->date,
                    'time'           => $data->time,
                    'status'         => $data->status,
                    'created_date'   => $data->created_date
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.bookMeeting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$user = User::whereHas(
            'roles', function($q){
            $q->where('name', 'user');
        }
        )->where('status', '1')->get();*/
        $user = User::where('is_admin','0')->get();

        return view('admin.bookMeeting.create', compact(['user']) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'phone' => 'required',
            'email' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);
        /* Insert   data */
        $userID = auth()->user()->id;
        $Image  = null;

        $data  = [

            'user_id'        => $request->user_id,
            'booked_by'      => 1,
            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'date'           => $request->date,
            'time'           => $request->time,
            'detail'         => $request->detail,
            'status'         => 'booked',
            'created_by'  => $userID
        ];
        BookMeeting::create($data);
        return redirect()->route('admin.bookMeeting')->with('inserted','Meeting Created👍');
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = BookMeeting::find($request->id);

        $user = User::where('is_admin','0')->get();
        $meetingStatus = Config::get('constants.book_meeting_status');

        return view('admin.bookMeeting.create' ,compact('editData','user','meetingStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateData  = BookMeeting::find( $request->id);
        $userID      = auth()->user()->id;
        /* Insert Page data */


        $updateData->update([
            'user_id'        => $request->user_id,
            'booked_by'      => 1,
            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'date'           => $request->date,
            'time'           => $request->time,
            'detail'         => $request->detail,
            'status'         => $request->status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);
        return redirect()->route('admin.bookMeeting')->with('updated','Meeting Updated 👍');
    }
    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = BookMeeting::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
        return redirect()->route('admin.bookMeeting')->with('success','Meeting Deleted');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $updateData = BookMeeting::find($request->id);
        $userID   = auth()->user()->id;
        $status   =  ( !empty($updateData->status) && $updateData->status == 1 ) ?  2 :  1 ;

        $updateData->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.bookMeeting')->with('success','Meeting Status Changed');
    }

    public function fetchUser(Request $request)
    {
        $data['usersData'] = User::where("id",$request->user_id)->get(["name", "id","email", "phone" ])->first();

        return response()->json($data);
    }

}
