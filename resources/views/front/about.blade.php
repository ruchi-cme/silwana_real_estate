<x-base>
<x-banner title="ABOUT SILWANA REAL ESTATE" page="About Us"></x-banner>

 
    <!-- investment -->
    <section class="investment management mission-vision">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="investment-image">
                            <div>
                                <img src="{{ asset('images/front/home')}}/img1.png" alt="" />
                            </div>
                        </div>
                    </div>
                    @if (!empty($mission))
                    <div class="col-lg-6">
                        <div class="investment-wrap management-wrap">
                            <div class="title">
                                <span class="btn btn-2">Silwana {{ $mission['page'] }}</span>
                                <h2>{{ $mission['page'] }}</h2>
                                <div>
                                    <div class="investment-inner">
                                        <div>
                                            @php $detail =  nl2br($mission['detail']);
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
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="investment-image">
                            <div>
                                <img src="{{ asset('images/front/home')}}/img1.png" alt="" />
                            </div>
                        </div>
                    </div>
                    @if (!empty($vision))
                    <div class="col-lg-6">
                        <div class="investment-wrap management-wrap">
                            <div class="title">
                                <span class="btn btn-2">Silwana {{ $vision['page'] }}</span>
                                <h2>{{ $vision['page'] }}</h2>
                                <div>
                                    <div class="investment-inner">
                                        <div>
                                            @php $detail =  nl2br($vision['detail']);
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
                    @endif
                </div>
            </div>
        </div>
    </section>



</x-base>
