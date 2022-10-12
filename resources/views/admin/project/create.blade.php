@extends('admin.layouts.main',['title' => 'Project'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Proerty</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.project') }}">Project</a></li>
<li class="breadcrumb-item px-3 text-primary">{{ !empty( $editData->project_id) ? 'Edit': "Create" }}</li>
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

                <form class="form" method="POST" action=" {{ !empty( $editData->project_id) ?  route('admin.project.update') : route('admin.project.store') }}" id="user_form" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Project Details</h2>
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">  Name</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input required type="text" placeholder="Enter Project Name" class="form-control form-control-solid" name="project_name" value="{{ !empty( $editData->project_name) ? $editData->project_name : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 ">  Detail</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <textarea placeholder="Enter Project Detail" name="project_detail" class="form-control form-control-solid h-100px" >{{ !empty( $editData->project_detail) ? $editData->project_detail : '' }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Category</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <select required class="form-select form-select-solid form-select-lg" name="category_id" id="category_id" data-placeholder="Select Category" data-control="select2" >
                                        <option ></option>
                                        {{ $categoryData = getCategory() }}
                                        @if (!empty($categoryData))
                                            @foreach ($categoryData as $cat)
                                                <option value="{{ $cat->category_id }}" {{ !empty( $editData->category_id)  && ($editData->category_id ==  $cat->category_id) ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->


                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Work Status</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <select required class="form-select form-select-solid form-select-lg" name="work_status" id="work_status" data-placeholder="Select Work Status" data-control="select2"  >
                                    <option  ></option>
                                    @foreach ($workStatus as $key => $val)
                                        <option value="{{ $key }}" {{ !empty( $editData->category_id)  && ($editData->work_status == $key) ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach

                                </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Amenities</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <select required class="form-select form-select-solid form-select-lg" multiple="multiple" name="amenities_id[]" id="work_status" data-placeholder="Select Amenities" data-control="select2"  >
                                        <option  ></option>
                                        {{ $amenitiesData = getAmenities() }}
                                        @if (!empty($amenitiesData))
                                            @foreach ($amenitiesData as $amenity)
                                                <option value="{{ $amenity->amenities_id }}" {{ !empty($selectedAmenity) && in_array($amenity->amenities_id, $selectedAmenity)  ? 'selected' : '' }}>{{ $amenity->amenity_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Maintenance</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" placeholder="Enter Maintenance" class="form-control form-control-solid" name="maintenance" value="{{ !empty( $editData->maintenance) ? $editData->maintenance : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Architecture Diagram</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="file" class="form-control form-control-solid" name="project_pdf[]" multiple id="project_pdf" >

                                    <div class="col-xl-9 fv-row fv-plugins-icon-container pdf-preview-div">
                                        @if (!empty($selectedImage))
                                            @foreach ($selectedImage as $image )
                                                @if ($image['type'] == 1)
                                                    <span class="pip">
                                                         <input type="hidden" name="edit_project_pdf[]" value="{{ !empty( $image['title'] ) ? $image['title']  : '' }}" id="edit_project_pdf">
                                                        <img height='50' width='50' class="imageThumb" src="{{ asset('images/project/pdf').'/'.$image['title'] }}" title=""/>
                                                <br/><span class="removePdf"><i class="fa fa-trash"></i></span>
                                                </span>
                                                @endif
                                            @endforeach
                                        @endif
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>



                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Images</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="file" class="form-control form-control-solid" multiple name="project_image[]" id="project_image" >

                                    <div class="col-xl-9 fv-row fv-plugins-icon-container images-preview-div">

                                     @if (!empty($selectedImage))
                                         @foreach ($selectedImage as $image )
                                             @if ($image['type'] == 2)
                                                <span class="pip">
                                                     <input type="hidden" name="edit_project_image[]" value="{{ !empty( $image['title'] ) ? $image['title']  : '' }}" id="edit_project_image">
                                                    <img height='50' width='50' class="imageThumb" src="{{ asset('images/project/images').'/'.$image['title'] }}" title=""/>
                                                <br/><span class="removeImg"><i class="fa fa-trash"></i></span>
                                                </span>
                                            @endif
                                        @endforeach
                                     @endif

                                    </div>

                            </div>
                            <!--end::Row-->

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->

                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Project Address</h2>
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Address</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Address" class="form-control form-control-solid" name="address" value="{{ !empty( $editData->address) ? $editData->address : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Landmark</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input required type="text" placeholder="Enter Landmark" class="form-control form-control-solid" name="landmark" value="{{ !empty( $editData->landmark) ? $editData->landmark : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Location</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <select class="form-select form-select-solid form-select-lg" name="country" id="country" data-control="select2" data-placeholder="Choose Country" >
                                                @foreach ($countries as $country)
                                                    <option ></option>
                                                    <option value="{{ $country->id }}" {{ !empty($editData->country)  && ($editData->country ==  $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <select class="form-select form-select-solid form-select-lg" name="state" id="state" data-placeholder="Select State" data-control="select2" >
                                                @if(!empty($states))
                                                @foreach ($states as $state)
                                                    <option ></option>
                                                    <option value="{{ $state->id }}" {{ !empty($editData->state)  && ($editData->state ==  $state->id) ? 'selected' : '' }}>{{ $state->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <select class="form-select form-select-solid form-select-lg" name="city" id="city" data-control="select2"  data-placeholder="Select City">
                                                @if(!empty($cities))
                                                @foreach ($cities as $city)
                                                    <option ></option>
                                                    <option value="{{ $city->id }}" {{ !empty($editData->city)  && ($editData->city ==  $city->id) ? 'selected' : '' }}>{{ $city->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Zip  </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" placeholder="Enter Zip" class="form-control form-control-solid" name="zip" value="{{ !empty( $editData->zip) ? $editData->zip : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row text-center">
                                <input type="hidden" name="project_id" value="{{ !empty( $editData->project_id) ? $editData->project_id : '' }}" id="project_id">
                                <!--begin::Col-->
                                <!--begin::Actions-->
                                <div class="mb-0">
                                    <button type="submit" data-form="user_form" class="btn btn-primary" id="create_button">
                                        <!--begin::Indicator-->
                                        <span class="indicator-label">{{ !empty( $editData->project_id) ?  'Update' : 'Create' }} Project</span>
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
<style>
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
@push('scripts')
    <script src="{{ asset('js/swal.js') }}" ></script>

    <script type="text/javascript">

         $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#project_image").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img height='50' width='50' class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\"><i class=\"fa fa-trash\"></i></span>" +
                                "</span>").insertAfter(".images-preview-div");
                            $(".remove").click(function(){
                                $(this).parent(".pip").remove();
                            });

                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
         $(".removeImg").click(function(){
             $(this).parent(".pip").remove();

         });
         $(".removePdf").click(function(){
             $(this).parent(".pip").remove();
         });
         $(document).ready(function() {
             if (window.File && window.FileList && window.FileReader) {
                 $("#project_pdf").on("change", function(e) {
                     var files = e.target.files,
                         filesLength = files.length;
                     for (var i = 0; i < filesLength; i++) {
                         var f = files[i]
                         var fileReader = new FileReader();
                         fileReader.onload = (function(e) {
                             var file = e.target;
                             $("<span class=\"pip\">" +
                                 "<img height='50' width='50' class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                 "<br/><span class=\"remove\"><i class=\"fa fa-trash\"></i></span>" +
                                 "</span>").insertAfter(".pdf-preview-div");
                             $(".remove").click(function(){
                                 $(this).parent(".pip").remove();
                             });

                         });
                         fileReader.readAsDataURL(f);
                     }
                 });
             } else {
                 alert("Your browser doesn't support to File API")
             }
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

         $(document).ready(function (e) {
             // country select listener ----------------------------------------------------------------------------

             $('#country').on("select2:select", function (e) {
                 var country = this.value;
                 $("#state").html('');
                 $.ajax({
                     url: "{{ route('state.fetch') }}",
                     type: "GET",
                     data: {
                         country_id: country,
                     },
                     dataType: 'json',
                     success: function (result) {
                         $('#state').html('<option value="">Select State</option>');
                         $.each(result.states, function (key, value) {
                             $("#state").append('<option value="' + value
                                 .id + '">' + value.name + '</option>');
                         });
                         $('#state').select2('open');
                     }
                 });
             });

         });
        // state select listener ----------------------------------------------------------------------------

         $('#state').on("select2:select", function (e) {
             var state = this.value;
             $("#city").html('');
             $.ajax({
                 url: "{{ route('city.fetch') }}",
                 type: "GET",
                 data: {
                     state_id: state,
                 },
                 dataType: 'json',
                 success: function (result) {
                     $('#city').html('<option value="">Select State</option>');
                     $.each(result.cities, function (key, value) {
                         $("#city").append('<option value="' + value
                             .id + '">' + value.name + '</option>');
                     });
                     $('#city').select2('open');
                 }
             });
         });


    </script>

@endpush
