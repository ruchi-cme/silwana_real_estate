@extends('admin.layouts.main',['title' => 'Profile'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('user.user') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Profile</li>
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
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-125px symbol-lg-125px symbol-fixed position-relative">
                                <img class="img img-fluid" src="{{ !empty($user->image)  ? asset('images/user/'.$user->image) : asset('images/front/noProfile.jpeg')}}" alt="image">
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $user->name }}</a>

                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-bold fs-1 pe-2">

                                        <a  class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->

                                            <!--end::Svg Icon--> {{$user->email}} </a>

                                    </div>
                                    <!--end::Info-->
                                    <div class="d-flex flex-wrap fw-bold fs-4  pe-2">

                                        <a class="d-flex align-items-center text-gray-400 mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                            <span class="svg-icon svg-icon-4 me-3">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                            <!--end::Svg Icon--> {{$user->phone}}
                                        </a>

                                    </div>
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->

                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <!--begin::Card header-->
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0">Profile Details</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="/admin/user/editProfile/{{$user->id}}" class="btn btn-primary align-self-center">Edit Profile</a>
                            <!--end::Action-->
                        </div>
                        <!--begin::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Full Name</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{$user->name}}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Contact Phone
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bolder fs-6 text-gray-800 me-2">{{$user->phone}}</span>

                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->


                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Communication</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">Email, Phone</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
        </div>
        <!--end::Navbar-->
    </div>
    <!--end::Container-->
</div>

@endsection

