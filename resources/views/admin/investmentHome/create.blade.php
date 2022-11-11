@extends('admin.layouts.main',['title' => 'Investment Home CMS'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Home CMS</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.investmentHome') }}">Investment Home </a></li>
<li class="breadcrumb-item px-3 text-primary"> {{ !empty( $editData->id) ?   'Edit' :  'Create' }}</li>
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
                @include('layouts.alerts.alert')

                <form class="form" method="POST" action=" {{ !empty( $editData->id) ?  route('admin.investmentHome.update') : route('admin.investmentHome.store') }}" id="dataForm"  enctype="multipart/form-data" >
                    @csrf
                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Investment Home  </h2>
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Title</div>
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

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Detail</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <textarea placeholder="Enter Detail" required name="detail" class="form-control form-control-solid h-100px" >{{ !empty( $editData->detail) ? $editData->detail : '' }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->


                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Icon 1 </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col--> <div class="col-md-3 mb-3">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: none">
                                        <!--begin::Preview existing image-->
                                        @php
                                            $path =  !empty($editData->image_video_title) ? asset('images/investmentHome/image').'/'. $editData->image_video_title  : ''  ;
                                            $test =   "background-image:url('$path')"  ;
                                           $videoUrl =  !empty($editData->image_video_title) ? asset('images/investmentHome/video').'/'. $editData->image_video_title  : ''  ;

                                        @endphp
                                        <div class="imageBgDiv image-input-wrapper w-125px h-125px" style="{{  !empty($editData->image_video_title) ? $test :'"background-image : none'}}"></div>

                                        <!--end::Preview existing image-->
                                        <!--begin::Label-->
                                        <label class="inputFileError errorMsg" for="direction" style="">  </label>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file"  name="icon[]" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="edit_image_title"  value="{{ !empty($editData->image_video_title) ? $editData->image_video_title : ''  }}" />
                                            <input type="hidden" name="avatar_remove" />
                                            <input type="hidden" id="imageType" name="imageType" value="{{ !empty($editData->type) ? $editData->type : ''  }}" />
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
                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Sub Title 1</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Sub Title" class="form-control form-control-solid" name="sub_title[]" value="{{ !empty( $editData->name) ? $editData->name : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Sub Title Detail 1</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <textarea placeholder="Enter  Sub Title Detail" required name="sub_title_detail[]" class="form-control form-control-solid h-100px" >{{ !empty( $editData->detail) ? $editData->detail : '' }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->


                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Icon 2 </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col--> <div class="col-md-3 mb-3">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: none">
                                        <!--begin::Preview existing image-->
                                        @php
                                            $path =  !empty($editData->image_video_title) ? asset('images/investmentHome/image').'/'. $editData->image_video_title  : ''  ;
                                            $test =   "background-image:url('$path')"  ;
                                           $videoUrl =  !empty($editData->image_video_title) ? asset('images/investmentHome/video').'/'. $editData->image_video_title  : ''  ;

                                        @endphp
                                        <div class="imageBgDiv image-input-wrapper w-125px h-125px" style="{{  !empty($editData->image_video_title) ? $test :'"background-image : none'}}"></div>

                                        <!--end::Preview existing image-->
                                        <!--begin::Label-->
                                        <label class="inputFileError errorMsg" for="direction" style="">  </label>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file"   name="icon[]" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="edit_image_title"  value="{{ !empty($editData->image_video_title) ? $editData->image_video_title : ''  }}" />
                                            <input type="hidden" name="avatar_remove" />
                                            <input type="hidden" id="imageType" name="imageType" value="{{ !empty($editData->type) ? $editData->type : ''  }}" />
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
                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Sub Title 2</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Sub Title" class="form-control form-control-solid" name="sub_title[]" value="{{ !empty( $editData->name) ? $editData->name : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Sub Title Detail 2</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <textarea placeholder="Enter  Sub Title Detail" required name="sub_title_detail[]" class="form-control form-control-solid h-100px" >{{ !empty( $editData->detail) ? $editData->detail : '' }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Icon 3 </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col--> <div class="col-md-3 mb-3">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: none">
                                        <!--begin::Preview existing image-->
                                        @php
                                            $path =  !empty($editData->image_video_title) ? asset('images/investmentHome/image').'/'. $editData->image_video_title  : ''  ;
                                            $test =   "background-image:url('$path')"  ;
                                           $videoUrl =  !empty($editData->image_video_title) ? asset('images/investmentHome/video').'/'. $editData->image_video_title  : ''  ;

                                        @endphp
                                        <div class="imageBgDiv image-input-wrapper w-125px h-125px" style="{{  !empty($editData->image_video_title) ? $test :'"background-image : none'}}"></div>

                                        <!--end::Preview existing image-->
                                        <!--begin::Label-->
                                        <label class="inputFileError errorMsg" for="direction" style="">  </label>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file"   name="icon[]" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="edit_image_title"  value="{{ !empty($editData->image_video_title) ? $editData->image_video_title : ''  }}" />
                                            <input type="hidden" name="avatar_remove" />
                                            <input type="hidden" id="imageType" name="imageType" value="{{ !empty($editData->type) ? $editData->type : ''  }}" />
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
                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Sub Title 3</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Sub Title" class="form-control form-control-solid" name="sub_title[]" value="{{ !empty( $editData->name) ? $editData->name : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Sub Title Detail 3</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <textarea placeholder="Enter  Sub Title Detail" required name="sub_title_detail[]" class="form-control form-control-solid h-100px" >{{ !empty( $editData->detail) ? $editData->detail : '' }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

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
                                            $path =  !empty($editData->image_video_title) ? asset('images/investmentHome/image').'/'. $editData->image_video_title  : ''  ;
                                            $test =   "background-image:url('$path')"  ;
                                           $videoUrl =  !empty($editData->image_video_title) ? asset('images/investmentHome/video').'/'. $editData->image_video_title  : ''  ;

                                        @endphp
                                        <div class="imageBgDiv image-input-wrapper w-125px h-125px" style="{{  !empty($editData->image_video_title) ? $test :'"background-image : none'}}"></div>

                                        <!--end::Preview existing image-->
                                        <!--begin::Label-->
                                        <label class="inputFileError errorMsg" for="direction" style="">  </label>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" value="{{ !empty($editData->image_video_title) ? $editData->image_video_title : '' }}" name="image_title" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="edit_image_title"  value="{{ !empty($editData->image_video_title) ? $editData->image_video_title : ''  }}" />
                                            <input type="hidden" name="avatar_remove" />
                                            <input type="hidden" id="imageType" name="imageType" value="{{ !empty($editData->type) ? $editData->type : ''  }}" />
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
                                            <input type="hidden" id="imageType" name="imageType" value="{{  !empty($editData->type) ? $editData->type : ''  }}" />
                                            <input type="hidden" name="edit_video_title" value="{{ !empty($editData->image_video_title  ) ? $editData->image_video_title   : '' }}" id="edit_video_title">

                                            <span class="pip editpip">
                                                        <video controls="" src="{{ !empty($editData->image_video_title) ? asset('images/investmentHome/video').'/'.$editData->image_video_title : '' }}" width="120" height="120"></video>
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
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function (e) {

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
