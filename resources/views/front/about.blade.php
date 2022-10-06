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
                            <div class="title">
                                <h2>{{ $aboutus['page'] }}</h2>
                                <span class="btn btn-2 border-0">Choosing Us</span>
                            </div>
                            <p class="pt-0">
                                {{ $aboutus['detail'] }}
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- investment -->

    <section class="investment management">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="investment-image">
                            <div>
                                <img src=" {{ asset('images/front/home')}}/img1.png" alt="" />
                            </div>
                            <div>
                                <div class="play-btn-wrap">
                                    <a href="#">
                                        <img src="{{ asset('images/front/home')}}/play.svg" alt="" />
                                    </a>
                                </div>
                                <img src="{{ asset('images/front/home')}}/img2.png" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="investment-wrap management-wrap">
                            <div class="title">
                                <span class="btn btn-2">{{ ucfirst( $aboutus['page']) }}</span>
                                <h2>Building Management</h2>
                                <div>
                                    @if (!empty($aboutus['page_details']))
                                    @foreach ($aboutus['page_details'] as $row)
                                        <div class="investment-inner">
                                            <div class="investment-icon-wrap">
                                                <img src=" {{ asset('images/heading').'/'. $row['heading_image']}} " alt="check">
                                            </div>
                                            <div>
                                                <p>
                                                    {{   $row['heading_detail']}}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Silwana Rentals -->

    <section class="owner-message rentals-sales features-projects p-100 our-projects overflow-hidden">
        <div class="container position-relative">
            <img src="{{ asset('images/front/home')}}/plan3.svg" class="our-amenities-plan img3" alt="">
            <img src="{{ asset('images/front/home')}}/plan4.svg" class="our-amenities-plan img4" alt="">
            @if (!empty($rental))
            <div class="row position-relative">
                <div class="col-lg-6"></div>
                <div class="col-lg-6 col-md-12">
                    <div class="title text-end">
                        <span class="btn btn-2">Silwana {{ $rental['page'] }}</span>
                        <h2>{{$rental['page']}}</h2>
                    </div>
                </div>
                <div class="col-lg-12 owner-message-wrap">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="owner-message-inner owner-image-wrap">
                                <img src="{{ asset('images/page').'/'. $rental['page_image']}} " alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="owner-message-inner position-relative">
                                @php $detail =  nl2br($rental['detail']);
                                $detail = explode('<br />', $detail);
                                @endphp
                                @foreach ($detail as $del)
                                    <p> {{ $del }} </p>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if (!empty($sales))
            <div class="row position-relative">
                <div class="col-lg-6"></div>
                <div class="col-lg-6 col-md-12">
                    <div class="title">
                        <span class="btn btn-2">Silwana  {{ $sales['page'] }}</span>
                        <h2> {{ $sales['page'] }}</h2>
                    </div>
                </div>
                <div class="col-lg-12 owner-message-wrap">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="owner-message-inner owner-image-wrap">
                                <img src="{{ asset('images/page').'/'. $sales['page_image']}}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="owner-message-inner position-relative">

                                @php $detail =  nl2br($sales['detail']);
                                $detail = explode('<br />', $detail);
                                @endphp
                                @foreach ($detail as $del)
                                    <p> {{ $del }} </p>
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
    <section class="investment management mission-vision">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="investment-image">
                            <div>
                                <img src="{{ asset('images/front/home')}}/img1.png" alt="" />
                            </div>
                        </div>
                    </div>
                    @if (!empty($mission))
                    <div class="col-lg-6">
                        <div class="investment-wrap management-wrap">
                            <div class="title">
                                <span class="btn btn-2">Silwana {{ $mission['page'] }}</span>
                                <h2>{{ $mission['page'] }}</h2>
                                <div>
                                    <div class="investment-inner">
                                        <div>
                                            @php $detail =  nl2br($mission['detail']);
                                            $detail = explode('<br />', $detail);
                                            @endphp
                                            @foreach ($detail as $del)
                                                <p> {{ $del }} </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="investment-image">
                            <div>
                                <img src="{{ asset('images/front/home')}}/img1.png" alt="" />
                            </div>
                        </div>
                    </div>
                    @if (!empty($vision))
                    <div class="col-lg-6">
                        <div class="investment-wrap management-wrap">
                            <div class="title">
                                <span class="btn btn-2">Silwana {{ $vision['page'] }}</span>
                                <h2>{{ $vision['page'] }}</h2>
                                <div>
                                    <div class="investment-inner">
                                        <div>
                                            @php $detail =  nl2br($vision['detail']);
                                            $detail = explode('<br />', $detail);
                                            @endphp
                                            @foreach ($detail as $del)
                                                <p> {{ $del }} </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>



</x-base>
