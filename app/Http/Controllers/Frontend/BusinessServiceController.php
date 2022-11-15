<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class BusinessServiceController extends Controller
{
    public function index()
    {
        $investmentData = getInvestmentService();
        $buildingData   = getBuildingService();
        $rentalData     = getRentalService();
        $salesData      = getSalesService();


        return view('front.sales',compact(  'investmentData','buildingData', 'rentalData','salesData' ));
    }
}
