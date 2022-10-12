<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\FloorUnitMapping;
use Illuminate\Http\Request;
use Config;
use Auth;
use Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $unit_id  =  decrypt($request->route('id'));
        $unitData = FloorUnitMapping::select([ 'proj_floor_unit_id','booking_price','total_price'])
            ->where('proj_floor_unit_id' , $unit_id)
            ->get()
            ->first();

        $bookingType = Config::get('constants.booking_type');
        $paymentType = Config::get('constants.payment_type');

        return view('front.propertyBooking' ,compact('unitData','bookingType','paymentType'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [ // <---
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'payment_type' => 'required',
            'booking_type' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else {
            $data = FloorUnitMapping::find(decrypt($request->unit_id));

            $insertData = [
                'user_id' => Auth::guard('front')->user()->id,
                'unit_id' => decrypt($request->unit_id),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'booking_price' => $data->booking_price,
                'booking_type' => $request->booking_type,
                'payment_type' => $request->payment_type,
                'booking_details' => $request->booking_details,
                'status' => 1, //Booking Price Paid
                'created_by' => Auth::guard('front')->user()->id,
            ];
            $bookingId = Booking::create($insertData);

            if (!empty($bookingId)) {

                $data->update([
                    'booking_type' => 2,
                    'modified_by' => Auth::guard('front')->user()->id,
                    'modified_date' => now()
                ]);
            }

            $myBooking = getBookingDetail(Auth::guard('front')->user()->id);

            return redirect()->route('myBooking')->with('inserted', 'You have successfully booked your property👍');
        }

     }

    public function cancelBooking(Request $request){

        $data = Booking::find( decrypt($request->booking_id));

        $unitdata = FloorUnitMapping::find(  ($data->unit_id));

        if(!empty($data)) {
            $data->update([
                'canceled'  => 1,
                'canceled_by'   => Auth::guard('front')->user()->id,
                'canceled_date' => now()
            ]);



            $unitdata->update([
                'booking_type'  => 1,
                'modified_by'   => Auth::guard('front')->user()->id,
                'modified_date' => now()
            ]);
            $reponse['success'] = 'Booking cancelled successfully.';
        }
        else {
            $reponse['success'] = 'Something went wrong.';
        }
        return $reponse;
    }
}