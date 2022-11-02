@extends('admin.layouts.main',['title' => 'Category'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Master</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary text-muted" href="{{ route('admin.category') }}">Category</a></li>
<li class="breadcrumb-item px-3 text-primary">{{ !empty( $editData->category_id) ?   'Edit' :  'Create' }}</li>
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

                <form class="form" method="POST" enctype="multipart/form-data" action="{{ !empty($editData->category_id) ? route('admin.category.update') : route('admin.category.store') }}" id="categoryForm">
                   @csrf

                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Category</h2>
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Category Name</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required class="form-control form-control-solid" placeholder="Enter Category Name" autofocus name="category_name" id="category_name" value="{{ !empty($editData->category_name ) ? $editData->category_name : ''}}" >
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
                                    <input type="file" class="form-control form-control-solid" name="category_image" id="category_image" >
                                    <input type="hidden" name="edit_category_image" value="{{ !empty( $editData->category_image) ? $editData->category_image : '' }}" id="edit_category_image">

                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->


                            <!--begin::Row-->
                            <?php if (!empty( $editData->category_image)) {
                                ?>
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Preview Image</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">

                                    <img src="{{ asset('images/category').'/'.$editData->category_image }}" width="100px" height="100px">

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


                        </div>
                        <!--end::Card body-->
                        <div class="card-footer">
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <!--begin::Actions-->
                            <div class="mb-0">
                                <input type="hidden" class="form-control form-control-solid" name="category_id" id="category_id" value="{{ !empty($editData->category_id ) ? $editData->category_id : ''}}" >

                                <button type="button" data-form="categoryForm" class="btn btn-primary" id="create_button">
                                    <!--begin::Indicator-->
                                    <span class="indicator-label">{{ !empty($editData->category_id ) ?  'Update' : 'Create'}}  Category</span>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function (e) {

            $("#categoryForm").validate({
                ignore: '',
                rules: {
                    "category_name" :"required",
                    "category_image":"required",
                },
                messages: {
                    "category_name" : "Please enter category",
                    "category_image": "Please select image"
                }
            });

            $('#create_button').on('click', function(event) {


                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#categoryForm').valid()  ) { console.log(2);
                    $( '#categoryForm' ).submit();
                } else { console.log(3);
                    console.log("does not validate");
                    return false;
                }
            });

            $('#preview-image-before-upload').attr('src','');
            $('#category_image').change(function(){

                $('.previewImage').css('display','block');
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        }); // focus on search input in select 2 -------------------------------------------------------------------
    </script>

@endpush
