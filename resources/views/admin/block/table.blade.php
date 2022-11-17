@extends('admin.layouts.main',['title' => 'Block'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Property</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary text-muted" href="{{ route('admin.floor') }}">Block</a></li>
<li class="breadcrumb-item px-3 text-primary">{{ !empty( $editData->proj_block_floor_id) ? 'Edit': "Create" }}</li>
@endsection
<style>
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

                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <form id="tableForm" method="post" action="{{ !empty($editData->proj_block_map_id) ? route('admin.block.update') : route('admin.block.store') }}">
                            @csrf

                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="fw-bolder">Category</h2>
                                </div>
                                <!--begin::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">

                                <section class="unit-wrapper">

                                        <div class="d-flex floor-wrap cmn-box">
                                            <div class="form-group">
                                                <label for="">Block</label>
                                                <input type="text" name=block_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Floor</label>
                                                <input type="text" id="floor_no" name="floor_no">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Initial name</label>
                                                <input type="text" name="initial_name">
                                            </div>

                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary addFloor" name="add floor"> Add Floor</button>
                                            </div>
                                        </div>

                                        <div class="table-main-wrapper cmn-box"  >
                                            <table class="tablee" id="tble">
                                                <tbody class="appendHtml">

                                                </tbody>
                                            </table>


                                        </div>


                                </section>
                            </div>
                            <!--end::Card body-->
                            <div class="card-footer">
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <!--begin::Actions-->
                            <div class="mb-0">
                                <input type="hidden" class="form-control form-control-solid" name="category_id" id="category_id" value="">

                                <button type="submit" data-form="user_form" class="btn btn-primary" id="create_button">
                                    <!--begin::Indicator-->
                                    <span class="indicator-label">Create  Category</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator-->
                                </button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        </form>
                </div>

            </div>
            <!--end::Content-->

        </div>
        <!--end::Layout-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->

<table class="table" id="tbl" style="display: none">
    <tbody class="">
    <tr id="tr_clone" >
        <td>
            <button type="button"  class="btn btn-sm btn-icon btn-hover-scale btn-active-danger me-2 button btn-remove" id="create_button">
                <span class="svg-icon svg-icon-1"><i class="fa fa-trash"></i></span>
            </button>
        </td>
        <td>
            <label for="">categories</label>
            <select name="category_id-{0}" id="">
                <option value="">categories 1</option>
                <option value="">categories 1</option>
                <option value="">categories 1</option>
            </select>
        </td>
        <td>
            <div class="d-flex from-to-wrap">
                <div>
                    <label for="">From</label>
                    <input type="text" name="from">
                </div>
                <div>
                    <label for="">to</label>
                    <input type="text" name="to">
                </div>
            </div>
        </td>
        <td class="unitWrap">
            <div class="unit-wrap">
                <label for="">unit</label>
                <input type="text" name="unit" class="unitNo">
            </div>
        </td>

                <td id="unitTdClone" style="display: none">
                    <input type="text" disabled value="A-101">
                    <input type="text" placeholder="Sq. Ft.">
                    <input type="text" placeholder="Booking price">
                </td>



    </tr>
    </tbody>
</table>


@endsection

@push('scripts')
    <script src="{{ asset('js/swal.js') }}" ></script>
     <script   src="{{ asset('js/front/custom') }}/general.js"> </script>

    <script type="text/javascript">
        $(document).ready(function () {
        $('.addFloor').on('click', function (e) {

            var floor_no = $('#floor_no').val();

            var rowCount = $('.appendHtml tr').length;
            if(rowCount == 0) {
                var tdCount = floor_no;
            }
            else if(floor_no > rowCount ) {
                var tdCount = floor_no - rowCount;
            }
            else if(floor_no < rowCount ) {
                var removeTr = rowCount - floor_no ;
                for($i = rowCount; $i >= floor_no; $i--) {
                    remove_btn($i);
                }
            }

            for (var i = rowCount; i < floor_no ; i++) {


                $('.appendHtml').append(`<tr id="tr_clone_${i}" >
                <td>
                    <button type="button" class="btn btn-sm btn-icon btn-hover-scale btn-active-danger me-2 button btn-remove" onclick="remove_btn(${i})" id="create_button">
                        <span class="svg-icon svg-icon-1"><i class="fa fa-trash"></i></span>
                    </button>
                </td>
                <td>
                    <label for="">categories</label>
                    <select name="category_id[]" id="category_id${i}">
                        <option value="">categories 1</option>
                        <option value="1">categories 1</option>
                        <option value="2">categories 1</option>
                    </select>
                </td>
                <td>
                    <div class="d-flex from-to-wrap">
                        <div>
                            <label for="">From</label>
                            <input type="text" name="from[]" >
                        </div>
                        <div>
                            <label for="">to</label>
                            <input type="text" name="to[]">
                        </div>
                    </div>
                </td>
                <td id="unitWrap_${i}">
                    <div class="unit-wrap">
                        <label for="">unit</label>
                        <input type="text" name="unit[]" value="" onclick="triggerKeyUp(${i});" class="unitChange" id="unit_no_${i}">
                    </div>
                </td>
            </tr> `);

            }
        });
        });

        function triggerKeyUp(i) {

           $("#unit_no_"+i).keyup(function () {

            var totalUnit = $("#unit_no_"+i).val();
            var rowCount = $('.units'+i).length;

            if(rowCount == 0) {
                var tdCount = totalUnit;
            }
            else if(totalUnit > rowCount ) {
                var tdCount = totalUnit - rowCount;
            }
            else if(totalUnit < rowCount ) {
                var removeTr = rowCount - totalUnit ;
                for($i = rowCount; $i >= totalUnit; $i--) {
                    $('.units'+$i).remove();
                }
            }

                for (var j = 0; j < totalUnit ; j++) {
                    $('#unitWrap_'+i).after(`<td class="units${j}">
                            <input type="text" name="" readonly value="A-101">
                            <input type="text" placeholder="Sq. Ft.">
                            <input type="text" placeholder="Booking price">
                        </td>
                    `);
                }
            });
        }

        function remove_btn(i) {
            $('#tr_clone_'+i).remove();
        }

         /* $(".btn-remove").on('click', function( ) { alert(1);
            var whichtr = $(this).closest("tr").remove();
         }); */

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
    </script>

@endpush
