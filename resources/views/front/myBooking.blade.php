<x-base>
<x-banner title="My booking" page="My booking"></x-banner>

@if (!empty($myBooking))
    <section class="portfolio-list my-booking">
        @include('layouts.alerts.error')
        @include('layouts.alerts.alert')

        <div class="container">
        <div class="row">
            <div class="col-lg-12">

                @foreach ($myBooking as $row)

                    <div class="project-feature-wrap">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="project-feature-img">
                                    @php   $image = getBookingImage($row['proj_floor_unit_id'])   @endphp
                                    @if (!empty($image))
                                        @foreach ($image as $img)
                                            @php
                                                $path = $img['path'].'/'.$img['title'];
                                            @endphp
                                        @endforeach
                                    <img src="{{ !empty($path) ?  asset($path) : '' }}" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="upcoming-projects-wrap title mb-0">
                                    <span class="btn btn-2">{{ $row['category_name'] }}</span>
                                    <h2> {{ $row['project_name'] }}  </h2>
                                    <h6>{{ $row['unit_name'].' '.$row['address'].' '.$row['state'].' '.$row['city'] }} </h6>
                                    <p>  {{ $row['project_detail'] }} </p>
                                    <div class="upcoming-project-detail-lists property-main-detail">
                                        <div class="position-static">
                                            <div class="property-main-total-detail">
                                                <div class="property-main-total">
                                                    <div class="property-main-img-wrap">
                                                        <img src="{{ asset('images/front/home') }}/bed2.svg" alt="">
                                                    </div>
                                                    <p>{{ $row['rooms'] }}</p>
                                                </div>
                                                <p>Bedroom</p>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>{{ $row['total_price'] }}</h3>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    @if($row['canceled'] == 1)
                                        <a   class="cmn-btn btn-2" >CANCELLED  </a>
                                    @else
                                        <a href="javascript:void(0)" id="cncl_{{ encrypt($row['booking_id']) }}" booking_id="{{ encrypt($row['booking_id']) }}" class="cmn-btn cancelBooking" >CANCEL BOOKING</a>
                                     @endif
                                    <a href="{{ URL('/propertydetail/'.encrypt($row['proj_floor_unit_id'] )) }}" class="cmn-btn ms-xl-3">VIEW MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
    @section('scripts')
        <script   src="{{ asset('js/front/custom/myBooking') }}/myBooking.js"> </script>
    @endsection

</x-base>
