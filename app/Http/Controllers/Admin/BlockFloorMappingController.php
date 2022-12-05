<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{BlockFloorMapping,ProjFloorImage,FloorDetail,FloorUnitMapping};
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlockFloorMappingController extends Controller
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
                'block_floor_mappings.block_floor_map_id',
                'block_floor_mappings.total_floor',
                'project_master.project_name',
                'block_name_mappings.block_name',
                'block_floor_mappings.status',
                'block_floor_mappings.created_date',
                'block_floor_mappings.project_id'
            ];
            $dbData = BlockFloorMapping::leftJoin('project_master', 'project_master.project_id', '=', 'block_floor_mappings.project_id')
                ->leftJoin('block_name_mappings', 'block_name_mappings.block_name_map_id', '=', 'block_floor_mappings.block_name_map_id')
                ->select($select)
                ->orderBy('block_floor_mappings.block_floor_map_id', 'desc')
                ->where('block_floor_mappings.deleted',0)
                ->get();

            $data = $dbData->map(function ($data){

                return [
                    'project_id'       => $data->project_id,
                    'id'              => $data->block_floor_map_id,
                    'project_name'    => $data->project_name,
                    'block_name'      => $data->block_name,
                    'total_floor'     => $data->total_floor,
                    'status'          => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'    => $data->created_date
                ];
            });

            return DataTables::of($data)->toJson();
        }
        return view('admin.floor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.floor.table' );
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
            'project_name'=> 'required',
            'block_name'  => 'required',
            'total_floor' => 'required',
            'initial_name'=> 'required',
        ]);

        $userID = auth()->user()->id;

        /*****    Insert Block Data    *******/
        if (!empty($request->block_floor_map_id)) {

            /*****    Update Block  Data    *******/
            $updateData  = BlockFloorMapping::find( $request->block_floor_map_id);

            $total_floor = $request->total_floor - $updateData->total_floor ;
            $latestFloor = $updateData->total_floor;

            $updateData->update([
                'project_id'         => $request->project_name,
                'block_name_map_id'  => $request->block_name,
                'total_floor'   => $request->total_floor,
                'initial_name'       => $request->initial_name,
                'modified_by'  => $userID
            ]);

            $blockFloorId['block_floor_map_id'] = $request->block_floor_map_id ;

        } else {
            $insertBlockFloorData = [
                'project_id'         => $request->project_name,
                'block_name_map_id'  => $request->block_name,
                'total_floor'        => $request->total_floor,
                'initial_name'       => $request->initial_name,
                'status'             => 1,
                'created_by'         => $userID
            ];

           $blockFloorId = BlockFloorMapping::create($insertBlockFloorData);
            $total_floor = $request->total_floor;
            $latestFloor = '';
        }

        /******* Insert Floor Detail *********/
        if(!empty($total_floor))
        {
            /****** RESET Arrays *******/

            $category_id    = array_values($request->category_id);
            $from           = array_values($request->from);
            $unit           = array_values($request->unit);
            $unit_name      = array_values($request->unit_name);
            $sq_ft          = array_values($request->sq_ft);
            $total_price    = array_values($request->total_price);
            $booking_price  = array_values($request->booking_price);
            $floor_number   = array_values( $request->floor_number);
            /****** END RESET Arrays *******/

            for($j=0; $j < $total_floor; $j++  )
            {
                $insertFloorDetail['project_id']         = $request->project_name;
                $insertFloorDetail['block_floor_map_id'] = $blockFloorId['block_floor_map_id'];
                $insertFloorDetail['category_id']        = $category_id[$j];
                $insertFloorDetail['floor_no']           = $floor_number[$j];  /// !empty($latestFloor) ? $latestFloor + 1 : $j + 1 ;
                $insertFloorDetail['from']               = $from[$j];
                $insertFloorDetail['unit_count']         = $unit[$j];
                $insertFloorDetail['status']             = 1;
                $insertFloorDetail['created_by']         = $userID;

                $floorDetailId = FloorDetail::create($insertFloorDetail);

                /******* Insert Unit Detail *********/
                if($unit[$j])
                {
                    for( $i=0; $i < $unit[$j]; $i++ )
                    {
                        $insertUnitDetail['floor_detail_id']   = $floorDetailId['floor_detail_id'] ;
                        $insertUnitDetail['unit_name']         = $unit_name[$j][$i];
                        $insertUnitDetail['area_in_sq_feet']   = $sq_ft[$j][$i];
                        $insertUnitDetail['total_price']       = $total_price[$j][$i];
                        $insertUnitDetail['booking_price']     = $booking_price[$j][$i];
                        $insertUnitDetail['booking_type']      = 1;
                        $insertUnitDetail['status']            = 1;
                        $insertUnitDetail['created_by']        = $userID;

                        FloorUnitMapping::insert($insertUnitDetail);
                    }
                }
            }
        }

        return redirect()->route('admin.floor')->with('inserted','Floor Created👍');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlockFloorMapping  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
         $editData = BlockFloorMapping::find($request->id);

        $floorData = FloorDetail::where('block_floor_map_id',$request->id)->get()->toArray();
        //dd($floorData);
      //  $unitData = FloorUnitMapping::where();

        return view('admin.floor.table' ,compact('editData','floorData'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlockFloorMapping  $blockFloorMapping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        /*****    Update Block  Data    *******/
        $updateData  = BlockFloorMapping::find( $request->proj_block_floor_id);
        $userID      = auth()->user()->id;

        $updateData->update([
            'proj_block_mapg_id'   => $request->proj_block_floor_id,
            'category_id'   => $request->category_name,
            'floor_no'     => $request->floor_no,
            'unit_count'   => $request->unit_count,
            'floor_detail' => $request->floor_detail,
            'modified_by'  => $userID
        ]);

        /******* delete  Image *********/

        $image  = ProjFloorImage::where('proj_block_floor_id' ,  $request->proj_block_floor_id)->get();
        $editImg = !empty($request->edit_image) ? $request->edit_image :[] ;

        if (!empty($image)) {
            foreach ($image as $img) {
                if (!in_array($img['title'] , $editImg)) {
                    if (file_exists(public_path() . '/images/floor/' . $img['title'])) {
                        @unlink(public_path("images/floor/"). $img['title']);
                        ProjFloorImage::where('proj_floor_image_id', $img['proj_floor_image_id'])->delete();
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
                $destinationPath = public_path('images/floor');
                $name = date('YmdHis') . "." . $file->getClientOriginalName();  ;
                $image->move($destinationPath, $name);
                $insertImg[$key]['proj_block_floor_id'] = $request->proj_block_floor_id;
                $insertImg[$key]['title']  = $name;
                $insertImg[$key]['path']   = $destinationPath;
                $insertImg[$key]['status'] = 1;
                $insertImg[$key]['created_by'] = $userID;
            }
            ProjFloorImage::insert($insertImg);
        }

        return redirect()->route('admin.floor')->with('updated','Floor Updated 👍');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlockFloorMapping  $blockFloorMapping
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data   = BlockFloorMapping::find($id);
        $userID = auth()->user()->id;

        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);

        return redirect()->route('admin.floor')->with('success','Floor Deleted');
    }


    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $data = BlockFloorMapping::find($request->id);

        $userID   = auth()->user()->id;
        $status   = ( !empty($data->status) && $data->status == 1 ) ?  2 :  1 ;

        $data->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.floor')->with('success','Floor Status Changed');
    }

    public function getProBlockUnitData(Request $request) {

        $project_id = $request->project_id;
        $data['blockData'] = getProjectBlockFloorUnitDetail($project_id);;
        return response()->json($data);
    }
}
