<x-base>
<x-banner title="Our projects" page="Our projects"></x-banner>

    @if(!empty($projectList))
        @foreach($projectList as $firstIndex)
            @php  $proImg =  getProjectImage($firstIndex['project_id'],'single') @endphp
        <section class="portfolio-list">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="project-feature-wrap">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="project-feature-img video-wrapper">
                                        <img src="{{ !empty($proImg['title']) ? asset("images/project/images/" . $proImg['title'])  : '' }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="upcoming-projects-wrap">
                                        <h4>Top project</h4>
                                        <h2>{{  $firstIndex['project_name'] }}</h2>
                                        <h6> <img src="{{ asset('/images/front/location.svg') }} " alt="" /> 5137 Compton Ave, Los Angeles</h6>
                                        <p>  {{ $firstIndex['project_detail'] }}</p>
                                        <a href="{{ URL('projectDetail/'. encrypt($firstIndex['project_id'])) }}" class="cmn-btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
           @break
        @endforeach

        <!-- blog -->

        <section class="blog pb-0 portfolio-view-detail">
            <div class="container">
                <div class="row">
                    @for($i=0;   count($projectList) > $i ; $i++)
                        @php  $proImg =  getProjectImage($projectList[$i]['project_id'],'single') ;   @endphp
                        @if($i == 0 )
                           @continue
                        @elseif ($i == 1)
                            <div class="col-lg-12">
                                <div class="news-media-wrap">
                                    <div class="news-media-img-wrap video-wrapper">
                                        <img src="{{ !empty($proImg['title']) ? asset("images/project/images/" . $proImg['title'])  : '' }}" alt="">
                                    </div>
                                    <div class="news-media-text">
                                        <h4>{{ $projectList[$i]['project_name'] }}</h4>
                                        <p> {{ $projectList[$i]['project_detail'] }} </p>
                                        <a href="{{ URL('projectDetail/'.encrypt($projectList[$i]['project_id'])) }}" class="cmn-btn">VIEW DETAILS</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6">
                                <div class="news-media-wrap border-0 portfolio-view">
                                    <div class="news-media-img-wrap video-wrapper">
                                        <img src="{{ !empty($proImg['title']) ? asset("images/project/images/" . $proImg['title'])  : '' }}" alt="">
                                    </div>
                                    <div class="news-media-text">
                                        <h4>{{ $projectList[$i]['project_name'] }}</h4>
                                        <p> {{ $projectList[$i]['project_detail'] }} </p>
                                        <a href="{{ URL('projectDetail/'.encrypt($projectList[$i]['project_id'])) }}" class="cmn-btn">VIEW DETAILS</a>
                                    </div>
                                </div>
                            </div>
                        @endif



                    @endfor
                </div>
            </div>
        </section>

    @endif
</x-base>
