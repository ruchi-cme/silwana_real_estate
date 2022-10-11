<x-base>
    <x-banner title="Property Details" page="Property Details"></x-banner>
    <!-- property-detail-main -->
    <section class="property-detail-main mt-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="search-property">
                        <h2>Search Property</h2>
                        <form action="">
                            <div class="form-group mb-0 position-relative">
                                <select name="" id="" class="form-control">
                                    <option value="">Select Block</option>
                                </select>
                            </div>
                            <div class="form-group mb-0 position-relative">
                                <select name="" id="" class="form-control">
                                    <option value="">Select Floor</option>
                                </select>
                            </div>
                            <div class="form-group mb-0 position-relative">
                                <select name="" id="" class="form-control">
                                    <option value="">Select Unit</option>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <button type="" class="cmn-btn search-btn"><img src="./assets/images/search.svg" alt="search" /></button>
                            </div>
                        </form>
                    </div>
                </div>
                @if(!empty($propertyImage))
                    @foreach($propertyImage as $row)
                        <div class="col-xl-4">
                            <div class="property-detail-main-wrap">
                                <img src="{{ asset('images/unit').'/'.$row['title'] }}" alt="">
                            </div>
                        </div>
                    @endforeach
                @endif

              <!--  <div class="col-xl-4">
                    <div class="property-detail-main-wrap">
                        <img src="./assets/images/property-detail/image2.png" alt="">
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="property-detail-main-wrap">
                        <img src="./assets/images/property-detail/image3.png" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="property-detail-main-wrap-big video-wrapper">
                        <button id="play-button" class="play-btn" type="button"><img src="./assets/images/home/play-btn.svg" alt="play-btn"></button>
                        <button class="pause-btn" id="pause-button" type="button"><img src="./assets/images/home/pause-btn.svg" alt=""></button>
                        <video id="videotest" loop>
                            <source src="https://assets.mixkit.co/videos/preview/mixkit-flying-through-the-clouds-with-the-radiant-sun-14171-large.mp4" type="video/mp4">
                            <source src="movie.ogg" type="video/ogg">
                        </video>
                    </div>
                </div>
                <div class="col-lg-4 d-flex flex-column">
                    <div class="property-detail-main-wrap-small">
                        <img src="./assets/images/property-detail/image1.png" alt="">
                    </div>
                    <div class="property-detail-main-wrap-small">
                        <img src="./assets/images/property-detail/image1.png" alt="">
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <section class="apartment-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="title">
                        <span class="btn btn-2">{{ $propertyDetail['category_name'] }}</span>
                        <h2>{{ $propertyDetail['project_name'] }}</h2>
                        @php $address = getProjectAddress($propertyDetail['project_id'])  @endphp
                        <h5><img src="./assets/images/location.svg" class="location-image" alt="location" />  {{ $address['address'] }}</h5>
                        <p> {{ $propertyDetail['project_detail'] }} </p>
                    </div>

                    <div>
                        <h4>Property Detail</h4>
                        <div class="property-detail-list-wrap">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="property-detail-list-inner">
                                        <ul>
                                            <li>
                                                <p>Property ID</p>
                                                <span>{{ $propertyDetail['unit_name'] }}</span>
                                            </li>
                                            <li>
                                                <p>Home Area</p>
                                                <span>{{ $propertyDetail['area_in_sq_feet'] }} sqft</span>
                                            </li>
                                            <li>
                                                <p>Room</p>
                                                <span>  {{ $propertyDetail['rooms'] }}  Rooms</span>
                                            </li>
                                            <li>
                                                <p>Baths</p>
                                                <span>2 Baths</span>
                                            </li>
                                            <li>
                                                <p>Year Built</p>
                                                <span>2022</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="property-detail-list-inner">
                                        <ul>
                                            <li>
                                                <p>Lot Area</p>
                                                <span>SRED369</span>
                                            </li>
                                            <li>
                                                <p>Lot Dimensions</p>
                                                <span>120 sqft</span>
                                            </li>
                                            <li>
                                                <p>Beds</p>
                                                <span>5 Beds</span>
                                            </li>
                                            <li>
                                                <p>Price</p>
                                                <span>AMD {{ $propertyDetail['total_price'] }}  </span>
                                            </li>
                                            <li>
                                                <p>Property Type</p>
                                                <span>{{ $propertyDetail['category_name'] }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fact-features">
                        <div class="row">
                            <h4>Facts and Features</h4>
                            <div class="col-lg-4">
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
                            <div class="col-lg-4">
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
                            <div class="col-lg-4">
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
                            <div class="col-lg-4">
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
                            <div class="col-lg-4">
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
                            <div class="col-lg-4">
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
                <div class="col-lg-4">
                    <div class="top-categories property-price">
                        <ul>
                            <h4>Property Price</h4>
                            <li>
                                <h6>AED {{ $propertyDetail['total_price'] }} <span>(AMD 2500 / sq.ft)</span> </h6>

                            </li>
                            <li class="booking-price">
                                <h6>Booking Price</h6>
                                <span>AMD {{ $propertyDetail['booking_price'] }}</span>
                            </li>
                            <li>
                                <a href="javascript:void(0)"  unit_id="{{ encrypt($propertyDetail['proj_floor_unit_id']) }}"  user_id="{{ Auth::guard('front')->check() ? Auth::guard('front')->user()->id : '' }}" class="cmn-btn book_now">BOOK NOW</a>
                            </li>
                        </ul>
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

                    <div class="top-categories top-property p-0">
                        <h4>Top Properties</h4>
                        <div class="owl-carousel owl-theme top-properties-slider">
                            <div class="item">
                                <div class="property-sale-wrap">
                                    <div class="property-sale-img-wrap">
                                        <img src="./assets/images/home/decore.png" alt="decore" />
                                    </div>
                                    <div class="property-detail-wrap position-relative">
                                        <h4>AED 12,500,000</h4>
                                        <h6>Furnished | 4 BR + Maids| Sea View</h6>
                                        <p>5137 Compton Ave, Los Angeles</p>
                                        <div class="top-property-details-wrap">
                                            <div>
                                                <img src="./assets/images/property-detail/bed.svg" alt="bed" />
                                            </div>
                                            <h6>3 Bedroom</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="property-sale-wrap">
                                    <div class="property-sale-img-wrap">
                                        <img src="./assets/images/home/decore.png" alt="decore" />
                                    </div>
                                    <div class="property-detail-wrap position-relative">
                                        <h4>AED 12,500,000</h4>
                                        <h6>Furnished | 4 BR + Maids| Sea View</h6>
                                        <p>5137 Compton Ave, Los Angeles</p>
                                        <div class="top-property-details-wrap">
                                            <div>
                                                <img src="./assets/images/property-detail/bed.svg" alt="bed" />
                                            </div>
                                            <h6>3 Bedroom</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="property-sale-wrap">
                                    <div class="property-sale-img-wrap">
                                        <img src="./assets/images/home/decore.png" alt="decore" />
                                    </div>
                                    <div class="property-detail-wrap position-relative">
                                        <h4>AED 12,500,000</h4>
                                        <h6>Furnished | 4 BR + Maids| Sea View</h6>
                                        <p>5137 Compton Ave, Los Angeles</p>
                                        <div class="top-property-details-wrap">
                                            <div>
                                                <img src="./assets/images/property-detail/bed.svg" alt="bed" />
                                            </div>
                                            <h6>3 Bedroom</h6>
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
    @section('scripts')
        <script type="text/javascript">


            $(".book_now").click(function(){
              var user_id =  $(this).attr('user_id');
              var unit_id =  $(this).attr('unit_id');

              if(user_id != '')
              {
                  var route = "{{ URL('/booking/' )   }}";
                  var url = route+'/'+ unit_id ;
                  window.location.href = url;

                  /*    $.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                     });
              $.ajax({
                       url: " ",
                       type: "Post",
                       data: {
                           user_id : user_id, unit_id : unit_id
                       },
                       dataType: 'json',
                       success: function (result) {

                       }
                   }); */

              }else{
                  //if not logged in
                  $(this).attr('data-bs-toggle', 'modal');
                  $(this).attr('data-bs-target', '#login-modal');
              }

            });

        </script>
    @endsection
</x-base>

