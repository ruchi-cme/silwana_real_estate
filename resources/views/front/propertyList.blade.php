<x-base>
    <x-banner title="Property List" page="Property List"></x-banner>

    <!-- product list -->
    <section class="product-lists">
        <div class="container">
            <div class="row">
                @if($propertyList )
                    @foreach($propertyList as $row)

                        <div class="col-xl-4 col-md-6">
                    <div class="property-sale-wrap">
                        <div class="property-sale-img-wrap">
                            @php    $img =   getPropertyImage($row['proj_floor_unit_id'],'single');  @endphp
                            <a href="{{ URL('/propertydetail/'.encrypt($row['proj_floor_unit_id'] ))  }}">
                                <img src=" {{  asset('images/unit/').'/'.$img['title']  }}" alt="decore">
                            </a>
                        </div>
                        <div class="property-detail-wrap position-relative">
                            <div class="property-main-detail">
                                <div>

                                    <div class="property-main-total-detail">
                                        <div class="property-main-total">
                                            <div class="property-main-img-wrap">
                                                <img src="./assets/images/home/bed2.svg" alt="">
                                            </div>
                                            <p> {{ !empty($row['rooms']) ?  $row['rooms']  : ''}}</p>
                                        </div>
                                    <p>Bedroom</p>
                                    </div>
                                </div>
                            </div>
                            <h4>AED {{ $row['booking_price'] }}</h4>
                            <h6>  {{ !empty($row['rooms']) ?  $row['rooms'] .' Rooms' : ''}} | {{ $row['overlooking'] }}  </h6>
                            <p>
                               @php  $address = getProjectAddress($row['project_id']) @endphp
                                {{ $address['address'] }}
                            </p>
                        </div>
                    </div>
                </div>
                    @endforeach
                @endif

             <!--   <div class="col-lg-12">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-center">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><img src="./assets/images/left-arrow.svg" alt=""></a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">01</a></li>
                          <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">02</a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">03</a></li>
                          <li class="page-item"><a class="page-link" href="#">...</a></li>
                          <li class="page-item"><a class="page-link" href="#">09</a></li>
                          <li class="page-item"><a class="page-link" href="#">10</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#"><img src="./assets/images/right-arrow.svg" alt=""></a>
                          </li>
                        </ul>
                      </nav>
                </div> -->
            </div>
        </div>
    </section>

</x-base>
