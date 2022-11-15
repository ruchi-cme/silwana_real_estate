@extends('admin.layouts.main',['title' => 'Footer CMS'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">CMS</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.footer') }}"> Footer</a></li>
<li class="breadcrumb-item px-3 text-primary"> {{ !empty( $editData->id) ?   'Edit' :  'Create' }}</li>
@endsection
<style>
.error ,  .inputFileError, .errorMsg{
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

                <form class="form" method="POST" action=" {{ !empty( $editData->id) ?  route('admin.footer.update') : route('admin.footer.store') }}" id="dataForm" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Footer Details</h2>
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Notes</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Notes" class="form-control form-control-solid" name="notes" value="{{ !empty( $editData->notes) ? $editData->notes : '' }}" >
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
                                            $path =  !empty($editData->image) ? asset('images/footer' ).'/'.$editData->image : ''  ;
                                            $test =   "background-image:url('$path')"  ;  @endphp
                                        <div class="imageBgDiv image-input-wrapper w-125px h-125px" style="{{  !empty($editData->image) ? $test :'"background-image : none'}}"></div>
                                        <!--end::Preview existing image-->
                                        <!--begin::Label-->
                                        <label class="inputFileError errorMsg" for="direction" style="">  </label>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{  !empty($editData->image) ? 'Change' : 'Upload' }} image">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" value="{{ !empty($editData->image) ? $editData->image : '' }}" name="image" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="edit_image"  value="{{ !empty($editData->image) ? $editData->image : ''  }}" />
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

                            <div class="increment">
                                @if(!empty($editData->social_media_data))
                                    @php
                                        $social_media_data = json_decode( $editData->social_media_data );

                                        $i = 1;
                                    @endphp

                                    @foreach($social_media_data as $row)

                                        <div class=" control-group"  >
                                            <div class="col-xl-3">
                                                <div class="fs-6 fw-bold mt-2 mb-3">Image</div>
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-xl-12 fv-row fv-plugins-icon-container ">
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <input  type="text" attrame="Enter Link" placeholder="Enter Link" class="form-control form-control-solid direction" name="link[]" value="{{ $row->link }}" >
                                                        <label class="inputerror errorMsg" for="link" style="">  </label>
                                                    </div>

                                                    <!--begin::Col-->
                                                    <div class="col-md-3 mb-3">
                                                        <!--begin::Image input-->
                                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: none">
                                                            <!--begin::Preview existing image-->
                                                            @php
                                                                $path =  !empty($row->icon) ? asset('images/footer').'/'. $row->icon  : ''  ;
                                                                $test =   "background-image:url('$path')"  ;

                                                            @endphp
                                                            <div class="imageBgDiv image-input-wrapper w-125px h-125px" style="{{  !empty($row->icon) ? $test :'"background-image : none'}}"></div>

                                                            <!--end::Preview existing image-->
                                                            <!--begin::Label-->
                                                            <label class="inputFileError errorMsg" for="direction" style="">  </label>
                                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                                <!--begin::Inputs-->
                                                                <input type="file"  name="icon[]" accept=".png, .jpg, .jpeg" />
                                                                <input type="hidden" name="edit_icon[]"  value="{{ !empty($row->icon) ? $row->icon : ''  }}" />
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
                                            </div>
                                        </div>
                                    @endforeach
                                @else


                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-bold mt-2 mb-3">Social Media Data 1</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-xl-12 fv-row fv-plugins-icon-container">
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                <input type="text" placeholder="Enter Link" attrame="Enter Link" class="form-control form-control-solid" name="link[]" value="" >
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
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload Icon">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="icon[]" accept=".png, .jpg, .jpeg" />
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
                                    </div>
                                    <!--begin::Col-->


                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-bold mt-2 mb-3">Social Media Data 2</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-xl-12 fv-row fv-plugins-icon-container">
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                <input type="text" placeholder="Enter Link" attrame="Enter Link" class="form-control form-control-solid" name="link[]" value="" >
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
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload Icon">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="icon[]" accept=".png, .jpg, .jpeg" />
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
                                    </div>
                                    <!--begin::Col-->


                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-bold mt-2 mb-3">Social Media Data 3</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-xl-12 fv-row fv-plugins-icon-container">
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                <input type="text" placeholder="Enter Link" attrame="Enter Link" class="form-control form-control-solid" name="link[]" value="" >
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
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload Icon">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="icon[]" accept=".png, .jpg, .jpeg" />
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
                                    </div>
                                    <!--begin::Col-->

                                @endif
                            </div>
                            <!--end::Row-->



                            <!--begin::Row-->
                            <div class="row text-center">
                                <input type="hidden" name="id" value="{{ !empty( $editData->id) ? $editData->id : '' }}" id="id">
                                <!--begin::Col-->
                                <!--begin::Actions-->
                                <div class="mb-0">
                                    <button type="button" data-form="amenityForm" class="btn btn-primary" id="create_button">
                                        <!--begin::Indicator-->
                                        <span class="indicator-label">{{ !empty( $editData->id) ?  'Update' : 'Create' }}  </span>
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
                    "detail" : "required",
                    "notes" : "required"
                },
                messages: {
                    "title" : "Please enter title",
                    "detail" :  "Please enter detail",
                    "notes" : "Please enter notes"
                }
            });

            $('#create_button').on('click', function(event) {

                var error = 1;
                $("#dataForm input[type=text]").each(function() {

                    if($(this).val().trim() === '') {
                        // update time range value already filled

                        $(this).next('.inputerror').html('Please '+  $(this).attr('attrame') );
                        error++;
                    }
                    else{
                        $(this).next('.inputerror').html('');
                    }
                });

                var err = 1;
                $(document).find("div.imageBgDiv").each(function() {

                    var bgImg = $(this).css('background-image').trim();

                    if (bgImg == 'url("about:invalid")' || bgImg == 'none'   ) {

                        $(this).next('.inputFileError').html('Required');
                        err++;
                    } else {
                        $(this).next('.inputFileError').html('');
                    }
                });

                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#dataForm').valid() && err == 1  ) { console.log(2);
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
