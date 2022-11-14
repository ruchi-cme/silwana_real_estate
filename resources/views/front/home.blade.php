<x-base>
    <section class="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content">
                            <h1>FIND YOUR DREAM HOUSE BY US</h1>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner-form">
                        <h2>LEAVE YOUR INTEREST</h2>
                        <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                            Thank you for getting in touch! We will connect you soon!
                        </div>
                        <form id="inquiryForm" >
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group">
                                <input type="text" class="form-control inquiryText" name="first_name" id="first_name" placeholder="First Name">
                                <span class="text-danger" id="fnameErrorMsg"></span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control inquiryText" name="last_name" id="last_name" placeholder="Last Name">
                                <span class="text-danger" id="lnameErrorMsg"></span>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control inquiryText" name="email_id" id="email_id" placeholder="Email">
                                <span class="text-danger" id="emailIdErrorMsg"></span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control inquiryText " name="phone_no" id="phone_no" placeholder="Mobile Number">
                                <span class="text-danger" id="phoneNoErrorMsg"></span>
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Message" name="message" id="message" cols="15" rows="3" class="form-control inquiryText"></textarea>
                                <span class="text-danger" id="messageErrorMsg"></span>
                            </div>
                            <div class="form-group mb-0">
                                <input type="submit" class="cmn-btn submitInquiry" value="INQUIRY NOW">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- banner -->

    <!-- about us -->
    @if (!empty($aboutus))
    <section class="about-us p-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <a href="{{ route('about') }}"> <span class="btn btn-2">About Us</span> </a>
                        <h2>{{$aboutus['name']}}</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="about-us-wrap">
                        <div class="about-us-img">
                            <img src="{{ asset('images/aboutUs').'/'. $aboutus['image']}}" alt="about-us" />
                        </div>
                            <div class="about-us-wrapper">
                                <p class="comment more" showChar="400">   {{$aboutus['detail'] }} </p>
                                <div class="about-us-main">

                                    @php
                                       $subtitle = json_decode($aboutus['sub_title']);
                                    @endphp
                                    @foreach ($subtitle as $row)

                                    <div class="about-us-detail">
                                        <div class="about-us-lists">
                                            <div class="about-us-lists-inner">
                                                <img src="{{ asset('images/front/about/home-icon.svg')  }}" alt="about-list" />
                                            </div>
                                            <h6> {{$row }}</h6>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- investment -->

    @if (!empty($investment))
    <section class="cmn-bg investment">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="investment-image">
                            <div>
                                <img src="{{ asset('images/investmentHome/image/').'/'. $investment->image_title }}" alt="" />
                            </div>
                            <div>
                                @if(!empty($investment->video_title) && file_exists(public_path('images/investmentHome/video/').'/'. $investment->video_title) )
                                <video controls="" src=" {{ !empty($investment->video_title) ? asset('images/investmentHome/video/').'/'. $investment->video_title :'' }}" width="120" height="120"></video>
                                @else
                                    <img src="{{ asset('images/front/home/img2.png') }} " alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="investment-wrap">
                            <div class="title">
                                <span class="btn btn-2">{{$investment->title }}</span>
                                <h2>{{$investment->name }}</h2>
                                <p class="comment more" showChar="500">  {{$investment->detail }}  </p>
                                <div>
                                    @php
                                        $sub_titles = json_decode( $investment->sub_title );
                                        $i = 1;
                                    @endphp
                                    @foreach ($sub_titles as $row)
                                    <div class="investment-inner">
                                        <div class="investment-icon-wrap">
                                            <img src="{{ asset('images/investmentHome/icon/').'/'. $row->icon }}" alt="icon5">
                                        </div>
                                        <div>
                                            <h6>{{$row->sub_title }}</h6>
                                            <p class="comment more" showChar="100"> {{$row->sub_title_detail }}  </p>

                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- property-by-categories -->
    @if(!empty($categories))
    <section class="property-by-categories p-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <a href="{{ URL('ourProject') }}"> <span class="btn btn-2">Property</span></a>

                        <h2>Property By Categories</h2>
                    </div>
                </div>

                @php
                    $i = 0
                @endphp
                @foreach($categories as $cat)
                    @php
                        $css = 'col-xl-4';
                    @endphp
                    @if ($i== 0)
                        @php
                            $css = 'col-xl-8';
                        @endphp
                    @endif
                <div class="{{$css}} col-lg-6">
                    <div class="property-by-categories-wrap">
                        <img src="{{ asset('images/category').'/'. $cat['category_image']}}" alt="">
                        <div class="property-by-categories-detail">
                            <div>
                                <h3>{{$cat['category_name']}}</h3>
                                <a href="{{ URL('ourProject/category/'.encrypt($cat['category_id'])) }}" class="cmn-btn">GREATE DEAL AVAILABLE</a>
                            </div>
                        </div>
                    </div>
                </div>
                    @php
                        $i++;
                    @endphp
                @endforeach

            </div>
        </div>
    </section>
    @endif

    <!-- property-plan -->
        <!--  <section class="property-plan p-100 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <span class="btn btn-2">Plan Sketch</span>
                        <h2>property plan</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="property-wrap">
                        <ul class="nav nav-tabs justify-content-between border-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#penthouse">Penthouse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#top-garden">Top Garden</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#apartment">Apartment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#offices">Offices</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="penthouse" class="container tab-pane active"><br>
                                <div class="row align-items-center">
                                    <div class="col-lg-7">
                                        <div class="property-inner-wrap property-img-wrap">
                                            <img src="{{asset('images/front/home')}}/tab1.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="property-inner-wrap">
                                            <h4>Penthouse</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur elita dipiscing elit, sed do eiusmod </p>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <p>TOTAL AREA</p>
                                                        <p>2800 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BEDROOM</p>
                                                        <p>150 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BATHROOM</p>
                                                        <p>45 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BELCONY/PETS</p>
                                                        <p>Allowed</p>
                                                    </li>
                                                    <li>
                                                        <p>LOUNGE</p>
                                                        <p>650 Sq. Ft</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div>
                                                <a href="" class="cmn-btn">DOWNLOAD PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="top-garden" class="container tab-pane fade"><br>
                                <div class="row align-items-center">
                                    <div class="col-lg-7">
                                        <div class="property-inner-wrap property-img-wrap">
                                            <img src="{{asset('images/front/home')}}/tab1.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="property-inner-wrap">
                                            <h4>Penthouse</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur elita dipiscing elit, sed do eiusmod </p>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <p>TOTAL AREA</p>
                                                        <p>2800 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BEDROOM</p>
                                                        <p>150 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BATHROOM</p>
                                                        <p>45 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BELCONY/PETS</p>
                                                        <p>Allowed</p>
                                                    </li>
                                                    <li>
                                                        <p>LOUNGE</p>
                                                        <p>650 Sq. Ft</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div>
                                                <a href="" class="cmn-btn">DOWNLOAD PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="apartment" class="container tab-pane fade"><br>
                                <div class="row align-items-center">
                                    <div class="col-lg-7">
                                        <div class="property-inner-wrap property-img-wrap">
                                            <img src="{{asset('images/front/home')}}/tab1.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="property-inner-wrap">
                                            <h4>Penthouse</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur elita dipiscing elit, sed do eiusmod </p>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <p>TOTAL AREA</p>
                                                        <p>2800 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BEDROOM</p>
                                                        <p>150 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BATHROOM</p>
                                                        <p>45 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BELCONY/PETS</p>
                                                        <p>Allowed</p>
                                                    </li>
                                                    <li>
                                                        <p>LOUNGE</p>
                                                        <p>650 Sq. Ft</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div>
                                                <a href="" class="cmn-btn">DOWNLOAD PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="offices" class="container tab-pane fade"><br>
                                <div class="row align-items-center">
                                    <div class="col-lg-7">
                                        <div class="property-inner-wrap property-img-wrap">
                                            <img src="{{asset('images/front/home')}}/tab1.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="property-inner-wrap">
                                            <h4>Penthouse</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur elita dipiscing elit, sed do eiusmod </p>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <p>TOTAL AREA</p>
                                                        <p>2800 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BEDROOM</p>
                                                        <p>150 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BATHROOM</p>
                                                        <p>45 Sq. Ft</p>
                                                    </li>
                                                    <li>
                                                        <p>BELCONY/PETS</p>
                                                        <p>Allowed</p>
                                                    </li>
                                                    <li>
                                                        <p>LOUNGE</p>
                                                        <p>650 Sq. Ft</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div>
                                                <a href="" class="cmn-btn">DOWNLOAD PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 -->
    <!-- our-projects -->

    <section class="our-projects p-100 pb-0 cmn-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    @if(!empty($ourProject))
                    <div class="title">
                        <span class="btn btn-2">{{ $ourProject['title'] }}</span>
                        <h2>{{ $ourProject['name'] }}</h2>
                        <p class="comment more" showChar="200">  {{ $ourProject['detail'] }} </p>
                    </div>
                    @endif
                </div>

                @for($i=0; count($ourProjectList) > $i; $i++)
                    @php  $proImg =  getProjectImage($ourProjectList[$i]['project_id'],'single');

                    @endphp

                @if($i == 0 || $i == 3)
                        <div class="col-xl-6 col-lg-6">
                            <div class="our-projects-wrap position-relative">
                                <img src="{{ !empty($proImg['title']) ? asset("images/project/images/".$proImg['title'])  :  asset("images/front/home/feature1.png" ) }}" alt="">
                                <div class="our-projects-inner">
                                    <p>{{ $ourProjectList[$i]['project_name'] }}</p>
                                </div>
                                <div class="inquiry-now-wrap">
                                    <a href="{{route('contactUs')}}" class="cmn-btn">INQUIRY Now</a>
                                </div>
                            </div>
                        </div>
                    @elseif($i >= 4)
                        @break
                    @else
                        <div class="col-xl-3 col-lg-6">
                            <div class="our-projects-wrap our-projects-wrap-main position-relative">
                                <img src="{{ !empty($proImg['title']) ? asset("images/project/images/".$proImg['title'])  :  asset("images/front/home/feature1.png" ) }}" alt="">
                                <div class="our-projects-inner">
                                    <p>{{ $ourProjectList[$i]['project_name'] }}</p>
                                </div>
                                <div class="inquiry-now-wrap">
                                    <a href="{{route('contactUs')}}" class="cmn-btn">INQUIRY Now</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor


            </div>
        </div>
    </section>

    <!-- our-amenities -->
    @if (!empty($amenities))
    <section class="our-amenities p-100 position-relative overflow-hidden">
        <img src="{{asset('images/front/home')}}/plan1.svg" class="our-amenities-plan img1" alt="">
        <img src="{{asset('images/front/home')}}/plan2.svg" class="our-amenities-plan img2" alt="">
        <div class="container">
            <div class="row">
                <div class="title text-center">
                    <span class="btn btn-2">Amenities</span>
                    <h2>Our Amenities</h2>
                </div>
                @foreach($amenities as $aminity)
                    @php $countProject = getCountAmenityProject($aminity['amenities_id']); @endphp
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="our-amenities-wrap text-center">
                        <div class="our-amenities-img">
                            <img src="{{ asset('images/amenities').'/'.$aminity['amenity_image']}}" alt="">
                        </div>
                        <h6>{{$aminity['amenity_name']}}</h6>
                        <p>{{$countProject}} Properties</p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    @endif

    <!-- Property on sales -->
   <!-- <section class="property-on-sales p-100 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <span class="btn btn-2">Sales</span>
                        <h2>Property on sales</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme sale-property-slider">
                        <div class="item">
                            <div class="property-sale-wrap">
                                <div class="property-sale-img-wrap">
                                    <img src="{{asset('images/front/home')}}/decore.png" alt="decore" />
                                </div>
                                <div class="property-detail-wrap position-relative">
                                    <div class="property-main-detail">
                                        <div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                        </div>
                                    </div>
                                    <h4>AED 12,500,000</h4>
                                    <h6>Furnished | 4 BR + Maids| Sea View</h6>
                                    <p>5137 Compton Ave, Los Angeles</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="property-sale-wrap">
                                <div class="property-sale-img-wrap">
                                    <img src="{{asset('images/front/home')}}/decore.png" alt="decore" />
                                </div>
                                <div class="property-detail-wrap position-relative">
                                    <div class="property-main-detail">
                                        <div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                        </div>
                                    </div>
                                    <h4>AED 12,500,000</h4>
                                    <h6>Furnished | 4 BR + Maids| Sea View</h6>
                                    <p>5137 Compton Ave, Los Angeles</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="property-sale-wrap">
                                <div class="property-sale-img-wrap">
                                    <img src="{{asset('images/front/home')}}/decore.png" alt="decore" />
                                </div>
                                <div class="property-detail-wrap position-relative">
                                    <div class="property-main-detail">
                                        <div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                        </div>
                                    </div>
                                    <h4>AED 12,500,000</h4>
                                    <h6>Furnished | 4 BR + Maids| Sea View</h6>
                                    <p>5137 Compton Ave, Los Angeles</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="property-sale-wrap">
                                <div class="property-sale-img-wrap">
                                    <img src="{{asset('images/front/home')}}/decore.png" alt="decore" />
                                </div>
                                <div class="property-detail-wrap position-relative">
                                    <div class="property-main-detail">
                                        <div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{asset('images/front/home')}}/bed2.svg" alt="">
                                                    </div>
                                                    <p>3</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                        </div>
                                    </div>
                                    <h4>AED 12,500,000</h4>
                                    <h6>Furnished | 4 BR + Maids| Sea View</h6>
                                    <p>5137 Compton Ave, Los Angeles</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
