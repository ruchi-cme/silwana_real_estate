<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestmentHome;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InvestmentHomeController extends Controller
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

            $dbData = InvestmentHome::select([ 'id','name','image_video_title','type','status' ])
                ->where('deleted',0)
                ->orderBy("id",'DESC')
                ->get();
            $data = $dbData->map(function ($data) {

                return [
                    'id'                 => $data->media_id,
                    'name'               => $data->name,
                    'type'              =>  $data->type ,

                    'status'             => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'       => $data->created_date
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.media.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create' );
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

        ]);
        /* Insert AboutUs data */
        $userID = auth()->user()->id;

        /******* Insert PDF *********/

        if($request->hasfile('image_title'))
        {
            foreach($request->file('image_title') as $key => $file)
            {
                $pdf = $request->file('image_title')[$key];
                $destinationPath = public_path('images/media/image');
                $name = date('YmdHis') . "." . $file->getClientOriginalName();
                $pdf->move($destinationPath, $name);

                $insert[$key]['image_video_title'] = $name;
                $insert[$key]['name'] = $request->name;
                $insert[$key]['type']  = 1;  //image
                $insert[$key]['status'] = 1;
                $insert[$key]['created_by'] = $userID;
            }
            Media::insert($insert);
        }

        /******* Insert Images *********/
        if($request->hasfile('video_title'))
        {
            foreach($request->file('video_title') as $key => $file)
            {
                $image = $request->file('video_title')[$key];
                $destinationPath = public_path('images/media/video');
                $name = date('YmdHis') . "." . $file->getClientOriginalName();  ;
                $image->move($destinationPath, $name);
                $insertVideo[$key]['image_video_title'] = $name;
                $insertVideo[$key]['name'] = $request->name;
                $insertVideo[$key]['type']   = 2;  //video
                $insertVideo[$key]['status'] = 1;
                $insertVideo[$key]['created_by'] = $userID;
            }
            Media::insert($insertVideo);
        }

        return redirect()->route('admin.media')->with('inserted','Media Created👍');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ourTeam  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = Media::find($request->id);

        return view('admin.media.create' ,compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $userID      = auth()->user()->id;
        /******* Insert PDF *********/
        $updateData  = Media::find( $request->id);

        if($request->hasfile('image_title') || $request->edit_image_title ) {
            $image = $request->file('image_title');
            $editImage = $request->edit_image_title;
            if (!empty($image)) {

                $destinationPath = public_path('images/media/image/');

                $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $Image);
                if (!empty($editImage)) {
                    @unlink(public_path('images/media/image/') . $editImage);
                }
            } elseif (!empty($editImage)) {
                $Image = $editImage;
            } else {
                $Image = null;
            }
        }
        if($request->hasfile('video_title') || $request->edit_video_title) {

            $video = $request->file('video_title');
            $editVideo = $request->edit_video_title;
            if (!empty($video) ) {
                $destinationPath = public_path('images/media/video/');

                $Image = date('YmdHis') . "." . $video->getClientOriginalExtension();
                $video->move($destinationPath, $Image);
                if (!empty($editVideo)) {
                    @unlink( public_path('images/media/video/') . $editVideo);
                }
            }
            elseif (!empty($editVideo)) {
                $Image = $editVideo;
            }
            else
            {
                $Image = null;
            }
        }

        $updateData->update([
            'name'  => $request->name,
            'type'  => $request->imageType,
            'image_video_title' => $Image,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.media')->with('updated','Media Updated 👍');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Media::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
        return redirect()->route('admin.media')->with('success','Media Deleted');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $updateData = Media::find($request->id);
        $userID   = auth()->user()->id;
        $status   =  ( !empty($updateData->status) && $updateData->status == 1 ) ?  2 :  1 ;

        $updateData->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.media')->with('success','Media Status Changed');
    }
}
