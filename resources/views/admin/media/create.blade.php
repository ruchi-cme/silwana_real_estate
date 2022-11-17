@extends('admin.layouts.main',['title' => 'Media'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">CMS</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.media') }}">Media</a></li>
<li class="breadcrumb-item px-3 text-primary"> {{ !empty( $editData->media_id) ?   'Edit' :  'Create' }}</li>
@endsection
<style>
.error , .inputFileError{
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

                            @if(!empty($editData) && $editData->type == 1)
                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-bold mt-2 mb-3 required"> Image   </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col--> <div class="col-md-3 mb-3">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: none">
                                            <!--begin::Preview existing image-->
                                            @php
                                                     $path =  !empty($editData->image_video_title) ? asset('images/media/image').'/'. $editData->image_video_title  : ''  ;
                                                     $test =   "background-image:url('$path')"  ;
                                                    $videoUrl =  !empty($editData->image_video_title) ? asset('images/media/video').'/'. $editData->image_video_title  : ''  ;

                                            @endphp

                                            @if($editData->type == 1 )
                                                <div class="imageBgDiv image-input-wrapper w-125px h-125px" style="{{  !empty($editData->image_video_title) ? $test :'"background-image : none'}}"></div>
                                            @else
                                                  <div class="imageBgDiv image-input-wrapper w-125px h-125px" ><video controls="" src="{{$videoUrl}}" width="120" height="120"></video></div>
                                            @endif

                                            <!--end::Preview existing image-->
                                            <!--begin::Label-->
                                            <label class="inputFileError errorMsg" for="direction" style="">  </label>
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input type="file" value="{{ !empty($editData->image_video_title) ? $editData->image_video_title : '' }}" name="image_title" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="edit_image_title"  value="{{ !empty($editData->image_video_title) ? $editData->image_video_title : ''  }}" />
                                                <input type="hidden" name="avatar_remove" />
                                                <input type="hidden" id="imageType" name="imageType" value="{{$editData->type}}" />
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
                            @elseif(  !empty($editData) && $editData->type == 2  )
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
                                            <input type="file" accepts="video/*" class="form-control form-control-solid" name="video_title"   id="video_title" >

                                            <div class="col-xl-9 fv-row fv-plugins-icon-container video-preview-div">
                                                <input type="hidden" id="imageType" name="imageType" value="{{$editData->type}}" />
                                                <input type="hidden" name="edit_video_title" value="{{ !empty($editData->image_video_title  ) ? $editData->image_video_title   : '' }}" id="edit_video_title">

                                                <span class="pip editpip">
                                                        <video controls="" src="{{ asset('images/media/video').'/'.$editData->image_video_title}}" width="120" height="120"></video>
                                                         <br/><span class="removeVideo"><i class="fa fa-trash"></i></span>
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
                            @else
                                <!--begin::Row-->
                                <div class="row mb-8">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-bold mt-2 mb-3 required"> Select Image/Video</div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                        <!--begin:Input-->
                                        <label class="btn">
                                            <input class="form-check-input selectImgVideo" type="radio" name="select_radio" id="form_checkbox" value="1"> Both
                                        </label>
                                        <label class="btn">
                                            <input class="form-check-input selectImgVideo" type="radio" name="select_radio" id="form_checkbox" value="2"> Images
                                        </label>
                                        <label class="btn">
                                            <input class="form-check-input selectImgVideo" type="radio" name="select_radio" id="form_checkbox" value="3"> Video
                                        </label>
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row mb-8">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-bold mt-2 mb-3 uploadImgLabel"> Upload Images</div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                        <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                            <input type="file" class="form-control form-control-solid" name="image_title[]" multiple id="image_title" >

                                            <div class="col-xl-9 fv-row fv-plugins-icon-container pdf-preview-div">
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
                                        <div class="fs-6 fw-bold mt-2 mb-3 uploadVideoLabel"> Upload Videos</div>
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
                            @endif

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

                        var imageType  = $('#imageType').val();

                        if($('.editpip').is(':visible')){
                            $('.editpip').remove();
                        }
                        var addClass = '';
                        if(imageType == 2){
                            addClass = 'editpip';
                        }
                        $(" <span class='pip "+addClass+"'>" +
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

            $(".selectImgVideo").on("change", function(e){
              var selectedVal =  $(this).val() ;
                if(selectedVal == 1 ){
                    $('.uploadVideoLabel').addClass('required');
                    $('.uploadImgLabel').addClass('required');

                } else if(selectedVal == 2 ) {
                    $('.uploadVideoLabel').removeClass('required');
                    $('#error3').html('');
                    $('.uploadImgLabel').addClass('required');
                } else {
                    $('.uploadImgLabel').removeClass('required');
                    $('#error1').html('');
                    $('.uploadVideoLabel').addClass('required');
                }
            });

            $("#dataForm").validate({
                ignore: '',
                rules: {
                    "name" :"required",
                    "select_radio" : "required"
                },
                messages: {
                    "name" : "Please enter name",
                    "select_radio" : "Please select"
                }
            });

            $('#create_button').on('click', function(event) {

               var err = 1;
                if ( $( '.uploadImgLabel' ).hasClass( "required" ) ) {

                    var image_title = $('#image_title').val();

                    if(image_title == ''){
                        $('#error1').html(  "Please select image");
                        err = 2;
                    }
                }
                var err1 = 1;
                if ( $( '.uploadVideoLabel' ).hasClass( "required" ) ) {
                    var video_title = $('#video_title').val();

                    if(video_title == ''){
                        $('#error3').html(  "Please select video");
                        err1 = 2;
                    }
                }

                var err2 = 1;
                $(document).find("div.imageBgDiv").each(function() {

                    var bgImg = $(this).css('background-image').trim();

                    if (bgImg == 'url("about:invalid")' || bgImg == 'none'  ) {

                        $(this).next('.inputFileError').html('Required');
                        err2++;
                    } else {
                        $(this).next('.inputFileError').html('');
                    }
                });


                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#dataForm').valid() && err == 1 &&  err1 == 1  &&  err2 == 1 ) { console.log(2);
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
