@extends('admin.layouts.main',['title' => 'Project Detail View'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.project') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary"><a href="{{ route('admin.project') }}" class="pe-3">Project </a> </li>
<li class="breadcrumb-item px-3 text-primary">Project Detail View</li>
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
                                <h3 class="fw-bolder m-0"> Project Detail</h3>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--begin::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9">

                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Project Name</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($projectData['project_name'] ) ? $projectData['project_name'] :'' }} </span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Project Detail</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bolder fs-6 text-gray-800 me-2"> {{ !empty($projectData['project_detail'] ) ? $projectData['project_detail'] :'' }} </span>

                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Address</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800"> {{ !empty($address['address']) ? $address['address'] : '' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Amenities </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    @php $amnm = []; @endphp
                                    @foreach($amenities as $amenity)
                                       @php $amnm[] .=   $amenity['amenity_name'] ;  @endphp
                                    @endforeach

                                    <span class="fw-bolder fs-6 text-gray-800"> {{ !empty($amnm ) ? implode(',',$amnm) :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                @php  $detail =  getpropertyDetailsByProject( $projectData['project_id']);  @endphp
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Area</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($detail) ? $detail['min_area'].' sqft'  : '' }} -  {{ !empty($detail) ? $detail['max_area'].' sqft' :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                      <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">property Type</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($projectData['category_name']) ? $projectData['category_name']  : '' }}  </span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Block</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800"> {{ !empty($detail) ? $detail['block_name']  : '' }}  </span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Price</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($detail) ? $detail['min']  : '' }} -  {{ !empty($detail) ? $detail['max'] :'' }} </span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            @php  $imagePDFile = '';
                                    if(!empty($selectedImage))
                                        $imagePDFile  =  !empty($selectedImage['title'] ) ? asset('images/project/pdf/').'/'.$selectedImage['title'] : ''
                            @endphp
                            <!--begin::Input group-->

                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Brocher</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                @if(!empty( $imagePDFile))
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800"><iframe src="{{ $imagePDFile }}" width="100%" height="500px"></iframe></span>
                                        <input type="hidden"  id="downloadUrl" name="downloadUrl" value="{{$imagePDFile}}">
                                        <a  id="downloadBrochure12"  download href="{{ $imagePDFile }}" proName="{{ $projectData['project_name'] }}" class="btn btn-hover-scale btn-success" >DOWNLOAD BROCHURE</a>
                                    </div>
                                @else
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">-</span>
                                      </div>
                                @endif
                                <!--end::Col-->
                            </div>



                            <!--end::Input group-->

                        </div>
                            <!--end::Input group-->

                    </div>
                        <!--end::Card body-->
                </div>
         </div>

            <!-- end of image-->

     </div>
        <!--end::Navbar-->

  </div>
    <!--end::Container-->

@endsection

