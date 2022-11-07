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
        $projectList    = getProjectList('',array('1','2','3'));
        $currentURL    = last(request()->segments());
        return view('front.OurProjectType',compact('projectList','currentURL' ));
    }

    public function projectDetail(Request $request)
    {
        $project_id    =  decrypt($request->route('id'));
        $projectList   = getProjectList($project_id);
        $selectedImage = getProjectImage($projectList['project_id']);
        $address       = getProjectAddress($projectList['project_id']);
        $amenities     = getAmenitiesByProject($projectList['project_id']);
        $categories    = getCategory();
        $blockData     = getBlockData($project_id);
        $bookingType = Config::get('constants.booking_type');
        $paymentType = Config::get('constants.payment_type');
        $pdf = ProjectImage::select(['project_image_id', 'title','path','type'])
            ->where('project_id' ,  $projectList['project_id'])
            ->where('type' ,  1)
            ->get()
            ->first();


        return view('front.propertyDetail',compact('projectList',
            'selectedImage',
            'address','amenities',
            'categories','blockData','bookingType','paymentType','pdf' ));
    }

    public function projectType(Request $request) {

        $searchProject = $request->searchProject;
        $currentURL    = last(request()->segments());

        if ($currentURL == 'ongoing') {
            //work_status = 1 for ongoing
            $workStatus =  array('1' );
            $projectList  = getProjectList( '' , $workStatus );
        }
        elseif ($currentURL == 'upcoming') {
            //work_status = 2 for ongoing
            $workStatus =  array('2' );
            $projectList  = getProjectList( '' , $workStatus);
        }
        else {
            //work_status = 3 for ongoing
            $workStatus =  array('3' );
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
            $workStatus =  array('1' );
            $projectList  = getProjectList( '' , $workStatus ,$search);
        }
        elseif ($currentURL == 'upcoming') {
            //work_status = 2 for ongoing
            $workStatus =  array('2' );
            $projectList  = getProjectList( '' , $workStatus,$search);
        }
        else {
            //work_status = 3 for ongoing
            $workStatus =  array('3' );
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
