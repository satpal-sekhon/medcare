<div class="sidebar-wrapper">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="{{ route('admin-dashboard') }}" data-bs-original-title="" title="">
                <img class="img-fluid for-white" src="{{ asset('assets/images/logo/1.png') }}" alt="logo">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ route('admin-dashboard') }}">
                <img class="img-fluid main-logo main-white" src="{{ asset('assets/images/logo/2.png') }}" alt="logo">
                <img class="img-fluid main-logo main-dark" src="{{ asset('assets/images/logo/1.png') }}" alt="logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"></li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin-dashboard') }}">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>Manage Categories</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.primary-categories.index') }}">Primary Categories</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.categories.index') }}">Categories</a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('admin.sub-categories.index') }}">Sub Categories</a>
                            </li> --}}
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Brands</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.brands.index') }}">Brands</a>
                            </li>

                            <li>
                                <a href="{{ route('brands.create') }}">Add New brand</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Diseases</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.diseases.index') }}">Diseases</a>
                            </li>

                            <li>
                                <a href="{{ route('diseases.create') }}">Add New Disease</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.products.index') }}">Products</a>
                            </li>

                            <li>
                                <a href="{{ route('products.create') }}">Add New Product</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-group-line"></i>
                            <span>User Accounts</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.users.index') }}">Manage Users</a>
                            </li>
                            <li>
                                <a href="#">Banned Users</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-file-user-line"></i>
                            <span>Vendor</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="#">Manage Vendors</a>
                            </li>
                            <li>
                                <a href="#">New Registration</a>
                            </li>
                            <li>
                                <a href="#">Approve Vendor</a>
                            </li>
                            <li>
                                <a href="#">Banned Vendors</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.coupons.index') }}">
                            <i class="ri-coupon-line"></i>
                            <span>Coupon/Offers</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="#">
                            <i class="ri-survey-line"></i>
                            <span>Transactions</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-unordered"></i>
                            <span>Orders</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="">Product Orders</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.quick-orders.index') }}">Quick Orders</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.lab-package-orders.index') }}">Lab Package Orders</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.doctor-consultations.index') }}">Doctor Consultations</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-nurse-line"></i>
                            <span>Doctors</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.doctor-types.index') }}">Doctor Types</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.doctors.index') }}">Manage Doctors</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="#">
                            <i class="ri-store-2-line"></i>
                            <span>Pharmacy Stores</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-nurse-line"></i>
                            <span>Lab Packages</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.lab-tests.index') }}">Lab Tests</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.lab-packages.index') }}">Lab Packages</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-settings-line"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="#">Site Settings</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.settings.general') }}">General Settings</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
</div>