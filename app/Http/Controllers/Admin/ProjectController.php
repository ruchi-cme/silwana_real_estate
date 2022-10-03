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
            'work_status' => 'required',
            'project_pdf.*' => 'mimes:pdf,txt',
            'project_image.*' => 'mimes:jpg,png,jpeg,gif,svg'
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
                $destinationPath = 'images/project/pdf';
                $name = date('YmdHis') . "." . $file->getClientOriginalName();
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


        /******* Insert Images *********/
        if($request->hasfile('project_image'))
        {
            foreach($request->file('project_image') as $key => $file)
            {
                $image = $request->file('project_image')[$key];
                $destinationPath = 'images/project/images';
                $name = date('YmdHis') . "." . $file->getClientOriginalName();  ;
                $image->move($destinationPath, $name);
                $insertImg[$key]['project_id'] = $project_id['project_id'];
                $insertImg[$key]['title']  = $name;
                $insertImg[$key]['path']   = $destinationPath;
                $insertImg[$key]['type']   = 2;  //image
                $insertImg[$key]['status'] = 1;
                $insertImg[$key]['created_by'] = $userID;
            }
            ProjectImage::insert($insertImg);
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
        $editProjectImg = !empty($request->edit_project_image) ? $request->edit_project_image :[] ;


        if (!empty($projectImages)) {
            foreach ($projectImages as $img) {

                    if (  !in_array($img['title'] , $editProjectPdf) ) {
                        if($img['type'] == 1) {
                            if (  file_exists(public_path().'/images/project/pdf/'.$img['title'])) {
                                unlink("images/project/pdf/".$img['title']);
                                ProjectImage::where('project_image_id' , $img['project_image_id'])->where('type' , 1)->delete();
                            }
                        }
                    }

                    if  (  !in_array($img['title'] , $editProjectImg)) {
                        if($img['type'] == 2) {
                            if (file_exists(public_path() . '/images/project/images/' . $img['title'])) {
                                unlink("images/project/images/" . $img['title']);
                                ProjectImage::where('project_image_id', $img['project_image_id'])->where('type' , 2)->delete();
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
                $destinationPath = 'images/project/pdf';
                $name = date('YmdHis') . "." . $file->getClientOriginalName();
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



        /******* Insert Images *********/
        if($request->hasfile('project_image'))
        {
            foreach($request->file('project_image') as $key => $file)
            {
                $image = $request->file('project_image')[$key];
                $destinationPath = 'images/project/images';
                $name = date('YmdHis') . "." . $file->getClientOriginalName();
                $image->move($destinationPath, $name);
                $insertImg[$key]['project_id'] = $request->project_id;
                $insertImg[$key]['title']  = $name;
                $insertImg[$key]['path']   = $destinationPath;
                $insertImg[$key]['type']   = 2;  //image
                $insertImg[$key]['status'] = 1;
                $insertImg[$key]['created_by'] = $userID;
            }
            ProjectImage::insert($insertImg);
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
}
