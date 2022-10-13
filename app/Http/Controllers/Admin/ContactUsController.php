<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
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

            $dbData = ContactUs::select([ 'contactus_id','title','desc','notes','image','status'])
                ->where('deleted',0)
                ->orderBy("contactus_id",'DESC')
                ->get();
            $data = $dbData->map(function ($data){

                return [
                    'id'             => $data->contactus_id,
                    'title'          => $data->title,
                    'desc'           => $data->desc,
                    'notes'          => $data->notes,
                    'image'          => asset('images/contactus')."/".$data->image,
                    'status'         => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'   => $data->created_date
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.contactus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contactus.create' );
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
            'title'   => 'required',
            'desc'    => 'required',

             'image'  => 'required|image|mimes:jpeg,png,jpg,svg',
        ]);
        /* Insert contact data */
        $userID = auth()->user()->id;
        $Image  = null;

        if ($image = $request->file('image')) {
            $destinationPath = public_path('images/contactus');
            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
        }
        $page  = [
            'title'  => $request->title,
            'desc'   => $request->desc,
            'notes'  => $request->notes,
            'image'  => $Image,
            'status' => 1,
            'created_by'  => $userID
        ];
        $silwana_id = ContactUs::create($page);
        return redirect()->route('admin.contactus')->with('inserted','Contact Created👍');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactUs  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = ContactUs::find($request->id);
        return view('admin.contactus.create' ,compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
        $updateData  = ContactUs::find( $request->contactus_id);
        $userID      = auth()->user()->id;
        /* Insert Page data */
        $input = $request->all();

        $image = $request->file('image');
        $editImage = $request->edit_image;
        if (!empty($image) ) {

            $destinationPath = public_path('images/contactus');
            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
            if (!empty($editImage)) {
                @unlink(public_path("images/contactus/") . $editImage);
            }
        }
        elseif (!empty($editImage)) {
            $Image = $editImage;
        }
        else
        {
            $Image = null;
        }
        $updateData->update([
            'title'  => $request->title,
            'desc'   => $request->desc,
            'notes'  => $request->notes,
            'image'  =>  $Image,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);
        return redirect()->route('admin.contactus')->with('updated','Contact Updated 👍');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$data = ContactUs::find($id);
       if ( !empty($data->image) ){
           unlink("images/contactus/".$data->image);
       }
       $data->delete();*/
        $data = ContactUs::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'       => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
        return redirect()->route('admin.contactus')->with('success','Contact Deleted');
    }

    public function changeStatus(Request $request)
    {
        $updateData = ContactUs::find($request->id);
        $userID   = auth()->user()->id;
        $status   =  ( !empty($updateData->status) && $updateData->status == 1 ) ?  2 :  1 ;

        $updateData->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.contactus')->with('success','Contact Status Changed');
    }

}
