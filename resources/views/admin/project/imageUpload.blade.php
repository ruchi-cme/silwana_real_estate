@extends('admin.layouts.main',['title' => 'Project'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Proerty</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.project') }}">Project</a></li>
<li class="breadcrumb-item px-3 text-primary">{{ !empty( $projectData->project_id) ? 'Edit Image Upload': "Image Upload" }}</li>
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

                <form class="form" method="POST" action=" {{ !empty( $projectData->project_id) ?  route('admin.project.imageUpdate') : route('admin.project.imageStore') }}" id="projectImage" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Project Images</h2>
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
                                    <div class="fs-6 fw-bold mt-2 mb-3  "> Project Name</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    {{ $projectData['project_name'] }}   <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8 ">
                                <!--begin::Col-->
                                <div class="increment">
                                @if(!empty($selectedImage))

                                        @foreach($selectedImage as $row)
                                            <div class=" control-group"  >
                                                <div class="col-xl-3">
                                                    <div class="fs-6 fw-bold mt-2 mb-3">Image</div>
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-xl-12 fv-row fv-plugins-icon-container ">
                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <input  type="text" placeholder="Enter Direction" class="form-control form-control-solid direction" name="edit_direction[]" value="{{ $row['direction'] }}" >
                                                            <label class="inputerror" for="edit_direction" style="">  </label>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <input  type="text" placeholder="Enter Facing" class="form-control form-control-solid facing" name="edit_facing[]" value="{{ $row['facing']}}" >
                                                            <label class="inputerror" for="edit_facing" style="">  </label>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <!--begin::Image input-->
                                                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(assets/media/avatars/blank.png)">
                                                                <!--begin::Preview existing image-->
                                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('images/project/images' ).'/'.$row['title']}})"></div>
                                                                <!--end::Preview existing image-->
                                                                <!--begin::Label-->
                                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                                    <!--begin::Inputs-->
                                                                    <input type="file" value="{{ $row['title'] }}" name="edit_change_image[]" accept=".png, .jpg, .jpeg" />
                                                                    <input type="hidden" name="edit_image[]"  value="{{ $row['title'] }}" />
                                                                    <input type="hidden" name="avatar_remove" />
                                                                    <!--end::Inputs-->
                                                                </label>
                                                                <label class="inputerror" for="edit_image" style="">  </label>
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

                                                        <div class="col-md-1 mb-3">
                                                            <div class="col-md-1 mb-3">
                                                                <!--begin::Actions-->
                                                                <div class="mb-0">
                                                                    <input type="hidden" name="project_image_id[]" value="{{ $row['project_image_id'] }}">
                                                                    <button type="button" removeImgId="{{ $row['project_image_id'] }}"  class="btn btn-sm btn-icon btn-hover-scale btn-active-danger me-2 button btn-remove" id="create_button">
                                                                        <span class="svg-icon svg-icon-1"><i class="fa fa-trash"></i></span>
                                                                    </button>
                                                                </div>
                                                                <!--end::Actions-->
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                @endif
                                    </div>

                                <!--begin::Row-->
                                <div class="row  ">
                                    <!--begin::Actions-->
                                    <div class="col-md-4 mb-3">
                                        <div class="mb-0">
                                            <button type="button"  class="btn  btn-success" id="create_button">
                                                Add more
                                            </button>
                                        </div>
                                    </div>
                                    <!--end::Actions-->
                                    <div class="col-md-4 mb-3">
                                        <input type="hidden" name="project_id" value="{{ $projectData->project_id }}" id="project_id">
                                        <input type="hidden" name="removeImgId" id="removeImgId">

                                        <!--begin::Col-->
                                        <!--begin::Actions-->
                                        <div class="mb-0">
                                            <button type="button" data-form="projectImage" class="btn btn-primary" id="submitbtn">
                                                <!--begin::Indicator-->
                                                <span class="indicator-label"> create Project</span>
                                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                <!--end::Indicator-->
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <!--begin::Col-->
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

<!--begin::Row-->
<div class="row mb-" id="clone" style="display: none">
    <div class=" control-group"  >

        <!--begin::Col-->
        <div class="col-xl-3">
            <div class="fs-6 fw-bold mt-2 mb-3">Image</div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-12 fv-row fv-plugins-icon-container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="text" placeholder="Enter Direction" class="form-control form-control-solid" name="direction[]" value=" " >

                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" placeholder="Enter Facing" class="form-control form-control-solid" name="facing[]" value=" " >

                </div>
                <div class="col-md-3 mb-3">
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(assets/media/avatars/blank.png)">
                        <!--begin::Preview existing image-->
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url()"></div>
                        <!--end::Preview existing image-->
                        <!--begin::Label-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <!--begin::Inputs-->
                            <input type="file" name="image[]" accept=".png, .jpg, .jpeg" />

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

                <div class="col-md-1 mb-3">

                    <!--begin::Actions-->
                    <div class="mb-0">
                        <button type="button"  class="btn btn-sm btn-icon btn-hover-scale btn-active-danger me-2 button btn-remove" id="create_button">
                            <span class="svg-icon svg-icon-1"><i class="fa fa-trash"></i></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </div>
            </div>
        </div>


        <!--begin::Col-->
    </div>
</div>
<!--end::Row-->
@endsection

@push('scripts')
    <script src="{{ asset('js/swal.js') }}" ></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script   src="{{ asset('js/front/custom') }}/general.js"> </script>

    <script type="text/javascript">

        $(document).ready(function() {
            $(".btn-success").click(function() {
                var html = $("#clone").html();
                $(".increment").append(html);
            });
            var test = [];
            $("body").on("click",".btn-remove",function() {
                var removeImgId = $(this).attr('removeImgId');
                test.push(removeImgId);
                $('#removeImgId').val(test);
                $(this).parents(".control-group").remove();
            });

            $('#submitbtn').on('click', function(event) {

                // adding rules for inputs with class 'comment'
                var test = 1;
               // $(document).find('.input').each(function() {

                $("#projectImage").find("input[type=file]").each(function(index, field){

                });


                    $("#projectImage input[type=text]").each(function() {
                    if($(this).val() == '') {
                        // update time range value already filled
                        $(this).next('.inputerror').html('Please enter block');
                        test++;
                    }
                    else{
                        $(this).next('.inputerror').html('');
                    }
                });

                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#projectImage').valid() && test == 1) { console.log(2);
                   // $( '#projectImage' ).submit();
                } else { console.log(3);
                    console.log("does not validate");
                    return false;
                }
            });

        });


    </script>

@endpush
