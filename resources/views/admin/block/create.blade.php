@extends('admin.layouts.main',['title' => 'Block'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Property</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary text-muted" href="{{ route('admin.block') }}">Block</a></li>
<li class="breadcrumb-item px-3 text-primary">{{ !empty( $editData->proj_block_map_id) ? 'Edit': "Create" }}</li>
@endsection

<style>
    .error{
        color: #FF0000;
    }
    .inputerror {
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

                <form class="form" method="POST" action="{{ !empty($editData->proj_block_map_id) ? route('admin.block.update') : route('admin.block.store') }}" id="blockForm" enctype="multipart/form-data">
                   @csrf

                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Block Detail</h2>
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
                                    <select class="form-select form-select-solid form-select-lg @error('project_name') is-invalid @enderror " name="project_name" id="project_id" data-placeholder="Select Project" data-control="select2" >
                                        <option ></option>
                                        {{ $projectData = getProject() }}
                                        @if (!empty($projectData))
                                            @foreach ($projectData as $pro)
                                                <option value="{{ $pro->project_id }}" {{ !empty( $editData->project_id)  && ($editData->project_id ==  $pro->project_id) ? 'selected' : '' }}>{{ $pro->project_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('project_name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8 blockTypeDiv">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required">Type of Block</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <select class="form-select form-select-solid form-select-lg blockType"  name="type_of_block" id="type_of_block" data-placeholder="Select Type Of Block" data-control="select2" >
                                        <option ></option>
                                        @foreach ($type_of_block as $key => $val)
                                            <option value="{{ $key }}" {{ !empty( $editData->type_of_block) && ($editData->type_of_block == $key) ? 'selected' : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            @if (!empty( $editData->type_of_block)  &&  ($editData->type_of_block == 1) )
                                @php
                                    $from='';$to='';
                                   if( !empty( $editData->range))
                                    {
                                        $range = explode(',', $editData->range);
                                        $from = $range[0];

                                    }

                                    @endphp
                                <div class="row mb-8 rangeDiv">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-bold mt-2 mb-3 required">Range</div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                        <div class="d-flex from-to-wrap">
                                            <div>
                                                <label for="">From</label>
                                                <select class="form-control form-control-solid " name="from" id="from" onchange="changeFromTo()">
                                                   <option value="">Select Range From</option>
                                                    @foreach (range('A', 'Z') as $char)
                                                        <option value="{{$char}}" {{  ($from ==  $char) ? 'selected' : '' }}>{{$char}}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div><div class="fv-plugins-message-container invalid-feedback"></div></div>
                                </div>
                            @endif
                            <!--begin::Row-->
                            <div class="row mb-8 totalBlockDiv">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Total Block</div>
                                </div>

                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" onchange="toRange()" class="form-control form-control-solid" placeholder="Enter Total Block" autofocus name="total_block" id="total_block" value="{{ !empty($editData->total_block ) ? $editData->total_block : ''}}" >
                                     <div class="fv-plugins-message-container invalid-feedback"></div>
                                    <label>Note : if anything change in total blocks, older blocks will deleted and new blocks will generate. If type of block is range</label>
                                </div>
                            </div>

                            <div class="row mb-8 PrintDiv">
                                @if(!empty($blockNameList))
                                    @foreach($blockNameList as $key => $blockname)

                                        <div class="row mb-8 blockDiv blockDiv_{{$key}}">
                                            <!--begin::Col-->
                                            <div class="col-xl-1">
                                                <button type="button"  class="btn btn-sm btn-icon btn-hover-scale btn-active-danger me-2 button removeBlockBtn"  removeBlockId="{{ $blockname['block_name_map_id']}}"  onclick="remove_btn({{$key}})" id="removeBlockBtn{{$key}}">
                                                <span class="svg-icon svg-icon-1"><i class="fa fa-trash"></i></span>
                                            </button>
                                                </div>
                                            <div class="col-xl-3">
                                                <div class="fs-6 fw-bold mt-2 mb-3 required">Block Name </div>
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-xl-8 fv-row fv-plugins-icon-container">
                                                <input type="hidden" class="form-control form-control-solid"  name="block_name_map_id[]" id="block_name_map_id" value="{{ $blockname['block_name_map_id'] }}" >
                                                <input type="text" class="form-control form-control-solid block_name" placeholder="Enter Block Name" autofocus name="edit_block_name[]" id="edit_block_name" value="{{ $blockname['block_name'] }}" >
                                                <label class="inputerror" for="block_name" style="">  </label>
                                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <!--end::Row-->

                        <!--end::Card body-->
                        <div class="card-footer">
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <!--begin::Actions-->
                            <div class="mb-0">
                                <input type="hidden" class="form-control form-control-solid" name="proj_block_map_id" id="proj_block_map_id" value="{{ !empty($editData->proj_block_map_id ) ? $editData->proj_block_map_id : ''}}" >
                                <input type="hidden" name="removeId" id="removeId">

                                <button type="button" data-form="blockForm" class="btn btn-primary" id="create_button">
                                    <!--begin::Indicator-->
                                    <span class="indicator-label">{{ !empty($editData->proj_block_map_id ) ?  'Update' : 'Create'}}  Block</span>
                                    <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator-->
                                </button>
                            </div>
                            <!--end::Actions-->
                        </div>
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

<script   src="{{ asset('js/front/custom') }}/general.js"> </script>

<script type="text/javascript">

    var test = [];
    function remove_btn(i) {
        var removeId = $('#removeBlockBtn'+i).attr('removeBlockId');
        test.push(removeId);
        $('#removeId').val(test);
        $('.blockDiv_'+i).remove();
        var totalblock = $('#total_block').val();
        var newCount = totalblock - 1 ;
        $('#total_block').val(newCount);

    }

        $(".blockType").on('change',function(){

           var blockType =  $(this).val();
            if(blockType == 2) {

                $('.rangeDiv').hide();
                toRange();
                return false;
            } else {

                var html = ' <div class="row mb-8 rangeDiv">'+
               ' <div class="col-xl-3">'+
               '     <div class="fs-6 fw-bold mt-2 mb-3 required">Range</div>'+
                '</div>'+
               ' <div class="col-xl-9 fv-row fv-plugins-icon-container">'+
               '     <div class="d-flex from-to-wrap">'+
               '         <div>'+
               '             <label for="">From</label>'+
                '<select class="form-control form-control-solid fromTo" name="from" id="from" onchange="changeFromTo()">   <option value="">Select Range From</option>';

                for (var l = 65; l <= 90; l++) {
                    html += '<option value="'+String.fromCharCode(l)+'">' + String.fromCharCode(l) + '</option>';

                }

                html +=  ' </select>'+
                '        </div>'+
                '     </div><div class="fv-plugins-message-container invalid-feedback"></div></div>'+
                ' </div>';

                $('.blockTypeDiv').after( html);
                $('#from').trigger('change');
                return false;
            }
        });

        function toRange() {

            var rowCount = $('.PrintDiv div.blockDiv').length;
            var total_block = $("#total_block").val();

            var from = $("#from").val();

            if(typeof(from)  === "undefined" || from == ''){
                var nex = '';
                var curr = '';
            }
            //do this
            else{
                var nex = from.charCodeAt(0);
                var curr = String.fromCharCode(nex);
            }

            var blockType = $('#type_of_block').find(":selected").val();
            if(blockType == 1) {

                var removeId = [];
                $(document).find('.blockDiv .removeBlockBtn').each(function() {
                     var removeblockid = $(this).attr('removeblockid');

                    removeId.push(removeblockid);
                    $('#removeId').val(removeId);
                });
                    $('.blockDiv').remove();
                createBlockName(0, total_block, nex, curr);
                return false;
            }


            if(rowCount == 0) {
                var tdCount = total_block;
            }
            else if(total_block > rowCount ) {
                var tdCount = total_block - rowCount;
            }
            else if(total_block < rowCount ) {

                for($i = rowCount; $i >= total_block; $i--) {
                    var removeId = $('#removeBlockBtn'+$i).attr('removeBlockId');
                    test.push(removeId);
                    $('#removeId').val(test);
                    $('.blockDiv_'+$i).remove();
                }
            }

            createBlockName(rowCount, total_block,nex,curr);
    }

    function  createBlockName(rowCount, total_block, nex, curr) {
        for (var k = rowCount; k < total_block ; k++) {

            if(nex  !== "")
                curr = String.fromCharCode(nex++);

            $('.PrintDiv').append(`
                <div class="row mb-8 blockDiv blockDiv_${k}">
                <!--begin::Col-->
                    <div class="col-xl-3">
                        <div class="fs-6 fw-bold mt-2 mb-3 required">Block Name </div>
                    </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                  <input type="text" class="form-control form-control-solid block_name" placeholder="Enter Block Name" autofocus name="block_name[]" id="block_name${k}" value="${curr}" >
               <label class="inputerror" for="block_name" style="">  </label>

                </div>
                </div> `);
        }
    }


function changeFromTo(){
    var removeId = [];
    $(document).find('.blockDiv .removeBlockBtn').each(function() {
        var removeblockid = $(this).attr('removeblockid');

        removeId.push(removeblockid);
        $('#removeId').val(removeId);
    });
    $('.blockDiv').remove();
    $('#total_block').val('');
}
$(document).ready(function () {

    $('#create_button').on('click', function(event) {

        // adding rules for inputs with class 'comment'
        var test = 1;
        $(document).find('.block_name').each(function() {

            if($(this).val().trim() == '') {
             // update time range value already filled
                $(this).next('.inputerror').html('Please enter block');
                 test++;
            }
            else{
                $(this).next('.inputerror').html('');
            }
        });

        // prevent default submit action
        event.preventDefault();

        // test if form is valid
        if($('#blockForm').valid() && test == 1) { console.log(2);
           $( '#blockForm' ).submit();
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
