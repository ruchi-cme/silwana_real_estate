<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\{Category};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            /* Current Login User ID */
            $userID = auth()->user()->id;
            $category = Category::select([ 'category_id','category_name','status'])
                ->where('deleted',0)
                ->orderByDesc("category_id")
                ->get();

            $data = $category->map(function ($data){

                return [
                    'id'            => $data->category_id,
                    'category_name' => $data->category_name,
                    'status'        => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'  => $data->created_date ,
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.category.index');
    }


    public function create(Request $request)
    {
        $categoryData = Category::find($request->id);

        return view('admin.category.create' ,compact('categoryData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        DB::transaction(function() use($request){
            $userID   = auth()->user()->id;
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->status        = 1;
            $category->created_by    = $userID;
            $category->save();

        });

        return redirect()->route('admin.category')->with('inserted','Category Created👍');
    }

    public function update(Request $request)
    {
        $category = Category::find( $request->category_id);
        $userID   = auth()->user()->id;
        $category->update([
            'category_name' => $request->category_name,
            'modified_by'   =>  $userID,
            'modified_date' => now()

        ]);

        return redirect()->route('admin.category')->with('updated','Category Details Updated 👍');
    }


    public function delete($id)
    {
        $data = Category::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
        //Category::find($id)->delete();
        return redirect()->route('admin.category')->with('success','Category Deleted');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $category = Category::find($request->id);
        $userID   = auth()->user()->id;
        $status   =  ( !empty($category->status) && $category->status == 1 ) ?  2 :  1 ;

        $category->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        return redirect()->route('admin.category')->with('success','Category Status Changed');
    }
}
