@extends('admin.layouts.main',['title' => 'Building '])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Sales CMS</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.buildingService') }}">Building </a></li>
<li class="breadcrumb-item px-3 text-primary"> {{ !empty( $editData->id) ?   'Edit' :  'Create' }}</li>
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
                @include('layouts.alerts.alert')

                <form class="form" method="POST" action=" {{ !empty( $editData->id) ? route('admin.buildingService.update') : route('admin.buildingService.store') }}" id="dataForm"  enctype="multipart/form-data" >
                    @csrf
                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder"> Building </h2>
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Title </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Title" class="form-control form-control-solid" name="title" value="{{ !empty( $editData->title) ? $editData->title : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Name</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Name" class="form-control form-control-solid" name="name" value="{{ !empty( $editData->name) ? $editData->name : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->


                        <div class="increment">
                            @if(!empty( $editData->detail))
                                @php
                                    $details = json_decode( $editData->detail );

                                    $i = 1;
                                @endphp
                                <div class="row">
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-bold mt-2 mb-3 required">Detail</div>
                                    </div>
                                    <div class="col-md-7 mb-7">
                                        <button type="button"  class="btn btn-success" id="add_more">
                                            Add more
                                        </button>
                                    </div>
                                </div>

                                @foreach($details as $row)

                                    <!--begin::Row-->

                                        <div class="row">
                                            <div class="col-xl-3">
                                                <div class="fs-6 fw-bold mt-2 mb-3 required">Detail</div>
                                            </div>
                                            <div class="col-md-7 mb-7">
                                                <input type="text" placeholder="Enter Detail" attrame="Enter Detail" class="form-control form-control-solid" name="detail[]" value=" {{$row }}" >
                                                <label class="inputerror errorMsg" for="detail" style="">  </label>
                                            </div>

                                            <div class="col-md-1 mb-3">

                                                <!--begin::Actions-->
                                                <div class="mb-0">
                                                    <button type="button"  class="btn btn-sm btn-icon btn-hover-scale btn-active-danger me-2 button btn-remove" id=" ">
                                                        <span class="svg-icon svg-icon-1"><i class="fa fa-trash"></i></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                        </div>


                                    @php $i++ @endphp
                                @endforeach

                            @else

                                    <div class="row">
                                        <div class="col-xl-3">
                                            <div class="fs-6 fw-bold mt-2 mb-3 required">Detail</div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="text" placeholder="Enter Detail" attrame="Enter Detail" class="form-control form-control-solid" name="detail[]" value="" >
                                            <label class="inputerror errorMsg" for="detail" style="">  </label>
                                        </div>

                                        <div class="col-md-2 mb-2">

                                            <!--begin::Actions-->
                                            <div class="mb-0">
                                                <button type="button"  class="btn btn-success" id="add_more">
                                                    Add more
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                    </div>

                            @endif
                        </div>

                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Image </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col--> <div class="col-md-3 mb-3">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: none">
                                        <!--begin::Preview existing image-->
                                        @php
                                            $path =  !empty($editData->image_title) ? asset('images/businessServices').'/'. $editData->image_title  : ''  ;
                                            $test =   "background-image:url('$path')"  ;
                                           $videoUrl =  !empty($editData->video_title) ? asset('images/businessServices/video').'/'. $editData->video_title  : ''  ;

                                        @endphp
                                        <div class="imageBgDiv image-input-wrapper w-125px h-125px" style="{{  !empty($editData->image_title) ? $test :'"background-image : none'}}"></div>

                                        <!--end::Preview existing image-->
                                        <!--begin::Label-->
                                        <label class="inputFileError errorMsg" for="direction" style="">  </label>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" value="{{ !empty($editData->image_title) ? $editData->image_title : '' }}" name="image_title" id="image" accept="image/*" onchange="validateFileType()"  />
                                            <input type="hidden" name="edit_image_title"  value="{{ !empty($editData->image_title) ? $editData->image_title : ''  }}" />
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
                                    <label class="errorMsg" id="fileErr" for="image" style="">  </label>
                                    <!--end::Image input-->
                                </div>
                            </div>

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 uploadVideoLabel"> Upload Video </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                        <input type="file" accepts="video/*"   class="form-control form-control-solid" name="video_title"value="{{ !empty($editData->video_title  ) ? $editData->video_title   : '' }}" id="video_title" onchange="validateVideoFileType()" >

                                        <div class="col-xl-9 fv-row fv-plugins-icon-container video-preview-div">
                                             <input type="hidden"   name="edit_video_title" value="{{ !empty($editData->video_title  ) ? $editData->video_title   : '' }}" id="edit_video_title">

                                            <span class="pip editpip">
                                            @if(!empty($editData->video_title))
                                                <video id="showVideo" controls="" src="{{ !empty($editData->video_title) ? asset('images/businessServices/video').'/'.$editData->video_title : '' }}" width="120" height="120"></video>
                                                 <br/>
                                             @endif
                                            </span>
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <label>Note : Upload only Video </label>

                                    </div>
                                    <label class="inputFileError errorMsg"  id="error3"  style=" color:#FF0000;">  </label>
                                    <label class="inputFileError errorMsg" id="error4" style="  color:#FF0000;">  </label>
                                </div>
                            </div>
                            <!--end::Row-->
                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row text-center">
                                <input type="hidden" name="id" value="{{ !empty( $editData->id) ? $editData->id : '' }}" id="id">
                                <!--begin::Col-->
                                <!--begin::Actions-->
                                <div class="mb-0">
                                    <button type="button" data-form="dataForm" class="btn btn-primary" id="create_button">
                                        <!--begin::Indicator-->
                                        <span class="indicator-label">{{ !empty( $editData->id) ?  'Update' : 'Create' }} </span>
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
<div  id="clone" style="display: none">
    <div class="row">
        <div class="col-xl-3">
            <div class="fs-6 fw-bold mt-2 mb-3 required">Detail</div>
        </div>
        <div class="col-md-4 mb-3">
            <input type="text" placeholder="Enter Detail" attrame="Enter Detail" class="form-control form-control-solid" name="detail[]" value="" >
            <label class="inputerror errorMsg" for="detail" style="">  </label>
        </div>

        <div class="col-md-2 mb-2">

            <!--begin::Actions-->
            <div class="mb-0">
                <button type="button"  class="btn btn-sm btn-icon btn-hover-scale btn-active-danger me-2 button btn-remove" id="remove">
                    <span class="svg-icon svg-icon-1"><i class="fa fa-trash"></i></span>
                </button>
            </div>
            <!--end::Actions-->
        </div>
    </div>
</div>
@endsection

@push('scripts')

    <script type="text/javascript">

        $(document).ready(function (e) {

            $(".btn-success").click(function() {
                var html = $("#clone").html();
                $(".increment").append(html);
            });

            $("body").on("click",".btn-remove",function() {
                $(this).parents(".row").remove();
            });

            $("#dataForm").validate({
                ignore: '',
                rules: {
                    "title" :"required",
                    "name" :"required",
                    "detail" : "required",
                },
                messages: {
                    "title" : "Please enter title",
                    "name" : "Please enter name",
                    "detail" :  "Please enter detail",
                }
            });

            $('#create_button').on('click', function(event) {

                var error = 1;
                $("#dataForm input[type=text]").each(function() {


                    if($(this).val().trim() === '') {
                        // update time range value already filled

                        $(this).next('.inputerror').html('This field is required');
                        error++;
                    }
                    else{
                        $(this).next('.inputerror').html('');
                    }
                });

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
                if($('#dataForm').valid() && err == 1  && error == 1  ) { console.log(2);
                    $( '#dataForm' ).submit();
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