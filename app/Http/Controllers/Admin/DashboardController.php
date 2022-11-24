<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ Booking};
use Illuminate\Http\Request;


class DashboardController extends Controller
{
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

        switch (auth()->user()->roles->first()->id) {
            case 1:   //admin
                $view ='admin.blank.admin';
                break;
            case 2:    //employee
                $view ='admin.blank.default';
                break;
            case 3:    //broker
                $view ='admin.blank.default';
                break;
            case 4:   //user
                $view ='admin.blank.default';
                break;
            case 5:     //super admin
                $view ='admin.blank.default';
                break;
            default:
              $view ='admin.blank.default';
              break;
        }
        return view($view, compact('totalProject','ongoing','upcoming','completed','totalBooking','cancelBooking'));
    }

    public function getDailyBooking()
    {
        $booking  = Booking::select([ 'project_id'])
            ->whereIn('status' , array('1','2'))
            ->where('canceled',0)
            ->get();
    }
}
