<div class="app-menu">

    <!-- Sidenav Brand Logo -->
    <a href="index.html" class="logo-box">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <img src="{{ asset('assets/images/logo-light.png') }}" class="logo-lg h-6" alt="Light logo">
            <img src=" {{ asset('assets/images/logo-sm.png') }}" class="logo-sm" alt="Small logo">
        </div>

        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <img src="{{ asset('assets/images/logo-dark.png') }}" class="logo-lg h-6" alt="Dark logo">
            <img src="{{ asset('assets/images/logo-sm.png') }} " class="logo-sm" alt="Small logo">
        </div>
    </a>

    <!-- Sidenav Menu Toggle Button -->
    <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
        <span class="sr-only">Menu Toggle Button</span>
        <i class="mgc_round_line text-xl"></i>
    </button>

    <!--- Menu -->
    <div class="srcollbar" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                        aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <ul class="menu" data-fc-type="accordion">
                                <li class="menu-title">Menu</li>

                                <li class="menu-item">
                                    <a href="{{ route('admin.dashboard') }}" class="{{ (Route::is('admin.dashboard')) ? 'active' : '' }} menu-link">
                                        <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                                        <span class="menu-text"> Dashboard </span>
                                    </a>
                                </li>


                                <li class="menu-item">
                                    <a href="{{ route('admin.students')}}" class="menu-link">
                                        <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                                        <span class="menu-text"> Students </span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="{{route('admin.advocates')}}" class="menu-link">
                                        <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                                        <span class="menu-text"> Advocates </span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <a href="{{route('admin.pages.home')}}"  class="menu-link">
                                        <span class="menu-icon"><i class="mgc_box_3_line"></i></span>
                                        <span class="menu-text"> Home Page </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <a href="{{route('admin.pages.blog.display')}}"  class="menu-link">
                                        <span class="menu-icon"><i class="mgc_pen_3_line"></i></span>
                                        <span class="menu-text"> Blog </span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    {{-- <a href="{{route('admin.pages')}}" data-fc-type="collapse" class="menu-link fc-collapse">
                                        <span class="menu-icon"><i class="mgc_box_3_line"></i></span>
                                        <span class="menu-text"> Event Page </span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <a href="{{route('admin.pages')}}" data-fc-type="collapse" class="menu-link fc-collapse">
                                        <span class="menu-icon"><i class="mgc_box_3_line"></i></span>
                                        <span class="menu-text"> Blog Page </span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <a href="{{route('admin.pages')}}" data-fc-type="collapse" class="menu-link fc-collapse">
                                        <span class="menu-icon"><i class="mgc_box_3_line"></i></span>
                                        <span class="menu-text"> Faq Page </span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                    <a href="{{route('admin.pages')}}" data-fc-type="collapse" class="menu-link fc-collapse">
                                        <span class="menu-icon"><i class="mgc_box_3_line"></i></span>
                                        <span class="menu-text"> Contact-US Page </span>
                                        <span class="menu-arrow"></span>
                                    </a> --}}

                                </li>


                            </ul>



                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 1281px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 218px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div>
</div>
