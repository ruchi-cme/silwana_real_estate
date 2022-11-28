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

            <form method="POST" action="{{ route('reset-password') }}" id="resetPasswordForm">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <!--begin::Heading-->
                <div class="mb-10 text-center">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">Reset Password</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Input group-->
                <div class="row fv-row mb-7">
                    @include('layouts.alerts.alert')
                    <!--begin::Col-->
                    <div class="col-xl-12">
                        <label class="form-label required fw-bolder text-dark fs-6">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-10 fv-row" data-kt-password-meter="true">
                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Label-->
                        <label class="form-label fw-bolder text-dark fs-6 required">Password</label>
                        <!--end::Label-->
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input required class="form-control error form-control-lg form-control-solid {{ $errors->has('password') ? 'bg-light-danger' : '' }}  @error('password') is-invalid @enderror" type="password" placeholder="" name="password" autocomplete="off" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                            <i class="bi bi-eye-slash fs-2"></i>
                            <i class="bi bi-eye fs-2 d-none"></i>
                        </span>
                        </div>
                        <!--end::Input wrapper-->
                        <!--begin::Meter-->
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                        <!--end::Meter-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Hint-->
                    <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
                    <!--end::Hint-->
                </div>
                <!--end::Input group=-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
                    <input id="password-confirm" required class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password_confirmation" autocomplete="off" />
                </div>
                <!--end::Input group-->


                <!--begin::Actions-->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
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

            $("#resetPasswordForm").validate({
                ignore: '',
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    "password":"required"
                },
            });


        });
        // focus on search input in select 2 -------------------------------------------------------------------
    </script>

@endpush
