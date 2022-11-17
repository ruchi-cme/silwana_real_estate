@extends('admin.layouts.main',['title' => 'Property Booking'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.booking') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary"><a href="{{ route('admin.booking') }}" class="pe-3">Property Booking </a> </li>
<li class="breadcrumb-item px-3 text-primary">Property Booking View</li>
@endsection

@section('content')

<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->

    <div id="kt_content_container" class="container-fluid">
        @include('layouts.alerts.error')
        @include('layouts.alerts.alert')

        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10 shadow-lg">

                <div class="card-body pt-9 pb-0">
                    <!--profile image-->
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <!--begin::Card header-->
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0"> Booking Detail</h3>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--begin::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <form action="{{ url('admin/booking/update/'.$myBooking['booking_id'])  }}" method="post" id="bookingForm" >
                                @csrf
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Project Name</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ $myBooking['project_name']  }} </span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Block Name  </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bolder fs-6 text-gray-800 me-2"> {{ $myBooking['block_name']  }} </span>

                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Unit Name</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800"> {{ $myBooking['unit_name'] }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Area </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800"> {{ $myBooking['area_in_sq_feet'] }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Booking Price</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800"> {{ $myBooking['booking_price'] }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Total Price</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800"> {{ $myBooking['total_price'] }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                        @if(!empty( $myBooking['status']) &&  $myBooking['status'] != 3)
                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-bold text-muted required">Booking Status</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <select required class="form-select form-select-solid form-select-lg" name="status" id="status" data-placeholder="Select status" data-control="select2" >

                                            @if (!empty($bookingStatus))
                                                @foreach ($bookingStatus as $key => $val)
                                                    <option value="{{ $key }}" {{ !empty( $myBooking['status'])  && ($myBooking['status'] == $key) ? 'selected' : '' }}>{{ $val }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="card-footer">
                                    <!--begin::Seperator-->
                                    <div class="separator separator-dashed mb-7"></div>
                                    <!--end::Seperator-->
                                    <!--begin::Actions-->
                                    <div class="mb-0">
                                        <input type="hidden" class="form-control form-control-solid" name="booking_id" id="booking_id" value="{{ !empty($myBooking['booking_id']) ? $myBooking['booking_id'] : ''}}" >
                                        <input type="hidden" class="form-control form-control-solid" name="floor_unit_id" id="floor_unit_id" value="{{ !empty($myBooking['floor_unit_id']) ? $myBooking['floor_unit_id'] : ''}}" >

                                        <button type="button" data-form="blockForm" class="btn btn-primary" id="create_button">
                                            <!--begin::Indicator-->
                                            <span class="indicator-label">Update Booking Status</span>
                                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            <!--end::Indicator-->
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                @else
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-bold text-muted">Booking Status</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bolder fs-6 text-gray-800"> {{ !empty( $myBooking['status']) && $myBooking['status'] == 3 ? 'Cancelled' : '' }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                @endif
                                <!--end::Input group-->
                            </form>
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>

            <!-- end of image-->

        </div>
        <!--end::Navbar-->

    </div>
    <!--end::Container-->
</div>

@endsection
@push('scripts')
     <script type="text/javascript">

        $(document).ready(function (e) {
            $("#bookingForm").validate({
                ignore: '',
                rules: {
                    "status" :"required",
                },
                messages: {
                    "status" : "Pleaseselect status",

                }
            });

            $('#create_button').on('click', function(event) {

                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#bookingForm').valid()  ) { console.log(2);
                    $( '#bookingForm' ).submit();
                } else { console.log(3);
                    console.log("does not validate");
                    return false;
                }
            });


        });
    </script>

@endpush
