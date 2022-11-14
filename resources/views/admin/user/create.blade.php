@extends('admin.layouts.main',['title' => 'User Management'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary text-muted" href="{{ route('admin.user') }}">User</a></li>
<li class="breadcrumb-item px-3 text-primary">Create</li>
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

                <form class="form" method="POST" action="{{ route('admin.user.store') }}" id="user_form">
                   @csrf

                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Login Credentials</h2>
                            </div>
                            <!--begin::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">

                            <div class="mt-3">
                                <label for="exampleFormControlInput1" class="required form-label fs-5 fw-bolder">User Name</label>
                                <input type="text" class="form-control form-control-solid" name="name" placeholder="User Name" required/>
                            </div>

                            <div class="mt-3">
                                <label for="exampleFormControlInput1" class="required form-label fs-5 fw-bolder">Email</label>
                                <input type="email" class="form-control form-control-solid" name="email" id="user_email" placeholder="Email" required/>
                                <label id="email-error" class="error" for="user_email"></label>
                            </div>

                            <div class="mt-3">
                                <label for="exampleFormControlInput1" class="required form-label fs-5 fw-bolder">Password</label>
                                <input type="password" class="form-control form-control-solid" name="password" placeholder="Password"/ required>
                            </div>

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
                                <h2 class="fw-bolder required">Select Role</h2>
                            </div>
                            <!--begin::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">

                            <div class="row">

                                <div class="col-md-12">
                                    <select class="form-select" aria-label="Select Role" required name="role">
                                        <option selected disabled>Select Role</option>
                                        @foreach ($roles as $role)
                                        <option value={{ $role->id }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>

                        </div>
                        <!--end::Card body-->
                        <div class="card-footer">
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <!--begin::Actions-->
                            <div class="mb-0 text-center">
                                <button type="submit" data-form="user_form" class="btn btn-primary" id="create_button">
                                    <!--begin::Indicator-->
                                    <span class="indicator-label">Create User</span>
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
    <script src="{{ asset('js/swal.js') }}" ></script>

    <script type="text/javascript">

        $("#user_form").validate({
            ignore: '',
            rules: {
                "name" :"required",
                "password" : "required",
                "role" :  "required",
                email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                "name" : "Please enter name",
                "password" :  "Please enter password",
                "role" : "Please select role",
                email: {
                    required: "Please enter email",
                }
            }
        });
        $('#create_button').on('click', function(event) {

            email = $('#user_email').val();
            checkEmail(email);
            // prevent default submit action
            event.preventDefault();

            // test if form is valid
            if($('#user_form').valid()  ) { console.log(2);
                $( '#user_form' ).submit();
            } else { console.log(3);
                console.log("does not validate");
                return false;
            }
        });

        $('#user_email').on('change', function(event) {

            let email = event.target.value;
            checkEmail(email);

        })
        function checkEmail(email){

                $.ajax({
                    url: "{{ route('admin.user.check.email') }}",
                    type: "GET",
                    data: {
                        'email': email,
                    },
                    success: function (data) {
                        console.log("data" + data);
                    },
                    error: function (request, err) {
                        console.log(request);
                        $('#email-error').css('display','block');
                        $('#email-error').html('Please provide unique email address');
                        return false;

                    }
                });
        }






    </script>
@endpush
