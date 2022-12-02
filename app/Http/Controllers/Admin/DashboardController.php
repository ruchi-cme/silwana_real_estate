<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ Booking};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProject = count(getProjectList('',array('1','2','3')));;

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


      //  select count(project_id) as total_project , MONTHNAME(created_date) as month from bookings  where created_date >= date_sub(now(),interval 6 month) group by month ORDER BY month DESC
/*
        SELECT
    SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
    SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
    SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
    SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
    SUM(IF(month = 'May', total, 0)) AS 'May',
    SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
    SUM(IF(month = 'Jul', total, 0)) AS 'Jul',
    SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
    SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
    SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
    SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
    SUM(IF(month = 'Dec', total, 0)) AS 'Dec'
FROM
(SELECT
        MIN(DATE_FORMAT(created_date, '%b')) AS month,
            SUM(booking_price) AS total
    FROM
        bookings

        where created_date >= date_sub(now(),interval 12 month)
    GROUP BY YEAR(created_date) , MONTH(created_date)
    ORDER BY YEAR(created_date) , MONTH(created_date)) AS sale */

        $chartData =     DB::select("SELECT
    SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
    SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
    SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
    SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
    SUM(IF(month = 'May', total, 0)) AS 'May',
    SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
    SUM(IF(month = 'Jul', total, 0)) AS 'Jul',
    SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
    SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
    SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
    SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
    SUM(IF(month = 'Dec', total, 0)) AS 'Dec'
FROM
(SELECT
        MIN(DATE_FORMAT(created_date, '%b')) AS month,
            SUM(booking_price) AS total
    FROM
        bookings

        where created_date >= date_sub(now(),interval 12 month)
    GROUP BY YEAR(created_date) , MONTH(created_date)
    ORDER BY YEAR(created_date) , MONTH(created_date)) AS sale");

   $select =  DB::select( " SELECT m.month, p.booking_price
                            FROM (
                                SELECT 'January' AS
                            MONTH
                            UNION SELECT 'February' AS
                            MONTH
                            UNION SELECT 'March' AS
                            MONTH
                            UNION SELECT 'April' AS
                            MONTH
                            UNION SELECT 'May' AS
                            MONTH
                            UNION SELECT 'June' AS
                            MONTH
                            UNION SELECT 'July' AS
                            MONTH
                            UNION SELECT 'August' AS
                            MONTH
                            UNION SELECT 'September' AS
                            MONTH
                            UNION SELECT 'October' AS
                            MONTH
                            UNION SELECT 'November' AS
                            MONTH
                            UNION SELECT 'December' AS
                            MONTH
                            ) AS m
                            LEFT JOIN bookings p ON m.month =  MONTHNAME(p.created_date)" )  ;




          //select year(created_date),month(created_date),sum(booking_price), project_id from bookings where status in ('1','2') group by year(created_date),month(created_date),project_id order by year(created_date),month(created_date)

        $select = [ DB::raw('count(project_id) as y, MONTHNAME(created_date) as label')];
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
                        $chart_data[$key]['label']  =$m;
                        $chart_data[$key]['y'] = $row['y'];
                    }
                    else {
                        $chart_data[$key]['label']  = $m;
                        $chart_data[$key]['y']  = 0;
                    }
                }

            }
        }

        $view ='admin.blank.default';

        if(!empty((auth()->user()->roles->first()->name) &&  (auth()->user()->roles->first()->name == 'admin'))) {
            $view ='admin.blank.admin';
        }

        return view($view, compact('totalProject', 'totalBooking', 'chartData', 'topProBooking'));
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
