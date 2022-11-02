<x-base>
<x-banner title="NEws & Media" page="News Feed"  ></x-banner>

    <!-- news-event -->
    <section class="news-event-main cmn-bg p-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <h2>News & Events</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="news-event-wrap news-media-wrap">
                        <div class="news-event-img-wrap">
                            <img src="./assets/images/news-media/news-media1.png" alt="" />
                        </div>
                        <div class="news-events-text">
                            <h6>The Arab Marketing Agency announces the launch of its digital website</h6>
                            <a href="#" class="cmn-btn">READ MORE <img src="./assets/images/about/arrow.svg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="news-event-wrap news-media-wrap">
                        <div class="news-event-img-wrap">
                            <img src="./assets/images/news-media/news-media2.png" alt="" />
                        </div>
                        <div class="news-events-text">
                            <h6>GogolCoin Unveils Its Cryptocurrency Exchange</h6>
                            <a href="#" class="cmn-btn">READ MORE <img src="./assets/images/about/arrow.svg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="news-event-wrap news-media-wrap">
                        <div class="news-event-img-wrap">
                            <img src="./assets/images/news-media/news-media3.png" alt="" />
                        </div>
                        <div class="news-events-text">
                            <h6>Silwana Group, ADA Energy to extract 3b barrels of oil in Guinea-Bissau</h6>
                            <a href="#" class="cmn-btn">READ MORE <img src="./assets/images/about/arrow.svg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Silwana Media Gallery -->
    <section class="our-media-gallery p-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <h2 class="mt-0">Silwana Media Gallery</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="property-wrap">
                        <ul class="nav nav-tabs justify-content-between border-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#images">IMAGES</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#video">VIDEOS</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="images" class="container tab-pane active"><br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="media-image-wrap position-relative">
                                            <img src="./assets/images/news-media/social-media1.png" alt="social-media-img" />
                                            <div class="media-wrap-inner position-absolute" data-bs-toggle="modal" data-bs-target="#myModal">
                                                <div class="view-img">
                                                    <img src="./assets/images/news-media/view-eye.png" alt="eye-img" />
                                                </div>

                                                <div class="media-inner-text">
                                                    <h5>Rewards & Recognitions</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="media-image-wrap position-relative">
                                            <img src="./assets/images/news-media/social-media2.png" alt="social-media-img" />
                                            <div class="media-wrap-inner position-absolute">
                                                <div class="view-img">
                                                    <img src="./assets/images/news-media/view-eye.png" alt="eye-img" />
                                                </div>

                                                <div class="media-inner-text">
                                                    <h5>Rewards & Recognitions</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="media-image-wrap position-relative">
                                            <img src="./assets/images/news-media/social-media3.png" alt="social-media-img" />
                                            <div class="media-wrap-inner position-absolute">
                                                <div class="view-img">
                                                    <img src="./assets/images/news-media/view-eye.png" alt="eye-img" />
                                                </div>

                                                <div class="media-inner-text">
                                                    <h5>Rewards & Recognitions</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="video" class="container tab-pane fade"><br>
                                <div class="row">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- The Modal -->
    <div class="modal media-image-slider-main" id="myModal">
        <div class="modal-dialog">

            <div class="modal-content bg-transparent">
                <div class="modal-header">
                    <!-- <h4 class="modal-title">Modal Heading</h4> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="bg-transparent">
                    <div class="owl-carousel owl-theme media-image-slider">
                        <div class="item">
                            <div class="media-image-slider-wrap">
                                <img src="./assets/images/news-media/social-media1.png" alt="social-media1" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="media-image-slider-wrap">
                                <img src="./assets/images/news-media/social-media2.png" alt="social-media2" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="media-image-slider-wrap">
                                <img src="./assets/images/news-media/social-media3.png" alt="social-media3" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-base>
