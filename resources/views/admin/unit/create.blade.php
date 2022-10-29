@extends('admin.layouts.main',['title' => 'Unit'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Projects</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary text-muted" href="{{ route('admin.unit') }}">unit</a></li>
<li class="breadcrumb-item px-3 text-primary">{{ !empty( $editData->floor_unit_id) ? 'Edit': "Create" }}</li>
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
                <form class="form" method="POST" action="{{ !empty($editData->floor_unit_id) ? route('admin.unit.update') : route('admin.unit.store') }}" id="unit_form" enctype="multipart/form-data">
                   @csrf

                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Unit Detail</h2>
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Project</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <select required class="form-select form-select-solid form-select-lg" id="project_id" name="project_name" data-placeholder="Select Project" data-control="select2" >
                                        @php $projectData = getProject() @endphp
                                        @if (!empty($projectData))
                                            @foreach ($projectData as $pro)
                                                <option value="{{ $pro->project_id }}" {{ !empty( $editData->project_id)  && ($editData->project_id ==  $pro->project_id) ? 'selected' : '' }}>{{ $pro->project_name }}</option>
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Block</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="hidden" id="edit_block_name" value="{{ !empty( $editData->block_name_map_id)  ? $editData->block_name_map_id : ''}}">

                                    <select   class="form-select form-select-solid form-select-lg" name="block_name" id="block_name" data-placeholder="Select Block" data-control="select2" >
                                        <option ></option>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Floor </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input   type="text" class="form-control form-control-solid" placeholder="Enter Unit Name" autofocus name="floor_number" id="floor_number" value="{{ !empty($editData->floor_no ) ? $editData->floor_no : ''}}" >
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
                                    <select   class="form-select form-select-solid form-select-lg" name="category_name" id="category_id" data-placeholder="Select Category" data-control="select2" >
                                        <option ></option>
                                        @php $categoryData = getCategory() @endphp
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
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Unit Name</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" placeholder="Enter Unit Name" autofocus name="unit_name" id="unit_name" value="{{ !empty($editData->unit_name ) ? $editData->unit_name : ''}}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Area (In Sq Feet)</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input   type="text" class="form-control form-control-solid" placeholder="Enter Area" autofocus name="area_in_sq_feet" id="area_in_sq_feet" value="{{ !empty($editData->area_in_sq_feet ) ? $editData->area_in_sq_feet : ''}}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 ">Price</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" placeholder="Enter Price" autofocus name="total_price" id="total_price" value="{{ !empty($editData->total_price ) ? $editData->total_price : ''}}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 ">Booking Price</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" placeholder="Enter Booking Price" autofocus name="booking_price" id="booking_price" value="{{ !empty($editData->booking_price ) ? $editData->booking_price : ''}}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                        <!--end::Card body-->
                            <div class="card-footer">
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <!--begin::Actions-->
                            <div class="mb-0">
                                <input type="hidden"  name="floor_unit_id" id="floor_unit_id" value="{{ !empty($editData->floor_unit_id ) ? $editData->floor_unit_id : ''}}" >
                                <input type="hidden"  name="floor_detail_id" id="floor_detail_id" value="{{ !empty($editData->floor_detail_id ) ? $editData->floor_detail_id : ''}}" >
                                <input type="hidden"  name="block_floor_map_id" id="block_floor_map_id" value="{{ !empty($editData->block_floor_map_id ) ? $editData->block_floor_map_id : ''}}" >
                                <button type="button" data-form="unit_form" class="btn btn-primary" id="create_button">
                                    <!--begin::Indicator-->
                                    <span class="indicator-label">{{ !empty($editData->floor_unit_id ) ?  'Update' : 'Create'}}  Unit</span>
                                    <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator-->
                                </button>
                            </div>
                            <!--end::Actions-->
                        </div>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {

            $('#create_button').on('click', function(event) {


                $("#unit_form").validate({
                    ignore: '',
                    rules: {
                        "project_name" :"required",
                        "block_name" : "required",
                        "category_name" : "required",
                        "unit_name" : "required",
                        "total_price" : "required",
                        "booking_price" :"required",
                        floor_number: {
                            required: true,
                            digits: true
                        },
                        area_in_sq_feet: {
                            required: true,
                            digits: true
                        }
                    },
                    messages: {
                        "project_name" :"Please select project",
                        "block_name" : "Please select block",
                        "category_name" : "Please enter category",
                        "unit_name" : "Please enter unit name",
                        "total_price" : "Please enter price",
                        "booking_price" : "Please enter booking price",
                        floor_number: {
                            required: "Please enter floor",
                            digits: "Please enter digit"
                        },
                        area_in_sq_feet: {
                            required: "Please enter area",
                            digits: "Please enter digit"
                        }
                    }
                });

                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#unit_form').valid()  ) { console.log(2);
                    $( '#unit_form' ).submit();
                } else { console.log(3);
                    console.log("does not validate");
                    return false;
                }
            });



            var project_id =  $('#project_id').val();
            if(project_id != '') {
                getBlock(project_id);
            }

            $('#project_id').on("select2:select", function (e) {
                var project_id = this.value;
                getBlock(project_id);
            });

            function getBlock(project_id){
                $("#block_name").html('');
                $.ajax({
                    url: "{{ route('block.fetch') }}",
                    type: "GET",
                    data: {
                        project_id: project_id,
                    },
                    dataType: 'json',
                    success: function (result) {

                        $('#block_name').html('<option value="">Select Block</option>');
                        $.each(result.blockData, function (key, value) {
                            $("#block_name").append('<option value="' + value
                                .block_name_map_id + '">' + value.block_name + '</option>');
                        });
                        $('#block_name').select2('open');

                        var edit_block_name =  $('#edit_block_name').val();
                        if(edit_block_name != '') {
                            $("#block_name").val(edit_block_name);
                        }
                    }
                });
            }

        });


        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        }); // focus on search input in select 2 -------------------------------------------------------------------
    </script>

@endpush
