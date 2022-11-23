<x-base>
    <x-banner title="Property Details" page="Property Details"></x-banner>
    @php  $imagePDFile = '';
        if(!empty($pdf))
            $imagePDFile  =  !empty($pdf['title'] ) ? asset('images/project/pdf/').'/'.$pdf['title'] : ''
     @endphp


    @if (!empty($projectList))

        <!-- property-detail-main -->
        <section class="property-detail-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="title">
                            <input type="hidden" name="project_id" id="project_id" value="{{ $projectList['project_id'] }}">
                            <span class="btn btn-2">{{ $projectList['category_name'] }}</span>
                            <h2>{{ $projectList['project_name'] }}</h2>
                            <h5><img src="{{ asset('/images/front/location.svg') }}" class="location-image" alt="location" /> {{ !empty($address['address']) ? $address['address'] : '' }} </h5>
                            <p> {{ $projectList['project_detail'] }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top-categories property-price border-0">
                            <ul>
                                <li>
                                    <a id="downloadBrochure12"  {{ !empty($imagePDFile) ? 'download' :'' }}  href="{{ $imagePDFile }}" proName="{{ $projectList['project_name'] }}"  class="cmn-btn">DOWNLOAD BROCHURE</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"  user_id="{{ Auth::guard('front')->check() ? Auth::guard('front')->user()->id : '' }}" class="cmn-btn bookNow">BOOK NOW</a>

                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        @if(!empty($selectedImage))

                            @php $files = [];  $j = 0; @endphp

                        @for($i=0; count($selectedImage) > $i; $i++)

                            @if($selectedImage[$i]['type'] == 1)
                                    @php $files[] = $selectedImage[$i]['title']; @endphp
                             @endif

                                @if($selectedImage[$i]['type'] == 2 && $i <= 2)
                                    <div class="col-xl-4 col-lg-6">
                                        <div class="property-detail-main-wrap">
                                            <img src="{{ asset('images/project/images/').'/'.$selectedImage[$i]['title'] }}" alt="">
                                            <div class="property-detail-more-detail"  data-bs-toggle="modal" data-bs-target="#photoModal">
                                                <a href="javascript:void(0)" class="more-photos">More Photos</a>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($selectedImage[$i]['type'] == 2 && $i > 2  && $j < 1 )
                                    @php $j++ @endphp
                                    <div class="col-lg-4 d-flex flex-column">
                                        <div class="property-detail-main-wrap-small property-detail-main-wrap">
                                            <img src="{{ asset('images/project/images/').'/'.$selectedImage[$i]['title'] }}" alt="">
                                            <div class="property-detail-more-detail"  data-bs-toggle="modal" data-bs-target="#photoModal">
                                                <a href="javascript:void(0)" class="more-photos">More Photos</a>
                                            </div>
                                        </div>

                                    </div>
                                @elseif($selectedImage[$i]['type'] == 1 )
                                    <input type="hidden" id="pdfFile" name="pdfFile" value=" ">
                                    <div class="col-lg-8">
                                            <div class="property-detail-main-wrap-big video-wrapper brochure-wrap">
                                                <iframe src="{{ !empty( $selectedImage[$i]['title'] ) ? asset('images/project/pdf' ).'/'.$selectedImage[$i]['title'] : '' }}" width="100%" height="500px"></iframe>
                                                <input type="hidden"  id="downloadUrl" name="downloadUrl" value="{{ !empty($selectedImage[$i]['title'] ) ? asset('images/project/pdf/').'/'.$selectedImage[$i]['title'] : ''}}">
                                                <a  id="downloadBrochure12"  download href="{{ $imagePDFile }}" proName="{{ $projectList['project_name'] }}" class="cmn-btn" >DOWNLOAD BROCHURE</a>
                                            </div>
                                        </div>
                                @endif
                            @endfor

                            @php  $pdfFiles =   implode(",",$files) ; @endphp
                            <input type="hidden"  id="files" name="files" value="{{ $pdfFiles }}">

                        @endif

                    </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="apartment-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div>
                        <h4>Property Detail</h4>
                        <div class="property-detail-list-wrap">
                            <div class="row">
                                <div class="col-xl-8 col-lg-8">
                                    <div class="property-detail-list-inner">
                                        @php  $detail =  getpropertyDetailsByProject( $projectList['project_id']) @endphp
                                        <ul>
                                            <li>
                                                <p>Home Area</p>
                                                <span> {{ !empty($detail) ? $detail['min_area'].' sqft'  : '' }} -  {{ !empty($detail) ? $detail['max_area'].' sqft' :'' }}</span>
                                            </li>
                                            <li>
                                                <p>Property Type</p>
                                                <span> {{ $projectList['category_name'] }}</span>
                                            </li>
                                            <li>
                                                <p>Blocks</p>
                                                <span> {{ !empty($detail) ? $detail['block_name']  : '' }}</span>
                                            </li>
                                            <li>
                                                <p>Price</p>
                                                <span> {{ !empty($detail) ? $detail['min']  : '' }} -  {{ !empty($detail) ? $detail['max'] :'' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="fact-features">
                        <div class="row">
                            <h4>Project Amenities</h4>
                            @foreach($amenities as $amenity)
                                <div class="col-lx-4 col-lg-6">
                                    <div class="fact-features-wrap">
                                        <div class="fact-features-wrap-img">
                                            <img src="{{ asset('images/amenities').'/'.$amenity['amenity_image'] }}" alt="">
                                        </div>
                                        <div>
                                            <h6>{{ $amenity['amenity_name'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @php
                       $lat  =  $projectList['latitude'];
                       $long =  $projectList['longitude'];
                    @endphp
                    <div class="map-wrap">
                        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14686.38110757174!2d72.50322167825783!3d23.038627905445274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9b4c4b8342df%3A0x62dafb0b4b33890b!2sBodakdev%2C%20Ahmedabad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1665982756650!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                        <iframe
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            src="https://maps.google.com/maps?q={{$lat}},{{$long}}&z=14&language=en&amp;output=embed"
                        >
                        </iframe>
                        <br />
                        <small>
                            <a
                                href="https://maps.google.com/maps?q={{$lat}},{{$long}}&z=14&language=en&amp;output=embed"
                                style="color:#0000FF;text-align:left"
                                target="_blank"  >
                                See map bigger
                            </a>
                        </small>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="top-categories">
                        <ul>
                            <h4>Top Categories</h4>
                            @if(!empty($categories))
                                @foreach($categories as $cat)
                                   @php $countProject = getCountCategoryProject($cat['category_id']); @endphp
                                     @if(!empty($countProject))
                                        <li>
                                            <p>{{ $cat['category_name'] }}</p>
                                            <span>({{ $countProject }} Properties)</span>
                                        </li>
                                    @endif
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- The Modal -->
    <div class="modal apartment-modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div>
                    <form action="{{ route('booking/store') }}" method="post" id="bookingForm" name="bookingForm" >
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="title">
                                    <h2>{{ $projectList['project_name'] }}</h2>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group select-title">
                                    <select required name="block_id" id="block_name" class="form-control">
                                        <option value="">Select Block</option>
                                        @if(!empty($blockData))
                                            @foreach($blockData as $block)
                                                <option value="{{ $block['block_name_map_id'] }}">{{ $block['block_name'] }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group select-title">
                                    <select required name="floor_id" id="floor" class="form-control">
                                        <option value="">Select Floor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group select-title">
                                    <select required name="unit_id" id="unit" class="form-control">
                                        <option value="">Select Unit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" required placeholder="First Name" name="first_name" value="{{   (Auth::guard('front')->check()) ? Auth::guard('front')->user()->firstname : '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" required placeholder="Last Name" name="last_name" value="{{  (Auth::guard('front')->check()) ?  Auth::guard('front')->user()->lastname :'' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" required placeholder="Mobile Number" name="phone" value="{{  (Auth::guard('front')->check()) ? Auth::guard('front')->user()->phone :'' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" required placeholder="Email" name="email" value="{{  (Auth::guard('front')->check()) ?  Auth::guard('front')->user()->email :'' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select required name="payment_type" id="" class="form-control">
                                        <option value="">Booking Type</option>
                                        @foreach ($paymentType as $key => $val)
                                            <option value="{{ $key }}" >{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select required name="booking_type" id="booking_type" class="form-control">
                                        <option value="">Payment Type</option>
                                        @foreach ($bookingType as $key => $val)
                                            <option value="{{ $key }}"  >{{ $val }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea  id="booking_details" cols="30" rows="3" name="booking_details" class="form-control" placeholder="Booking Details"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="top-categories property-price p-0">
                                    <ul>
                                        <h4>Property Price</h4>
                                        <li>
                                            <h6 >AED <span id="totalPrice"></span> <span >( <span id="sqft"> 2500  </span> / sq.ft)</span> </h6>

                                        </li>
                                        <li class="booking-price">
                                            <h6>Booking Price <span >AMD  <span id="bookingPrice"> </span> </span></h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="top-categories property-price border-0 pe-0">
                                    <ul>
                                        <li>
                                            <input type="hidden" name="project_id" id="project_id" value="{{ $projectList['project_id'] }}">
                                            <button  id="create_button" class="cmn-btn bookNows">Book Now</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- The Photo Modal -->
    <div class="modal media-image-slider-main" id="photoModal">
        <div class="modal-dialog">

            <div class="modal-content bg-transparent">
                <div class="modal-header">
                    <!-- <h4 class="modal-title">Modal Heading</h4> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="bg-transparent">
                    <div class="owl-carousel owl-theme media-image-slider">
                        @if(!empty($selectedImage))
                            @for($i=0; count($selectedImage) > $i; $i++)
                                @if($selectedImage[$i]['type'] == 2)
                                <div class="item">
                                    <div class="media-image-slider-wrap">
                                        <img src="{{ asset('images/project/images/').'/'.$selectedImage[$i]['title'] }}"/>
                                    </div>
                                </div>
                                @endif
                            @endfor
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade edit-profile-modal" id="noPDFModal" tabindex="-1" aria-labelledby="noPDFModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0 text-center">
                    <div class=" mx-auto">
                        <h5 class="modal-title text-center" id="noPDFModalLabel">No Pdf of this project!</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group mb-0 text-center">
                            <button type="button" class="cmn-btn " data-bs-dismiss="modal">OK</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
        <script src="{{asset('js/front')}}/script.js"></script>
        <script   src="{{ asset('js/front/custom/propertyDetail') }}/propertyDetail.js"> </script>
    @endsection
</x-base>

