<x-base>
<x-banner title="ABOUT SILWANA REAL ESTATE" page="About Us"></x-banner>


    <!-- investment -->
    <section class="investment management mission-vision">
        <div class="container">
            <div class="container">
                @if (!empty($aboutUs))
                    @foreach($aboutUs as $row)
                <div class="row">
                    <div class="col-lg-6">
                        <div class="investment-image">
                            <div>
                                <img src="{{ asset('images/front/home')}}/img1.png" alt="" />
                            </div>
                        </div>
                    </div>

                            <div class="col-lg-6">
                                <div class="investment-wrap management-wrap">
                                    <div class="title">
                                        <span class="btn btn-2">Silwana {{ $row['name'] }}</span>
                                        <h2>{{ $row['name'] }}</h2>
                                        <div>
                                            <div class="investment-inner">
                                                <div>
                                                    @php $detail =  nl2br($row['detail']);
                                            $detail = explode('<br />', $detail);
                                                    @endphp
                                                    @foreach ($detail as $del)
                                                        <p> {{ $del }} </p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                </div>
                @endforeach

                @endif
            </div>
        </div>
    </section>



</x-base>
