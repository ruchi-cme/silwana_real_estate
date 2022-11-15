<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesService;
use Illuminate\Http\Request;

class SalesServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  index()
    {
        $editData = getSalesService(); //
        return view('admin.salesService.create' ,compact('editData'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'detail' => 'required',
            'name'   => 'required',
            'image'   => 'required|mimes:png,jpeg,gif,svg', // |size:2048
        ]);
        /* Insert   data */
        $userID = auth()->user()->id;
        $Image  = null;

        if ($image = $request->file('image')) {
            $destinationPath = public_path('images/businessServices');
            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
        }


        $data  = [
            'title'       => $request->title,
            'name'        => $request->name,
            'detail'      => $request->detail,
            'image'       => $Image,
            'created_by'  => $userID
        ];
        SalesService::create($data);
        return redirect()->route('admin.salesService')->with('inserted','Sales Service Created👍');
    }


    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request  )
    {
        $request->validate([
            'title'   => 'required',
            'detail' => 'required',
            'name'   => 'required',
            'image'   => 'required|mimes:png,jpeg,gif,svg', // |size:2048
        ]);

        $updateData  = SalesService::find( $request->id);
        $userID      = auth()->user()->id;
        /* Insert   data */
        $input = $request->all();

        $image = $request->file('image');
        $editImage = $request->edit_image;
        if (!empty($image) ) {

            $destinationPath = public_path('images/businessServices');

            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
            if (!empty($editImage)) {
                @unlink( public_path('images/businessServices/') . $editImage);
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
            'title'         => $request->title,
            'name'          => $request->name,
            'detail'        => $request->detail,
            'image'         => $Image,
            'modified_by'   => $userID,
            'modified_date' => now()
        ]);
        return redirect()->route('admin.salesService')->with('updated','Sales Service Updated 👍');
    }

}
