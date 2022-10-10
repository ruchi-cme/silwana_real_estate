<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyListController extends Controller
{

    public function index(Request $request)
    {
        $propertyList    = getPropertyList();
        return view('front.propertyList',compact('propertyList' ));
    }


    public function propertydetail(Request $request)
    {
        $projectList    = getProjectList();
        return view('front.propertyDetail',compact('projectList' ));
    }
}
