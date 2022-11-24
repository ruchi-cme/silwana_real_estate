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
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-xl-4">
                        <!--begin::Statistics Widget 5-->
                        <a href="#" class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body text-center">
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">Total Booking  </div>
                                <div class="fw-bold text-white"><h3>{{ !empty($totalBooking) ? $totalBooking : '0' }}</h3> </div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin::Statistics Widget 5-->
                        <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body text-center">

                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">Cancel Booking</div>
                                <div class="fw-bold text-white"><h3>{{ !empty($cancelBooking) ? $cancelBooking : '0' }}</h3> </div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <!--<div class="col-xl-4">
                      begin::Statistics Widget 5--
                        <a href="#" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
                            < --begin::Body--
                            <div class="card-body">
                                <! --begin::Svg Icon | path: icons/duotune/graphs/gra005.svg--
                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M14 12V21H10V12C10 11.4 10.4 11 11 11H13C13.6 11 14 11.4 14 12ZM7 2H5C4.4 2 4 2.4 4 3V21H8V3C8 2.4 7.6 2 7 2Z" fill="black" />
													<path d="M21 20H20V16C20 15.4 19.6 15 19 15H17C16.4 15 16 15.4 16 16V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="black" />
												</svg>
											</span>
                                <! -end::Svg Icon--
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">Active Project</div>
                                <div class="fw-bold text-white">50% Increased for FY20</div>
                            </div>
                            <!- end::Body-
                        </a>
                        < --end::Statistics Widget 5
                    </div>-->
                </div>
                <div class="row g-5 g-xl-8">
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                </div>
                <div class="row g-5 g-xl-8">
                    <div class="col-xxl-4">
                        <!--begin::Mixed Widget 2-->
                        <div class="card card-xxl-stretch">
                            <!--begin::Header-->
                            <div class="card-header border-0 bg-danger py-5">
                                <h3 class="card-title fw-bolder text-white">Projects</h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body p-0">
                                <!--begin::Chart-->
                                <div class="mixed-widget-2-chart card-rounded-bottom bg-danger" data-kt-color="danger" style="height: 50px"></div>
                                <!--end::Chart-->
                                <!--begin::Stats-->
                                <div class="card-p mt-n20 position-relative">
                                    <!--begin::Row-->
                                    <div class="row g-0">
                                        <!--begin::Col-->

                                        <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                            <!--end::Svg Icon-->
                                            <a href="#" class="text-warning fw-bold fs-6">Total Project </a>
                                            <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
												 <h3>{{ !empty($totalProject) ? $totalProject : '0' }}</h3>
											 </span>
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col bg-light-primary px-6 py-8 rounded-2 mb-7 text-center">
                                            <!--end::Svg Icon-->
                                            <a href="#" class="text-primary fw-bold fs-6">Upcoming </a>
                                            <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
												 <h3>{{ !empty($upcoming) ? $upcoming : '0' }}</h3>
											 </span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="row g-0">
                                        <!--begin::Col-->
                                        <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 text-center">
                                            <!--end::Svg Icon-->
                                            <a href="#" class="text-danger fw-bold fs-6 mt-2">Ongoing</a>
                                            <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
												 <h3>{{ !empty($ongoing) ? $ongoing : '0' }}</h3>
											 </span>
                                        </div>

                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col bg-light-success px-6 py-8 rounded-2 text-center">
                                            <!--end::Svg Icon-->
                                            <a href="#" class="text-success fw-bold fs-6 mt-2">Completed </a>
                                            <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
												 <h3>{{ !empty($completed) ? $completed : '0' }}</h3>
											 </span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Mixed Widget 2-->
                    </div>

                </div>
                <!--end::Row-->

            <!--end::Card-->
        </div>

        <!--end::Container-->
    </div>
    <!--end::Post-->
    <!--end::Container-->
</div>
<!--end::Post-->
@php

 $dataPoints = !empty($chartData) ? $chartData : '0'  ;  @endphp
@endsection
<style>
    .canvasjs-chart-credit
    {
        display: none !important;
    }
</style>
@push('scripts')
<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Booking Data"
            },
            axisY: {
                title: "Total Booking Count"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.## Booking",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }

</script>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endpush

