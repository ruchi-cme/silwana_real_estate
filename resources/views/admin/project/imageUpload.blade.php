@extends('admin.layouts.main',['title' => 'Project Image Upload'])

@section('breadcrumb')
    <li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
    <li class="breadcrumb-item px-3 text-primary">Projects</li>
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
                                                                    <input  type="text" attrame="Enter Direction" placeholder="Enter Direction" class="form-control form-control-solid direction" name="edit_direction[]" value="{{ $row['direction'] }}" >
                                                                    <label class="inputerror errorMsg" for="edit_direction" style="">  </label>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <input  type="text" attrame="Enter Facing"  placeholder="Enter Facing" class="form-control form-control-solid facing" name="edit_facing[]" value="{{ $row['facing']}}" >
                                                                    <label class="inputerror errorMsg" for="edit_facing" style="">  </label>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <!--begin::Image input-->
                                                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: none">
                                                                        <!--begin::Preview existing image-->
                                                                       @php
                                                                          $path =  !empty($row['title']) ? asset('images/project/images' ).'/'.$row['title'] : ''  ;
                                                                          $test =   "background-image:url('$path')"  ;  @endphp
                                                                        <div class="imageBgDiv image-input-wrapper w-125px h-125px" style="{{  !empty($row['title']) ? $test :'"background-image : none'}}"></div>
                                                                        <!--end::Preview existing image-->
                                                                        <!--begin::Label-->
                                                                        <label class="inputFileError errorMsg" for="direction" style="">  </label>
                                                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                                                            <i class="bi bi-pencil-fill fs-7"></i>
                                                                            <!--begin::Inputs-->
                                                                            <input type="file" value="{{ $row['title'] }}" name="edit_change_image[]" accept=".png, .jpg, .jpeg" />
                                                                            <input type="hidden" name="edit_image[]"  value="{{ $row['title'] }}" />
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
                            </div>
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

        <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <script src="{{ asset('js/scripts.bundle.js') }}"></script>

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
                        <input type="text" placeholder="Enter Direction" attrame="Enter Direction" class="form-control form-control-solid" name="direction[]" value="" >
                        <label class="inputerror errorMsg" for="direction" style="">  </label>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="text" placeholder="Enter Facing" attrame="Enter Facing" class="form-control form-control-solid" name="facing[]" value="" >
                        <label class="inputerror errorMsg" for="direction" style="">  </label>
                    </div>
                    <div class="col-md-3 mb-3">
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: none">
                            <!--begin::Preview existing image-->
                            @php $img= ''; @endphp
                            <div class="imageBgDiv image-input-wrapper w-125px h-125px" style="background-image: none"></div>
                            <!--end::Preview existing image-->
                            <!--begin::Label-->
                            <label class="inputFileError errorMsg" for="direction" style="">  </label>
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

                // adding rules for inputs with class

                var err = 1;
                $(document).find("div.imageBgDiv").each(function() {

                   var bgImg = $(this).css('background-image').trim();

                   if (bgImg == 'url("about:invalid")' || bgImg == 'none' &&  $(this).is(":visible") == true) {

                       $(this).next('.inputFileError').html('Required');
                       err++;
                   } else {
                       $(this).next('.inputFileError').html('');
                   }
                });

                var error = 1;
                $("#projectImage input[type=text]").each(function() {

                    if($(this).val().trim() === '') {
                        // update time range value already filled

                        $(this).next('.inputerror').html('Please '+  $(this).attr('attrame') );
                        error++;
                    }
                    else{
                        $(this).next('.inputerror').html('');
                    }
                });

                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#projectImage').valid() && error == 1 && err == 1  ) { console.log(2);
                    $( '#projectImage' ).submit();
                } else { console.log(3);
                    console.log("does not validate");
                    return false;
                }
            });
        });

    </script>

@endpush
