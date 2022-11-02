<div>
    <!-- looking-for-house -->

    @php $footerData = getSilwanaPages('footer');  @endphp

    <section class="looking-for-house">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if(!empty($footerData))
                        <div class="looking-for-house-wrap">
                            <div class="looking-for-house-img">
                                <img src="{{ asset('images/page').'/'. $footerData['page_image']}}" alt="">
                            </div>
                            <div class="row looking-for-house-text">
                                <div class="col-lg-5">
                                    <div>
                                        <img src="{{asset('images/front')}}/logo2.svg" class="logo-2" alt="">
                                        <p> {{ $footerData['detail'] }} </p>
                                    </div>
                                </div>

                                @foreach ($footerData['page_details'] as $row)

                                    <div class="col-lg-7">
                                        <div class="looking-for-house-inner">
                                            <h2>{{$row['heading']}}</h2>
                                            <p>{{$row['heading_detail']}}</p>
                                            <a href="{{ route('ourProject/ongoing') }}" class="cmn-btn">EXPLORE PROPERTIES</a>
                                        </div>
                                    </div>
                                @endforeach
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


    <footer class="position-relative overflow-hidden">
        <img src="{{asset('images/front')}}/building1.svg" class="position-absolute footer-building-img img9" alt="">
        <img src="{{asset('images/front')}}/building1.svg" class="position-absolute footer-building-img img10" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About us</a></li>
                        <li><a href="{{ route('propertyList') }}">Property on Sale</a></li>
                        <li><a href="{{ route('myBooking') }}">My Booking</a></li>
                        <li><a href="{{ route('contactUs') }}">Contact us</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="footer-title text-center">
                        <h4 class="wtext">Follow Us On</h4>
                        <div class="social-links">
                            <a href="#"><img src="{{asset('images/front')}}/insta.svg" alt=""></a>
                            <a href="#"><img src="{{asset('images/front')}}/twiter.svg" alt=""></a>
                            <a href="#"><img src="{{asset('images/front')}}/fb.svg" alt=""></a>
                        </div>
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
