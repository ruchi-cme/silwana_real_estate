@extends('admin.layouts.main',['title' => 'Amenities'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Master</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.amenities') }}">Amenities</a></li>
<li class="breadcrumb-item px-3 text-primary"> {{ !empty( $editData->amenity_name) ?   'Edit' :  'Create' }}</li>
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
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="file" class="form-control form-control-solid" name="amenity_image" id="amenity_image" >
                                    <input type="hidden" name="edit_amenity_image" value="{{ !empty( $editData->amenity_image) ? $editData->amenity_image : '' }}" id="edit_amenity_image">

                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->


                            <!--begin::Row-->
                            <?php if (!empty( $editData->amenity_image)) {
                                ?>
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Preview Image</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">

                                    <img src="{{ asset('images/amenities').'/'.$editData->amenity_image }}" width="100px" height="100px">

                                </div>
                            </div>
                                <?php
                            }  ?>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row previewImage" style="display: none">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Current Selected Preview Image</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <img id="preview-image-before-upload" src=""   alt="preview image" style="max-height: 250px;">
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
                    "amenity_image":"required",
                },
                messages: {
                    "amenity_name" : "Please enter amenity name",
                    "amenity_detail" :  "Please enter amenity detail",
                    "amenity_image": "Please select image"
                }
            });

            $('#create_button').on('click', function(event) {

                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#amenityForm').valid()  ) { console.log(2);
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
