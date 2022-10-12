<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProjectImage;
use Illuminate\Http\Request;

class OurProjectController extends Controller
{
    public function index(Request $request)
    {
        $projectList    = getProjectList();
        return view('front.ourProject',compact('projectList' ));
    }

    public function projectDetail(Request $request)
    {
        $project_id    =  decrypt($request->route('id'));
        $projectList   = getProjectList($project_id);
        $selectedImage = getProjectImage($projectList['project_id']);
        $address       = getProjectAddress($projectList['project_id']);

        return view('front.projectDetail',compact('projectList','selectedImage','address' ));
    }
}
