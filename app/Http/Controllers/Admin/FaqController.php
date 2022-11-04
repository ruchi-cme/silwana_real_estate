<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
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

            $dbData = Faq::select([ 'faq_id','name','detail','image','status' ])
                ->where('deleted',0)
                ->orderBy("faq_id",'DESC')
                ->get();
            $data = $dbData->map(function ($data){

                return [
                    'id'             => $data->faq_id,
                    'name'           => $data->name,
                    'detail'         => $data->detail,
                    'image'          => asset('images/faq')."/".$data->image,
                    'status'         => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'   => $data->created_date
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create' );
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
            $destinationPath = public_path('images/faq');
            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
        }
        $data  = [
            'name'        => $request->name,
            'detail'      => $request->detail,
            'image'       => $Image,
            'status'      => 1,
            'created_by'  => $userID
        ];
         Faq::create($data);
        return redirect()->route('admin.faq')->with('inserted','FAQ Created👍');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = Faq::find($request->id);

        return view('admin.faq.create' ,compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateData  = Faq::find( $request->faq_id);
        $userID      = auth()->user()->id;
        /* Insert Page data */
        $input = $request->all();

        $image = $request->file('image');
        $editImage = $request->edit_image;
        if (!empty($image) ) {

            $destinationPath = public_path('images/faq');

            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
            if (!empty($editImage)) {
                @unlink( public_path('images/faq/') . $editImage);
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
            'name'  => $request->name,
            'detail'=> $request->detail,
            'image' => $Image,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);
        return redirect()->route('admin.faq')->with('updated','FAQ Updated 👍');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Faq::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
        return redirect()->route('admin.faq')->with('success','FAQ Deleted');
    }

/**
 * Responds with a welcome message with instructions
 *
 * @return \Illuminate\Http\Response
 */

public function changeStatus(Request $request)
{
    $updateData = Faq::find($request->id);
    $userID   = auth()->user()->id;
    $status   =  ( !empty($updateData->status) && $updateData->status == 1 ) ?  2 :  1 ;

    $updateData->update([
        'status' => $status,
        'modified_by'   =>  $userID,
        'modified_date' => now()
    ]);

    return redirect()->route('admin.faq')->with('success','FAQ Status Changed');
}

}
