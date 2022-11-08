<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeatureProjectHome;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeatureProjectHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $editData = getFeatureProjectHome();
        return view('admin.featureProjectHome.create' ,compact('editData'));

       /* if($request->ajax())
        {
            // Current Login User ID  /
            $userID = auth()->user()->id;

            $dbData = FeatureProjectHome::select([ 'id','name','detail','title','status' ])
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
        return view('admin.featureProjectHome.index');*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.featureProjectHome.create' );
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
        FeatureProjectHome::create($data);
        return redirect()->route('admin.featureProjectHome')->with('inserted','Feature Project Created👍');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ourTeam  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = FeatureProjectHome::find($request->id);
        return view('admin.featureProjectHome.create' ,compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateData  = FeatureProjectHome::find( $request->id);

        $userID      = auth()->user()->id;


        $updateData->update([
            'name'  => $request->name,
            'detail'=> $request->detail,
            'title' => $request->title,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);
        return redirect()->route('admin.featureProjectHome')->with('updated','Feature Project Updated 👍');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = FeatureProjectHome::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
        return redirect()->route('admin.featureProjectHome')->with('success','Feature Project Deleted');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $updateData = FeatureProjectHome::find($request->id);
        $userID   = auth()->user()->id;
        $status   =  ( !empty($updateData->status) && $updateData->status == 1 ) ?  2 :  1 ;

        $updateData->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.featureProjectHome')->with('success','Feature Project Status Changed');
    }
}
