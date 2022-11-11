<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestmentHome;
use Illuminate\Http\Request;

class InvestmentHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editData = getInvestmentHomeCMS();
        return view('admin.investmentHome.create' ,compact('editData'));
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
        /* Insert AboutUs data */
        $userID = auth()->user()->id;

        /******* Insert Images *********/
        $Image = ''; $video  = '';


        if($request->hasfile('image_title'))
        {
            $image = $request->file('image_title') ;
            $destinationPath = public_path('images/investmentHome/image');
            $Image = date('YmdHis') . "." .  str_replace(' ', '', $image->getClientOriginalExtension());;
            $image->move($destinationPath, $Image);
        }

        /******* Insert Video *********/
        if($request->hasfile('video_title'))
        {
                $image = $request->file('video_title') ;
                $destinationPath = public_path('images/investmentHome/video');
                $video = date('YmdHis') . "." .  str_replace(' ', '', $image->getClientOriginalExtension());  ;
                $image->move($destinationPath, $video);
        }
        $arr = [];
        if($request->hasfile('icon')) {

            foreach ($request->file('icon') as $key => $file) {

                $icon = $request->file('icon')[$key];
                $destinationPath = public_path('images/investmentHome/icon');
                $iconName = date('YmdHis') . "." . $file->getClientOriginalName();
                $icon->move($destinationPath, $iconName);

                $arr[] = [
                    'icon' => $iconName,
                    'sub_title' => $request->sub_title[$key],
                    'sub_title_detail' => $request->sub_title_detail[$key],
                ];
            }
        }

        $data  = [
            'title'        => $request->title,
            'name'         => $request->name,
            'detail'       => $request->detail,
            'sub_title'    => json_encode($arr),
            'image_title'  => $Image,
            'video_title'  => $video,
            'status'       => 1,
            'created_by'   => $userID
        ];

         InvestmentHome::create($data);

        return redirect()->route('admin.investmentHome')->with('inserted','Investment Data Created👍');
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

                $destinationPath = public_path('images/investmentHome/image/');

                $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $Image);
                if (!empty($editImage)) {
                    @unlink(public_path('images/investmentHome/image/') . $editImage);
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
                $destinationPath = public_path('images/investmentHome/video/');

                $Video = date('YmdHis') . "." . $video->getClientOriginalExtension();
                $video->move($destinationPath, $Video);
                if (!empty($editVideo)) {
                    @unlink( public_path('images/investmentHome/video/') . $editVideo);
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

        $arr = [];
        if($request->hasfile('icon')) {

            foreach ($request->file('icon') as $key => $file) {

                $icon = $request->file('icon')[$key];
                $destinationPath = public_path('images/investmentHome/icon');
                $iconName = date('YmdHis') . "." . $file->getClientOriginalName();
                $icon->move($destinationPath, $iconName);

                $arr[] = [
                    'icon' => $iconName,
                    'sub_title' => $request->sub_title[$key],
                    'sub_title_detail' => $request->sub_title_detail[$key],
                ];
            }
        }

        $updateData->update([
            'title'        => $request->title,
            'name'         => $request->name,
            'detail'       => $request->detail,
            'sub_title'    => json_encode($arr),
            'image_title'  => $Image,
            'video_title'  => $Video,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.investmentHome')->with('updated','Media Updated 👍');
    }

}
