<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\{Category,Project,BlockImageMapping,Block_name_mapping};
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Config;


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
                'proj_block_mappings.total_block',
                'proj_block_mappings.status',
                'proj_block_mappings.created_date',
                'project_master.project_name'
            ];
            $dbData = Block::leftJoin('project_master', 'project_master.project_id', '=', 'proj_block_mappings.project_id')
                ->select($select)
                ->orderBy('proj_block_mappings.proj_block_map_id', 'desc')
                ->where('proj_block_mappings.deleted',0)
                ->get();

            $data = $dbData->map(function ($data){

                return [
                    'id'              => $data->proj_block_map_id,
                    'total_block'      => $data->total_block,
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
        $type_of_block = Config::get('constants.type_of_block');

        return view('admin.block.create', compact('type_of_block') );

       // return view('admin.block.create' );

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
            'total_block'   => 'required',
        ]);

        $userID = auth()->user()->id;
        $range = null;
        if(isset($request->from ) ) {
            $range =   $request->from ;
        }
        /*****    Insert Block Data    *******/
        $insertData  = [
            'project_id'    => $request->project_name,
            'total_block'   => $request->total_block,
            'type_of_block' => $request->type_of_block,
            'range'         => $range,
            'status'        => 1,
            'created_by'    => $userID
        ];
        $block_id = Block::create($insertData);


        /******* Insert block name *********/

        if($request->block_name)
        {
            foreach($request->block_name as  $val)
            {
                $insertDataa   = [
                    'project_id'    => $request->project_name,
                    'proj_block_map_id'  => $block_id['proj_block_map_id'],
                    'block_name'    => $val,
                    'status'        => 1,
                    'created_by'    => $userID
                ];
                Block_name_mapping::create($insertDataa);
            }
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

        $blockNameList = Block_name_mapping::where('proj_block_map_id' ,  $request->id)->get()->toArray();

        $type_of_block = Config::get('constants.type_of_block');

        return view('admin.block.create' ,compact('editData','type_of_block','blockNameList'));
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
        $userID      = auth()->user()->id;

        /*****    delete Block  Data   *******/

        if(!empty($request->removeId)) {
           $test =  ltrim($request->removeId,',');
            $removeId = explode(',', $test);
            foreach ($removeId as $row) {
                Block_name_mapping::where('block_name_map_id', $row)->delete();
            }
        }
        /*****    Update Block  Data    *******/

        $updateData  = Block::find( $request->proj_block_map_id);

        $range = null;
        if(isset($request->from )  ) {
           $range =   $request->from ;
         }

        $updateData->update([
            'project_id'   => $request->project_name,
            'total_block'   => $request->total_block,
            'type_of_block' => $request->type_of_block,
            'range'         => $range,
            'modified_by'  => $userID
        ]);

        /******* Insert block name *********/

        if($request->block_name)
        {
            foreach($request->block_name  as  $val)
            {
                $insertDataa   = [
                    'project_id'    => $request->project_name,
                    'proj_block_map_id' => $request->proj_block_map_id,
                    'block_name'    => $val,
                    'status'        => 1,
                    'created_by'    => $userID
                ];
                Block_name_mapping::create($insertDataa);
            }
        }
        if($request->block_name_map_id)
        {
            for ($i = 0; $i < count($request->block_name_map_id); $i++) {

                $blocks = Block_name_mapping::find($request->block_name_map_id[$i]);
                $updateBlockData   = [
                    'project_id'    => $request->project_name,
                    'proj_block_map_id'  => $request->proj_block_map_id,
                    'block_name'    => $request->edit_block_name[$i],
                    'status'        => 1,
                    'created_by'    => $userID
                ];
                $blocks->update($updateBlockData);
            }
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

       $block = Block_name_mapping::select('block_name_map_id')->where('proj_block_map_id', $id)->get()->toArray();

        for ($i = 0; $i < count($block); $i++) {

            $blocks = Block_name_mapping::find($block[$i]['block_name_map_id']);
            $updateBlockData   = [
                'deleted'  => 1,  //Deleted
                'deleted_date'  => now(),
                'deleted_by'    =>  $userID,
            ];
            $blocks->update($updateBlockData);
        }


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
