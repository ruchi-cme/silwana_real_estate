<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestService;
use Illuminate\Http\Request;

class InvestServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editData = getInvestmentService(); //
        return view('admin.investService.create' ,compact('editData'));
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
            'sub_title'   => 'required',
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
            'sub_title'   => $request->sub_title,
            'detail'      => $request->detail,
            'image'       => $Image,
            'created_by'  => $userID
        ];
        InvestService::create($data);
        return redirect()->route('admin.investService')->with('inserted','Investment Service Created👍');
    }


    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request  )
    {
        $updateData  = InvestService::find( $request->id);
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
            'title'          => $request->title,
            'sub_title'     =>  $request->sub_title,
            'detail'        => $request->detail,
            'image'         => $Image,
            'modified_by'   => $userID,
            'modified_date' => now()
        ]);
        return redirect()->route('admin.investService')->with('updated','Investment Service Updated 👍');
    }

}
