<div class="app-menu">

    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="logo-box">
        <div class="logo-light">
            <img src="{{ asset('assets/images/logo-light.png') }}" class="logo-lg h-6" alt="Eureka">
            <img src="{{ asset('assets/images/logo-sm.png') }}" class="logo-sm" alt="Eureka">
        </div>
        <div class="logo-dark">
            <img src="{{ asset('assets/images/logo-dark.png') }}" class="logo-lg h-6" alt="Eureka">
            <img src="{{ asset('assets/images/logo-sm.png') }}" class="logo-sm" alt="Eureka">
        </div>
    </a>

    <!-- Menu Toggle -->
    <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
        <span class="sr-only">Toggle</span>
        <i class="mgc_round_line text-xl"></i>
    </button>

    <!-- Menu Content -->
    <div class="srcollbar" data-simplebar>
        <ul class="menu" data-fc-type="accordion">

            {{-- Dashboard --}}
            <li class="menu-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ Route::is('admin.dashboard') ? 'active' : '' }} menu-link">
                    <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            {{-- Users --}}
            <li class="menu-item">
                <a href="#sidebarUsers" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_group_line"></i></span>
                    <span class="menu-text">Users</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="sub-menu collapse hidden" id="sidebarUsers">
                    <li class="menu-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="{{ Route::is('admin.users*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">All Users</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.students') }}"
                            class="{{ Route::is('admin.students') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Students</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.advocates') }}"
                            class="{{ Route::is('admin.advocates') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Advocates</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.volunteers') }}"
                            class="{{ Route::is('admin.volunteers*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Volunteers</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Academics --}}
            <li class="menu-item">
                <a href="#sidebarAcademics" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_book_line"></i></span>
                    <span class="menu-text">Academics</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="sub-menu collapse hidden" id="sidebarAcademics">
                    <li class="menu-item">
                        <a href="{{ route('admin.exams.index') }}"
                            class="{{ Route::is('admin.exams*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Exams</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.schools.index') }}"
                            class="{{ Route::is('admin.schools*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Schools</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.categories.index') }}"
                            class="{{ Route::is('admin.categories*') || Route::is('admin.subjects*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Categories</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.competitions.index') }}"
                            class="{{ Route::is('admin.competitions*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Competitions</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.results.index') }}"
                            class="{{ Route::is('admin.results*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Results</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Content --}}
            <li class="menu-item">
                <a href="#sidebarContent" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_document_line"></i></span>
                    <span class="menu-text">Content</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="sub-menu collapse hidden" id="sidebarContent">
                    <li class="menu-item">
                        <a href="{{ route('admin.materials.index') }}"
                            class="{{ Route::is('admin.materials*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Materials</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.pages.blog.display') }}"
                            class="{{ Route::is('admin.pages.blog*') || Route::is('admin.pages.update.blog*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Blog</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.pages.events.display') }}"
                            class="{{ Route::is('admin.pages.events*') || Route::is('admin.pages.update.event*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Events</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.pages.home') }}"
                            class="{{ Route::is('admin.pages.home*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Home Page</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Billing --}}
            <li class="menu-item">
                <a href="#sidebarBilling" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_bank_card_line"></i></span>
                    <span class="menu-text">Billing</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="sub-menu collapse hidden" id="sidebarBilling">
                    <li class="menu-item">
                        <a href="{{ route('admin.billing.plans') }}"
                            class="{{ Route::is('admin.billing.plans*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Credit Plans</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.billing.costs') }}"
                            class="{{ Route::is('admin.billing.costs*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Feature Costs</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.billing.subscriptions') }}"
                            class="{{ Route::is('admin.billing.subscriptions*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Subscriptions</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.billing.payments') }}"
                            class="{{ Route::is('admin.billing.payments') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Payments</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.billing.adjust') }}"
                            class="{{ Route::is('admin.billing.adjust*') ? 'active' : '' }} menu-link">
                            <span class="menu-text">Adjust Credits</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Notifications --}}
            <li class="menu-item">
                <a href="{{ route('admin.notifications.index') }}"
                    class="{{ Route::is('admin.notifications*') ? 'active' : '' }} menu-link">
                    <span class="menu-icon"><i class="mgc_notification_line"></i></span>
                    <span class="menu-text">Notifications</span>
                </a>
            </li>

            {{-- Sign Out --}}
            <li class="menu-item">
                <a href="{{ route('admin.logout') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_exit_line"></i></span>
                    <span class="menu-text">Sign Out</span>
                </a>
            </li>

        </ul>
    </div>
</div>
