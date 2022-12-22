<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrokerInquiry;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrokerInquiryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            
            /* Current Login User ID */
            $userID = auth()->user()->id;

            $dataList = BrokerInquiry::orderByDesc("id")
                ->get();
            $data = $dataList->map(function ($data){

                return [
                    'id'        => $data->id,
                    'agency_company_name'      => $data->agency_company_name,
                    'agency_company_address'     => $data->agency_company_address,
                    'company_email'     => $data->company_email,
                    'company_mobile'     => $data->company_mobile,
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.brokerInquiry.index');
    }

    public function view(Request $request)
    {
        $inquiry = BrokerInquiry::where('id',$request->id)->get()->first();
        return view('admin.brokerInquiry.view',compact('inquiry'));
    }

}
