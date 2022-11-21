<x-base>
<x-banner title="Sales" page="Sales"></x-banner>


    @if(!empty($investmentData))
        <!-- about us -->
        <section class="about-us about-silwana">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-us-wrap">
                            <div class="about-us-img">
                                <img src="{{asset('images/businessServices').'/'.$investmentData->image}}" alt="about-us" />
                            </div>
                            <div class="about-us-wrapper">
                                <div class="title wow fadeInLeft">
                                    <h2>{{$investmentData->title}}</h2>
                                    <span class="btn btn-2 border-0">{{$investmentData->sub_title}}</span>
                                </div>

                                @php $detail =  nl2br($investmentData->detail);
                                            $detail = explode('<br />', $detail);
                                @endphp
                                @foreach ($detail as $del)
                                    <p class="pt-0"> {{$del}} </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(!empty($buildingData))
    <!-- investment -->
    <section class="investment management">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="investment-image">
                            <div>

                                <img src="{{asset('images/businessServices').'/'.$buildingData->image_title}}" class="wow fadeInRight" alt="" />
                            </div>
                            <div>
                                @if(!empty($buildingData->video_title) && file_exists(public_path('images/businessServices/video/').'/'. $buildingData->video_title) )
                                    <video class="wow fadeInLeft" controls="" src=" {{ !empty($buildingData->video_title) ? asset('images/businessServices/video/').'/'. $buildingData->video_title :'' }}" width="120" height="120"></video>
                                @else
                                    <img src="{{ asset('images/front/home/img2.png') }} "  class="wow fadeInLeft" alt="">
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="investment-wrap management-wrap">
                            <div class="title">
                                <span class="btn btn-2">{{ $buildingData->title }}</span>
                                <h2>{{ $buildingData->name }}</h2>
                                <div>
                                    @if(!empty($buildingData->detail))
                                        @php
                                            $details = json_decode( $buildingData->detail );


                                        @endphp
                                        @foreach($details as $row)
                                            <div class="investment-inner">
                                                <div class="investment-icon-wrap">
                                                    <img src="{{ asset('images/front/check.svg') }}" alt="check">
                                                </div>
                                                <div>
                                                    <p>
                                                         {{$row}}
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
    @endif
    <!-- owner-message -->
    <section class="owner-message rentals-sales features-projects p-100 our-projects overflow-hidden">
        <div class="container position-relative">
            <img src="{{ asset('images/front/home/plan3.svg') }}" class="our-amenities-plan img3" alt="">
            <img src="{{ asset('images/front/home/plan4.svg') }}" class="our-amenities-plan img4" alt="">
            @if(!empty($rentalData))
                <div class="row position-relative">
                <div class="col-lg-6"></div>
                <div class="col-lg-6 col-md-12">
                    <div class="title text-end">
                        <span class="btn btn-2">{{$rentalData->title}}</span>
                        <h2>{{$rentalData->name}}</h2>
                    </div>
                </div>
                <div class="col-lg-12 owner-message-wrap">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="owner-message-inner owner-image-wrap">
                                <img class="wow fadeInRight" src="{{asset('images/businessServices').'/'.$rentalData->image}}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="owner-message-inner position-relative">
                                @php $detail =  nl2br($rentalData->detail);
                                            $detail = explode('<br />', $detail);
                                @endphp
                                @foreach ($detail as $del)
                                    <p class="pt-0"> {{ $del }} </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(!empty($salesData))
                <div class="row position-relative">
                <div class="col-lg-6"></div>
                <div class="col-lg-6 col-md-12">
                    <div class="title">
                        <span class="btn btn-2">{{$salesData->title}}</span>
                        <h2>{{$salesData->name}}</h2>
                    </div>
                </div>
                <div class="col-lg-12 owner-message-wrap">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="owner-message-inner owner-image-wrap">
                                <img class="wow fadeInLeft" src="{{asset('images/businessServices').'/'.$salesData->image}}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="owner-message-inner position-relative">
                                @php $detail =  nl2br($salesData->detail);
                                            $detail = explode('<br />', $detail);
                                @endphp
                                @foreach ($detail as $del)
                                    <p > {{ $del }} </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>



    <!-- investment
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
 -->


</x-base>
