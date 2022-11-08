<x-base>
<x-banner title="MEET OUR TEAM" page="Our Team"></x-banner>

    <!-- owner-message -->
    @if (!empty($ourTeam))
        @foreach($ourTeam as $owner)
            @if($owner['designation'] == 'group chairman' )
                <section class="owner-message features-projects p-100 our-projects overflow-hidden">
                    <div class="container position-relative">
                    <img src="{{ asset('images/front/home/plan3.svg') }} " class="our-amenities-plan img3" alt="">
                    <img src="{{ asset('images/front/home/plan4.svg') }}" class="our-amenities-plan img4" alt="">
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">
                            <div class="title">
                                <span class="btn btn-2">CHAIRMAN'S MESSAGE</span>
                                <h2>{{ $owner['name']}} </h2>
                                <h6>{{ $owner['designation']}} </h6>
                            </div>
                        </div>
                        <div class="col-lg-12 owner-message-wrap">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="owner-message-inner owner-image-wrap">
                                        <img src="{{ asset('images/ourTeam').'/'. $owner['image']}} " alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="owner-message-inner">
                                        <p> {{   $owner['detail']}}  </p>
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
        @endforeach
    @endif
    <!-- our-team -->
    <section class="our-team p-100 pt-0">
        <div class="container position-relative">
            <img src="{{ asset('images/front/about/plan1.svg') }}" class="our-amenities-plan img7" alt="">
            <img src="{{ asset('images/front/about/plan2.svg') }}" class="our-amenities-plan img8" alt="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <span class="btn btn-2">Team</span>
                        <h2>OUR TEAM</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="our-team-wrap">

                        @if (!empty($ourTeam))
                            @php $i=0; @endphp
                            @foreach($ourTeam as $row)
                                @if($row['designation'] != 'group chairman' )
                                    <div class="our-team-inner">
                                        @if($i <= 2)
                                        <div class="our-team-image-wrap">
                                            <img src="{{ asset('images/ourTeam').'/'. $row['image']}}" alt="team" />
                                        </div>

                                        <div class="our-team-content">
                                            <h4>{{ $row['name']}}</h4>
                                            <h6>{{ $row['designation']}}</h6>
                                            <p>
                                                {{ $row['detail'] }}
                                            </p>
                                            <div class="our-team-quotes text-center">
                                                <img src="{{ asset('images/front/about/quotes.svg') }}" alt="">
                                            </div>
                                        </div>
                                        @elseif( $i >=  2)
                                            <div class="our-team-content">
                                                <h4>{{ $row['name']}}</h4>
                                                <h6>{{ $row['designation']}}</h6>
                                                <p>
                                                    {{ $row['detail'] }}
                                                </p>
                                                <div class="our-team-quotes text-center">
                                                    <img src="{{ asset('images/front/about/quotes.svg') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="our-team-image-wrap">
                                                <img src="{{ asset('images/ourTeam').'/'. $row['image']}}" alt="team" />
                                            </div>
                                        @endif
                                    </div>

                                @endif
                                    @php $i++;
                                       if( $i >  4)
                                            $i= 0 ;
                                    @endphp
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>


</x-base>
