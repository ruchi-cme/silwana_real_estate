<x-base>
<x-banner title="My Profile" page="My Profile"></x-banner>

    <!-- profile -->
    <section class="profile p-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="profile-wrapper">
                        <div class="row align-items-center">
                            <div class="col-lg-2">
                                <div class="profile-main-img">
                                    <img src="{{ $userData['imageSrc'] }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="profile-detail">
                                    <div>
                                        <p>Full Name</p>
                                        <h6>{{ $userData['name'] }}</h6>
                                    </div>
                                    <div class="d-flex profile-detail-main">
                                        <div class="profile-detail-inner">
                                            <p>Mobile Number</p>
                                            <h6>{{ $userData['phone'] }}</h6>
                                        </div>
                                        <div class="profile-detail-inner">
                                            <p>Email</p>
                                            <h6>{{ $userData['email'] }}</h6>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="cmn-btn edit-profile-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">EDIT PROFILE <img src="./assets/images/edit.svg" alt=""> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!--  <section class="portfolio-list my-booking my-profile-wrap">
        <div class="container position-relative">
            <img src="./assets/images/home/plan3.svg" class="our-amenities-plan img3" alt="">
            <img src="./assets/images/home/plan4.svg" class="our-amenities-plan img4" alt="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <h2 class="mt-0">MY BOOKING</h2>
                    </div>
                    <div class="project-feature-wrap">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <div class="project-feature-img">
                                    <img src="./assets/images/home/feature1.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="upcoming-projects-wrap title mb-0">
                                    <span class="btn btn-2">Apartment</span>
                                    <h2>Furnished | 4 BR + Maids</h2>
                                    <h6>5137 Compton Ave, Los Angeles</h6>
                                    <h3>AED 12,500,000</h3>
                                    <a href="#" class="cmn-btn">CANCEL BOOKING</a>
                                    <a href="#" class="cmn-btn ms-xl-3">VIEW MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project-feature-wrap">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <div class="project-feature-img">
                                    <img src="./assets/images/home/feature1.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="upcoming-projects-wrap title mb-0">
                                    <span class="btn btn-2">Apartment</span>
                                    <h2>Furnished | 4 BR + Maids</h2>
                                    <h6>5137 Compton Ave, Los Angeles</h6>
                                    <h3>AED 12,500,000</h3>
                                    <a href="#" class="cmn-btn">CANCEL BOOKING</a>
                                    <a href="#" class="cmn-btn ms-xl-3">VIEW MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

</x-base>
<!-- Modal -->
<div class="modal fade edit-profile-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0 text-center">
                <div class=" mx-auto">
                    <h5 class="modal-title text-center" id="exampleModalLabel">edit profile</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form onsubmit="validationForm()" action="{{route('myProfile/update')}}" method="post" class="edit-profile-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="edit-profile-circle">
                                <div class="circle">
                                    <img class="profile-pic" src="{{ $userData['imageSrc'] }}">
                                </div>
                                <div class="p-image">
                                    <i class="fas fa-pen upload-button"></i>
                                    <input class="file-upload" type="file" name="image" accept="image/*"/>
                                    <input  type="hidden" name="edit_image" value="{{ $userData['image'] }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" name="firstname" value="{{ !empty($userData['firstname'])? $userData['firstname'] : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" name="lastname" value="{{ !empty($userData['lastname'])? $userData['lastname'] : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="">Mobile Number</label>
                            <input type="text" class="form-control"  name="phone"  value="{{  !empty($userData['phone'])? $userData['phone'] :'' }}">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control"   name="email"   value="{{ !empty($userData['email']) ? $userData['email'] :'' }}">
                        </div>
                        <div class="form-group mb-0 d-flex justify-content-between">
                            <input type="hidden" name="user_id" value="{{!empty($userData['id']) ? $userData['id']  : ''}}">
                            <button type="button" class="cmn-btn" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="cmn-btn">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 
