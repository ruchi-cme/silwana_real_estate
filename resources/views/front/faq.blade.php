<x-base>
<x-banner title="FREQUENTLY ASKED QUESTIONS" page="FAQ"></x-banner>

    <!-- faq -->
    <section class="faq p-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="faq-wrap">
                        <div class="accordion" id="accordionExample">
                            @if($faq )
                                @php
                                    $i = 1
                                @endphp
                                @foreach($faq as $row)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{$i}}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                                                 {{$row['name']}}
                                            </button>
                                        </h2>
                                        <div id="collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="heading{{$i}}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p> {{$row['detail']}} </p>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp

                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="answer-wrap">
                        <h2>Can't find the answer?</h2>
                        <p>Please contact us to raise your question</p>
                        <a href="{{ route('contactUs') }}" class="cmn-btn">CONTACT US</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-base>
