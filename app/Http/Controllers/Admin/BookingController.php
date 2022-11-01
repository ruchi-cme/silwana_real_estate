<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class BookingController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            /* Current Login User ID */
            $userID = auth()->user()->id;

            $dbData = getBookingDetail();
            $data = $dbData->map(function ($data){

                return [
                    'id'             => $data->booking_id,
                    'project_name'   => $data->project_name,
                    'unit_name'      => $data->unit_name,
                    'booking_price'  => $data->booking_price,
                    'category_name'  =>  $data->category_name,
                    'status'         => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',

                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.booking.index');
    }

    public function view(Request $request)
    {
        $myBooking = getBookingDetail('',$request->id);

        return view('admin.booking.view',compact('myBooking'));
    }

}
