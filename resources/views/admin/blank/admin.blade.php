@extends('admin.layouts.main',['title' => 'Dashboard'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Dashboard</li>
@endsection

@section('content')

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            @include('layouts.alerts.error')
            <!--begin::Card-->
            <div class="row">

                <!-- -------total-data-------- -->
                <div class="col-xxl-4 col-xl-4 col-lg-12 col-md-12 mb-4">
                    <a href="" class="data-wrapper data-wrapper-1">
                        <div class="left-img">
                            <img src="{{ asset('images/front/totel-project-img.svg') }}" alt="totel-project">
                        </div>
                        <div class="right-content">
                            <h3>{{ !empty($totalProject) ? $totalProject : ''  }}</h3>
                            <h5>Total Projects</h5>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-12 col-md-12 mb-4">
                    <a href="" class="data-wrapper data-wrapper-2">
                        <div class="left-img">
                            <img src="{{ asset('images/front/totel-bookin-img.svg') }}" alt="totel-project">
                        </div>
                        <div class="right-content">
                            <h3>{{ !empty($totalBooking['total_booking']) ? $totalBooking['total_booking'] : ''  }}</h3>
                            <h5>Total Bookings</h5>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-12 col-md-12 mb-4">
                    <a href="" class="data-wrapper data-wrapper-3">
                        <div class="left-img">
                            <img src="{{ asset('images/front/totel-revenue-img.svg') }}" alt="totel-project">
                        </div>
                        <div class="right-content">
                            <h3>{{ !empty($totalBooking['revenue']) ? $totalBooking['revenue'] : ''  }}</h3>
                            <h5>Total Revenue (AED)</h5>
                        </div>
                    </a>
                </div>
            </div>
            <!-- ------------- -->

            <!-- -----bookin-data-part--- -->
            <div class="booking-data-part">
                <div class="row">
                    <div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12">
                        <div class="booking-data-wrapper" id="chartContainer">

                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-12 col-md-12">
                        <div class="top-bookings-wrapper">
                            <h3 class="top-bookings-title">Top 5 Bookings</h3>
                            @if(!empty($topProBooking))
                                @foreach($topProBooking as $row)
                                    <div class="our-top-bookings-wrapper">
                                        <div class="top-bookings-left">
                                            <h4><a href="">{{$row['project_name']}}</a></h4>
                                            <p>United Arab Emirates</p>
                                        </div>
                                        <div class="top-bookings-right">
                                            <h3>{{$row['booking_count']}}</h3>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!--end::Card-->
        </div>

        <!--end::Container-->
    </div>
    <!--end::Post-->
    <!--end::Container-->
</div>
<!--end::Post-->

@php $dataPoints = !empty($chartData)?  $chartData : '' ; @endphp
@endsection
@push('scripts')
    <script>
        window.onload = function() {


            var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "light2", // "light1", "light2", "dark1", "dark2"
                    animationEnabled: true,
                    title:{
                        text: "Share Value - 2016"
                    },
                    axisX: {
                        interval: 1,
                        intervalType: "month",
                        valueFormatString: "MMM"
                    },
                    axisY:{
                        title: "Price (in AED)",
                        includeZero: true,
                        valueFormatString: "AED#0"
                    },
                    data: [{
                        type: "line",
                        markerSize: 12,
                        xValueFormatString: "MMM, YYYY",
                        yValueFormatString: "$###.#",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
        });
            chart.render();


        }

    </script>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endpush
