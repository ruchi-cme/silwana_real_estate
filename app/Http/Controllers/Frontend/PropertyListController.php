<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FloorUnitMapping;
use Response;

class PropertyListController extends Controller
{

    public function index(Request $request)
    {
        $propertyList    = getPropertyList();
        return view('front.propertyList',compact('propertyList' ));
    }


    public function propertyDetail(Request $request)
    {
        $unit_id  =  decrypt($request->route('id'));
        $propertyDetail =  getPropertyList($unit_id);
        $propertyImage  =  getPropertyImage($unit_id);
        $blockData = getBlockData($propertyDetail['project_id']);

        return view('front.propertyDetail',compact('propertyDetail', 'propertyImage','blockData' ));
    }

    public  function getFloor(Request $request)
    {
        dd($request);
      //  $data['floors'] = getFloor($request->block);
       // return response()->json($data);
    }

public function getUnit(Request $request)
    {
        $data['units'] = getUnit($request->floor_id);
        return response()->json($data);
    }

}
