@extends('auth.layouts.main')

@section('content')
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <!--begin::Logo-->
        <a href="../../demo1/dist/index.html" class="mb-12">
            <img alt="Logo" src="{{ asset('images/front/logo.svg') }}" class="h-100px" />
        </a>
        <!--end::Logo-->
        <!--begin::Wrapper-->
        <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Form-->

            <form id="fogotPassform" method="POST" action="{{ route('forget-password') }}">
                @csrf
                <!--begin::Heading-->
                <div class="mb-10 text-center">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">Reset Password</h1>
                    <!--end::Title-->
                    <!--begin::Link-->
                    <div class="text-gray-400 fw-bold fs-4">Already have an account?
                        <a href="{{ route('login') }}" class="link-primary fw-bolder">Sign in here</a></div>
                    <!--end::Link-->
                </div>
                <!--end::Heading-->
                <!--begin::Input group-->
                <div class="row fv-row mb-7">
                    @include('layouts.alerts.alert')
                    <!--begin::Col-->
                    <div class="col-xl-12">
                        <label class="form-label required fw-bolder text-dark fs-6">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control error @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                   </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->


                <!--begin::Actions-->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
@endsection
<style>
    .error {
        color: #FF0000;
    }
</style>
@push('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function (e) {

            $("#fogotPassform").validate({
                ignore: '',
                rules: {
                    email: {
                        required: true,
                        email: true
                    },

                },

            });


        });
 // focus on search input in select 2 -------------------------------------------------------------------
    </script>

@endpush
