<x-base>
    <x-banner title="Property Details" page="Property Details"></x-banner>


<!-- property-detail-main -->
<section class="property-detail-main mt-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="search-property">
                    <h2>Search Property</h2>
                    <form action="{{ route('ourProject/projectSearch' ) }}" method="post">
                        @csrf
                        <div class="form-group mb-0 position-relative">
                            <input type="text" name="searchProject" class="form-control" placeholder="eg. silwana real estate">
                            <input type="hidden" name="currentURL"  value="{{$currentURL}}">
                            @if( !empty(request()->id))
                                <input type="hidden" name="category_id"  value="{{ decrypt(request()->id) }}">
                            @endif



                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="cmn-btn search-btn"><img src="{{asset("images/front" )}}/search.svg" alt="search" /> search</button>
                        </div>
                    </form>
                </div>
            </div>

            @if (!empty($projectList))
                @foreach($projectList as $row)
                    @php  $proImg =  getProjectImage($row['project_id'],'single') @endphp

                    <div class="col-lg-4 col-md-6">
                        <a href="{{ URL('projectDetail/'.encrypt($row['project_id'])) }}" class="portfolio-lists-wrap">
                            <div class="portfolio-lists-img-wrap">
                                <img src="{{ !empty($proImg['title']) ? asset("images/project/images/".$proImg['title'])  :  asset("images/front/home/feature1.png" ) }}" alt="">
                            </div>
                            <div class="portfolio-lists-detail">
                                <h6>{{  $row['project_name'] }}</h6>
                                <p> {{  $row['category_name'] }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
                    <!-- <div class="col-lg-12">
                        <div class="text-center">
                            <button class="cmn-btn load-more-btn">LOAD MORE</button>
                        </div>
                    </div> -->
            @endif




        </div>
    </div>
</section>

</x-base>
