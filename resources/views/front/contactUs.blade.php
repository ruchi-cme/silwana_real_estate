<x-base>
<x-banner title="Contact Us" page="Contact Us"></x-banner>

    <!-- register -->
    <section class="register-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="register-inner wow fadeInUp">
                        <div class="row justify-content-center">

                            @if (!empty($contactUs))
                                @php $i=0; @endphp
                                @foreach($contactUs as $row)
                                    @if( $i > 2)
                                        @break
                                    @endif
                                    <div class="col-xl-4 col-lg-6">
                                        <div class="talk-to-sales text-center">
                                            <div class="talk-to-sale-img">
                                                <img src="{{ asset('images/contactus').'/'. $row['image'] }}" alt="">
                                            </div>
                                            <h4> {{ $row['title'] }} </h4>
                                            <p> {{ $row['desc'] }} </p>
                                            <a href="javascript:void(0)">{{ $row['notes'] }}</a>
                                        </div>
                                    </div>
                                    @php $i++; @endphp
                                @endforeach
                            @endif

                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                                    Thank you for getting in touch! We will connect you soon!
                                </div>
                                <form id="inquiryForm" >
                                    @csrf
                                    <div class="text-center">

                                        <h2>Register your intrest</h2>
                                        <p> </p>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control inquiryText" name="first_name" id="first_name" placeholder="First Name">
                                                <span class="text-danger" id="fnameErrorMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control inquiryText" name="last_name" id="last_name" placeholder="Last Name">
                                                <span class="text-danger" id="lnameErrorMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control inquiryText" name="email_id" id="email_id" placeholder="Email">
                                                <span class="text-danger" id="emailIdErrorMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control inquiryText " name="phone_no" id="phone_no" placeholder="Mobile Number">
                                                <span class="text-danger" id="phoneNoErrorMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea name="message" id="message" cols="30" rows="6" class="form-control inquiryText" placeholder="Message"></textarea>
                                                <span class="text-danger" id="messageErrorMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-left">
                                            <button type="submit"  class="cmn-btn submitInquiry">Send Message</button>
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
    @section('scripts')
        <script   src="{{ asset('js/front/custom/inquiry') }}/inquiry.js"> </script>
    @endsection
</x-base>
