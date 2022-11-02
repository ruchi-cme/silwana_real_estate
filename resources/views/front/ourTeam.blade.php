<x-base>
<x-banner title="MEET OUR TEAM" page="Our Team"></x-banner>


    <!-- owner-message -->
    @if (!empty($ownermsg))
        <section class="owner-message features-projects p-100 our-projects overflow-hidden">
            <div class="container position-relative">
                <img src="{{ asset('images/front/home/plan3.svg') }} " class="our-amenities-plan img3" alt="">
                <img src="{{ asset('images/front/home/plan4.svg') }}" class="our-amenities-plan img4" alt="">
                <div class="row">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="title">
                            <span class="btn btn-2">CHAIRMAN'S MESSAGE</span>
                            <h2>{{   $ownermsg['page']}} </h2>
                            <h6>group chairman</h6>
                        </div>
                    </div>
                    <div class="col-lg-12 owner-message-wrap">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="owner-message-inner owner-image-wrap">
                                    <img src="{{ asset('images/page').'/'. $ownermsg['page_image']}} " alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="owner-message-inner">
                                    <p> {{   $ownermsg['detail']}}  </p>
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
                        <div class="our-team-inner">
                            <div class="our-team-image-wrap">
                                <img src="{{ asset('images/front/about/team.svg') }}" alt="team" />
                            </div>
                            <div class="our-team-content">
                                <h4>Sheikh Nasser Al Qasimi</h4>
                                <h6>Executive Director & Partner</h6>
                                <p>
                                    Lorem ipsum dolor sit amet, conse
                                    ctetur adipiscing elit, sed do eius
                                    mod Lorem ipsum dolor sit amet, conse ctetur adipiscing elit, sed do eius mod
                                </p>
                                <div class="our-team-quotes text-center">
                                    <img src="{{ asset('images/front/about/quotes.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="our-team-inner">
                            <div class="our-team-image-wrap">
                                <img src="{{ asset('images/front/about/team.svg') }}" alt="team" />
                            </div>
                            <div class="our-team-content">
                                <h4>Sheikh Nasser Al Qasimi</h4>
                                <h6>Executive Director & Partner</h6>
                                <p>
                                    Lorem ipsum dolor sit amet, conse
                                    ctetur adipiscing elit, sed do eius
                                    mod Lorem ipsum dolor sit amet, conse ctetur adipiscing elit, sed do eius mod
                                </p>
                                <div class="our-team-quotes text-center">
                                    <img src="{{ asset('images/front/about/quotes.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="our-team-inner">
                            <div class="our-team-content">
                                <h4>Sheikh Nasser Al Qasimi</h4>
                                <h6>Executive Director & Partner</h6>
                                <p>
                                    Lorem ipsum dolor sit amet, conse
                                    ctetur adipiscing elit, sed do eius
                                    mod Lorem ipsum dolor sit amet, conse ctetur adipiscing elit, sed do eius mod
                                </p>
                                <div class="our-team-quotes text-center">
                                    <img src="{{ asset('images/front/about/quotes.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="our-team-image-wrap">
                                <img src="{{ asset('images/front/about/team.svg') }}" alt="team" />
                            </div>
                        </div>
                        <div class="our-team-inner">
                            <div class="our-team-content">
                                <h4>Sheikh Nasser Al Qasimi</h4>
                                <h6>Executive Director & Partner</h6>
                                <p>
                                    Lorem ipsum dolor sit amet, conse
                                    ctetur adipiscing elit, sed do eius
                                    mod Lorem ipsum dolor sit amet, conse ctetur adipiscing elit, sed do eius mod
                                </p>
                                <div class="our-team-quotes text-center">
                                    <img src="{{ asset('images/front/about/quotes.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="our-team-image-wrap">
                                <img src="{{ asset('images/front/about/team.svg') }}" alt="team" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</x-base>
