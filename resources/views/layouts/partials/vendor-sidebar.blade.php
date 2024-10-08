<div class="sidebar-wrapper">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="{{ route('vendor-dashboard') }}" data-bs-original-title="" title="">
                <img class="img-fluid for-white" src="{{ asset(getSetting('site_logo_1')) }}" alt="logo">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ route('vendor-dashboard') }}">
                <img class="img-fluid main-logo main-white" src="{{ asset(getSetting('site_logo_2')) }}" alt="logo">
                <img class="img-fluid main-logo main-dark" src="{{ asset(getSetting('site_logo_1')) }}" alt="logo">
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
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('vendor-dashboard') }}">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('vendor.my-orders') }}">
                            <i class="ri-shopping-basket-line"></i>
                            <span>My Orders</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('vendor.orders') }}">
                            <i class="ri-list-unordered"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('vendor.bills') }}">
                            <i class="ri-bill-line"></i>
                            <span>Bills</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
</div>