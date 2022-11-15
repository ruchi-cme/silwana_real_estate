     <header id="navigation_bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 header-top">
                    @php $builderDetail =  getBuilderDetail() @endphp
                    <a href="#"> <img src="{{asset('images/front')}}/call.svg" alt="call" /> <p>+{{ $builderDetail['phone_number'] }}</p> </a>
                    <a href="#"> <img src="{{asset('images/front')}}/mail.svg" alt="email" /> <p>{{ $builderDetail['builder_email']  }}</p> </a>
                </div>
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-xl p-0">
                        <div class="container p-0">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img src="{{asset('images/front')}}/logo.svg" alt="">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                                <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('home') }}">home</a>
                                    </li>
                                    <li class="nav-item estimate-wrap">
                                        <div class="dropdown about-dropdown-menu">
                                            <a class="dropdown-toggle nav-link" href="{{ route('about') }}" role="button">
                                                About us
                                            </a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <div class="profile-detail-header">
                                                   @php  $news   = getNews();  @endphp
                                                    @if(!empty($news))
                                                        @for ($i= 0; count($news)> $i; $i++ )
                                                            @if($i == 1)
                                                                @break;
                                                            @endif
                                                            <ul class="p-0 bg-transparent shadow-none">
                                                                <div class="news-media-wrap p-0">
                                                                    <div class="news-media-img-wrap">
                                                                        <img src="{{ asset('images/news/').'/'.$news[$i]['image'] }}" alt="">
                                                                    </div>
                                                                    <div class="news-media-text">
                                                                        <p class="m-0"> {{ $news[$i]['name'] }}</p>
                                                                        <a href="{{  $news[$i]['link']  }}" class="cmn-btn">Read More <img src="{{ asset('images/front/about') }}/arrow.svg" alt=""></a>
                                                                    </div>
                                                                </div>
                                                            </ul>
                                                        @endfor
                                                    @endif


                                                    <ul>
                                                        <li><a class="dropdown-item" href="{{ route('about') }}">About Us</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('ourTeam') }}">Our Team</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('aboutusFaq') }}">FAQ</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('newsMedia') }}">News & Media</a></li>
                                                    </ul>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item estimate-wrap ">
                                        <div class="dropdown about-dropdown-menu our-project-dropdown-menu">
                                            <a href="{{ route('ourProject') }}"  class="dropdown-toggle nav-link" role="button">
                                                Our Projects
                                            </a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <div class="profile-detail-header">
                                                    <ul>
                                                        <li><a class="dropdown-item" href="{{ route('ourProject/ongoing') }}">Ongoing Project</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('ourProject/upcoming') }}">Upcoming Projects</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('ourProject/completed') }}">Completed Projects</a></li>
                                                    </ul>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('sales') }}"> Sales</a>
                                    </li>
                                   <!-- <li class="nav-item">
                                        <a class="nav-link" href="{{ route('propertyList') }}">Property on Sale</a>
                                    </li> -->

                                    @if (Auth::guard('front')->check())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('myBooking') }}">My Booking</a>
                                    </li>
                                    @endif
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('contactUs') }}">Contact us</a>
                                    </li>
                                </ul>
                                <div class="estimate-wrap">
                                    @if (Auth::guard('front')->check())
                                        @php $image = asset('images/front').'/noProfile.jpeg' ; @endphp
                                        @if(Auth::guard('front')->user()->image)
                                            @php $image = asset('images/user') .'/'. Auth::guard('front')->user()->image; @endphp
                                        @endif
                                        <div class="dropdown">
                                        <button class="cmn-btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="profile-img-wrap-sml">
                                                <img src="{{$image}}" alt="profile" />
                                            </div>
                                            <p>{{Auth::guard('front')->user()->name}}</p>
                                        </button>

                                        <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton1">
                                            <div class="profile-detail-header">
                                                <ul class="text-center">
                                                    <li>
                                                        <div class="profile-main-img mx-auto">
                                                            <img src="{{$image}} " alt="">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <p>{{Auth::guard('front')->user()->name}}</p>
                                                    </li>
                                                    @if(!empty(Auth::guard('front')->user()->phone))
                                                        <li>
                                                            <p> <img src="{{asset('images/front')}}/call.svg" alt="call" /> +{{ Auth::guard('front')->user()->phone  }}</p>
                                                        </li>
                                                    @endif

                                                    <li>
                                                        <p> <img src="{{asset('images/front')}}/email.svg" alt="email" /> {{Auth::guard('front')->user()->email}}</p>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li><a class="dropdown-item" href="{{ route('myProfile') }}">My Profile</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('myBooking') }}">My Booking</a></li>
                                                    <li>
                                                        <form method="POST" id="logout_form" action={{ route('home/logout') }}>
                                                            @csrf
                                                            <a href="javascript:{}" class="dropdown-item"  onclick="document.getElementById('logout_form').submit();"  >Sign Out</a>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </ul>
                                    </div>
                                    @else
                                    <x-loginButton />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>


    <!-- Modal -->
    <div class="modal fade"  id="signup-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <div class="login-form-img-wrap">
                                <img src="{{asset('images/front')}}/login-form-imh.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <form   class="sign-up-form" method="post">
                                @csrf
                                <div>
                                    <h2>Sign up</h2>
                                    <p>Please Sign up and explore your dream house from silwana real estate.</p>
                                    <div class="alert alert-danger  mt-1 mb-1" id="signupError"  style="display: none"></div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Name" name="name" id="name" class="form-control">
                                            <span class="alert text-danger  mt-1 mb-1" id="signupname" ></span>
                                         </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Mobile Number"  id="phone" name="phone" class="form-control">
                                            <span class="alert text-danger  mt-1 mb-1" id="signupphone" ></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Email" name="email" id="semail" class="form-control">
                                            <span class="alert text-danger  mt-1 mb-1" id="signupemail" ></span>
                                         </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="password" placeholder="Password"  id="spassword"  name="password" class="form-control">
                                            <span class="alert text-danger  mt-1 mb-1" id="signuppass" ></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-left">
                                        <button type="submit" class="cmn-btn w-100 signup btn-signup">SIGN UP</button>
                                    </div>
                                    <div class="col-lg-12 text-center already-acc">
                                        <p class="m-0">Have you already account? <button type="button"  data-bs-toggle="modal" data-bs-target="#login-modal">Login</button> </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <div class="login-form-img-wrap">
                                <img src="{{asset('images/front')}}/login-form-imh.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <form method="post"  id="loginForm"  class="sign-up-form"  >

                               <div>
                                    <h2>login</h2>
                                    <p>Please Sign In and explore your dream house from silwana real estate.</p>
                                   <div class="alert alert-danger  mt-1 mb-1" id="loginError"  style="display: none"></div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" name="email" id="email" placeholder="Email" class="form-control">
                                              <span class="alert text-danger  mt-1 mb-1" id="loginemail" ></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                                            <span class="alert text-danger  mt-1 mb-1" id="loginpassword" ></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-left">
                                        <button type="submit" class="cmn-btn w-100 btn-login">Login</button>
                                    </div>
                                    <div class="col-lg-12 text-center already-acc">
                                        <p class="m-0">Have you already account? <button type="button" data-bs-toggle="modal" data-bs-target="#signup-modal">Signup</button> </p>
                                        <div class="login-form-img-wrap2">
                                            <img src="{{asset('images/front')}}/dubai.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

