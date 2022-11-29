<x-base>
<x-banner title="Reset Password" page="Reset Password"></x-banner>

    <!-- register -->
    <section class="register-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="register-inner wow fadeInUp">
                        <div class="row justify-content-center">

                            <div class="col-lg-12">

                                <form method="POST" action="{{ route('reset-password') }}" id="resetPasswordForm">
                                    @csrf
                                    <div class="text-center">

                                        <h2>Reset Password</h2>
                                        <p> </p>
                                        @if (Session::has('error'))
                                            <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row mb-10">
                                                <!--begin::Icon-->

                                                <!--end::Icon-->
                                                <!--begin::Content-->
                                                <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                                    <span>{!! Session::get('error') !!}</span>
                                                </div>
                                                <!--end::Content-->
                                                <!--begin::Close-->
                                                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                    <span class="svg-icon svg-icon-2x svg-icon-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
            </svg>
        </span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                                <!--end::Close-->
                                            </div>
                                        @endif
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input type="hidden" name="flag" value="front">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input required placeholder="Password" class="form-control error form-control-lg form-control-solid {{ $errors->has('password') ? 'bg-light-danger' : '' }}  @error('password') is-invalid @enderror" type="password" placeholder="" name="password" id="password" autocomplete="off" />

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input id="password-confirm" placeholder="Confirm Password"  required class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password_confirmation" autocomplete="off" />
                                                <span class="text-danger" id="emailIdErrorMsg"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 text-left">
                                            <button type="submit"  class="cmn-btn resetPasswordForm">Reset Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-base>

