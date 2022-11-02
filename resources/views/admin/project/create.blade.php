@extends('admin.layouts.main',['title' => 'Project'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Projects</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.project') }}">Project</a></li>
<li class="breadcrumb-item px-3 text-primary">{{ !empty( $editData->project_id) ? 'Edit': "Create" }}</li>
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

                <form class="form" method="POST" action=" {{ !empty( $editData->project_id) ?  route('admin.project.update') : route('admin.project.store') }}" id="projectForm" enctype="multipart/form-data">
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">  Detail</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <textarea required placeholder="Enter Project Detail" name="project_detail" class="form-control form-control-solid h-100px" >{{ !empty( $editData->project_detail) ? $editData->project_detail : '' }}</textarea>
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
                                    <label>Note : Upload only PDF file </label>
                                </div>
                            </div>
                            <!--end::Row-->

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
                                       <!-- <input type="text" required placeholder="Enter Address" class="form-control form-control-solid" id="autocompletes" name="address" value="{{ !empty( $editData->address) ? $editData->address : '' }}" >
                                       -->
                                        <input type="text" required  class="form-control form-control-solid"   name="autocomplete" id="autocomplete"  placeholder="Choose Location" value="{{ !empty( $editData->address) ? $editData->address : '' }}" >


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
                                        <input required type="text" placeholder="Enter Landmark" class="form-control form-control-solid" name="landmark" value="{{ !empty( $editData->landmark) ? $editData->landmark : '' }}" id="landmark" >
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
                                                    <option ></option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}" {{ !empty($editData->country)  && ($editData->country ==  $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <select class="form-select form-select-solid form-select-lg" name="state" id="state" data-placeholder="Select State" data-control="select2" >
                                                    @if(!empty($states))    <option ></option>
                                                    @foreach ($states as $state)

                                                        <option value="{{ $state->id }}" {{ !empty($editData->state)  && ($editData->state ==  $state->id) ? 'selected' : '' }}>{{ $state->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <select class="form-select form-select-solid form-select-lg" name="city" id="city" data-control="select2"  data-placeholder="Select City">
                                                    @if(!empty($cities))    <option ></option>
                                                    @foreach ($cities as $city)

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
                                        <input id="zip" type="text" placeholder="Enter Zip" class="form-control form-control-solid" name="zip" value="{{ !empty( $editData->zip) ? $editData->zip : '' }}" >
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row text-center">
                                    <input type="hidden" name="project_id" value="{{ !empty( $editData->project_id) ? $editData->project_id : '' }}" id="project_id">
                                    <input type="hidden" name="latitude" value="{{ !empty( $editData->latitude) ? $editData->latitude : '' }}" id="latitude">
                                    <input type="hidden" name="longitude" value="{{ !empty( $editData->longitude) ? $editData->longitude : '' }}" id="longitude">
                                    <input type="hidden" name="countryid" value="" id="countryid">
                                    <input type="hidden" name="stateid" value="" id="stateid">
                                    <!--begin::Col-->
                                    <!--begin::Actions-->
                                    <div class="mb-0">
                                        <button type="button" data-form="projectForm" class="btn btn-primary" id="create_button">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script type="text/javascript"  src="https://maps.google.com/maps/api/js?key=AIzaSyCaGutB-33lg0jkFrBPKeQnusQSv2I2hyA&sensor=false&libraries=places"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
        });
        google.maps.event.addDomListener(window, 'load', initialize);
        function initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                console.log(place.address_components );
                for(var i = 0; i < place.address_components.length; i += 1) {
                    var addressObj = place.address_components[i];
                    for(var j = 0; j < addressObj.types.length; j += 1) {
                        if (addressObj.types[j] === 'country') {
                            console.log(addressObj.types[j]); // confirm that this is 'country'
                            console.log(addressObj.long_name); // confirm that this is the country name
                            console.log(addressObj.short_name);
                            var countryShortName = addressObj.short_name;

                        }
                        if (addressObj.types[j] === 'locality') {
                            console.log(addressObj.types[j]); // confirm that this is 'city'
                            console.log(addressObj.long_name); // confirm that this is the city name
                            var cityShortName = addressObj.long_name;

                        }
                        if (addressObj.types[j] === 'route') {
                            console.log(addressObj.types[j]); // confirm that this is 'country'
                            console.log(addressObj.long_name); // confirm that this is the country name
                            $('#landmark').val(addressObj.long_name);
                        }
                        if (addressObj.types[j] === 'administrative_area_level_1') {
                            console.log(addressObj.types[j]); // confirm that this is 'state'
                            console.log(addressObj.long_name); // confirm that this is the state name
                            var stateShortName = addressObj.long_name;

                        }

                        if (addressObj.types[j] === 'postal_code') {
                            console.log(addressObj.types[j]); // confirm that this is 'postal_code'
                            console.log(addressObj.long_name); // confirm that this is the postal_code
                            $('#zip').val(addressObj.long_name);
                        }

                        if (addressObj.types[j] === 'street_number') {
                            console.log(addressObj.types[j]); // confirm that this is 'street_number'
                            console.log(addressObj.long_name); // confirm that this is the street_number
                        }
                    }
                }
                selectCountry(countryShortName,'country');
                selectCountry(stateShortName,'state' );
                selectCountry(cityShortName,'city');
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());

            });
        }
        function selectCountry(countryShortName,selectId   ){
         
            var path = '';
            if(selectId == 'country'){
                 path = "{{ route('country.fetch') }}"
            } else if(selectId == 'state'){
                path = "{{ route('selectState.fetch') }}"
            } else {
                path = "{{ route('selectCity.fetch') }}"
            }


            $("#"+selectId).html('');
            $.ajax({
                url:  path,
                type: "GET",
                data: {
                    sortname: countryShortName,
                },
                dataType: 'json',
                success: function (result) {
                    $('#'+selectId).html('<option value="">Select  </option>');
                    $.each(result.countries, function (key, value) {
                        $("#"+selectId).append('<option value="' + value
                            .id + '">' + value.name + '</option>');

                        $('#'+selectId).val(value.id).trigger('change');

                    });
                }
            });
        }


         $(document).ready(function() {

         $(".removePdf").click(function(){
             $(this).parent(".pip").remove();
         });

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

             $("#projectForm").validate({
                 ignore: '',
                 rules: {
                     "project_name" :"required",
                     "category_id" : "required",
                     "work_status" : "required",
                     "amenities_id" :  "required",
                     "address" :  "required",
                     "landmark" :  "required",
                     "country" :  "required",
                     "state" :  "required",
                     "city" :  "required",
                     zip: {
                         required: true,
                         digits: true
                     }
                 },
                 messages: {
                     "project_name" : "Please enter project name",
                     "category_id" :  "Please select category",
                     "work_status" : "Please select work status",
                     "amenities_id" : "Please select amenity",
                     "address" :  "Please enter address",
                     "landmark" :  "Please enter landmaark",
                     "country" :  "Please select country",
                     "state" :  "Please select state",
                     "city" :  "Please select city",
                     zip: {
                         required: "Please enter zip",
                         digits: "Please enter digit"
                     }
                 }
             });

             $('#create_button').on('click', function(event) {

                 // prevent default submit action
                 event.preventDefault();

                 // test if form is valid
                 if($('#projectForm').valid()  ) { console.log(2);
                     $( '#projectForm' ).submit();
                 } else { console.log(3);
                     console.log("does not validate");
                     return false;
                 }
             });


        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        }); // focus on search input in select 2 -------------------------------------------------------------------


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

         });

    </script>

@endpush
