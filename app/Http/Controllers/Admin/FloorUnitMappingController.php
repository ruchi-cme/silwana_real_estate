<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{FloorDetail, FloorUnitMapping, ProjUnitImage, BlockFloorMapping};
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Config;

class FloorUnitMappingController extends Controller
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


            $select =  [
                'floor_unit_mapping.floor_unit_id',
                'floor_unit_mapping.unit_name',
                'floor_unit_mapping.area_in_sq_feet',
                'floor_unit_mapping.total_price',
                'floor_unit_mapping.booking_price',
                'floor_unit_mapping.total_price',
                'floor_unit_mapping.booking_type',
                'floor_unit_mapping.status',
                'category_master.category_name',
                'block_name_mappings.block_name',
                'project_master.project_name'
            ];
            $dbData = FloorUnitMapping::leftJoin('floor_details', 'floor_details.floor_detail_id', '=', 'floor_unit_mapping.floor_detail_id')
                ->leftJoin('block_floor_mappings', 'block_floor_mappings.block_floor_map_id', '=', 'floor_details.block_floor_map_id')
                ->leftJoin('block_name_mappings', 'block_name_mappings.block_name_map_id', '=', 'block_floor_mappings.block_name_map_id')
                ->leftJoin('project_master', 'project_master.project_id', '=', 'floor_details.project_id')
                ->leftJoin('category_master', 'category_master.category_id', '=', 'floor_details.category_id')

                ->select($select)
                ->orderBy('floor_unit_mapping.floor_unit_id', 'desc')
                ->where('floor_unit_mapping.deleted',0)
                ->get();

            $data = $dbData->map(function ($data){

                return [
                    'id'              => $data->floor_unit_id,
                    'project_name'      => $data->project_name,
                    'block_name'      => $data->block_name,
                    'unit_name'       => $data->unit_name,
                    'category_name'   => $data->category_name,
                    'total_price'     => $data->total_price,
                    'booking_price'   => $data->booking_price,
                    'area_in_sq_feet' => $data->area_in_sq_feet,
                    'status'          => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'    => $data->created_date
                ];
            });

            return DataTables::of($data)->toJson();
        }
        return view('admin.unit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookingStatus = Config::get('constants.booking_status');
        return view('admin.unit.create',compact('bookingStatus') );
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
            'block_name'     => 'required',
            'floor_number'   => 'required',
            'category_name'  => 'required',
            'unit_name'      => 'required',
            'area_in_sq_feet' => 'required',
            'total_price'    => 'required',
            'booking_price'  => 'required',
        ]);

        $userID = auth()->user()->id;

        //get project data
        $blockFloorMap = BlockFloorMapping::select([ 'block_floor_map_id','total_floor'])
            ->where('project_id', $request->project_name)
            ->where('block_name_map_id', $request->block_name)
            ->get()->first();


        /*****    Insert Block Data    *******/
        if(!empty($blockFloorMap)) {

             $blockFloorMap->update([

                'total_floor'   =>  $blockFloorMap->total_floor + 1,
                'modified_by'  => $userID
            ]);
            $blockFloorId['block_floor_map_id'] = $blockFloorMap->block_floor_map_id ;

            //get project data
            $floorDetail = FloorDetail::select([ 'floor_detail_id','unit_count'])
                ->where('project_id', $request->project_name)
                ->where('block_floor_map_id', $blockFloorMap->block_floor_map_id)
                ->where('floor_no', $request->floor_number)
                ->get()->first();

            if(!empty($floorDetail)) {
                $floorDetail->update([

                    'unit_count'   =>  $floorDetail->unit_count + 1,
                    'modified_by'  => $userID
                ]);
                $floorDetailId['floor_detail_id']  = $floorDetail->floor_detail_id;
            }
            else{
                $insertFloorDetail['project_id']         = $request->project_name;
                $insertFloorDetail['block_floor_map_id'] = $blockFloorId['block_floor_map_id'];
                $insertFloorDetail['category_id']        = $request->category_name ;
                $insertFloorDetail['floor_no']           = $request->floor_number;  /// !empty($latestFloor) ? $latestFloor + 1 : $j + 1 ;
                $insertFloorDetail['unit_count']         = 1 ;
                $insertFloorDetail['status']             = 1;
                $insertFloorDetail['created_by']         = $userID;

                  $floorDetailId = FloorDetail::create($insertFloorDetail);
            }
        }  else{
            $insertBlockFloorData = [
                'project_id'         => $request->project_name,
                'block_name_map_id'  => $request->block_name,
                'total_floor'        => $request->total_floor,
                'initial_name'       => $request->initial_name,
                'status'             => 1,
                'created_by'         => $userID
            ];
            $blockFloorId = BlockFloorMapping::create($insertBlockFloorData);

            $insertFloorDetail['project_id']         = $request->project_name;
            $insertFloorDetail['block_floor_map_id'] = $blockFloorId['block_floor_map_id'];
            $insertFloorDetail['category_id']        =$request->category_name;
            $insertFloorDetail['floor_no']           = $request->floor_number;
            $insertFloorDetail['unit_count']         = 1;
            $insertFloorDetail['status']             = 1;
            $insertFloorDetail['created_by']         = $userID;

            $floorDetailId = FloorDetail::create($insertFloorDetail);

        }

        $insertUnitDetail['floor_detail_id']   = $floorDetailId['floor_detail_id'] ;
        $insertUnitDetail['unit_name']         = $request->unit_name ;
        $insertUnitDetail['area_in_sq_feet']   = $request->area_in_sq_feet ;
        $insertUnitDetail['total_price']       = $request->total_price ;
        $insertUnitDetail['booking_price']     = $request->booking_price ;
        $insertUnitDetail['booking_type']      = 1;
        $insertUnitDetail['status']            = 1;
        $insertUnitDetail['created_by']        = $userID;

        FloorUnitMapping::insert($insertUnitDetail);

        return redirect()->route('admin.unit')->with('inserted','Unit Created👍');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FloorUnitMapping  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = FloorUnitMapping::find($request->id);

        $bookingStatus = Config::get('constants.booking_status');
        $selectedImage = ProjUnitImage::select([ 'title','path'])->where('proj_floor_unit_id' ,  $request->id)->get()->toArray();

        return view('admin.unit.create' ,compact('editData','selectedImage','bookingStatus'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FloorUnitMapping  $floorUnitMapping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FloorUnitMapping $floorUnitMapping)
    {
        /*****    Update Block  Data    *******/
        $updateData  = FloorUnitMapping::find( $request->proj_floor_unit_id);
        $userID      = auth()->user()->id;

        $updateData->update([
            'proj_block_floor_id'   => $request->block_name,
            'category_id'   => $request->category_name,
            'unit_name'     => $request->unit_name,
            'facing'        => $request->facing,
            'overlooking'   => $request->overlooking,
            'rooms'         => $request->rooms,
            'area_in_sq_feet' => $request->area_in_sq_feet,
            'total_price'   => $request->total_price,
            'booking_price' => $request->booking_price,
            'booking_type'  => $request->booking_type,
            'modified_by'  => $userID
        ]);

        /******* delete  Image *********/

        $image  = ProjUnitImage::where('proj_floor_unit_id' ,  $request->proj_floor_unit_id)->get();
        $editImg = !empty($request->edit_image) ? $request->edit_image :[] ;

        if (!empty($image)) {
            foreach ($image as $img) {
                if (!in_array($img['title'] , $editImg)) {
                    if (file_exists(public_path() . '/images/unit/' . $img['title'])) {
                        @unlink(public_path("images/unit/") . $img['title']);
                        ProjUnitImage::where('proj_unit_image_id', $img['proj_unit_image_id'])->delete();
                    }
                }
            }
        }

        /******* Insert Images *********/
        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $key => $file)
            {
                $image = $request->file('image')[$key];
                $destinationPath = public_path('images/unit');
                $name = date('YmdHis') . "." . $file->getClientOriginalName();  ;
                $image->move($destinationPath, $name);
                $insertImg[$key]['proj_floor_unit_id'] = $request->proj_floor_unit_id;
                $insertImg[$key]['title']  = $name;
                $insertImg[$key]['path']   = $destinationPath;
                $insertImg[$key]['status'] = 1;
                $insertImg[$key]['created_by'] = $userID;
            }
            ProjUnitImage::insert($insertImg);
        }

        return redirect()->route('admin.unit')->with('updated','Unit Updated 👍');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FloorUnitMapping  $floorUnitMapping
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data   = FloorUnitMapping::find($id);
        $userID = auth()->user()->id;

        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);

        return redirect()->route('admin.unit')->with('success','Unit Deleted');
    }


    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $data = FloorUnitMapping::find($request->id);

        $userID   = auth()->user()->id;
        $status   = ( !empty($data->status) && $data->status == 1 ) ?  2 :  1 ;

        $data->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.unit')->with('success','Unit Status Changed');
    }
}
