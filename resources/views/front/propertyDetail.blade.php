<x-base>
    <x-banner title="Property Details" page="Property Details"></x-banner>
    <!-- property-detail-main -->

    <section class="property-detail-main mt-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="search-property">
                        <h2>Search Property</h2>
                        <form action="{{ route('searchProperty') }}" method="post">
                             @csrf
                            <div class="form-group mb-0 position-relative">
                                <select name="block_name" id="block_name" class="form-control">
                                    <option value="">Select Block</option>
                                    @if(!empty($blockData))
                                        @foreach($blockData as $row)
                                            <option value="{{ $row['proj_block_map_id'] }}" >{{ $row['block_name'] }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mb-0 position-relative">
                                <select name="floor" id="floor" class="form-control">
                                    <option value="">Select Floor</option>
                                </select>
                            </div>
                            <div class="form-group mb-0 position-relative">
                                <select name="unit" id="unit" class="form-control">
                                    <option value="">Select Unit</option>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <button type="" class="cmn-btn search-btn"><img src="{{ asset('images/front')}}/search.svg" alt="search" /></button>
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
                        <h5><img src="{{ asset('images/front')}}/location.svg" class="location-image" alt="location" />  {{ $address['address'] }}</h5>
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
                                                <span>-</span>
                                            </li>
                                            <li>
                                                <p>Year Built</p>
                                                <span>-</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="property-detail-list-inner">
                                        <ul>
                                           <!--  <li>
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
                                            </li> -->
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
                                @if( $propertyDetail['booking_type'] == 1)
                                    <a href="javascript:void(0)"  unit_id="{{ encrypt($propertyDetail['proj_floor_unit_id']) }}"  user_id="{{ Auth::guard('front')->check() ? Auth::guard('front')->user()->id : '' }}" class="cmn-btn bookNow">BOOK NOW</a>

                                @else
                                    <button class="cmn-btn">BOOKED</button>

                                @endif
                            </li>
                        </ul>
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
                                        <img src="{{ asset('images/front/home')}}/decore.png" alt="decore" />
                                    </div>
                                    <div class="property-detail-wrap position-relative">
                                        <h4>AED 12,500,000</h4>
                                        <h6>Furnished | 4 BR + Maids| Sea View</h6>
                                        <p>5137 Compton Ave, Los Angeles</p>
                                        <div class="top-property-details-wrap">
                                            <div>
                                                <img src="{{ asset('images/front')}}/property-detail/bed.svg" alt="bed" />
                                            </div>
                                            <h6>3 Bedroom</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="property-sale-wrap">
                                    <div class="property-sale-img-wrap">
                                        <img src="{{ asset('images/front/home')}}/decore.png" alt="decore" />
                                    </div>
                                    <div class="property-detail-wrap position-relative">
                                        <h4>AED 12,500,000</h4>
                                        <h6>Furnished | 4 BR + Maids| Sea View</h6>
                                        <p>5137 Compton Ave, Los Angeles</p>
                                        <div class="top-property-details-wrap">
                                            <div>
                                                <img src="{{ asset('images/front/property-detail')}}/bed.svg" alt="bed" />
                                            </div>
                                            <h6>3 Bedroom</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="property-sale-wrap">
                                    <div class="property-sale-img-wrap">
                                        <img src="{{ asset('images/front/home')}}/decore.png" alt="decore" />
                                    </div>
                                    <div class="property-detail-wrap position-relative">
                                        <h4>AED 12,500,000</h4>
                                        <h6>Furnished | 4 BR + Maids| Sea View</h6>
                                        <p>5137 Compton Ave, Los Angeles</p>
                                        <div class="top-property-details-wrap">
                                            <div>
                                                <img src="{{ asset('images/front/property-detail')}}/bed.svg" alt="bed" />
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

        <script   src="{{ asset('js/front/custom/propertyDetail') }}/propertyDetail.js"> </script>
    @endsection
</x-base>

