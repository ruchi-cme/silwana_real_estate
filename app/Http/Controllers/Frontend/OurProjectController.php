<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OurProjectController extends Controller
{
    public function index(Request $request)
    {
        $projectList    = getProjectList();

        return view('front.ourProject',compact('projectList' ));
    }
}
