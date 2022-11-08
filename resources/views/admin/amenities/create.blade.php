@extends('admin.layouts.main',['title' => 'Amenities'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Master</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.amenities') }}">Amenities</a></li>
<li class="breadcrumb-item px-3 text-primary"> {{ !empty( $editData->amenity_name) ?   'Edit' :  'Create' }}</li>
@endsection
<style>
.error,  .inputFileError{
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

                <form class="form" method="POST" action=" {{ !empty( $editData->amenity_name) ?  route('admin.amenities.update') : route('admin.amenities.store') }}" id="amenityForm" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Amenities</h2>
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Amenity Name</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Amenity Name" class="form-control form-control-solid" name="amenity_name" value="{{ !empty( $editData->amenity_name) ? $editData->amenity_name : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Amenity Detail</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <textarea placeholder="Enter Amenity Detail" required name="amenity_detail" class="form-control form-control-solid h-100px" >{{ !empty( $editData->amenity_detail) ? $editData->amenity_detail : '' }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Image</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col--> <div class="col-md-3 mb-3">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: none">
                                        <!--begin::Preview existing image-->
                                        @php
                                            $path =  !empty($editData->amenity_image) ? asset('images/amenities' ).'/'.$editData->amenity_image : ''  ;
                                            $test =   "background-image:url('$path')"  ;  @endphp
                                        <div class="imageBgDiv image-input-wrapper w-125px h-125px" style="{{  !empty($editData->amenity_image) ? $test :'"background-image : none'}}"></div>
                                        <!--end::Preview existing image-->
                                        <!--begin::Label-->
                                        <label class="inputFileError errorMsg" for="direction" style="">  </label>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{  !empty($editData->amenity_image) ? 'Change' : 'Upload' }} image">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" value="{{ !empty($editData->amenity_image) ? $editData->amenity_image : '' }}" name="amenity_image" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="edit_amenity_image" value="{{ !empty( $editData->amenity_image) ? $editData->amenity_image : '' }}" id="edit_amenity_image">
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>

                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                                                                    <i class="bi bi-x fs-2"></i>
                                                                </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                                                                    <i class="bi bi-x fs-2"></i>
                                                                </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row text-center">
                                <input type="hidden" name="amenities_id" value="{{ !empty( $editData->amenities_id) ? $editData->amenities_id : '' }}" id="amenities_id">
                                <!--begin::Col-->
                                <!--begin::Actions-->
                                <div class="mb-0">
                                    <button type="button" data-form="amenityForm" class="btn btn-primary" id="create_button">
                                        <!--begin::Indicator-->
                                        <span class="indicator-label">{{ !empty( $editData->amenities_id) ?  'Update' : 'Create' }} Amenity</span>
                                        <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator-->
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Card body-->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function (e) {

            $('#preview-image-before-upload').attr('src','');
            $('#amenity_image').change(function(){

                $('.previewImage').css('display','block');
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });


            $("#amenityForm").validate({
                ignore: '',
                rules: {
                    "amenity_name" :"required",
                    "amenity_detail" : "required",

                },
                messages: {
                    "amenity_name" : "Please enter amenity name",
                    "amenity_detail" :  "Please enter amenity detail",

                }
            });

            $('#create_button').on('click', function(event) {
                var err = 1;
                $(document).find("div.imageBgDiv").each(function() {

                    var bgImg = $(this).css('background-image').trim();

                    if (bgImg == 'url("about:invalid")' || bgImg == 'none'  ) {

                        $(this).next('.inputFileError').html('Required');
                        err++;
                    } else {
                        $(this).next('.inputFileError').html('');
                    }
                });
                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#amenityForm').valid() && err == 1 ) { console.log(2);
                    $( '#amenityForm' ).submit();
                } else { console.log(3);
                    console.log("does not validate");
                    return false;
                }
            });


        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        }); // focus on search input in select 2 -------------------------------------------------------------------
    </script>

@endpush
