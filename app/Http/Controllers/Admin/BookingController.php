<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\FloorUnitMapping;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Config;
use Auth;
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
                switch ($data->status) {
                    case 1:
                        $status = 'Booking Price Paid';
                    break;
                    case 2:
                        $status = 'Full Aamount Paid';
                    break;
                    case 3:
                        $status = 'cancel';
                    break;
                    case 4:
                        $status = 'pending';
                        break;
                    case 5:
                        $status = 'Approved';
                        break;
                    default:
                        $status = '';
                }


               /* if (!empty($data->status)){
                    if ($data->status == 1) {
                        $status = '';
                    }
                    elseif ($data->status == 2) {

                    }
                }*/

                return [
                    'id'             => $data->booking_id,
                    'project_name'   => $data->project_name,
                    'unit_name'      => $data->unit_name,
                    'booking_price'  => $data->booking_price,
                    'category_name'  => $data->category_name,
                    'booing_status'  => $status,

                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.booking.index');
    }

    public function view(Request $request)
    {
        $myBooking = getBookingDetail('',$request->id);
        $bookingStatus = Config::get('constants.bookedstatus');
        return view('admin.booking.view',compact('myBooking','bookingStatus'));
    }

    public function updateBooking(Request $request)
    {
        $userID = auth()->user()->id;
        $data = Booking::find( $request->booking_id );
        $unitdata = FloorUnitMapping::find( $request->floor_unit_id );

        if(!empty($data)) {
            $canceled = 0;
            $booking_type = 2;  //booked
            if ($request->status == 3) { //cancelled
                $canceled = 1;
                $booking_type = 1;  // available
            }
            $data->update([
                'canceled' => $canceled,
                'status' => $request->status,
                'canceled_by' => $userID,
                'canceled_date' => now()
            ]);

            $unitdata->update([
                'booking_type' => $booking_type,
                'modified_by' => $userID,
                'modified_date' => now()
            ]);
        }
        return redirect()->route('admin.booking')->with('Updated','Booking Status Updated👍');
    }

}
