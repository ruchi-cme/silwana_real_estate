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
                                <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                                    Thank you for getting in touch! We will connect you soon!
                                </div>
                                <form method="POST" action="{{ route('reset-password') }}" id="resetPasswordForm">
                                    @csrf
                                    <div class="text-center">

                                        <h2>Reset Password</h2>
                                        <p> </p>
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

