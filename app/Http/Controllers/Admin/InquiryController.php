<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            /* Current Login User ID */
            $userID = auth()->user()->id;

            $dataList = Inquiry::orderByDesc("id")
                ->get();
            $data = $dataList->map(function ($data){

                return [
                    'id'        => $data->id,
                    'name'      => $data->first_name.' '.$data->last_name,
                    'email'     => $data->email,
                    'phone'     => $data->phone,
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.inquiry.index');
    }

    public function view(Request $request)
    {
        $inquiry = Inquiry::where('id',$request->id)->get()->first();

        return view('admin.inquiry.view',compact('inquiry'));
    }

}
