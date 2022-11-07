@extends('admin.layouts.main',['title' => 'Media'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">CMS</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.media') }}">Media</a></li>
<li class="breadcrumb-item px-3 text-primary"> {{ !empty( $editData->media_id) ?   'Edit' :  'Create' }}</li>
@endsection
<style>
.error{
    color: #FF0000;
}

 input[type="file"] {
     display: block;
 }
.imageThumb {
    max-height: 75px;
    border: 2px solid;
    padding: 1px;
    cursor: pointer;
}
.pip {
    display: inline-block;
    margin: 10px 10px 0 0;
}
.remove {
    display: block;
    background: #444;
    border: 1px solid black;
    color: white;
    text-align: center;
    cursor: pointer;
}
.remove:hover {
    background: white;
    color: black;
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

                <form class="form" method="POST" action=" {{ !empty( $editData->media_id) ?  route('admin.media.update') : route('admin.media.store') }}" id="dataForm" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Media</h2>
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Name</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Name" class="form-control form-control-solid" name="name" value="{{ !empty( $editData->name) ? $editData->name : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3  "> Upload Images</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                        <input type="file" class="form-control form-control-solid" name="image_title[]" multiple id="image_title" >

                                        <div class="col-xl-9 fv-row fv-plugins-icon-container pdf-preview-div">
                                            @if (!empty($editData->type) && ($editData->type == 1))
                                                <span class="pip">
                                                    <input type="hidden" name="edit_image_title[]" value="{{ !empty($editData->image_video_title  ) ? $editData->image_video_title   : '' }}" id="edit_image_title">
                                                    <img height='50' width='50' class="imageThumb" src="{{ asset('images/media/image').'/'.$editData->image_video_title}}" title="{{ !empty( $editData->image_video_title  ) ? $editData->image_video_title  : '' }}"/>
                                                  <br/><span class="removePdf"><i class="fa fa-trash"></i></span>
                                                </span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <label>Note : Upload only Images </label>


                                    </div>
                                    <label class="inputFileError errorMsg"  id="error1"  style=" color:#FF0000;">  </label>
                                    <label class="inputFileError errorMsg" id="error2" style="  color:#FF0000;">  </label>
                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3  "> Upload Videos</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                        <input type="file" accepts="video/*" class="form-control form-control-solid" name="video_title[]" multiple id="video_title" >

                                        <div class="col-xl-9 fv-row fv-plugins-icon-container video-preview-div">
                                            @if (!empty($editData->type) && ($editData->type == 2) )
                                                <span class="pip">
                                                    <input type="hidden" name="edit_video_title[]" value="{{ !empty($editData->image_video_title  ) ? $editData->image_video_title   : '' }}" id="edit_video_title">
                                                   <video controls="" src="{{ asset('images/media/video').'/'.$editData->image_video_title}}" width="120" height="120"></video>
                                                    <br/><span class="removeVideo"><i class="fa fa-trash"></i></span>
                                                </span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <label>Note : Upload only Video </label>

                                    </div>
                                    <label class="inputFileError errorMsg"  id="error3"  style=" color:#FF0000;">  </label>
                                    <label class="inputFileError errorMsg" id="error4" style="  color:#FF0000;">  </label>
                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row text-center">
                                <input type="hidden" name="id" value="{{ !empty( $editData->media_id) ? $editData->media_id : '' }}" id="media_id">
                                <!--begin::Col-->
                                <!--begin::Actions-->
                                <div class="mb-0">
                                    <button type="button" data-form="amenityForm" class="btn btn-primary" id="create_button">
                                        <!--begin::Indicator-->
                                        <span class="indicator-label">{{ !empty( $editData->media_id) ?  'Update' : 'Create' }} Media</span>
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

            $(".removeVideo").click(function(){
                $(this).parent(".pip").remove();
            });
            var a=0;
            var noFile = [];
            var noFilesize = [];
            if (window.File && window.FileList && window.FileReader) {

                $("#video_title").on("change", function(e) {

                    var noVideo = [];
                    var files = event.target.files;
                    for (var i = 0; i < files.length; i++) {
                        var f = files[i];
                        // Only process video files.
                        if (!f.type.match('video.*')) {
                            noVideo.push(f.name);
                            var noVideos = noVideo.toString();
                            if(noVideos !=  '') {

                                $('#error3').html(noVideos + " is not video! not uploaded");
                            }
                            continue;
                        }
                        $(" <span class=\"pip\">" +
                            "<video controls='' src='"+URL.createObjectURL(files[i])+"' width='120' height='120'></video>" +
                            "<br/><span class=\"removeV\"><i class=\"fa fa-trash\"></i></span>" +
                            "</span> ").insertAfter(".video-preview-div");
                        $(".removeV").click(function(){
                            $(this).parent(".pip").remove();
                        });
                        var noVideos = noVideo.toString();
                        if(noVideos !=  '') {

                            $('#error3').html(noVideos + " is not video! not uploaded");
                        }
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }

            $(".removePdf").click(function(){
                $(this).parent(".pip").remove();
            });
            var a=0;
            var noFile = [];
            var noFilesize = [];
            if (window.File && window.FileList && window.FileReader) {

                $("#image_title").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {

                        var f = files[i]

                        var fileType = f.type
                        var fileNm = f.name
                        var picsize = f.size
                        console.log(picsize)
                        if($.inArray(fileType, ['image/svg','image/gif','image/png','image/jpg','image/jpeg']) == -1 ) {

                            noFile.push(fileNm);
                            continue;
                            a=0;
                        }else if (picsize > 5000000) {
                            noFilesize.push(fileNm);

                            continue;
                        }

                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;

                            $("<span class=\"pip\">" +
                                "<img height='50' width='50' class=\"imageThumb\" src=\"" +  e.target.result  + "\" title=\"" + f.name + "\"/>" +
                                "<br/><span class=\"remove\"><i class=\"fa fa-trash\"></i></span>" +
                                "</span>").insertAfter(".pdf-preview-div");
                            $(".remove").click(function(){
                                $(this).parent(".pip").remove();
                            });

                            var noFiles = noFile.toString();

                            var noFilesizes = noFilesize.toString();

                            if(noFiles !=  '') {

                                $('#error1').html(noFiles + " is not image! not uploaded");
                            }
                            if(noFilesizes !=  '') {

                                $('#error1').html(noFilesizes + " is not uploaded Maximum File Size Limit is 1MB.");
                            }
                        });

                        fileReader.readAsDataURL(f);

                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }


            $("#dataForm").validate({
                ignore: '',
                rules: {
                    "name" :"required",
                    "image" : "required"
                },
                messages: {
                    "name" : "Please enter name",
                    "image" : "Please select image"
                }
            });

            $('#create_button').on('click', function(event) {
                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#dataForm').valid()  ) { console.log(2);
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
