<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ Booking};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index_bk()
    {
       $totalProject =  count(getProjectList('',array('1','2','3')));;

        $booking  = Booking::select([ DB::raw('count(bookings.booking_id) as total_booking ,sum(bookings.booking_price)  as revenue')])
                    ->whereIn('status' , array('1','2'))
                    ->where('canceled',0)
                    ->get()->first();

        $select = [ DB::raw('count(bookings.booking_id) as y,project_master.project_name as label')];
        $chartData = Booking::select($select)
            ->join('project_master' , 'project_master.project_id','=','bookings.project_id')
            ->groupBy('project_master.project_id' )
            ->get()->toArray();

        //select year(created_date),month(created_date),sum(booking_price), project_id from bookings where status in ('1','2') group by year(created_date),month(created_date),project_id order by year(created_date),month(created_date)
        $view ='admin.blank.default';

        if(!empty((auth()->user()->roles->first()->name) &&  (auth()->user()->roles->first()->name == 'admin'))) {
            $view ='admin.blank.admin';
        }

        return view($view, compact('totalProject', 'booking', 'chartData'));
    }



    public function index()
    {
        $totalProject =  count(getProjectList('',array('1','2','3')));;
        $workStatus =  array('1' );
        $ongoing  = count(getProjectList( '' , $workStatus ));
        $workStatus =  array('2' );
        $upcoming  = count(getProjectList( '' , $workStatus ));
        $workStatus =  array('3' );
        $completed  = count(getProjectList( '' , $workStatus ));

        $booking  = Booking::select([ 'project_id'])
            ->whereIn('status' , array('1','2'))
            ->where('canceled',0)
            ->get();
        $totalBooking = $booking->count();

        $bookings  = Booking::select([ 'project_id'])
            ->where('status' , '3')
            ->where('canceled',1)
            ->get();
        $cancelBooking = $bookings->count();

        $select = [ DB::raw('count(bookings.booking_id) as y,project_master.project_name as label')];
        $chartData = Booking::select($select)
            ->join('project_master' , 'project_master.project_id','=','bookings.project_id')
            ->groupBy('project_master.project_id' )
            ->get()->toArray();
        $view ='admin.blank.default';

        if(!empty((auth()->user()->roles->first()->name) &&  (auth()->user()->roles->first()->name == 'admin'))) {
            $view ='admin.blank.admin';
        }

        return view($view, compact('totalProject','ongoing','upcoming','completed','totalBooking','cancelBooking','chartData'));
    }

}
