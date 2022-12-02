
<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">

                <!-- Dashboard Start -->
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('admin.admin') ? 'active' : '' }}" href="{{ route('admin.admin') }}">
                        <span class="menu-icon">
                            <img src="{{ asset('images/front/dashboard.svg') }}" />
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                <!-- Dashboard  END -->

                <!-- CMS Start -->
                @if (auth()->user()->can('faq-view') || auth()->user()->can('ourTeam-view') ||   auth()->user()->can('aboutUs-view') || auth()->user()->can('news-view') || auth()->user()->can('media-view') || auth()->user()->can('contactus-view') || auth()->user()->can('footer-view'))
                    <div data-kt-menu-trigger="click" class="menu-item {{ Route::is('admin.faq*') || Route::is('admin.ourTeam*') || Route::is('admin.aboutUs*') || Route::is('admin.news*') || Route::is('admin.media*') ||  Route::is('admin.contactus*')  || Route::is('admin.footer')  ? 'show' : '' }} menu-accordion mb-1">
                        <span class="menu-link {{ Route::is('admin.faq*') || Route::is('admin.ourTeam*') || Route::is('admin.aboutUs*') || Route::is('admin.news*') || Route::is('admin.media*') ||  Route::is('admin.contactus*')  || Route::is('admin.footer') ? 'active' : '' }}">
                            <span class="menu-icon">
                                 <img src="{{ asset('images/front/homeCMS.svg') }}" />
                            </span>
                            <span class="menu-title">CMS</span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div class="menu-sub menu-sub-accordion">
                            @can('faq-view')
                                <div class="menu-item {{ Route::is('admin.faq*') ? 'show' : '' }}">
                                    <a class="menu-link" href="{{ route('admin.faq') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">FAQ</span>
                                    </a>
                                </div>
                            @endcan
                        </div>

                        <div class="menu-sub menu-sub-accordion">
                        @can('ourTeam-view')
                            <div class="menu-item {{ Route::is('admin.ourTeam*') ? 'show' : '' }}">
                                <a class="menu-link" href="{{ route('admin.ourTeam') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Our Team</span>
                                </a>
                            </div>
                        @endcan
                    </div>

                        <div class="menu-sub menu-sub-accordion">
                        @can('aboutus-view')
                            <div class="menu-item {{ Route::is('admin.aboutUs*') ? 'show' : '' }}">
                                <a class="menu-link" href="{{ route('admin.aboutUs') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">About Us</span>
                                </a>
                            </div>
                        @endcan
                    </div>

                        <div class="menu-sub menu-sub-accordion">
                            @can('news-view')
                                <div class="menu-item {{ Route::is('admin.news*') ? 'show' : '' }}">
                                    <a class="menu-link" href="{{ route('admin.news') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">News</span>
                                    </a>
                                </div>
                            @endcan
                        </div>

                        <div class="menu-sub menu-sub-accordion">
                            @can('media-view')
                                <div class="menu-item {{ Route::is('admin.media*') ? 'show' : '' }}">
                                    <a class="menu-link" href="{{ route('admin.media') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">Media</span>
                                    </a>
                                </div>
                            @endcan
                        </div>

                        <div class="menu-sub menu-sub-accordion">
                            @can('contactus-view')
                                <div class="menu-item {{ Route::is('admin.contactus*') ? 'show' : '' }}">
                                    <a class="menu-link" href="{{ route('admin.contactus') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">Contact Us</span>
                                    </a>
                                </div>
                            @endcan
                        </div>

                        <div class="menu-sub menu-sub-accordion">
                            @can('footer-view')
                                <div class="menu-item {{ Route::is('admin.footer*') ? 'show' : '' }}">
                                    <a class="menu-link" href="{{ route('admin.footer') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">Footer</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endif
                <!-- CMS END -->

                <!-- HOme CMS Start -->
                @if (auth()->user()->can('aboutUsHome-view') || auth()->user()->can('investmentHome-view') || auth()->user()->can('ourProjectHome-view') || auth()->user()->can('featureProjectHome-view') )
                   <div data-kt-menu-trigger="click" class="menu-item {{ Route::is('admin.aboutUsHome*') || Route::is('admin.investmentHome*')  || Route::is('admin.ourProjectHome*')  || Route::is('admin.featureProjectHome*')  ? 'show' : '' }} menu-accordion mb-1">
                       <span class="menu-link {{ Route::is('admin.aboutUsHome*') || Route::is('admin.investmentHome*')  || Route::is('admin.ourProjectHome*')  || Route::is('admin.featureProjectHome*')   ? 'active' : '' }}">
                       <span class="menu-icon">
                            <img src="{{ asset('images/front/homeCMS.svg') }}" />
                       </span>
                       <span class="menu-title">Home CMS</span>
                       <span class="menu-arrow"></span>
                   </span>

                        <div class="menu-sub menu-sub-accordion">
                           @can('aboutUsHome-view')
                               <div class="menu-item {{ Route::is('admin.aboutUsHome*') ? 'show' : '' }}">
                                   <a class="menu-link" href="{{ route('admin.aboutUsHome') }}">
                                   <span class="menu-bullet">
                                       <span class="bullet bullet-dot"></span>
                                   </span>
                                       <span class="menu-title">About Us Home</span>
                                   </a>
                               </div>
                           @endcan
                       </div>

                        <div class="menu-sub menu-sub-accordion">
                           @can('investmentHome-view')
                               <div class="menu-item {{ Route::is('admin.investmentHome*') ? 'show' : '' }}">
                                   <a class="menu-link" href="{{ route('admin.investmentHome') }}">
                                   <span class="menu-bullet">
                                       <span class="bullet bullet-dot"></span>
                                   </span>
                                       <span class="menu-title">Investment Home</span>
                                   </a>
                               </div>
                           @endcan
                       </div>

                        <div class="menu-sub menu-sub-accordion">
                       @can('ourProjectHome-view')
                           <div class="menu-item {{ Route::is('admin.ourProjectHome*') ? 'show' : '' }}">
                               <a class="menu-link" href="{{ route('admin.ourProjectHome') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                   <span class="menu-title">Our Project Home</span>
                               </a>
                           </div>
                       @endcan
                   </div>

                        <div class="menu-sub menu-sub-accordion">
                       @can('featureProjectHome-view')
                           <div class="menu-item {{ Route::is('admin.featureProjectHome*') ? 'show' : '' }}">
                               <a class="menu-link" href="{{ route('admin.featureProjectHome') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                   <span class="menu-title">Feature Project Home</span>
                               </a>
                           </div>
                       @endcan
                   </div>

                    </div>
                @endif
                <!-- HOmeCMS END -->

                <!-- Sales CMS Start -->
                @if (auth()->user()->can('investService-view') || auth()->user()->can('buildingService-view') || auth()->user()->can('rentalService-view') || auth()->user()->can('salesService-view') )
                    <div data-kt-menu-trigger="click" class="menu-item {{ Route::is('admin.investService*') || Route::is('admin.buildingService*')  || Route::is('admin.rentalService*')  || Route::is('admin.salesService*')  ? 'show' : '' }} menu-accordion mb-1">
                        <span class="menu-link {{ Route::is('admin.investService*') || Route::is('admin.buildingService*')  || Route::is('admin.rentalService*')  || Route::is('admin.salesService*')   ? 'active' : '' }}">
                           <span class="menu-icon">
                                <img src="{{ asset('images/front/homeCMS.svg') }}" />
                           </span>
                           <span class="menu-title">Sales CMS</span>
                           <span class="menu-arrow"></span>
                       </span>

                        <div class="menu-sub menu-sub-accordion">
                       @can('investService-view')
                           <div class="menu-item {{ Route::is('admin.investService*') ? 'show' : '' }}">
                               <a class="menu-link" href="{{ route('admin.investService') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                   <span class="menu-title">Investment  </span>
                               </a>
                           </div>
                       @endcan
                   </div>

                        <div class="menu-sub menu-sub-accordion">
                       @can('buildingService-view')
                           <div class="menu-item {{ Route::is('admin.buildingService*') ? 'show' : '' }}">
                               <a class="menu-link" href="{{ route('admin.buildingService') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                   <span class="menu-title">Building Management</span>
                               </a>
                           </div>
                       @endcan
                   </div>

                        <div class="menu-sub menu-sub-accordion">
                       @can('rentalService-view')
                           <div class="menu-item {{ Route::is('admin.rentalService*') ? 'show' : '' }}">
                               <a class="menu-link" href="{{ route('admin.rentalService') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                   <span class="menu-title">Rental</span>
                               </a>
                           </div>
                       @endcan
                   </div>

                        <div class="menu-sub menu-sub-accordion">
                       @can('salesService-view')
                           <div class="menu-item {{ Route::is('admin.salesService*') ? 'show' : '' }}">
                               <a class="menu-link" href="{{ route('admin.salesService') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                   <span class="menu-title">Sales</span>
                               </a>
                           </div>
                       @endcan
                   </div>

                     </div>
                @endif
                <!-- Sales CMS END -->

                @if (auth()->user()->can('category-view') || auth()->user()->can('amenities-view'))
                <div data-kt-menu-trigger="click" class="menu-item {{ Route::is('admin.category*') ||  Route::is('admin.amenities*') ? 'show' : '' }} menu-accordion mb-1">
                   <span class="menu-link {{ Route::is('admin.category*') ||  Route::is('admin.amenities*') ? 'active' : '' }}">
                       <span class="menu-icon">
                           <img src="{{ asset('images/front/masters (1).svg') }}" />
                       </span>
                       <span class="menu-title">Masters</span>
                       <span class="menu-arrow"></span>
                   </span>

                   <div class="menu-sub menu-sub-accordion">
                       @can('category-view')
                           <div class="menu-item {{ Route::is('admin.category*') ? 'show' : '' }}">
                               <a class="menu-link" href="{{ route('admin.category') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                   <span class="menu-title">Category</span>
                               </a>
                           </div>
                       @endcan
                   </div>
                   <div class="menu-sub menu-sub-accordion">
                       @can('amenities-view')
                           <div class="menu-item {{ Route::is('admin.amenities*') ? 'show' : '' }}">
                               <a class="menu-link" href="{{ route('admin.amenities') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                   <span class="menu-title">Amenities</span>
                               </a>
                           </div>
                       @endcan
                   </div>
                </div>
                @endif

                <!-- Projects Start -->
                @if (auth()->user()->can('project-view') || auth()->user()->can('block-view') || auth()->user()->can('floor-view') || auth()->user()->can('unit-view') || auth()->user()->can('projectAssign-view') )
                    <div data-kt-menu-trigger="click" class="menu-item {{   Route::is('admin.project*') || Route::is('admin.block*') || Route::is('admin.floor*') ||Route::is('admin.unit*') ||  Route::is('admin.projectAssign*') ? 'show' : '' }} menu-accordion mb-1">
                        <span class="menu-link {{   Route::is('admin.project*') || Route::is('admin.block*') || Route::is('admin.floor*') ||Route::is('admin.unit*') ||  Route::is('admin.projectAssign*') ? 'active' : '' }}">
                       <span class="menu-icon">
                           <img src="{{ asset('images/front/project.svg') }}" />
                       </span>
                       <span class="menu-title">Projects</span>
                       <span class="menu-arrow"></span>
                   </span>

                        <div class="menu-sub menu-sub-accordion">
                       @can('project-view')
                           <div class="menu-item {{ Route::is('admin.project*') ? 'show' : '' }}">
                               <a class="menu-link" href="{{ route('admin.project') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                   <span class="menu-title">Project</span>
                               </a>
                           </div>
                       @endcan
                   </div>

                        <div class="menu-sub menu-sub-accordion">
                           @can('block-view')
                               <div class="menu-item {{ Route::is('admin.block*') ? 'show' : '' }}">
                                   <a class="menu-link" href="{{ route('admin.block') }}">
                                   <span class="menu-bullet">
                                       <span class="bullet bullet-dot"></span>
                                   </span>
                                       <span class="menu-title">Block</span>
                                   </a>
                               </div>
                           @endcan
                       </div>

                        <div class="menu-sub menu-sub-accordion">
                       @can('floor-view')
                           <div class="menu-item {{ Route::is('admin.floor*') ? 'show' : '' }}">
                               <a class="menu-link" href="{{ route('admin.floor') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                   <span class="menu-title">Floor</span>
                               </a>
                           </div>
                       @endcan
                   </div>

                        <div class="menu-sub menu-sub-accordion">
                           @can('unit-view')
                               <div class="menu-item {{ Route::is('admin.unit*') ? 'show' : '' }}">
                                   <a class="menu-link" href="{{ route('admin.unit') }}">
                                   <span class="menu-bullet">
                                       <span class="bullet bullet-dot"></span>
                                   </span>
                                       <span class="menu-title">Unit</span>
                                   </a>
                               </div>
                           @endcan
                       </div>

                        <div class="menu-sub menu-sub-accordion">
                        @can('projectAssign-view' )
                            <div class="menu-item {{ Route::is('admin.projectAssign*') ? 'show' : '' }}">
                                <a class="menu-link" href="{{ route('admin.projectAssign') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                    <span class="menu-title">Project Assign</span>
                                </a>
                            </div>
                        @endcan
                        </div>

                    </div>
                @endif
                <!-- Projects END -->

                <!-- User Management Start -->
                @if (auth()->user()->can('user-view') || auth()->user()->can('role-view') || auth()->user()->can('permission-view')  )
                    <div data-kt-menu-trigger="click" class="menu-item {{  Route::is('admin.user*') || Route::is('admin.permission*') || Route::is('admin.role*') ? 'show' : '' }} menu-accordion mb-1">

                        <span class="menu-link {{  Route::is('admin.user*') || Route::is('admin.permission*') || Route::is('admin.role*') ? 'active' : '' }}">
                           <span class="menu-icon">
                             <img src="{{ asset('images/front/user_managment.svg') }}" />
                           </span>
                           <span class="menu-title">User Management</span>
                           <span class="menu-arrow"></span>
                       </span>

                        <div class="menu-sub menu-sub-accordion">
                        @can('user-view')
                            <div class="menu-item {{ Route::is('admin.user*') ? 'show' : '' }}">
                                <a class="menu-link" href="{{ route('admin.user') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">User</span>
                                </a>
                            </div>
                        @endcan

                     <!--    @can('role-view')
                       <div class="menu-item {{ Route::is('admin.role*') ? 'show' : '' }}">
                           <a class="menu-link" href="{{ route('admin.role') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                               <span class="menu-title">Role</span>
                           </a>
                       </div>
                       @endcan

                       @can('permission-view')
                       <div class="menu-item {{ Route::is('admin.permission*') ? 'show' : '' }}">
                           <a class="menu-link" href="{{ route('admin.permission') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                               <span class="menu-title">Permissions</span>
                           </a>
                       </div>
                       @endcan -->
                   </div>
                </div>
                @endif
                <!--  User Management END -->

                <!--Booking Start -->
                @if (auth()->user()->can('bookMeeting-view') || auth()->user()->can('propertyBooking-view'))
                    <div data-kt-menu-trigger="click" class="menu-item {{   Route::is('admin.bookMeeting*') || Route::is('admin.booking*')  ? 'show' : '' }} menu-accordion mb-1">

                       <span class="menu-link {{ Route::is('admin.bookMeeting*') || Route::is('admin.booking*')  ? 'active' : '' }}">
                           <span class="menu-icon">
                               <img src="{{ asset('images/front/bookings.svg') }}" />
                           </span>
                           <span class="menu-title">Bookings</span>
                           <span class="menu-arrow"></span>
                       </span>

                       <div class="menu-sub menu-sub-accordion">
                           @can('propertyBooking-list')
                               <div class="menu-item {{ Route::is('admin.booking*') ? 'show' : '' }}">
                                   <a class="menu-link" href="{{ route('admin.booking') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                       <span class="menu-title">Property Booking </span>
                                   </a>
                               </div>
                           @endcan
                       </div>

                       <div class="menu-sub menu-sub-accordion">
                           @can('bookMeeting-view')
                               <div class="menu-item {{ Route::is('admin.bookMeeting*') ? 'show' : '' }}">
                                   <a class="menu-link" href="{{ route('admin.bookMeeting') }}">
                               <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                               </span>
                                       <span class="menu-title">Book Meeting</span>
                                   </a>
                               </div>
                           @endcan
                       </div>
                   </div>
                @endif
                <!-- Booking END -->

                <!--Inquiry Start -->
                @can('inquiry-view')
                   <div class="menu-item {{ Route::is('admin.inquiry*') ? 'show' : '' }}">
                       <a class="menu-link" href="{{ route('admin.inquiry') }}">
                              <span class="menu-icon">
                            <img src="{{ asset('images/front/inquiry.svg') }}" />
                       </span>
                           <span class="menu-title">Inquiry</span>
                       </a>
                   </div>
                @endcan
                <!-- Inquiry END -->

            </div>
                <!--end::Menu-->
        </div>
                <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
    <!--begin::Footer-->
    <!--begin::Aside Toolbarl-->
    <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
    <!--begin::Aside user-->
    <!--begin::User-->
    <div class="aside-user d-flex align-items-sm-center justify-content-center py-4">
    <!--end::Symbol-->
    <!--begin::Wrapper-->
    <div class="aside-user-info flex-row-fluid flex-wrap ">
    <!--begin::Section-->
    <div class="d-flex">
       <!--begin::Info-->
       <div class="flex-grow-1 me-2">
           <!--begin::Username-->
           <a href="#" class="text-white text-hover-primary fs-6 fw-bold">{{ auth()->user()->name }}</a>
           <!--end::Username-->
           <!--begin::Description-->
           <span class="text-gray-600 fw-bold d-block fs-8 mb-1">{{ auth()->user()->email }}</span>
           <!--end::Description-->
       </div>
       <!--end::Info-->
       <!--begin::User menu-->
       <div class="me-n2">
           <!--begin::Action-->
           <a href="#" class="btn btn-icon btn-sm btn-active-color-primary mt-n2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
               <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
               <span class="svg-icon svg-icon-muted svg-icon-1">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                       <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="black" />
                       <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="black" />
                   </svg>
               </span>
               <!--end::Svg Icon-->
           </a>
           <!--begin::Menu-->
           <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
               <!--begin::Menu item-->
               <div class="menu-item px-3">
                   <div class="menu-content d-flex align-items-center px-3">
                       <!--begin::Avatar-->
                       <div class="symbol symbol-50px me-5">
                           <img  src="{{ !empty(auth()->user()->image)  ? asset('images/user/'.auth()->user()->image) : asset('images/front/noProfile.jpeg')}}" />
                       </div>
                       <!--end::Avatar-->
                       <!--begin::Username-->
                       <div class="d-flex flex-column">
                           <div class="fw-bolder d-flex align-items-center fs-5">{{ auth()->user()->name }}
                           <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2"> </span></div>
                           <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                       </div>
                       <!--end::Username-->
                   </div>
               </div>
               <!--end::Menu item-->
               <!--begin::Menu separator-->
               <div class="separator my-2"></div>
               <!--end::Menu separator-->
               <!--begin::Menu item-->
               <div class="menu-item px-5">
                   <a href="{{route('admin.user.profile')}}" class="menu-link px-5">My Profile</a>
               </div>
               <!--end::Menu item-->
               <!--begin::Menu item-->
               <div class="menu-item px-5">
                   <form method="POST" id="logout_form" action={{ route('logout') }}>
                       @csrf
                       <a href="javascript:{}" onclick="document.getElementById('logout_form').submit();" class="menu-link px-5 bg-light-danger">Logout</a>
                   </form>
               </div>
               <!--end::Menu item-->

           </div>
           <!--end::Menu-->
           <!--end::Action-->
       </div>
       <!--end::User menu-->
    </div>
    <!--end::Section-->
    </div>
    <!--end::Wrapper-->
    </div>
    <!--end::User-->
    <!--end::Aside user-->
    </div>
    <!--end::Aside Toolbarl-->
    <!--end::Footer-->
</div>
