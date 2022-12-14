@extends('admin.layouts.main',['title' => 'Amenities'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Project</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.amenities') }}">Amenities</a></li>
<li class="breadcrumb-item px-3 text-primary">Create</li>
@endsection

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

                <form class="form" method="POST" action=" {{ !empty( $editData->amenity_name) ?  route('admin.amenities.update') : route('admin.amenities.store') }}" id="user_form" enctype="multipart/form-data">
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
                                    <input type="text" placeholder="Enter Amenity Name" class="form-control form-control-solid" name="amenity_name" value="{{ !empty( $editData->amenity_name) ? $editData->amenity_name : '' }}" >
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
                                    <textarea placeholder="Enter Amenity Detail" name="amenity_detail" class="form-control form-control-solid h-100px" >{{ !empty( $editData->amenity_detail) ? $editData->amenity_detail : '' }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Image</div>
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
                                    <button type="submit" data-form="user_form" class="btn btn-primary" id="create_button">
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
    <script src="{{ asset('js/swal.js') }}" ></script>

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

        });

        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            var ele = $(this).closest('.example-2').clone(true);
            console.log(ele);
            $('.new_div').append(ele);
        });

        var button = document.querySelector("#create_button");

        var target = document.querySelector("#blockUI_target");
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        // Defination -------------------------------------------------------------------------------------------------------------

        var blockUI = new KTBlockUI(target, {
            message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Checking...</div>',
        }); // Element to block white fetching AJAX data ----------------------------------------------------------------------


        button.addEventListener("click", function () {
            if (!$("#user_form")[0].checkValidity()) {
                $("#user_form")[0].reportValidity();

                Toast.fire({
                    icon: 'error',
                    title: 'Please Fill Required Fields',
                    text: "Make sure required fields are filled properly before moving on"
                }); //display error toast

                return 0;
            }
            // Activate indicator
            button.setAttribute("data-kt-indicator", "on");
            button.setAttribute("disabled", "true");

            form = document.getElementById(this.getAttribute('data-form'));
            form.submit();
        }); // Handle Button Click Event ----------------------------------------------------------------------------


        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        }); // focus on search input in select 2 -------------------------------------------------------------------
    </script>

@endpush
