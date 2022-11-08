<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsHome;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AboutUsHomeController extends Controller
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

            $dbData = AboutUsHome::select([ 'id','name', 'detail','image','status' ])
                ->where('deleted',0)
                ->orderBy("id",'DESC')
                ->get();
            $data = $dbData->map(function ($data){

                return [
                    'id'             => $data->id,
                    'name'           => $data->name,
                    'detail'         => $data->detail,
                    'image'          => asset('images/aboutUs')."/".$data->image,
                    'status'         => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'   => $data->created_date
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.aboutUsHome.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.aboutUsHome.create' );
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
        ]);
        /* Insert FAQ data */
        $userID = auth()->user()->id;
        $Image  = null;

        if ($image = $request->file('image')) {
            $destinationPath = public_path('images/aboutUs');
            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
        }

        $sub_title =  json_encode($request->sub_title);
        $data  = [
            'name'        => $request->name,
            'detail'      => $request->detail,
            'sub_title'   => $sub_title,
            'image'       => $Image,
            'status'      => 1,
            'created_by'  => $userID
        ];
        AboutUsHome::create($data);
        return redirect()->route('admin.aboutUsHome')->with('inserted','AboutUs Created👍');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ourTeam  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = AboutUsHome::find($request->id);

        return view('admin.aboutUsHome.create' ,compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateData  = AboutUsHome::find( $request->id);
        $userID      = auth()->user()->id;
        /* Insert Page data */
        $input = $request->all();

        $image = $request->file('image');
        $editImage = $request->edit_image;
        if (!empty($image) ) {

            $destinationPath = public_path('images/aboutUs');

            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
            if (!empty($editImage)) {
                @unlink( public_path('images/aboutUs/') . $editImage);
            }
        }
        elseif (!empty($editImage)) {
            $Image = $editImage;
        }
        else
        {
            $Image = null;
        }
        $sub_title =  json_encode($request->sub_title);
        $updateData->update([
            'name'          => $request->name,
            'detail'        => $request->detail,
            'sub_title'     => $sub_title,
            'image'         => $Image,
            'modified_by'   => $userID,
            'modified_date' => now()
        ]);
        return redirect()->route('admin.aboutUsHome')->with('updated','About Us Updated 👍');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AboutUsHome::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
        return redirect()->route('admin.aboutUsHome')->with('success','About Us Deleted');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $updateData = AboutUsHome::find($request->id);
        $userID   = auth()->user()->id;
        $status   =  ( !empty($updateData->status) && $updateData->status == 1 ) ?  2 :  1 ;

        $updateData->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.aboutUsHome')->with('success','About Us Status Changed');
    }
}
