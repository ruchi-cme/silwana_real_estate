<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurProjectHome;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OurProjectHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $editData = getOurProjectHome();
        return view('admin.ourProjectHome.create' ,compact('editData'));
        /*  if($request->ajax())
         {
            // Current Login User ID
            $userID = auth()->user()->id;

             $dbData = OurProjectHome::select([ 'id','name','detail','title','status' ])
                 ->where('deleted',0)
                 ->orderBy("id",'DESC')
                 ->get();
             $data = $dbData->map(function ($data){

                 return [
                     'id'             => $data->id,
                     'name'           => $data->name,
                     'detail'         => $data->detail,
                     'title'          =>  $data->title,
                     'status'         => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                     'created_date'   => $data->created_date
                 ];
             });
             return DataTables::of($data)->toJson();
         }
         return view('admin.ourProjectHome.index');*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ourProjectHome.create' );
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
            'detail' => 'required',
            'title'   =>  'required',
        ]);
        /* Insert AboutUs data */
        $userID = auth()->user()->id;

        $data  = [
            'name'        => $request->name,
            'detail'      => $request->detail,
            'title'       =>  $request->title,
            'status'      => 1,
            'created_by'  => $userID
        ];
        OurProjectHome::create($data);
        return redirect()->route('admin.ourProjectHome')->with('inserted','Our Project Created👍');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ourTeam  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = OurProjectHome::find($request->id);
        return view('admin.ourProjectHome.create' ,compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $updateData  = OurProjectHome::find( $request->id);
        $userID      = auth()->user()->id;

        $updateData->update([
            'name'          => $request->name,
            'detail'        => $request->detail,
            'title'         => $request->title,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);
        $editData = OurProjectHome::find($request->id);
        return redirect()->route('admin.ourProjectHome')->with('success','Our Project Updated 👍');
      //  return view('admin.ourProjectHome.create' ,compact('editData'));

        //return redirect()->route('admin.ourProjectHome')->with('updated','Our Project Updated 👍');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = OurProjectHome::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
        return redirect()->route('admin.ourProjectHome')->with('success','Our Project Deleted');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $updateData = OurProjectHome::find($request->id);
        $userID   = auth()->user()->id;
        $status   =  ( !empty($updateData->status) && $updateData->status == 1 ) ?  2 :  1 ;

        $updateData->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.ourProjectHome')->with('success','Our Project Status Changed');
    }
}
