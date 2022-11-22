
<div>
    <!-- looking-for-house -->

    @php
        $footerData = getFooterData();
        $contactUs  = getContactUsDetail();
    @endphp

    <section class="looking-for-house">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if(!empty($footerData))
                        <div class="looking-for-house-wrap">
                            <div class="looking-for-house-img">
                                <img src="{{ asset('images/footer').'/'. $footerData['image']}}" alt="">
                            </div>
                            <div class="row looking-for-house-text">
                                <div class="col-lg-5">
                                    <div>
                                        <img src="{{asset('images/front')}}/logo2.svg" class="logo-2" alt="">
                                        <p> {{ $footerData['detail'] }} </p>
                                    </div>
                                </div>

                                <div class="col-lg-7">
                                    <div class="looking-for-house-inner">
                                        <h2>{{$footerData['title']}}</h2>
                                        <p>{{$footerData['notes']}}</p>
                                        <a href="{{ route('ourProject') }}" class="cmn-btn">EXPLORE PROPERTIES</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="looking-for-house-wrap">
                            <div class="looking-for-house-img" style="height: 160px;">    </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


    <footer class="position-relative overflow-hidden p-100">
        <!--  <img src="{{asset('images/front')}}/building1.svg" class="position-absolute footer-building-img img9" alt="">
        <img src="{{asset('images/front')}}/building1.svg" class="position-absolute footer-building-img img10" alt="">
       <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul>

                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About us</a></li>
                        <li><a href="{{ route('ourProject') }}">Our Project</a></li>
                        <li> <a href="{{ route('sales') }}">  Sales</a>   </li>
                        @if (Auth::guard('front')->check())
                            <li><a href="{{ route('myBooking') }}">My Booking</a></li>
                        @endif
                        <li><a href="{{ route('contactUs') }}">Contact us</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="footer-title text-center">
                        <h4 class="wtext">Follow Us On</h4>
                        <div class="social-links">
                            @if(!empty($footerData))
                                @php
                                    $social_media_data = json_decode( $footerData['social_media_data']  );
                                @endphp
                                @if(!empty($social_media_data))
                                    @foreach($social_media_data as $row)
                                         <a href="{{!empty($row->link) ? $row->link : '#' }}" target="_blank" ><img src="{{asset('images/footer').'/'.$row->icon}} " alt=""></a>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="footer-info">
                        <h5>INQUIRY</h5>
                        <div class="alert alert-success" role="alert" id="successInqMsg" style="display: none" >
                            Thank you for getting in touch! We will connect you soon!
                        </div>
                        <form id="inquiryFormFooter" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-4">
                                        <input type="text" class="form-control inquiryText" name="first_name" id="firstname" placeholder="First Name">
                                        <span class="text-danger" id="fnameErrorMsg"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-4">
                                        <input type="text" class="form-control inquiryText" name="last_name" id="lastname" placeholder="Last Name">
                                        <span class="text-danger" id="lnameErrorMsg"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-4">
                                        <input type="email" class="form-control inquiryText" name="email_id" id="emailid" placeholder="Email">
                                        <span class="text-danger" id="emailIdErrorMsg"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-4">
                                        <input type="text" class="form-control inquiryText " name="phone_no" id="phone" placeholder="Mobile Number">
                                        <span class="text-danger" id="phoneNoErrorMsg"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <textarea name="message" id="message" cols="." rows="1" class="form-control inquiryText" placeholder="Message"></textarea>
                                        <span class="text-danger" id="messageErrorMsg"></span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="submitInquiryBtn" class="cmn-btn submitInquiryForm">SEND MESSAGE</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-info usefull-links-main">
                        <h5>Usefull Links</h5>
                        <ul>
                            <li><a href="{{ route('ourProject') }}">Our Project</a></li>
                            @if (Auth::guard('front')->check())
                                <li><a href="{{ route('myBooking') }}">My Booking</a></li>
                            @endif
                            <li><a href="{{ route('about') }}">About us</a></li>
                            <li> <a href="{{ route('newsMedia') }}">  News & Media</a>   </li>
                            <li><a href="{{ route('aboutusFaq') }}">FAQs</a></li>
                            <li><a href="{{ route('contactUs') }}">Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-info">
                        <h5>SUPPORT</h5>
                        <ul class="support-wrap">
                            @if (!empty($contactUs))
                                @php $i=0; @endphp
                                @foreach($contactUs as $row)

                                    <li>
                                        <div>
                                            <img src="{{ asset('images/contactus').'/'. $row['image'] }}" alt="">
                                        </div>
                                        <a href="#"> {{ $row['notes'] }}</a>
                                    </li>

                                    @php $i++; @endphp
                                @endforeach
                            @endif

                                <div>
                                    <div class="footer-title text-center">
                                        <div class="social-links">
                                            @if(!empty($footerData))
                                                @php
                                                    $social_media_data = json_decode( $footerData['social_media_data']  );
                                                @endphp
                                                @if(!empty($social_media_data))
                                                    @foreach($social_media_data as $row)
                                                        <a  class="m-0 me-3" href="{{!empty($row->link) ? $row->link : '#' }}" target="_blank" ><img src="{{asset('images/footer').'/'.$row->icon}} " alt=""></a>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- copyright -->
    <section class="copyright">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="copy-wrapper text-center">
                        <p>© Copyright {{date('Y')}} Silwana real estate development. All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@section('scripts')
    <script   src="{{ asset('js/front/custom/inquiry') }}/inquiry.js"> </script>
@endsection
