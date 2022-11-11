@extends('admin.layouts.main',['title' => 'Book Meeting'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.bookMeeting') }}">Book Meeting</a></li>
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

                <form class="form" method="POST" action=" {{ !empty( $editData->id) ?  route('admin.bookMeeting.update') : route('admin.bookMeeting.store') }}" id="dataForm" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Book Meeting</h2>
                            </div>
                            <!--begin::Card title-->
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">


                        <!--end::Row-->

                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3  "> User</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <select class="form-select form-select-solid form-select-lg"  name="user_id" id="user_id" data-placeholder="Select User" data-control="select2" >
                                    <option value="" >Select User</option>
                                    @if (!empty($user))
                                        @foreach ($user as $u)
                                            <option value="{{ $u->id }}" {{ !empty( $editData->user_id)  && ($editData->user_id ==   $u->id ) ? 'selected' : '' }}>{{ $u->name }}</option>
                                        @endforeach
                                    @endif
                                </select><div class="fv-plugins-message-container invalid-feedback"></div></div>
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
                                    <input type="text" required placeholder="Enter Name" class="form-control form-control-solid" name="name" id="name" value="{{ !empty( $editData->name) ? $editData->name : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Email</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Email" class="form-control form-control-solid" name="email" id="email" value="{{ !empty( $editData->email) ? $editData->email : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Phone</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Phone" class="form-control form-control-solid" name="phone" id="phone" value="{{ !empty( $editData->phone) ? $editData->phone : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Date</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" id='date' required placeholder="Enter Date" class="datepicker form-control form-control-solid" name="date"   value="{{ !empty( $editData->date) ? date('Y-m-d', strtotime($editData->date )) : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Time</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" required placeholder="Enter Time" class="form-control datepicker form-control-solid" name="time" id="timepick" value="{{ !empty( $editData->time) ? $editData->time : '' }}" >
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            @if(!empty($editData->status))
                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3"> Status</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->

                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <select class="form-select form-select-solid form-select-lg"  name="status" id="status" data-placeholder="Select Status" data-control="select2" >
                                        <option value="" >Select Status</option>

                                        @if (!empty($meetingStatus))
                                            @foreach ($meetingStatus as $key => $val)
                                                <option value="{{ $key }}" {{ !empty( $editData->status)  && ($editData->status ==  $key ) ? 'selected' : '' }}>{{ $val }}</option>
                                            @endforeach
                                        @endif
                                    </select><div class="fv-plugins-message-container invalid-feedback"></div></div>
                                </div>
                                  @endif
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


                                </div>
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
                                        <span class="indicator-label">{{ !empty( $editData->id) ?  'Update' : 'Create' }} Meeting</span>
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

            var date = new Date();
            date.setDate(date.getDate());

            $('#date').datepicker({
                startDate: date,
                format:"yyyy-m-d"
            });


            $('#timepick').datetimepicker({
                format: 'hh:mm:ss a'
            });

            $('#user_id').on("select2:select", function (e) {
                var user_id = this.value;
                getUserDetail(user_id);
            });

            function getUserDetail(user_id){
                $("#block_name").html('');
                $.ajax({
                    url: "{{ route('user.fetch') }}",
                    type: "GET",
                    data: {
                        user_id : user_id,
                    },
                    dataType: 'json',
                    success: function (result) {
                        var res = result.usersData;
                        $('#name').val(res.name);
                        $('#email').val(res.email);
                        $('#phone').val(res.phone);

                    }
                });
            }
            $("#dataForm").validate({
                ignore: '',
                rules: {
                    'name'   : 'required',
                    'date' : 'required',
                    'time' : 'required',
                    "detail" :  "required",
                    phone: {
                        required: true,
                        digits: true
                    },
                    email: {
                        required: true,
                        email: true,//add an email rule that will ensure the value entered is valid email id.
                        maxlength: 255,
                    },
                },
                messages: {
                    "name" : "Please enter name",
                    'date' : 'Please enter date',
                    'time' : 'Please enter time',
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