-->
    <!-- features Projects -->
    <section class="features-projects p-100 our-projects overflow-hidden">
        <div class="container position-relative">
            <img src="{{asset('images/front/home')}}/plan3.svg" class="our-amenities-plan img3" alt="">
            <img src="{{asset('images/front/home')}}/plan4.svg" class="our-amenities-plan img4" alt="">
            <div class="row">
                <div class="col-lg-6">
                    @if(!empty($featureProject))
                        <div class="title">
                            <span class="btn btn-2">{{ $featureProject['title'] }}</span>
                                <h2>{{ $featureProject['name'] }}</h2>
                                <p class="comment more" showChar="400">  {{ $featureProject['detail'] }} </p>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme project-feature">
                        @if(!empty($featureProjectList))
                            @foreach($featureProjectList as $featurePro)
                                @php  $proImg =  getProjectImage($featurePro['project_id'],'single') @endphp

                                <div class="item">
                                    <div class="project-feature-wrap">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="project-feature-img">
                                                    <img src="{{ !empty($proImg['title']) ? asset("images/project/images/".$proImg['title'])  :  asset("images/front/home/feature1.png" ) }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="upcoming-projects-wrap">
                                                    <h4>upcoming projects</h4>
                                                    <h2> {{ $featurePro['project_name'] }}</h2>
                                                    <h6> {{ $featurePro['address'] }}</h6>
                                                    @php
                                                        $string    = $featurePro['project_detail'];

                                                    @endphp
                                                    <p>   {{ substr($string,0,550) }}
                                                        @if (strlen(strip_tags($string)) > 550)
                                                             <a href="{{ URL('projectDetail/'.encrypt($featurePro['project_id'])) }}"  >...</a>
                                                        @endif</p>
                                                    <div class="upcoming-project-detail-lists property-main-detail">

                                                        <div class="position-static">
                                                            <div class="property-main-total-detail">
                                                                <div class="property-main-total">
                                                                    <p> {{ $featurePro['category_name'] }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h3 > </h3>

                                                    @php
                                                        $pdf = getProjectPdf($featurePro['project_id']);
                                                         $imagePDFile  = '';
                                                        if(!empty($pdf))
                                                            $imagePDFile  =  !empty($pdf['title'] ) ? asset('images/project/pdf/').'/'.$pdf['title'] : ''

                                                    @endphp
                                                    <a   {{ !empty($imagePDFile) ? 'download' :'' }}  href="{{ $imagePDFile }}"   class="downloadBrochuretest cmn-btn">DOWNLOAD BROCHURE</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>
@section('scripts')
    <script   src="{{ asset('js/front/custom/inquiry') }}/inquiry.js"> </script>
    <script>
        $('.downloadBrochuretest').on('click', function () {

            if ($(this).attr('href').length < 1 || $(this).attr('href') == 'javascript:void(0)'){
                $(this).attr('href','javascript:void(0)');
                 alert('No Pdf of this project!');
            }
        });
    </script>
@endsection

</x-base>
