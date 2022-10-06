<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{FloorUnitMapping,ProjUnitImage };
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
                'proj_floor_unit_mapping.proj_floor_unit_id',
                'proj_floor_unit_mapping.unit_name',
                'proj_floor_unit_mapping.area_in_sq_feet',
                'proj_floor_unit_mapping.total_price',
                'proj_floor_unit_mapping.booking_price',
                'proj_floor_unit_mapping.total_price',
                'proj_floor_unit_mapping.booking_type',
                'proj_floor_unit_mapping.status',
                'category_master.category_name',
                'proj_block_mappings.block_name'
            ];
            $dbData = FloorUnitMapping::leftJoin('category_master', 'category_master.category_id', '=', 'proj_floor_unit_mapping.category_id')
                ->leftJoin('proj_block_mappings', 'proj_block_mappings.proj_block_map_id', '=', 'proj_floor_unit_mapping.proj_block_floor_id')
                ->leftJoin('project_master', 'project_master.project_id', '=', 'proj_block_mappings.project_id')
                ->select($select)
                ->orderBy('proj_floor_unit_mapping.proj_floor_unit_id', 'desc')
                ->where('proj_floor_unit_mapping.deleted',0)
                ->get();

            $data = $dbData->map(function ($data){

                return [
                    'id'              => $data->proj_floor_unit_id,
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
            'block_name'    => 'required',
            'category_name' => 'required',
            'unit_name'     => 'required',
            'area_in_sq_feet' => 'required',
            'total_price'   => 'required',
            'booking_price' => 'required',
            'booking_type'  => 'required',
            'image.*'       => 'mimes:jpg,png,jpeg,gif,svg',
        ]);

        $userID = auth()->user()->id;

        /*****    Insert Block Data    *******/
        $insertData  = [
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
            'status'        => 1,
            'created_by'    => $userID
        ];

        $proj_floor_unit_id = FloorUnitMapping::create($insertData);


        /******* Insert Images *********/
        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $key => $file)
            {
                $image = $request->file('image')[$key];
                $destinationPath = 'images/unit';
                $name = date('YmdHis') . "." . $file->getClientOriginalName();  ;
                $image->move($destinationPath, $name);
                $insertImg[$key]['proj_floor_unit_id'] = $proj_floor_unit_id['proj_floor_unit_id'];
                $insertImg[$key]['title']  = $name;
                $insertImg[$key]['path']   = $destinationPath;
                $insertImg[$key]['status'] = 1;
                $insertImg[$key]['created_by'] = $userID;
            }
            ProjUnitImage::insert($insertImg);
        }


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
                        unlink("images/unit/" . $img['title']);
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
                $destinationPath = 'images/unit';
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
