<x-base>
    <x-banner title="Project Details" page="Project Details"></x-banner>
    @if ($projectList)
    <!-- property-detail-main -->
    <section class="property-detail-main portfolio-detail-main">
        <div class="container">
            <div class="row">
                @php $proImg =  getProjectImage($projectList['project_id']) ;  @endphp
                @if(!empty($proImg))
                    @for($i=0; count($proImg) > $i; $i++)
                        @switch( $i)
                            @case(0)
                                <div class="col-xl-8">
                                    <div class="property-detail-main-wrap-big video-wrapper">
                                        <img src="./assets/images/property-detail/image1.png" alt="">
                                    </div>
                                </div>

                                @break
                        <div class="col-xl-4 d-flex flex-column">
                            @case(1)
                                <div class="property-detail-main-wrap-small">
                                    <img src="./assets/images/property-detail/image1.png" alt="">
                                </div>
                                @break
                            @case(2)
                               <div class="property-detail-main-wrap-small">
                                    <img src="./assets/images/property-detail/image1.png" alt="">
                                </div>
                                @break
                        </div>
                            @default
                                <span>Something went wrong, please try again</span>
                        @endswitch


                    @endfor
                @endif






            </div>
        </div>
    </section>

    <section class="apartment-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="title">
                        <span class="btn btn-2">Apartment</span>
                        <h2>Diamond Manor Apartment</h2>
                        <h5><img src="./assets/images/location.svg" class="location-image" alt="location" />5137 Compton Ave, Los Angeles</h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut lab ore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris  nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut lab ore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris  nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                            Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut lab ore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris  nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                            Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut lab ore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris  nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                            Lorem ipsum dolor sit amet.
                        </p>
                    </div>
                    <div class="fact-features">
                        <div class="row">
                            <h4>Facts and Features</h4>
                            <div class="col-lg-4 col-md-6">
                                <div class="fact-features-wrap">
                                    <div class="fact-features-wrap-img">
                                        <img src="./assets/images/home/ome.svg" alt="">
                                    </div>
                                    <div>
                                        <h6>Living Room</h6>
                                        <p>20 X 16 sq feet</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="fact-features-wrap">
                                    <div class="fact-features-wrap-img">
                                        <img src="./assets/images/home/ome.svg" alt="">
                                    </div>
                                    <div>
                                        <h6>Living Room</h6>
                                        <p>20 X 16 sq feet</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="fact-features-wrap">
                                    <div class="fact-features-wrap-img">
                                        <img src="./assets/images/home/ome.svg" alt="">
                                    </div>
                                    <div>
                                        <h6>Living Room</h6>
                                        <p>20 X 16 sq feet</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="fact-features-wrap">
                                    <div class="fact-features-wrap-img">
                                        <img src="./assets/images/home/ome.svg" alt="">
                                    </div>
                                    <div>
                                        <h6>Living Room</h6>
                                        <p>20 X 16 sq feet</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="fact-features-wrap">
                                    <div class="fact-features-wrap-img">
                                        <img src="./assets/images/home/ome.svg" alt="">
                                    </div>
                                    <div>
                                        <h6>Living Room</h6>
                                        <p>20 X 16 sq feet</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="fact-features-wrap">
                                    <div class="fact-features-wrap-img">
                                        <img src="./assets/images/home/ome.svg" alt="">
                                    </div>
                                    <div>
                                        <h6>Living Room</h6>
                                        <p>20 X 16 sq feet</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="floor-plan">
                        <h4>Facts and Features</h4>
                        <div class="property-wrap">
                            <ul class="nav nav-tabs justify-content-between border-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#penthouse">First Floor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#top-garden">Second Floor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#apartment">Third Floor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#offices">Fourth Floor</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="penthouse" class="container tab-pane active"><br>
                                    <div class="row align-items-center">
                                        <div class="col-lg-7">
                                            <div class="property-inner-wrap property-img-wrap">
                                                <img src="./assets/images/home/tab1.png" alt="">
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
                                                <img src="./assets/images/home/tab1.png" alt="">
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
                                                <img src="./assets/images/home/tab1.png" alt="">
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
                                                <img src="./assets/images/home/tab1.png" alt="">
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
                <div class="col-xl-4">
                    <div class="top-categories top-property p-0 read-blog-main">
                        <h4>Read Blogs</h4>
                        <div class="owl-carousel owl-theme read-blogs-slider">
                            <div class="item">
                                <div class="property-sale-wrap">
                                    <div class="property-sale-img-wrap video-wrapper">
                                        <button id="play-button" class="play-btn" type="button"><img src="./assets/images/home/play-btn.svg" alt="play-btn"></button>
                                        <button class="pause-btn" id="pause-button" type="button"><img src="./assets/images/home/pause-btn.svg" alt=""></button>
                                        <video id="videotest" loop="">
                                            <source src="https://assets.mixkit.co/videos/preview/mixkit-flying-through-the-clouds-with-the-radiant-sun-14171-large.mp4" type="video/mp4">
                                            <source src="movie.ogg" type="video/ogg">
                                        </video>
                                    </div>
                                    <div class="property-detail-wrap p-0 position-relative">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipisicin</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="property-sale-wrap">
                                    <div class="property-sale-img-wrap video-wrapper">
                                        <button id="play-button" class="play-btn" type="button"><img src="./assets/images/home/play-btn.svg" alt="play-btn"></button>
                                        <button class="pause-btn" id="pause-button" type="button"><img src="./assets/images/home/pause-btn.svg" alt=""></button>
                                        <video id="videotest" loop="">
                                            <source src="https://assets.mixkit.co/videos/preview/mixkit-flying-through-the-clouds-with-the-radiant-sun-14171-large.mp4" type="video/mp4">
                                            <source src="movie.ogg" type="video/ogg">
                                        </video>
                                    </div>
                                    <div class="property-detail-wrap p-0 position-relative">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipisicin</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="property-sale-wrap">
                                    <div class="property-sale-img-wrap video-wrapper">
                                        <button id="play-button" class="play-btn" type="button"><img src="./assets/images/home/play-btn.svg" alt="play-btn"></button>
                                        <button class="pause-btn" id="pause-button" type="button"><img src="./assets/images/home/pause-btn.svg" alt=""></button>
                                        <video id="videotest" loop="">
                                            <source src="https://assets.mixkit.co/videos/preview/mixkit-flying-through-the-clouds-with-the-radiant-sun-14171-large.mp4" type="video/mp4">
                                            <source src="movie.ogg" type="video/ogg">
                                        </video>
                                    </div>
                                    <div class="property-detail-wrap p-0 position-relative">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipisicin</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="top-categories top-projects">
                        <h4>Top Projects</h4>
                        <div class="top-projects-inner">
                            <div>
                                <img src="./assets/images/property-detail/project1.png" alt="">
                            </div>
                            <h5>The perfect silwana residency</h5>
                        </div>
                        <div class="top-projects-inner">
                            <div>
                                <img src="./assets/images/property-detail/project1.png" alt="">
                            </div>
                            <h5>The perfect silwana residency</h5>
                        </div>
                    </div>

                    <div class="top-categories">
                        <ul>
                            <h4>Top Categories</h4>
                            <li>
                                <p>Offices</p>
                                <span>(65 Properties)</span>
                            </li>
                            <li>
                                <p>Condos</p>
                                <span>(15 Properties)</span>
                            </li>
                            <li>
                                <p>House</p>
                                <span>(31 Properties)</span>
                            </li>
                            <li>
                                <p>Apartments</p>
                                <span>(47 Properties)</span>
                            </li>
                            <li>
                                <p>Villa</p>
                                <span>(07 Properties)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</x-base>
