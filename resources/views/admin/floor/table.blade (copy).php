@extends('admin.layouts.main',['title' => 'Floor'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Projects</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary text-muted" href="{{ route('admin.floor') }}">Floor</a></li>
<li class="breadcrumb-item px-3 text-primary">{{ !empty( $editData->proj_block_floor_id) ? 'Edit': "Create" }}</li>
@endsection
<style>
    .errorMsg {
        color: #FF0000 !important;
    }
    .unit-wrapper .table-main-wrapper {
        overflow-x: auto;
        margin-top: 30px;
        font-family: Poppins,Helvetica,sans-serif;
    }

    .unit-wrapper table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }

    .unit-wrapper th,
    .unit-wrapper td {
        text-align: left;
        padding: 8px;
        border: none;
    }

    .unit-wrapper input {
        background:none;
        border:1px solid #c6c6c6;
        border-radius: 5px;
        font-size: 14px;
        padding: 7px 10px;
        color: #000;
        margin: 0 0 5px;
    }

    .unit-wrapper label {
        font-size: 16px;
        color: #000;
        text-transform: capitalize;
    }

    .unit-wrapper select {
        background:none;
        border:1px solid #c6c6c6;
        border-radius: 5px;
        font-size: 14px;
        padding: 7px 10px;
        color: #000;
    }

    .unit-wrapper ::placeholder {
        font-size: 14px;
        color: #000;
    }

    .unit-wrapper .cmn-box {
        padding: 20px 25px;
        border-radius: 10px;
    }

    .unit-wrapper .from-to-wrap input,
    .unit-wrapper .unit-wrap input {
        max-width: 100px;
    }

    .block-table-main .card-body {
        overflow-x: auto;
    }

    .block-table-main .card {
        overflow-x: auto;
    }
    /* body {
        background-color: #f5f8fa;
    } */
</style>
@section('content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid block-table-main" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">

        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">

            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                <!--begin::Form-->

                @include('layouts.alerts.error')

                   <form id="tableForm" method="post" action="{{ route('admin.floor.store') }}">
                            @csrf
                        <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="fw-bolder">Floor</h2>
                                </div>
                                <!--begin::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">

                                <section class="unit-wrapper">

                                    <div class="form-group">
                                    <label for="">Project</label>
                                    <select class="form-select form-select-solid form-select-lg" name="project_name" id="project_id" data-placeholder="Select Project" data-control="select2" >
                                        <option ></option>
                                        @php $projectData = getProject() @endphp
                                        @if (!empty($projectData))
                                            @foreach ($projectData as $pro)
                                                <option value="{{ $pro->project_id }}" {{ !empty( $editData->project_id)  && ($editData->project_id ==  $pro->project_id) ? 'selected' : '' }}>{{ $pro->project_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label class="inputerror errorMsg" for="block_name" style="">  </label>
                                </div>

                                    <div class="d-flex floor-wrap cmn-box">
                                        <div class="form-group">
                                            <label for="">Block</label>
                                            <input type="hidden" id="edit_block_name" value="{{ !empty( $editData->block_name_map_id)  ? $editData->block_name_map_id : ''}}">
                                            <select class="form-select form-select-solid form-select-lg" name="block_name" id="block_name" data-placeholder="Select Project" data-control="select2" >
                                                <option ></option>
                                            </select>
                                            <label class="inputerror errorMsg" for="block_name" style="">  </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Floor</label>
                                            <input type="text" id="floor_no" name="total_floor" value="{{ !empty( $editData->total_floor)  ?  $editData->total_floor : '' }}" placeholder="Enter Floor">
                                            <label class="inputerror errorMsg" for="total_floor" style="">  </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Initial name</label>
                                            <input type="text" id="initial_name" name="initial_name" value="{{ !empty( $editData->initial_name)  ?  $editData->initial_name : '' }}" placeholder="Enter Initial Name">
                                            <label class="inputerror errorMsg" for="initial_name" style="">  </label>
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary addFloor" name="add floor"> Add Floor</button>
                                        </div>
                                    </div>

                                    <div class="table-main-wrapper cmn-box" id="main" >
                                            <table class="tablee" id="tble">
                                                <tbody class="appendHtml">

                                                @if(!empty($editData))

                                                    @foreach($floorData as $row)
                                                    <tr id="tr_clone" >
                                                        <td>
                                                            <div class="d-flex from-to-wrap">
                                                                <div>
                                                                    <label for="">Floor</label>
                                                                    <input type="text" class="floor_number"  disabled name="from" value="{{ $row['floor_no'] }}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <label for="">categories</label>
                                                            <select name="category_id" disabled  >
                                                                <option>Select Category</option>
                                                                @php $categoryData = getCategory() @endphp
                                                                @if (!empty($categoryData))
                                                                    @foreach ($categoryData as $cat)
                                                                        <option value="{{ $cat->category_id }}" {{ !empty( $row['category_id'])  && ($row['category_id'] ==  $cat->category_id) ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex from-to-wrap">
                                                                <div>
                                                                    <label for="">From</label>
                                                                    <input type="text" name="from" value="{{ $row['from'] }}" disabled>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="unitWrap">
                                                            <div class="unit-wrap">
                                                                <label for="">unit</label>
                                                                <input type="text" name="unit" class="unitNo" value="{{ $row['unit_count'] }}" disabled>
                                                            </div>
                                                        </td>

                                                        @php
                                                           $getUnit =  getUnit($row['floor_detail_id']);
                                                        @endphp
                                                        @if(!empty($getUnit))
                                                            @foreach($getUnit as $unit)
                                                                <td id="unitTdClone"  >
                                                                    <input type="text" value="{{ $unit['unit_name'] }}" disabled  >
                                                                    <input type="text" value="{{ $unit['area_in_sq_feet'] }}" placeholder="Sq. Ft." disabled>
                                                                    <input type="text" value="{{ $unit['booking_price'] }}" placeholder="Booking price" disabled>
                                                                    <input type="text" value="{{ $unit['total_price'] }}" placeholder="Total price" disabled>
                                                                </td>
                                                            @endforeach
                                                        @endif

                                                    </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>

                                    <!--begin::Seperator-->
                                    <div class="separator separator-dashed mb-7"></div>
                                    <!--end::Seperator-->

                                    <!--begin::Actions-->
                                    <div class="mb-0">
                                         <input type="hidden" name="floor_count" id="floor_count" value="">
                                        <input type="hidden" name="block_floor_map_id" id="block_floor_map_id" value="{{ !empty($editData->block_floor_map_id) ? $editData->block_floor_map_id :'' }}">

                                         <button type="button" data-form="tableForm" class="btn btn-primary" id="create_button">
                                            <!--begin::Indicator-->
                                            <span class="indicator-label">Create  Floor</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                <!--end::Indicator-->
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </section>
                            </div>
                            <!--end::Card body-->
                    </div>
                  </form>
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
        $(document).ready(function () {

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

            $('.addFloor').on('click', function (e) {

                var floor_count = $('#floor_count').val();

                var floor_no = $('#floor_no').val();

                    var digitval = $.isNumeric(floor_no);

                    if (digitval == false) {

                        $('#floor_no').next('.inputerror').html('Please Enter Digits');
                        event.preventDefault();
                    }else{
                        $('#floor_no').next('.inputerror').html('');
                    }


                var rowCount = $('.appendHtml tr').length;
                if(rowCount == 0) {
                    var tdCount = floor_no;
                }
                else if(floor_no > rowCount ) {
                    var tdCount = floor_no - rowCount;
                }
                else if(floor_no < rowCount ) { alert(rowCount); alert(floor_no);
                    var removeTr = rowCount - floor_no ;
                    for($i = rowCount; $i >= floor_no; $i--) {
                        remove_btn($i);
                    }
                }

                var n = 0;

                if(floor_count != '') {
                    n =  parseInt(floor_count) + 1 ;
                }

                for (var i = rowCount; i < floor_no ; i++) {

                    $('.appendHtml').append(`<tr id="tr_clone_${n}" >
                    <td>
                         <div class="d-flex from-to-wrap">
                           <div>
                                <button type="button" class="btn btn-sm btn-icon btn-hover-scale btn-active-danger me-2 button btn-remove" onclick="remove_btn(${n})" id="create_button">
                                     <span class="svg-icon svg-icon-1"><i class="fa fa-trash"></i></span>
                                </button>
                            </div>
                            <div>
                                <label for="">Floor</label>
                                <input class="floor_number" type="text" readonly name="floor_number[]" value="${i+1}">
                            </div>
                        </div>
                    </td>
                    <td>
                        <label for="">categories</label>
                        <select name="category_id[]" id="category_id${n}" placeholder="Select Category">
                           @php $categoryData = getCategory() @endphp
                              @if (!empty($categoryData))
                                @foreach ($categoryData as $cat)
                                     <option value="{{ $cat->category_id }}" >{{ $cat->category_name }}</option>
                                 @endforeach
                              @endif
                        </select>
                        <label class="inputerror errorMsg"  for="category_id" style=""></label>
                    </td>
                    <td>
                        <div class="d-flex from-to-wrap">
                            <div>
                                <label for="">From</label>
                                <input type="text" id="from${n}" name="from[]" placeholder="Enter From" class="only-numeric">
                             <label class="inputerror errorMsg" for="from" style=""></label>
                            </div>
                        </div>
                    </td>
                    <td id="unitWrap_${n}">
                        <div class="unit-wrap">
                            <label for="">unit</label>
                            <input type="text" name="unit[]" value="" onchange="triggerKeyUp(${n});" class="unitChange only-numeric"  placeholder="Enter Unit" id="unit_no_${n}">
                                <label class="inputerror errorMsg"  for="unit" style=""></label>
                        </div>
                    </td>
                </tr> `);

                    $('#floor_count').val(n);
                    n++;
                }
            });
            });

            function triggerKeyUp(i) {

            var totalUnit = $("#unit_no_"+i).val();
            var digitval = $.isNumeric(totalUnit);

            /*       validation     */
            if (digitval == false) {

                $("#unit_no_"+i).next('.inputerror').html('Please Enter Digits');
                event.preventDefault();

            } else {
                $("#unit_no_"+i).next('.inputerror').html('');
            }

            /*      remove if count is less     */
            var rowCount = $('.unitsWrap'+i).length;
            if(totalUnit < rowCount ) {
                for($i = rowCount; $i >= totalUnit; $i--) {
                    $('.unitTd'+i+$i).remove();
                }
            }


            /*      append Units    */

            var initial_name = $('#initial_name').val();
            var from = $("#from"+i).val();

                for (var j = rowCount; j < totalUnit ; j++) {

                    /*      set logic for units name   */
                   var unit_name =  initial_name +'-'+ from;

                    $('#unitWrap_'+i).after(`<td class="unitTd${i}${j} unitsWrap${i}  units${j}">

                            <input type="text" name="unit_name[${i}][]" placeholder="Unit Name" readonly value="${unit_name}">
                            <input type="text" placeholder="Enter Sq. Ft." name="sq_ft[${i}][]">
                            <label class="inputerror errorMsg" for="sq_ft" style=""> </label>
                            <input type="text" placeholder="Enter Booking Price" name="booking_price[${i}][]">
                            <label class="inputerror errorMsg" for="booking_price" style=""> </label>
                            <input type="text" placeholder="Enter Price" name="total_price[${i}][]">
                            <label class="inputerror errorMsg" for="total_price" style=""> </label>
                        </td>
                    `);
                    from++;
                }
                return false;

        }

            function remove_btn(i) {
                $('#tr_clone_'+i).remove();
                var floorVal =   $('#floor_no').val();
                $('#floor_no').val(parseInt(floorVal) - 1);

                $('.floor_number').each(function($i){
                     $(this).val($i+1) ;
                });
            }

        $(document).ready(function () {

            $('#create_button').on('click', function(event) {

                // adding rules for inputs with class 'comment'
                var error = 1;
                $("#tableForm input[type=text]").each(function() {

                    if($(this).val() === '') {
                        // update time range value already filled

                        $(this).next('.inputerror').html('Please '+  $(this).attr('placeholder') );
                        error++;
                    }
                    else{
                        $(this).next('.inputerror').html('');
                    }
                });

                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#tableForm').valid() && error == 1) { console.log(2);
                    $( '#tableForm' ).submit();
                } else { console.log(3);
                    console.log("does not validate");
                    return false;
                }
            });
        });

        const scrollContainer = document.getElementById("main");

        scrollContainer.addEventListener("wheel", (evt) => {
            evt.preventDefault();
            scrollContainer.scrollLeft += evt.deltaY;
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        }); // focus on search input in select 2 -------------------------------------------------------------------
    </script>

@endpush
