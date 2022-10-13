<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AmenitiesController extends Controller
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

            $dbData = Amenities::select([ 'amenities_id','amenity_name','amenity_detail','amenity_image','status'])
                ->where('deleted',0)
                ->orderBy("amenities_id",'DESC')
                ->get();
            $data = $dbData->map(function ($data){

                return [
                    'id'             => $data->amenities_id,
                    'amenity_name' => $data->amenity_name,
                    'amenity_detail' => $data->amenity_detail,
                    'amenity_image'  => asset('images/amenities')."/".$data->amenity_image,
                    'status'         => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'   => $data->created_date
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.amenities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.amenities.create' );
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
            'amenity_name'   => 'required',
            'amenity_detail' => 'required',
            //'page_image' => 'required|page_image|mimes:jpeg,png,jpg',
        ]);
        /* Insert Amenities data */
        $userID = auth()->user()->id;
        $Image  = null;

        if ($image = $request->file('amenity_image')) {
            $destinationPath = public_path('images/amenities');
            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
        }
        $page  = [
            'amenity_name'   => $request->amenity_name,
            'amenity_detail' => $request->amenity_detail,
            'amenity_image'  => $Image,
            'status'         => 1,
            'created_by'     => $userID
        ];
        $silwana_id = Amenities::create($page);
        return redirect()->route('admin.amenities')->with('inserted','Amenities Created👍');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\amenities  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = Amenities::find($request->id);
        return view('admin.amenities.create' ,compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\amenities  $amenities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $updateData  = Amenities::find( $request->amenities_id);
        $userID      = auth()->user()->id;
        /* Insert Page data */
        $input = $request->all();

        $image = $request->file('amenity_image');
        $editAmenityImage = $request->edit_amenity_image;
        if (!empty($image) ) {

            $destinationPath = public_path('images/amenities');

            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
            if (!empty($editAmenityImage)) {
                unlink( public_path('images/amenities/') . $editAmenityImage);
            }
        }
        elseif (!empty($editAmenityImage)) {
            $Image = $editAmenityImage;
        }
        else
          {
              $Image = null;
        }
        $updateData->update([
            'amenity_name'  => $request->amenity_name,
            'amenity_detail'=> $request->amenity_detail,
            'amenity_image' => $Image,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);
        return redirect()->route('admin.amenities')->with('updated','Amenities Updated 👍');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\amenities  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$data = Amenities::find($id);
        if ( !empty($data->amenity_image) ){
            unlink("images/amenities/".$data->amenity_image);
        }
        $data->delete();*/
        $data = Amenities::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
        return redirect()->route('admin.amenities')->with('success','Amenities Deleted');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $updateData = Amenities::find($request->id);
        $userID   = auth()->user()->id;
        $status   =  ( !empty($updateData->status) && $updateData->status == 1 ) ?  2 :  1 ;

        $updateData->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.amenities')->with('success','Amenities Status Changed');
    }

    public function deleteImage(){

    }
}
