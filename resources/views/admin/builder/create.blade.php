@extends('admin.layouts.main',['title' => 'Builder'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">About Silwana</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary text-muted" href="{{ route('admin.builder') }}">Builder</a></li>
<li class="breadcrumb-item px-3 text-primary">{{ !empty($editData->builder_id) ? ' Edit' : 'Create' }}</li>
@endsection
<style>
    .error{
        color: #FF0000;
    }
</style>
@section('content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">


        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">

            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                <!--begin::Form-->

                @include('layouts.alerts.error')

                <form class="form" method="POST" action="{{ !empty($editData->builder_id) ? route('admin.builder.update') : route('admin.builder.store') }}" id="user_form">
                   @csrf

                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Builder Detail</h2>
                            </div>
                            <!--begin::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Company Name</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input required type="text" class="form-control form-control-solid" placeholder="Enter Company Name" autofocus name="company_name" id="company_name" value="{{ !empty($editData->company_name ) ? $editData->company_name : ''}}" >
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Owner Name</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input required type="text" class="form-control form-control-solid" placeholder="Enter Owner Name" autofocus name="owner_name" id="owner_name" value="{{ !empty($editData->owner_name ) ? $editData->owner_name : ''}}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Email</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input required type="email" class="form-control form-control-solid" placeholder="Enter Email"   name="builder_email" id="builder_email" value="{{ !empty($editData->builder_email ) ? $editData->builder_email : ''}}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Phnoe Number</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input required type="text" class="form-control form-control-solid" name="phone_number" id="phone_number" placeholder="Enter Phone Number" value=" {{ !empty($editData->phone_number ) ? $editData->phone_number : ''}} ">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Details</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <textarea  required name="details" class="form-control form-control-solid" id="details" placeholder="Enter Details">{{ !empty($editData->details ) ? $editData->details : ''}}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Address</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" placeholder="Enter Address"   name="address" id="address" value="{{ !empty($editData->address ) ? $editData->address : ''}}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->



                        </div>
                        <!--end::Card body-->
                        <div class="card-footer">
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <!--begin::Actions-->
                            <div class="mb-0">
                                <input type="hidden" class="form-control form-control-solid" name="builder_id" id="builder_id" value="{{ !empty($editData->builder_id ) ? $editData->builder_id : ''}}" >

                                <button type="submit" data-form="user_form" class="btn btn-primary" id="create_button">
                                    <!--begin::Indicator-->
                                    <span class="indicator-label">{{ !empty($editData->builder_id ) ?  'Update' : 'Create'}}  Builder</span>
                                    <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator-->
                                </button>
                            </div>
                            <!--end::Actions-->
                        </div>
                    </div>
                    <!--end::Card-->

                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Layout-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection

@push('scripts')

<script type="text/javascript">
    $("#user_form").validate({
        ignore: '',
        rules: {
            "company_name" :"required",
            "owner_name" : "required",
            "details" :  "required",
            builder_email: {
                required: true,
                email: true
            },
            "phone_number" : {
                required: true,
                digits: true
            }
        },
        messages: {
            "company_name" : "Please enter company name",
            "owner_name" :  "Please enter owner name",
            "details" : "Please select details",
            builder_email: {
                required: "Please enter email",
            },
            "phone_number" : {
                required: "Please enter phone number",
            }
        }
    });

    $('#create_button').on('click', function(event) {



        // prevent default submit action
        event.preventDefault();

        // test if form is valid
        if($('#user_form').valid()  ) { console.log(2);
            $( '#user_form' ).submit();
        } else { console.log(3);
            console.log("does not validate");
            return false;
        }
    });

</script>

@endpush
