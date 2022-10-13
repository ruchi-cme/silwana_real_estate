<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\{Category,Project,BlockImageMapping};
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class BlockController extends Controller
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
                 'proj_block_mappings.proj_block_map_id',
                'proj_block_mappings.block_name',
                'proj_block_mappings.floor',
                'proj_block_mappings.facing_text',
                'proj_block_mappings.status',
                'proj_block_mappings.created_date',
                'category_master.category_name',
                'project_master.project_name'
            ];
            $dbData = Block::leftJoin('category_master', 'category_master.category_id', '=', 'proj_block_mappings.category_id')
                ->leftJoin('project_master', 'project_master.project_id', '=', 'proj_block_mappings.project_id')
                ->select($select)
                ->orderBy('proj_block_mappings.proj_block_map_id', 'desc')
                ->where('proj_block_mappings.deleted',0)
                ->get();
            $data = $dbData->map(function ($data){

                return [
                    'id'              => $data->proj_block_map_id,
                    'block_name'      => $data->block_name,
                    'floor'           => $data->floor,
                    'category_name'   => $data->category_name,
                    'project_name'    => $data->project_name,
                    'status'          => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'    => $data->created_date
                ];
            });

            return DataTables::of($data)->toJson();
        }
        return view('admin.block.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.block.create' );
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
            'project_name'  => 'required',
            'category_name' => 'required',
            'block_name'    => 'required',
            'floor'         => 'required',
            'facing_text'   => 'required',
            'block_image.*' => 'mimes:jpg,png,jpeg,gif,svg',
        ]);

        $userID = auth()->user()->id;

        /*****    Insert Block Data    *******/
        $insertData  = [
            'project_id'    => $request->project_name,
            'category_id'  => $request->category_name,
            'block_name'   => $request->block_name,
            'floor'        => $request->floor,
            'facing_text'   =>  $request->facing_text,
            'status'         => 1,
            'created_by'     => $userID
        ];
        $block_id = Block::create($insertData);


        /******* Insert Images *********/
        if($request->hasfile('block_image'))
        {
            foreach($request->file('block_image') as $key => $file)
            {
                $image = $request->file('block_image')[$key];
                $destinationPath = public_path('images/block');
                $name = date('YmdHis') . "." . $file->getClientOriginalName();  ;
                $image->move($destinationPath, $name);
                $insertImg[$key]['block_id'] = $block_id['proj_block_map_id'];
                $insertImg[$key]['title']  = $name;
                $insertImg[$key]['path']   = $destinationPath;
                $insertImg[$key]['status'] = 1;
                $insertImg[$key]['created_by'] = $userID;
            }
            BlockImageMapping::insert($insertImg);
        }


        return redirect()->route('admin.block')->with('inserted','Block Created👍');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Block  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = Block::find($request->id);
        $selectedImage = BlockImageMapping::select([ 'title','path'])->where('block_id' ,  $request->id)->get()->toArray();

        return view('admin.block.create' ,compact('editData','selectedImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request  )
    {
        /*****    Update Block  Data    *******/
        $updateData  = Block::find( $request->proj_block_map_id);
        $userID      = auth()->user()->id;

        $updateData->update([
            'project_id'   => $request->project_name,
            'category_id'  => $request->category_name,
            'block_name'   => $request->block_name,
            'floor'        => $request->floor,
            'facing_text'  =>  $request->facing_text,
            'modified_by'  => $userID
        ]);

        /******* Insert Image *********/

        $image  = BlockImageMapping::where('block_id' ,  $request->proj_block_map_id)->get();
        $editImg = !empty($request->edit_block_image) ? $request->edit_block_image :[] ;

        if (!empty($image)) {
            foreach ($image as $img) {
                if (!in_array($img['title'] , $editImg)) {
                    if (file_exists(public_path() . '/images/block/' . $img['title'])) {
                        @unlink(public_path("images/block/") . $img['title']);
                        BlockImageMapping::where('block_img_mpg_id', $img['block_img_mpg_id'])->delete();
                    }
                }
            }
        }

        /******* Insert Images *********/
        if($request->hasfile('block_image'))
        {
            foreach($request->file('block_image') as $key => $file)
            {
                $image = $request->file('block_image')[$key];
                $destinationPath = public_path('images/block');
                $name = date('YmdHis') . "." . $file->getClientOriginalName();  ;
                $image->move($destinationPath, $name);
                $insertImg[$key]['block_id'] = $request->proj_block_map_id;
                $insertImg[$key]['title']  = $name;
                $insertImg[$key]['path']   = $destinationPath;
                $insertImg[$key]['status'] = 1;
                $insertImg[$key]['created_by'] = $userID;
            }
            BlockImageMapping::insert($insertImg);
        }

        return redirect()->route('admin.block')->with('updated','Block Updated 👍');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Block::find($id);

        $userID   = auth()->user()->id;

        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);

        return redirect()->route('admin.block')->with('success','Block Deleted');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $data = Block::find($request->id);

        $userID   = auth()->user()->id;
        $status   = ( !empty($data->status) && $data->status == 1 ) ?  2 :  1 ;

        $data->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.block')->with('success','Block Status Changed');
    }
}
