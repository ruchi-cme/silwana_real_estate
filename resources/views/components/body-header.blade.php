
    <header id="navigation_bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 header-top">
                    <a href="#"> <img src="{{asset('images/front')}}/call.svg" alt="call" /> <p>+91 98765 32145</p> </a>
                    <a href="#"> <img src="{{asset('images/front')}}/mail.svg" alt="email" /> <p>username@silwanarealestate.com</p> </a>
                </div>
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-xl p-0">
                        <div class="container p-0">
                            <a class="navbar-brand" href="index.php">
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
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('about') }}">About us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('ourProject') }}">Our Projects</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('propertyList') }}">Property on Sale</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('myBooking') }}">My Booking</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('contactUs') }}">Contact us</a>
                                    </li>
                                </ul>
                                <div class="estimate-wrap">
                                    <div class="dropdown">
                                        <button class="cmn-btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="profile-img-wrap-sml">
                                                <img src="{{asset('images/front')}}/profile.png" alt="profile" />
                                            </div>
                                            <p>Hey Feras Mohammed Abed Abu-Hdaib</p>
                                        </button>
                                        <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton1">
                                            <div class="profile-detail-header">
                                                <ul class="text-center">
                                                    <li>
                                                        <div class="profile-main-img mx-auto">
                                                            <img src="{{asset('images/front')}}/profile.png" alt="">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <p>Feras Mohammed Abed Abu-Hdaib</p>
                                                    </li>
                                                    <li>
                                                        <p> <img src="{{asset('images/front')}}/call.svg" alt="call" /> +97145563096</p>
                                                    </li>
                                                    <li>
                                                        <p> <img src="{{asset('images/front')}}/email.svg" alt="email" /> support@silwanarealestate.com</p>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li><a class="dropdown-item" href="#">My Profile</a></li>
                                                    <li><a class="dropdown-item" href="#">My Booking</a></li>
                                                    <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                                                    <li><a class="dropdown-item" href="#">Sign Out</a></li>
                                                </ul>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>


    <!-- Modal -->
    <div class="modal fade" id="signup-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="" class="sign-up-form">
                                <div>
                                    <h2>Sign up</h2>
                                    <p>Please Sign up and explore your dream house from silwana real estate.</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Mobile Number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="password" placeholder="Password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-left">
                                        <button class="cmn-btn w-100">SIGN UP</button>
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
                            <form action="" class="sign-up-form">
                                <div>
                                    <h2>login</h2>
                                    <p>Please Sign up and explore your dream house from silwana real estate.</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-left">
                                        <button class="cmn-btn w-100">Login</button>
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
