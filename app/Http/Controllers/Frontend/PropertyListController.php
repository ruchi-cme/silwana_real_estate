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


    public function propertyDetail(Request $request)
    {
        $id            =  decrypt($request->route('id'));
        $propertyDetail=  getPropertyList($id);
        $propertyImage =  getPropertyImage($id);
        return view('front.propertyDetail',compact('propertyDetail', 'propertyImage' ));
    }


}
