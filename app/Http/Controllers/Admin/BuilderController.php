<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuilderController extends Controller
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
            $dataList = Builder::select([ 'builder_id','company_name','owner_name','builder_email','phone_number','status'])
                ->where('deleted',0)
                ->orderByDesc("builder_id")
                ->get();

            $data = $dataList->map(function ($data){

                return [
                    'id'            => $data->builder_id,
                    'company_name'  => $data->company_name,
                    'owner_name'    => $data->owner_name,
                    'builder_email' => $data->builder_email,
                    'phone_number'  => $data->phone_number,
                    'status'        => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'  => $data->created_date ,
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.builder.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.builder.create' );
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
            'company_name'  => 'required',
            'owner_name'    => 'required',
            'builder_email' => 'required',
            'phone_number'  => 'required|numeric',
            'details'       => 'required'
        ]);

        DB::transaction(function() use($request){
            $userID   = auth()->user()->id;
            $addData = new Builder();

            $addData->company_name  = $request->company_name;
            $addData->owner_name    = $request->owner_name;
            $addData->builder_email = $request->builder_email;
            $addData->details       = $request->details;
            $addData->address       = $request->address;
            $addData->phone_number  = $request->phone_number;
            $addData->status        = 1;
            $addData->created_by    = $userID;
            $addData->save();

        });

        return redirect()->route('admin.builder')->with('inserted','Builder Created👍');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\builder  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = Builder::find($request->id);
        return view('admin.builder.create' ,compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\builder  $builder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateData = Builder::find( $request->builder_id);
        $userID   = auth()->user()->id;
        $updateData->update([
            'company_name'  => $request->company_name,
            'owner_name'    => $request->owner_name,
            'builder_email' => $request->builder_email,
            'details'       => $request->details,
            'address'       => $request->address,
            'phone_number'  => $request->phone_number,
            'modified_by'   =>  $userID,
            'modified_date' => now()

        ]);

        return redirect()->route('admin.builder')->with('updated','Builder Details Updated 👍');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\builder  $builder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Builder::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
        //Builder::find($id)->delete();
        return redirect()->route('admin.builder')->with('success','Builder Deleted');
    }

    public function changeStatus(Request $request)
    {
        $data  = Builder::find($request->id);
        $userID = auth()->user()->id;
        $status =  ( !empty($data->status) && $data->status == 1 ) ?  2 :  1 ;

        $data->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.builder')->with('success','Builder Status Changed');
    }
}
