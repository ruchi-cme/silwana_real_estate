<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Amenities,
    City,
    Project,
    Category,
    Proj_ameni_mapping,
    Country,
    Project_address_detail,
    ProjectImage,
    State};
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Config;
use DB;

class ProjectController extends Controller
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

             $select =  [ 'project_master.project_id',
                            'project_master.project_name',
                            'project_master.work_status',
                            'project_master.status',
                            'project_master.created_date',
                            'category_master.category_name',
                        ];
            $dbData = Project::leftJoin('category_master', 'category_master.category_id', '=', 'project_master.category_id')
                ->select($select)
                ->where('project_master.deleted',0)
                ->orderBy('project_master.project_id', 'desc')
                ->get();

            $data = $dbData->map(function ($data){

                return [
                    'id'             => $data->project_id,
                    'project_name'   => $data->project_name,
                    'category_name'  => $data->category_name,
                    'work_status'    => !empty($data->work_status) && ($data->work_status == 1) ? 'Upcoming' : 'Ready for sale',
                    'status'         => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'   => $data->created_date
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workStatus = Config::get('constants.work_status');
        $countries = Country::all();

        return view('admin.project.create',compact('workStatus','countries'));
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
            'project_name'   => 'required',
            'category_id' => 'required',
            'work_status' => 'required',
            'amenities_id' => 'required',
            'address' => 'required',
            'project_pdf.*' => 'mimes:pdf,txt',
        ]);

        $userID = auth()->user()->id;

        /*****    Insert Project Data    *******/
        $projectData  = [
            'project_name'   => $request->project_name,
            'project_detail' => $request->project_detail,
            'category_id'    =>  $request->category_id,
            'maintenance'   => $request->maintenance,
            'work_status'    => $request->work_status,
            'status'         => 1,
            'created_by'     => $userID
        ];
        $project_id = Project::create($projectData);

         /*****    Insert Amenity  Data    *******/

        $amenities_id = $request->amenities_id;
        if (!empty($amenities_id)) {
            for($i = 0; $i < count($amenities_id); $i++) {
                $amenityData[] = [
                    'project_id'   => $project_id['project_id'] ,
                    'amenities_id' => $amenities_id[$i],
                    'status'       => 1,
                    'created_by'   => $userID
                ];
            }
        }

        Proj_ameni_mapping::insert($amenityData);

        /*****    Insert Project Address Data    *******/

        $projectAddressData  = [
            'project_id'     => $project_id['project_id'],
            'address'        => $request->address,
            'landmark'       => $request->landmark,
            'country'        => $request->country,
            'state'          => $request->state,
            'city'           => $request->city,
            'zip'            => $request->zip,
            'latitude'       => $request->latitude,
            'longitude'      => $request->longitude,
            'status'         => 1,
            'created_by'     => $userID
        ];
        Project_address_detail::create($projectAddressData);


        /******* Insert PDF *********/

        if($request->hasfile('project_pdf'))
        {
            foreach($request->file('project_pdf') as $key => $file)
            {
                $pdf = $request->file('project_pdf')[$key];
                $destinationPath = public_path('images/project/pdf');
                $name = date('YmdHis') . "." . str_replace(' ', '',$file->getClientOriginalName());
                $pdf->move($destinationPath, $name);
                $insert[$key]['project_id'] = $project_id['project_id'];
                $insert[$key]['title'] = $name;
                $insert[$key]['path'] = $destinationPath;
                $insert[$key]['type']  = 1;  //PDF
                $insert[$key]['status'] = 1;
                $insert[$key]['created_by'] = $userID;
            }
            ProjectImage::insert($insert);
        }



        return redirect()->route('admin.project')->with('inserted','project Created👍');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $workStatus   = Config::get('constants.work_status');
        $countries = Country::all();

        $select =  [ 'project_master.project_id',
            'project_master.project_name',
            'project_master.project_detail',
            'project_master.category_id',
            'project_master.maintenance',
            'project_master.work_status',
            'project_master.status',
            'project_master.created_date',
            'project_address_details.address',
            'project_address_details.landmark',
            'project_address_details.country',
            'project_address_details.state',
            'project_address_details.city',
            'project_address_details.zip',

        ];
        $editData = Project::leftJoin('proj_ameni_mappings', 'proj_ameni_mappings.project_id', '=', 'project_master.project_id')
            ->leftJoin('project_address_details','project_address_details.project_id' , '=', 'project_master.project_id')
            ->select($select)
            ->where('project_master.project_id', $request->id)
            ->first();

        $selectedAmenity = Proj_ameni_mapping::select([ 'amenities_id'])->where('project_id' ,  $request->id)->get()->toArray();
        $selectedAmenity = array_column($selectedAmenity, 'amenities_id');

        $selectedImage = ProjectImage::select([ 'title','path','type'])->where('project_id' ,  $request->id)->get()->toArray();


        $states  = State::where('country_id' , $editData->country)->orderBy("name",'ASC')->get();
        $cities = City::where('state_id' , $editData->state)->orderBy("name",'ASC')->get();


        //$editData = Project::find($request->id);

        return view('admin.project.create',compact('workStatus','selectedAmenity','editData','countries','selectedImage','states','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {

        /*****    Update Project  Data    *******/
        $updateData  = Project::find( $request->project_id);
        $userID      = auth()->user()->id;

        $updateData->update([
            'project_name'   => $request->project_name,
            'project_detail' => $request->project_detail,
            'category_id'    => $request->category_id,
            'maintenance'    => $request->maintenance,
            'work_status'    => $request->work_status,
            'modified_by'    => $userID,
            'modified_date'  => now()
        ]);

        /***** Update Amenity data **********/

        $amenities_id = $request->amenities_id;

        if (!empty($amenities_id)) {
            Proj_ameni_mapping::where('project_id' ,  $request->project_id)->delete() ;
            for($i = 0; $i < count($amenities_id); $i++) {
                $amenityData[] = [
                    'project_id'   => $request->project_id ,
                    'amenities_id' => $amenities_id[$i],
                    'status'       => 1,
                    'created_by'   => $userID
                ];
            }
            Proj_ameni_mapping::insert($amenityData);
        }

        /*****    Update Project Address Data    *******/

        $projectAddressData  = Project_address_detail::where('project_id' ,  $request->project_id);

        $projectAddressData->update([
            'project_id'     => $request->project_id,
            'address'        => $request->address,
            'landmark'       => $request->landmark,
            'country'        => $request->country,
            'state'          =>  $request->state,
            'city'           => $request->city,
            'zip'            => $request->zip,
            'latitude'       => $request->latitude,
            'longitude'      => $request->longitude,
            'status'         => 1,
            'created_by'     => $userID
        ]);

        /******* Insert PDF *********/

        $projectImages  = ProjectImage::where('project_id' ,  $request->project_id)->get();
        $editProjectPdf = !empty($request->edit_project_pdf) ? $request->edit_project_pdf : [] ;

        if (!empty($projectImages)) {
            foreach ($projectImages as $img) {

                    if (  !in_array($img['title'] , $editProjectPdf) ) {
                        if($img['type'] == 1) {
                            if (  file_exists(public_path().'/images/project/pdf/'.$img['title'])) {
                                @unlink(public_path("images/project/pdf/").$img['title']);
                                ProjectImage::where('project_image_id' , $img['project_image_id'])->where('type' , 1)->delete();
                            }
                        }
                    }


            }
        }

        if($request->hasfile('project_pdf'))
        {
            foreach($request->file('project_pdf') as $key => $file)
            {
                $pdf = $request->file('project_pdf')[$key];
                $destinationPath = public_path('images/project/pdf');
                $name = date('YmdHis') . "." .str_replace(' ', '',$file->getClientOriginalName());
                $pdf->move($destinationPath, $name);
                $insert[$key]['project_id'] = $request->project_id;
                $insert[$key]['title'] = $name;
                $insert[$key]['path'] = $destinationPath;
                $insert[$key]['type']  = 1;  //PDF
                $insert[$key]['status'] = 1;
                $insert[$key]['created_by'] = $userID;
            }
            ProjectImage::insert($insert);
        }


        return redirect()->route('admin.project')->with('updated','Project Updated 👍');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data   = Project::find($id);
        $userID = auth()->user()->id;
        $data->update([
            'deleted'      => 1,  //Deleted
            'deleted_date' => now(),
            'deleted_by'   =>  $userID,
        ]);

        /*$data = Project::find($id)->delete() ;
        Proj_ameni_mapping::where('project_id' ,  $id)->delete() ;
        Project_address_detail::where('project_id' ,  $id)->delete();

        $projectImages  = ProjectImage::where('project_id' ,  $id)->get();
        if (!empty($projectImages)) {

            foreach ($projectImages as $img) {

                if (file_exists(public_path() . '/images/project/pdf/' . $img['title']) ) {
                    unlink("images/project/pdf/" . $img['title']);
                }
                if ( file_exists(public_path() . '/images/project/images/' . $img['title'])) {
                    unlink("images/project/images/" . $img['title']);
                }
            }
             ProjectImage::where('project_id' ,  $id)->delete();

        }
*/
        return redirect()->route('admin.project')->with('success','Project Deleted');
    }


    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $data = Project::find($request->id);

        $userID   = auth()->user()->id;
         $status   =  ( !empty($data->status) && $data->status == 1 ) ?  2 :  1 ;

        $data->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.project')->with('success','Project Status Changed');
    }

    public function imageUpload(Request $request) {

        $projectData   = Project::find($request->id);
        $selectedImage = getProjectImage($request->id);

        return view('admin.project.imageUpload',compact('projectData','selectedImage'));
    }

    public function imageUpdate(Request $request) {

        /******* Insert Images *********/
        $userID        = auth()->user()->id;

        if(!empty($request->removeImgId)){

    $removeImgId = explode(',', $request->removeImgId);

    foreach ($removeImgId as $row) {
        $projectImg = ProjectImage::find($row);

        if (file_exists(public_path() . '/images/project/images/' . $projectImg->title)) {
            @unlink(public_path("images/project/images/" ). $projectImg->title);
        }
        ProjectImage::where('project_image_id', $projectImg->project_image_id)->where('type' , 2)->delete();
        }
    }

        if (!empty($request->direction)) {
            for ($i = 0; $i < count($request->direction); $i++) {

                $image = $request->file('image');
                $name = '';
                $destinationPath = "";
                if (isset($image)) {
                    $headingImage = $request->file('image')[$i];
                    $destinationPath = public_path('images/project/images');
                    $name = date('YmdHis') . "." . str_replace(' ', '',$headingImage->getClientOriginalName());
                    $headingImage->move($destinationPath, $name);
                }

                $insertImg[]  = [
                    'project_id'    => $request->project_id,
                    'title'         => $name,
                    'direction'     => $request->direction[$i],
                    'facing'        => $request->facing[$i],
                    'path'          => $destinationPath,
                    'type'          => 2  ,
                    'created_by'    => $userID ,
                    'status'        => 1,
                ];
            }

            ProjectImage::insert($insertImg);
        }

        if (!empty($request->project_image_id)) {
           for ($i = 0; $i < count($request->project_image_id); $i++) {

               $projectImg = ProjectImage::find($request->project_image_id[$i]);

               if ($request->edit_image) {
                   $editHeadingImage = $request->edit_image[$i];
               } else {
                   $editHeadingImage = '';
               }

               $headingImage = $request->file('edit_change_image');
               $destinationPath = public_path('images/project/images');
               if (isset($headingImage)) {
                   if (array_key_exists($i, $headingImage)) {
                       $headingImage = $request->file('edit_change_image')[$i];

                           $subHeadingImage = date('YmdHis') . "." . str_replace(' ', '',$headingImage->getClientOriginalName());
                       $headingImage->move($destinationPath, $subHeadingImage);
                       if (!empty($editHeadingImage) && file_exists(public_path() . '/images/project/images/' . $editHeadingImage)) {
                           @unlink(public_path('images/project/images/') . $editHeadingImage);
                       }
                   } else {
                       $subHeadingImage = $editHeadingImage;
                   }

               } elseif (!empty($editHeadingImage)) {
                   $subHeadingImage = $editHeadingImage;
               } else {
                   $subHeadingImage = null;
               }

               $updateImg = [
                   'project_id' => $request->project_id,
                   'title' => $subHeadingImage,
                   'direction' => $request->edit_direction[$i],
                   'facing' => $request->edit_facing[$i],
                   'path' => $destinationPath,
                   'type' => 2,
                   'created_by' => $userID,
                   'status' => 1,
               ];


               $projectImg->update($updateImg);
           }
       }
        return redirect()->route('admin.project')->with('inserted','Image uploaded👍');

    }
}
