<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectAssign;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
class ProjectAssignController extends Controller
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
                DB::raw('group_concat(DISTINCT( project_master.project_name)) as project_name') ,
                DB::raw('group_concat(DISTINCT( project_assigns.id)) as id'),
                DB::raw('group_concat(DISTINCT( users.name)) as name'),
                DB::raw('group_concat(DISTINCT( project_assigns.status)) as status')
                 ];
              $dbData = ProjectAssign::leftJoin('project_master',  DB::raw("find_in_set(project_master.project_id, project_assigns.project_id)"), ">", DB::raw('0')  )
                ->leftJoin('users', 'users.id', '=', 'project_assigns.user_id')
                ->select($select)
                ->where('project_assigns.deleted',0)
                ->groupBy("project_assigns.project_id")
                ->get();


            $data = $dbData->map(function ($data){

                return [
                    'id'             => $data->id,
                    'user'          => $data->name,
                    'project'        => $data->project_name,
                    'status'         => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',

                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.projectAssign.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::whereHas(
            'roles', function($q){
            $q->where('name', 'broker');
        }
        )->where('status', '1')->get();

        return view('admin.projectAssign.create',compact(['user']) );
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
            'user_id' => 'required',
            'project_id'  => 'required',
        ]);
        /* Insert FAQ data */
        $userID = auth()->user()->id;

        $project_id =  $request->project_id;

      /*  if (!empty($project_id)) {
            for($i = 0; $i < count($project_id); $i++) {
                $data[] = [
                    'user_id'       => $request->user_id,
                    'project_id'    => $project_id[$i],
                    'status'        => 1,
                    'created_by'    => $userID
                ];
            }
        }
        */

        $project_id =  implode(',', $request->project_id);
        $data = [
            'user_id'       => $request->user_id,
            'project_id'    => $project_id,
            'status'        => 1,
            'created_by'    => $userID
        ];

        ProjectAssign::create($data);

        return redirect()->route('admin.projectAssign')->with('inserted','Project Assigned👍');
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editData = ProjectAssign::find($request->id);
        $user = User::whereHas(
            'roles', function($q){
            $q->where('name', 'broker');
        }
        )->where('status', '1')->get();

        $assignProjectIds =''; //ProjectAssign::where( 'user_id',$editData->user_id)->get()->pluck('project_id')->toArray();

        return view('admin.projectAssign.create' ,compact('editData','user','assignProjectIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateData  = ProjectAssign::find( $request->id);
        $userID      = auth()->user()->id;

        /* Insert Page data */
        ProjectAssign::find($request->id)->delete();
        $project_id =  implode(',', $request->project_id);
        $data = [
            'user_id'       => $request->edit_user_id,
            'project_id'    => $project_id,
            'status'        => 1,
            'created_by'    => $userID
        ];
        ProjectAssign::create($data);

        return redirect()->route('admin.projectAssign')->with('updated','Project Assign Updated 👍');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ProjectAssign::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
        return redirect()->route('admin.projectAssign')->with('success','Project Assign Deleted');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $updateData = ProjectAssign::find($request->id);
        $userID     = auth()->user()->id;
        $status     = ( !empty($updateData->status) && $updateData->status == 1 ) ?  2 :  1 ;

        $updateData->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.projectAssign')->with('success','Project Assign Status Changed');
    }
}
