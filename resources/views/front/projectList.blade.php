@if (!empty($projectList))

    @foreach($projectList as $row)
        @php  $proImg =  getProjectImage($row['project_id'],'single') @endphp

        <div class="col-lg-4 col-md-6">
            <a href="{{ URL('projectDetail/'.encrypt($row['project_id'])) }}" class="portfolio-lists-wrap wow fadeInUp


">
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

@endif
