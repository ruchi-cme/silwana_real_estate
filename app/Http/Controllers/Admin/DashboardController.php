<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ Booking, Project};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $projectData  = Project::select([ 'project_id'])
            ->where('status' , 1)
            ->where('deleted',0)
            ->get();
        $countProject = $projectData->count();

        $totalProject =  $countProject;
        $totalBooking = Booking::select([ DB::raw('count(bookings.booking_id) as total_booking ,sum(bookings.booking_price)  as revenue')])
                        ->whereIn('status' , array('1','2'))
                        ->where('canceled',0)
                        ->get()->first();

        $topProBooking = Booking::select([ 'bookings.project_id', 'project_master.project_name',DB::raw( 'count(bookings.project_id) as booking_count')])
                         ->join('project_master',   'project_master.project_id',  '=', 'bookings.project_id')
                         ->whereIn('bookings.status' , array('1','2'))
                         ->where('bookings.canceled',0)
                         ->groupBy('bookings.project_id')
                         ->orderBy('booking_count', 'DESC')
                         ->limit(5)->get();

        $select = [ DB::raw('sum(booking_price) as y, MONTHNAME(created_date) as label')];
         $chartData = Booking::select($select)
            ->whereRaw('created_date >= date_sub(now(),interval 6 month)')
            ->whereIn('status' , array('1','2'))
             ->where('canceled',0)
             ->groupBy('label' )
             ->orderBy('y','DESC')
             ->get()->toArray();

        $month = [];
        for ($m=1; $m<=12; $m++) {
            $month[] .= date('F', mktime(0,0,0,$m, 1, date('Y')));

        }
        $getMonths = [];
        if(!empty($chartData)) {
            $getMonths = array_column($chartData, 'label');
        }

        $chart_data = [];
        if(!empty($chartData)) {
            foreach ($month as  $key =>$m ) {
                foreach ($chartData as $row ){

                    if ( in_array($m, $getMonths)) {
                        $chart_data[$key]['label']  =  date('M',strtotime($m ));;
                        $chart_data[$key]['y'] = $row['y'];
                    }
                    else {
                        $chart_data[$key]['label']  =  date('M',strtotime($m ));
                        $chart_data[$key]['y']  = 0;
                    }
                }
            }
        }

        $view ='admin.blank.default';

        if(!empty((auth()->user()->roles->first()->name) &&  (auth()->user()->roles->first()->name == 'admin'))) {
            $view ='admin.blank.admin';
        }

        return view($view, compact('totalProject', 'totalBooking', 'chart_data', 'topProBooking'));
    }

    function myfunction($value,$key)
    {
        echo "The key $key has the value $value<br>";
    }

    public function index_bk()
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
