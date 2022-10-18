<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{BlockFloorMapping,ProjFloorImage};
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
                'proj_block_floor_dtl.proj_block_floor_id',
                'proj_block_floor_dtl.floor_no',
                'proj_block_floor_dtl.unit_count',
                'proj_block_floor_dtl.status',
                'category_master.category_name',
                'proj_block_mappings.block_name'
            ];
            $dbData = BlockFloorMapping::leftJoin('category_master', 'category_master.category_id', '=', 'proj_block_floor_dtl.category_id')
                ->leftJoin('proj_block_mappings', 'proj_block_mappings.proj_block_map_id', '=', 'proj_block_floor_dtl.proj_block_mapg_id')
                ->select($select)
                ->orderBy('proj_block_floor_dtl.proj_block_floor_id', 'desc')
                ->where('proj_block_floor_dtl.deleted',0)
                ->get();


            $data = $dbData->map(function ($data){

                return [
                    'id'              => $data->proj_block_floor_id,
                    'block_name'      => $data->block_name,
                    'floor_no'        => $data->floor_no,
                    'category_name'   => $data->category_name,
                    'unit_count'      => $data->unit_count,
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
        return view('admin.block.table' );
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
            'floor_no'      => 'required',
            'unit_count'    => 'required',
            'image.*'       => 'mimes:jpg,png,jpeg,gif,svg',
        ]);

        $userID = auth()->user()->id;

        /*****    Insert Block Data    *******/
        $insertData  = [
            'proj_block_mapg_id'   => $request->block_name,
            'category_id'   => $request->category_name,
            'floor_no'     => $request->floor_no,
            'unit_count'   => $request->unit_count,
            'floor_detail' => $request->floor_detail,
            'status'       => 1,
            'created_by'   => $userID
        ];

        $proj_block_floor_id = BlockFloorMapping::create($insertData);


        /******* Insert Images *********/
        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $key => $file)
            {
                $image = $request->file('image')[$key];
                $destinationPath = public_path('images/floor');
                $name = date('YmdHis') . "." . $file->getClientOriginalName();  ;
                $image->move($destinationPath, $name);
                $insertImg[$key]['proj_block_floor_id'] = $proj_block_floor_id['proj_block_floor_id'];
                $insertImg[$key]['title']  = $name;
                $insertImg[$key]['path']   = $destinationPath;
                $insertImg[$key]['status'] = 1;
                $insertImg[$key]['created_by'] = $userID;
            }
            ProjFloorImage::insert($insertImg);
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
        $selectedImage = ProjFloorImage::select([ 'title','path'])->where('proj_block_floor_id' ,  $request->id)->get()->toArray();

        return view('admin.floor.create' ,compact('editData','selectedImage'));

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
}
