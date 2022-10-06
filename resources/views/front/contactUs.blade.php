<x-base>
<x-banner title="Contact Us" page="Contact Us"></x-banner>

    <!-- register -->
    <section class="register-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="register-inner">
                        <div class="row justify-content-center">

                            @if (!empty($contactUs))
                                @foreach($contactUs as $row)
                                    <div class="col-xl-4 col-lg-6">
                                        <div class="talk-to-sales text-center">
                                            <div class="talk-to-sale-img">
                                                <img src="{{ asset('images/contactus').'/'. $row['image'] }}" alt="">
                                            </div>
                                            <h4> {{ $row['title'] }} </h4>
                                            <p> {{ $row['desc'] }} </p>
                                            <a href="javascript:void(0)">{{ $row['notes'] }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="col-lg-12">
                                <form action="" class="register-form" >
                                    @csrf
                                    <div class="text-center">
                                        @if(!empty($page))
                                        <h2>{{ $page['page'] }}</h2>
                                        <p>{{ $page['detail'] }}</p>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="first_name" placeholder="First Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="last_name" placeholder="Last Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="mobile_number" placeholder="Mobile Number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea name="message" id="" cols="30" rows="6" class="form-control">Message</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-left">
                                            <button class="cmn-btn">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-base>
