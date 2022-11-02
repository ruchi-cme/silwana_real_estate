<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Config;
use Auth;

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
        $amenities     = getAmenities();
        $categories    = getCategory();
        $blockData     = getBlockData($project_id);
        $bookingType = Config::get('constants.booking_type');
        $paymentType = Config::get('constants.payment_type');
        return view('front.propertyDetail',compact('projectList',
            'selectedImage',
            'address','amenities',
            'categories','blockData','bookingType','paymentType' ));
    }

    public function projectType(Request $request) {

        $searchProject = $request->searchProject;
        $currentURL    = last(request()->segments());

        if ($currentURL == 'ongoing') {
            //work_status = 1 for ongoing
            $workStatus = 1;
            $projectList  = getProjectList( '' , $workStatus );
        }
        elseif ($currentURL == 'upcoming') {
            //work_status = 2 for ongoing
            $workStatus = 2;
            $projectList  = getProjectList( '' , $workStatus);
        }
        else {
            //work_status = 3 for ongoing
            $workStatus = 3;
            $projectList  = getProjectList( '' , $workStatus );
        }

        return view('front.OurProjectType',compact('projectList','currentURL'));
    }


    public function projectSearch(Request $request) {

        $searchProject = $request->searchProject;
        $currentURL    =  $request->currentURL ;

        $search = '';

        if (!empty($searchProject)) {
            $search = $searchProject;
        }

        if ($currentURL == 'ongoing') {
            //work_status = 1 for ongoing
            $workStatus = 1;
            $projectList  = getProjectList( '' , $workStatus ,$search);
        }
        elseif ($currentURL == 'upcoming') {
            //work_status = 2 for ongoing
            $workStatus = 2;
            $projectList  = getProjectList( '' , $workStatus,$search);
        }
        else {
            //work_status = 3 for ongoing
            $workStatus = 3;
            $projectList  = getProjectList( '' , $workStatus ,$search);
        }
        return view('front.OurProjectType',compact('projectList','currentURL'));
       //return redirect('ourProject/'.$currentURL);
    }

    public  function getFloor(Request $request)
    {
        $data['floors'] =  getFloor($request->block);
        return response()->json($data);
    }

    public function getUnit(Request $request)
    {
        $booking_type = 1;
        $data['units'] = getUnit($request->floor_id, $booking_type);
        return response()->json($data);
    }

    public function getUnitData(Request $request)
    {
        $data['unitData'] = getUnitData($request->unit_id);
        return response()->json($data);
    }



}
