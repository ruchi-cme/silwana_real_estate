<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuildingService;
use Illuminate\Http\Request;

class BuildingServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editData = getBuildingService();
        return view('admin.buildingService.create' ,compact('editData'));
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
            "title" => "required",
            "name"  => "required",
            "detail" => "required",
        ]);
        /* Insert   data */
        $userID = auth()->user()->id;

        /******* Insert Images *********/
        $Image = ''; $video  = '';


        if($request->hasfile('image_title'))
        {
            $image = $request->file('image_title') ;
            $destinationPath = public_path('images/businessServices');
            $Image = date('YmdHis') . "." .  str_replace(' ', '', $image->getClientOriginalExtension());;
            $image->move($destinationPath, $Image);
        }

        /******* Insert Video *********/
        if($request->hasfile('video_title'))
        {
            $image = $request->file('video_title') ;
            $destinationPath = public_path('images/businessServices/video');
            $video = date('YmdHis') . "." .  str_replace(' ', '', $image->getClientOriginalExtension());  ;
            $image->move($destinationPath, $video);
        }

        $data  = [
            'title'        => $request->title,
            'name'         => $request->name,
            'detail'    => json_encode($request->detail),
            'image_title'  => $Image,
            'video_title'  => $video,
            'created_by'   => $userID
        ];

        BuildingService::create($data);

        return redirect()->route('admin.buildingService')->with('inserted','Building Data Created👍');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {

        $userID      = auth()->user()->id;
        /******* Insert PDF *********/
        $updateData  = BuildingService::find( $request->id);

        if($request->hasfile('image_title') || $request->edit_image_title ) {
            $image = $request->file('image_title');
            $editImage = $request->edit_image_title;
            if (!empty($image)) {

                $destinationPath = public_path('images/businessServices/');

                $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $Image);
                if (!empty($editImage)) {
                    @unlink(public_path('images/businessServices/') . $editImage);
                }
            } elseif (!empty($editImage)) {
                $Image = $editImage;
            } else {
                $Image = null;
            }
        }
        $Video = null;
        if($request->hasfile('video_title') || $request->edit_video_title) {

            $video = $request->file('video_title');
            $editVideo = $request->edit_video_title;
            if (!empty($video) ) {
                $destinationPath = public_path('images/businessServices/video/');

                $Video = date('YmdHis') . "." . $video->getClientOriginalExtension();
                $video->move($destinationPath, $Video);
                if (!empty($editVideo)) {
                    @unlink( public_path('images/businessServices/video/') . $editVideo);
                }
            }
            elseif (!empty($editVideo)) {
                $Video = $editVideo;
            }
            else
            {
                $Video = null;
            }
        }

        $updateData->update([
            'title'         => $request->title,
            'name'          => $request->name,
            'detail'        => json_encode($request->detail),
            'image_title'   => $Image,
            'video_title'   => $Video,
            'modified_by'   => $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.buildingService')->with('updated','buildingService Updated 👍');
    }

}
