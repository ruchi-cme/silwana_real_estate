<x-base>
    <x-banner title="Property Booking" page="Property Booking"></x-banner>
    <!-- about banner -->


    <section class="property-booking overflow-hidden">
        @include('layouts.alerts.error')
        @include('layouts.alerts.alert')

        <div class="container position-relative">
            <img src="./assets/images/home/plan3.svg" class="our-amenities-plan img3" alt="">
            <img src="./assets/images/home/plan4.svg" class="our-amenities-plan img4" alt="">
            <div class="row">
                <div class="col-xl-8">
                    <form action="{{ route('booking/store') }}" method="post" class="property-booking-form">
                        @csrf
                        <div>
                            <h2>Property Booking</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. onsectetur adipisicing elit orem ipsum dolor sit amet</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" placeholder="First Name" name="first_name" value="{{ Auth::guard('front')->user()->firstname }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" placeholder="Last Name" name="last_name" value="{{ Auth::guard('front')->user()->lasttname }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" placeholder="Mobile Number" name="phone" value="{{ Auth::guard('front')->user()->phone }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" placeholder="Email" name="email" value="{{ Auth::guard('front')->user()->email }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  select-arrow position-relative">
                                    <select name="booking_type" id="booking_type" class="form-control">
                                        <option value="">Payment Type</option>
                                        @foreach ($bookingType as $key => $val)
                                            <option value="{{ $key }}"  >{{ $val }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group select-arrow position-relative">
                                    <select name="payment_type" id="" class="form-control">
                                        <option value="">Booking Type</option>
                                        @foreach ($paymentType as $key => $val)
                                            <option value="{{ $key }}" >{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea  id="booking_details" cols="30" rows="3" name="booking_details" class="form-control">Booking Details...</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 text-left">
                                <input type="hidden" name="unit_id" value="{{   encrypt( $unitData['proj_floor_unit_id'] ) }}">
                                <button class="cmn-btn bookNow">Book Now</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4">
                    <div class="top-categories property-price mt-0">
                        <ul>
                            <h4>Property Price</h4>
                            <li>
                                <h6>AED {{ $unitData['total_price'] }}<span>(AMD 2500 / sq.ft)</span> </h6>

                            </li>
                            <li class="booking-price">
                                <h6>Booking Price</h6>
                                <span>AMD  {{ $unitData['booking_price'] }}</span>
                            </li>
                            <div class="terms-conditions">
                                <h4>Tearm & Conditions</h4>
                                <p>Lorem ipsum dolor sit amet, elit  ut consectetur adipisicing elit, sed do ut labore.</p>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @section('scripts')
        <script type="text/javascript">

            $(".bookNow").click(function(){
                var user_id =  $(this).attr('user_id');
                var unit_id =  $(this).attr('unit_id');

                if(user_id != '')
                {
                    var route = "{{ URL('/booking/' )   }}";
                    var url = route+'/'+ unit_id ;
                    window.location.href = url;

                }else{
                    //if not logged in
                    $(this).attr('data-bs-toggle', 'modal');
                    $(this).attr('data-bs-target', '#login-modal');
                }

            });

        </script>
    @endsection

</x-base>
