<!-- about banner -->
<section class="about-banner overflow-hidden cmn-banner">
    <div class="container position-relative">
        <img src="{{asset('images/front')}}/about/building1.svg" class="our-amenities-plan img5" alt="building1">
        <img src="{{asset('images/front')}}/about/building2.svg" class="our-amenities-plan img6" alt="building2">
        <div class="row">
            <div class="about-banner-text text-center">
                <h2 class="wow fadeInUp">{{$title}}</h2>
                <h4>{{!empty($page) && ($page == 'News Feed') ? 'The latest news and press releases' : ''}}</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <img src="{{asset('images/front')}}/about/home-icon.png" alt=""> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$page}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
