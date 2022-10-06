<x-base>
<x-banner title="ABOUT SILWANA REAL ESTATE" page="About Us"></x-banner>

    <!-- about us -->
    @if (!empty($aboutus))
    <section class="about-us about-silwana">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-us-wrap">
                        <div class="about-us-img">
                            <img src="{{ asset('images/page').'/'. $aboutus['page_image']}}" alt="about-us" />
                        </div>
                        <div class="about-us-wrapper">
                            <p>  {{ $aboutus['detail'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- about silwana detail -->
    <section class="about-silwana-detail position-relative p-100 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-us-main">
                        @foreach ($aboutus['page_details'] as $row)

                        <div class="about-us-detail">
                            <div>
                                <div class="about-us-lists">
                                    <div class="about-us-lists-inner">
                                        <img src="{{ asset('images/heading').'/'. $row['heading_image']}}" alt="about-list" />
                                    </div>
                                    <h6>{{$row['heading']}}</h6>
                                </div>
                                <p>  {{ $row['heading_detail'] }} </p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- owner-message -->
    @if (!empty($owner_message))
    <section class="owner-message features-projects p-100 our-projects overflow-hidden">
        <div class="container position-relative">
            <img src="{{ asset('images/front/home/plan3.svg') }} " class="our-amenities-plan img3" alt="">
            <img src="{{ asset('images/front/home/plan4.svg') }}" class="our-amenities-plan img4" alt="">
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <div class="title">
                        <span class="btn btn-2">CHAIRMAN'S MESSAGE</span>
                        <h2>{{   $owner_message['page']}} </h2>
                        <h6>group chairman</h6>
                    </div>
                </div>
                <div class="col-lg-12 owner-message-wrap">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="owner-message-inner owner-image-wrap">
                                <img src="{{ asset('images/page').'/'. $owner_message['page_image']}} " alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="owner-message-inner">
                                <p> {{   $owner_message['detail']}}  </p>
                                <div>
                                    <img src="{{ asset('images/front/about/quotes.svg') }}" class="quotes-img" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- news-media -->
    <section class="news-media p-100 pt-0">
        <div class="container position-relative">
            <img src="./assets/images/about/plan1.svg" class="our-amenities-plan img7" alt="">
            <img src="./assets/images/about/plan2.svg" class="our-amenities-plan img8" alt="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <span class="btn btn-2">Property</span>
                        <h2>news & media</h2>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="news-media-wrap">
                        <div class="news-media-img-wrap">
                            <img src="./assets/images/about/media1.png" alt="" />
                        </div>
                        <div class="news-media-text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed labore ame tdoeiusmod</p>
                            <a href="#" class="cmn-btn">READ MORE <img src="./assets/images/about/arrow.svg" alt="" /></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="news-media-wrap">
                        <div class="news-media-img-wrap">
                            <img src="./assets/images/about/media1.png" alt="" />
                            <div>
                                <a href=""><img src="./assets/images/home/play-btn.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="news-media-text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed labore ame tdoeiusmod</p>
                            <a href="#" class="cmn-btn">READ MORE <img src="./assets/images/about/arrow.svg" alt="" /></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="news-media-wrap">
                        <div class="news-media-img-wrap">
                            <img src="./assets/images/about/media1.png" alt="" />
                            <div>
                                <a href=""><img src="./assets/images/home/play-btn.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="news-media-text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed labore ame tdoeiusmod</p>
                            <a href="#" class="cmn-btn">READ MORE <img src="./assets/images/about/arrow.svg" alt="" /></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="news-media-wrap">
                        <div class="news-media-img-wrap">
                            <img src="./assets/images/about/media1.png" alt="" />
                        </div>
                        <div class="news-media-text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed labore ame tdoeiusmod</p>
                            <a href="#" class="cmn-btn">READ MORE <img src="./assets/images/about/arrow.svg" alt="" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-base>
