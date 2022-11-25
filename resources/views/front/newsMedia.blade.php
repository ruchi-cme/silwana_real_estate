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
                @if(!empty($news))
                   @foreach($news as $new)
                        <div class="col-lg-4 col-md-6  mb-4">
                            <div class="news-event-wrap news-media-wrap wow fadeInUp">
                                <div class="news-event-img-wrap">
                                    <img src="{{ asset('images/news/').'/'.$new['image'] }}" alt="" />
                                </div>
                                <div class="news-events-text">
                                    <h6> {{ $new['name'] }}</h6>
                                    <a href="{{  $new['link']  }}" target="_blank" class="cmn-btn">READ MORE <img src="{{ asset('images/front/about/arrow.svg')   }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

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

                                    @if(!empty($media))
                                        @foreach($media as $row)
                                            @if($row['type'] == 1)
                                            <div class="col-lg-4 col-md-6 mb-4">
                                                <div class="media-image-wrap position-relative">
                                                    <img src="{{ asset('images/media/image').'/'.$row['image_video_title'] }}" alt="social-media-img" />
                                                    <div class="media-wrap-inner position-absolute" data-bs-toggle="modal" data-bs-target="#myModal">
                                                        <div class="view-img">
                                                            <img src="{{ asset('images/front/view-eye.png') }}" alt="eye-img" />
                                                        </div>

                                                        <div class="media-inner-text">
                                                            <h5>{{ $row['name'] }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div id="video" class="container tab-pane fade"><br>
                                <div class="row">
                                    @if(!empty($media))
                                        @foreach($media as $row)
                                            @if($row['type'] ==2)
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <div class="media-image-wrap position-relative">
                                                        <video controls="" src=" {{ asset('images/media/video').'/'.$row['image_video_title'] }}" ></video>
                                                    </div>
                                                </div>
                                           @endif
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

    <!-- The Modal -->
    <div class="modal media-image-slider-main media-gallery-main-modal" id="myModal">
        <div class="modal-dialog">

            <div class="modal-content bg-transparent">
                <div class="modal-header">
                    <!-- <h4 class="modal-title">Modal Heading</h4> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="bg-transparent">
                    <div class="owl-carousel owl-theme media-image-slider">
                        @if(!empty($media))
                            @foreach($media as $row)
                                @if($row['type'] == 1)
                                    <div class="item">
                                        <div class="media-image-slider-wrap">
                                            <img src="{{ asset('images/media/image').'/'.$row['image_video_title'] }}" alt="{{ $row['image_video_title'] }}" />
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-base>
