<x-base>
<x-banner title="My booking" page="My booking"></x-banner>

@if (!empty($myBooking))
    <section class="portfolio-list my-booking">
        @include('layouts.alerts.error')

        @include('layouts.alerts.alert')
        <div style="display: none" class="alert bg-success bookingSuccessAlert" id="bookingCancel">


            <!--begin::Content-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <h4 class="mb-2 text-light">Success</h4>
                <span>Booking cancelled successfully.👍</span>
            </div>
            <!--end::Content-->
            <!--begin::Close-->
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                <span class="svg-icon svg-icon-2x svg-icon-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
            </svg>
        </span>
                <!--end::Svg Icon-->
            </button>
            <!--end::Close-->
        </div>
        <div class="container">
        <div class="row">
            <div class="col-lg-12">

                @foreach ($myBooking as $row)

                    <div class="project-feature-wrap">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="project-feature-img">
                                    @php   $image = getProjectImage($row['project_id'],'obj')   @endphp
                                    @if (!empty($image))
                                        <a href="{{ URL('/projectDetail/'.encrypt($row['project_id'] )) }}">
                                            <img src="{{ !empty($image['title']) ?  asset('images/project/images/').'/'.$image['title']   : '' }}" alt="">
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="upcoming-projects-wrap title mb-0">
                                    <span class="btn btn-2">{{ $row['category_name'] }}</span>
                                    <a href="{{ URL('/projectDetail/'.encrypt($row['project_id'] )) }}">
                                        <h2> {{ $row['project_name'] }}  </h2>
                                    </a>
                                    <h6>{{ $row['unit_name'].' '.$row['address'].' '.$row['state'].' '.$row['city'] }} </h6>
                                    <p>  {{ $row['project_detail'] }} </p>

                                    <h3>AMD {{ $row['total_price'] }}</h3>

                                    <a class="cmn-btn btn-2" id="cncldBtn{{ $row['booking_id'] }}" style="display: none">CANCELLED  </a>
                                    @if($row['canceled'] == 1)
                                        <a class="cmn-btn btn-2" >CANCELLED  </a>
                                    @else
                                        <a href="javascript:void(0)" id="cncl_{{ $row['booking_id'] }}" booking_id="{{ $row['booking_id'] }}" class="cmn-btn cancelBooking"   >CANCEL BOOKING</a>
                                     @endif
                                   <a href="{{ URL('/projectDetail/'.encrypt($row['project_id'] )) }}" class="cmn-btn ms-xl-3">VIEW MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
</section>

        <div class="modal fade edit-profile-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0 text-center">
                        <div class=" mx-auto">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Are you sure you want to cancel?</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="form-group mb-0 justify-content-between text-center">
                                <input type="hidden" name="booking_id" id="booking_id_modal" />
                                <button type="button" class="cmn-btn" data-bs-dismiss="modal">No</button>
                                <button type="submit" class="cmn-btn cancelBookingModal">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @endif
    @section('scripts')
        <script   src="{{ asset('js/front/custom/myBooking') }}/myBooking.js"> </script>
    @endsection

</x-base>
