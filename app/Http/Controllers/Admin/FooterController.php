<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editData = getFooterData();
        return view('admin.footer.create' ,compact('editData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'title'  => 'required',
            'notes'  => 'required',
            'detail' => 'required',
        ]);
        /* Insert   data */
        $userID = auth()->user()->id;
        $Image  = null;

        if ($image = $request->file('image')) {
            $destinationPath = public_path('images/footer');
            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
        }
        $data  = [
            'title'       => $request->title,
            'detail'      => $request->detail,
            'notes'       => $request->notes,
            'image'       => $Image,
            'status'      => 1,
            'created_by'  => $userID
        ];
        Footer::create($data);
        return redirect()->route('admin.footer')->with('inserted','Footer Data Created👍');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Footer $footer)
    {
        $updateData  = Footer::find( $request->id);
        $userID      = auth()->user()->id;
        /* Insert   data */
        $input = $request->all();

        $image = $request->file('image');
        $editImage = $request->edit_image;
        if (!empty($image) ) {

            $destinationPath = public_path('images/footer');

            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
            if (!empty($editImage)) {
                @unlink( public_path('images/footer/') . $editImage);
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
            'detail'=> $request->detail,
            'notes' => $request->notes,
            'image' => $Image,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);
        return redirect()->route('admin.footer')->with('updated','Footer Data Updated 👍');
    }


}
