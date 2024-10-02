<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Heal Deal</title>

    @stack('meta')

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bulk-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    @stack('styles')

    @vite('resources/js/app.js')
</head>

<body class="bg-effect">
    <div id="vue-components">
        <!-- Header Start -->
        <header class="pb-0">
            @php
            $banner_notifications = \App\Models\HomePage::select('top_header_text')->find(1)->top_header_text ?? null;
            $banner_notifications = json_decode($banner_notifications, true) ?? [];
            @endphp

            @if(count($banner_notifications) > 0)
            <div class="header-top">
                <div class="container-fluid-lg">
                    <div class="row">
                        <div class="col-xxl-12 col-lg-12 d-lg-block d-none mx-auto">
                            <div class="header-offer">
                                <div class="notification-slider">
                                    @foreach ($banner_notifications as $notification)
                                    <div>
                                        <div class="timer-notification text-center">
                                            <h6>{{ $notification }}</h6>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endif

            <div class="top-nav top-header sticky-header">
                <div class="container-fluid-lg">
                    <div class="row">
                        <div class="col-12">
                            <div class="navbar-top">
                                <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                    <span class="navbar-toggler-icon">
                                        <i class="fa-solid fa-bars"></i>
                                    </span>
                                </button>
                                <a href="{{ route('home') }}" class="web-logo nav-logo">
                                    <img src="{{ asset('assets/images/logo/1.png') }}" class="img-fluid lazyload"
                                        alt="">
                                </a>

                                <search-bar></search-bar>

                                <div class="rightside-box">
                                    <div class="search-full">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i data-feather="search" class="font-light"></i>
                                            </span>
                                            <input type="text" class="form-control search-type"
                                                placeholder="Search here..">
                                            <span class="input-group-text close-search">
                                                <i data-feather="x" class="font-light"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <ul class="right-side-menu">
                                        <li class="right-side">
                                            <div class="delivery-login-box">
                                                <div class="delivery-icon">
                                                    <div class="search-box">
                                                        <i data-feather="search"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="right-side">
                                            <a href="{{ route('my-account.notifications') }}" class="btn p-0 position-relative header-wishlist">
                                                <div class="delivery-icon">
                                                    <i data-feather="bell"></i>

                                                    @if (auth()->user())
                                                        <span @class(["position-absolute top-0 start-100 translate-middle badge wishlist-count", 'd-none' => auth()->user()->unreadNotifications()->count() === 0])>
                                                            {{ auth()->user()->unreadNotifications()->count() }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </a>
                                        </li>
                                        <li class="right-side">
                                            <a href="{{ route('wishlist.index') }}" class="btn p-0 position-relative header-wishlist">
                                                <i data-feather="heart"></i>
                                                <span @class(["position-absolute top-0 start-100 translate-middle badge wishlist-count", 'd-none' => count(session()->get('wishlist', [])) === 0])>
                                                    {{ count(session()->get('wishlist', [])) }}
                                                </span>
                                            </a>
                                        </li>
                                        <li class="right-side">
                                            <div class="onhover-dropdown header-badge">
                                                <mini-cart></mini-cart>
                                            </div>
                                        </li>
                                        <li class="right-side onhover-dropdown">
                                            <div class="delivery-login-box">
                                                <div class="delivery-icon">
                                                    <i data-feather="user"></i>
                                                </div>
                                                <div class="delivery-detail">
                                                    <h6>Hello,</h6>
                                                    @guest
                                                    <h5>Guest User</h5>
                                                    @endguest

                                                    @auth
                                                    <h5>{{ auth()->user()->name }}</h5>
                                                    @endauth
                                                </div>
                                            </div>

                                            <div class="onhover-div onhover-div-login">
                                                <ul class="user-box-name">
                                                    @guest
                                                    <li class="product-box-contain">
                                                        <a href="{{ route('login') }}">Log In</a>
                                                    </li>

                                                    <li class="product-box-contain">
                                                        <a href="{{ route('sign-up') }}">Register</a>
                                                    </li>

                                                    <li class="product-box-contain">
                                                        <a href="{{ route('vendor-registration') }}">Vendor Registration</a>
                                                    </li>

                                                    <li class="product-box-contain">
                                                        <a href="{{ route('forgot-password') }}">Forgot Password</a>
                                                    </li>
                                                    @endguest

                                                    @auth
                                                    <li class="product-box-contain">
                                                        <a href="{{ route('my-account') }}">My Account</a>
                                                    </li>
                                                    <li class="product-box-contain">
                                                        <a href="{{ route('logout') }}">Logout</a>
                                                    </li>
                                                    @endauth
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid-lg py-md-2 mob-height-0">
                <div class="row">
                    <div class="col-12">
                        <div class="header-nav">
                            <div class="header-nav-left">
                                <button class="dropdown-category text-uppercase">
                                    <i data-feather="align-left"></i>
                                    <span>{{ $menus->first()->label }}</span>
                                </button>

                                <div class="category-dropdown">
                                    <div class="category-title">
                                        <h5>{{ $menus->first()->label }}</h5>
                                        <button type="button" class="btn p-0 close-button text-content">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>

                                    @if(isset($menuPrimaryCategories))
                                    <ul class="category-list">
                                        @foreach ($menuPrimaryCategories as $menuPrimaryCategory)
                                        <li class="onhover-category-list">
                                            <a href="{{ route('primary-category.view', $menuPrimaryCategory->slug) }}" class="category-name">
                                                <h6>{{ $menuPrimaryCategory->name }}</h6>
                                                <i class="fa-solid fa-angle-right"></i>
                                            </a>

                                            <div class="onhover-category-box d-block">
                                                <h5 class="text-center fw-bold d-none d-md-block">{{ $menuPrimaryCategory->name }}</h5>

                                                <div class="flex">
                                                    <div class="list-1">
                                                        <ul>
                                                            @foreach($menuPrimaryCategory->categories->take(8) as $category)
                                                            <li>
                                                                <a href="{{ route('category.view', $category->slug) }}">{{ $category->name }}</a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                    <div class="list-2">
                                                        <ul>
                                                            @foreach($menuPrimaryCategory->categories->skip(8)->take(8) as $category)
                                                            <li>
                                                                <a href="{{ route('category.view', $category->slug) }}">{{ $category->name }}</a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                            </div>

                            <div class="header-nav-middle">
                                <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky text-uppercase">
                                    <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                        <div class="offcanvas-header navbar-shadow">
                                            <h5>Menu</h5>
                                            <button class="btn-close lead" type="button"
                                                data-bs-dismiss="offcanvas"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <ul class="navbar-nav">
        @foreach($menus->skip(1)->take(6) as $item)
        <li @class(["nav-item", 'dropdown' => $item->is_dropdown])>
            @if($item->is_dropdown)
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown">{{ $item->label }}</a>
                <ul class="dropdown-menu">
                    @foreach($item->children as $child)
                        <li>
                            <a class="dropdown-item" href="{{ $child->route_name ? route($child->route_name): '#' }}">{{ $child->label }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <a class="nav-link" href="{{ $item->route_name ? route($item->route_name) : '#' }}">{{ $item->label }}</a>
            @endif
        </li>
    @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="header-nav-right">
                                <a href="{{ route($menus->last()->route_name) }}">
                                    <button class="btn deal-button">
                                        <i data-feather="zap"></i>
                                        <span>{{ $menus->last()->label }}</span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header End -->

        <!-- mobile fix menu start -->
        <div class="mobile-menu d-md-none d-block mobile-cart">
            <ul>
                <li class="active">
                    <a href="{{ route('home') }}">
                        <i class="iconly-Home icli"></i>
                        <span>Home</span>
                    </a>
                </li>

                <li class="mobile-category">
                    <a href="javascript:void(0)">
                        <i class="iconly-Category icli js-link"></i>
                        <span>Wellness</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="search-box">
                        <i class="iconly-Search icli"></i>
                        <span>Search</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('wishlist.index') }}" class="notifi-wishlist">
                        <i class="iconly-Heart icli"></i>
                        <span>My Wish</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('cart') }}">
                        <i class="iconly-Bag-2 icli fly-cate"></i>
                        <span>Cart</span>
                    </a>
                    <span class="position-absolute badge bg-danger d-none cartCount" style="top: 4px; right: 40px">2</span>
                </li>
            </ul>
        </div>
        <!-- mobile fix menu end -->

        @hasSection('title')
        {{-- <section class="breadcrumb-section pt-0">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain">
                            <h2>@yield('title')</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        @endif

        @yield('content')

        <!-- Footer Section Start -->
        <footer class="section-t-space">
            <div class="container-fluid-lg">
                {{-- <div class="service-section">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="service-contain">
                                <div class="service-box">
                                    <div class="service-image">
                                        <img src="/assets/svg/product.svg" class="lazyload" alt="">
                                    </div>

                                    <div class="service-detail">
                                        <h5>Well Packed Delivery</h5>
                                    </div>
                                </div>

                                <div class="service-box">
                                    <div class="service-image">
                                        <img src="/assets/svg/delivery.svg" class="lazyload" alt="">
                                    </div>

                                    <div class="service-detail">
                                        <h5>Free Delivery For Order Over ₹50</h5>
                                    </div>
                                </div>

                                <div class="service-box">
                                    <div class="service-image">
                                        <img src="/assets/svg/discount.svg" class="lazyload" alt="">
                                    </div>

                                    <div class="service-detail">
                                        <h5>Daily Mega Discounts</h5>
                                    </div>
                                </div>

                                <div class="service-box">
                                    <div class="service-image">
                                        <img src="{{ asset('assets/svg/market.svg') }}" class="lazyload" alt="">
                                    </div>

                                    <div class="service-detail">
                                        <h5>Best Price On The Market</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="main-footer section-b-space section-t-space"> --}}
                <div class="main-footer section-b-space section-t-space border-0">
                    <div class="row g-md-4 g-3">
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="footer-logo">
                                <div class="theme-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('assets/images/logo/2.png') }}" class="lazyload" alt="">
                                    </a>
                                </div>

                                <div class="footer-logo-contain">
                                    <p>Medical Life is an Medicine Ecommerce website we deliver Medicine in Retail &
                                        Wholesale price..</p>

                                    <ul class="address">
                                        <li>
                                            <i data-feather="home"></i>
                                            <a href="javascript:void(0)">Noida, Sector 78, India</a>
                                        </li>
                                        <li>
                                            <i data-feather="mail"></i>
                                            <a href="javascript:void(0)">support@fastkart.com</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="footer-title d-flex justify-content-between">
                                <h4>Categories</h4>
                                <i class="fa-solid fa-chevron-down d-md-none"></i>
                            </div>

                            <div class="footer-contain">
                                @php
                                    $footerCategories = \App\Models\Category::select('slug', 'name')->limit(6)->latest()->get();
                                @endphp
                                <ul>
                                    @foreach ($footerCategories as $footerCategory)
                                    <li>
                                        <a href="{{ route('category.view', $footerCategory->slug) }}" class="text-content">{{ $footerCategory->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl col-lg-2 col-sm-3">
                            <div class="footer-title d-flex justify-content-between">
                                <h4>Brands</h4>
                                <i class="fa-solid fa-chevron-down d-md-none"></i>
                            </div>

                            <div class="footer-contain">
                                @php
                                    $footerBrands = \App\Models\Brand::select('slug', 'name')->limit(6)->latest()->get();
                                @endphp
                                <ul>
                                    @foreach ($footerBrands as $footerBrand)
                                    <li>
                                        <a href="{{ route('brand.view', $footerBrand->slug) }}" class="text-content">{{ $footerBrand->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-sm-3">
                            <div class="footer-title d-flex justify-content-between">
                                <h4>Diseases</h4>
                                <i class="fa-solid fa-chevron-down d-md-none"></i>
                            </div>

                            <div class="footer-contain">
                                @php
                                    $footerDiseases = \App\Models\Disease::select('slug', 'name')->limit(6)->latest()->get();
                                @endphp
                                <ul>
                                    @foreach ($footerDiseases as $footerDisease)
                                    <li>
                                        <a href="{{ route('disease.view', $footerDisease->slug) }}" class="text-content">{{ $footerDisease->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="footer-title d-flex justify-content-between">
                                <h4>Quick Links</h4>
                                <i class="fa-solid fa-chevron-down d-md-none"></i>
                            </div>

                            <div class="footer-contain">
                                <ul>
                                    <li>
                                        <a href="{{ route('terms-and-conditions') }}" class="text-content">Terms & Conditions</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('privacy-policy') }}" class="text-content">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('return-and-refund-policy') }}" class="text-content">Return & Refund Policy</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('shipping-and-delivery') }}" class="text-content">Shipping & Delivery</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about-us') }}" class="text-content">About Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sub-footer section-small-space">
                    <div class="reserve">
                        <h6 class="text-content">©2022 Heal+ All rights reserved</h6>
                    </div>

                    <div class="payment">
                        <img src="{{ asset('assets/images/payment-methods.png') }}" class="lazyload" alt="">
                    </div>

                    <div class="social-link">
                        <h6 class="text-content">Stay connected :</h6>
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/" target="_blank">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://in.pinterest.com/" target="_blank">
                                    <i class="fa-brands fa-pinterest-p"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <div id="notification-container"></div>

        <!-- Bg overlay Start -->
        <div class="bg-overlay"></div>
        <!-- Bg overlay End -->
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('assets/js/feather/feather.min.js') }}" 5></script>
    <script src="{{ asset('assets/js/feather/feather-icon.js') }}"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('assets/js/lazysizes.min.js') }}"></script>

    <!-- Auto Height Js -->
    <script src="{{ asset('assets/js/auto-height.js') }}"></script>

    <!-- Fly Cart Js -->
    <script src="{{ asset('assets/js/fly-cart.js') }}"></script>

    <!-- Quantity js -->
    <script src="{{ asset('assets/js/quantity-2.js') }}"></script>

    <!-- script js -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <!-- Slick Slider -->
    <script src="{{ asset('assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/js/slick/slick-animation.min.js') }}"></script>

    <script>
        $(function(){
            $('.header-top .notification-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false,
                vertical: true,
                variableWidth: false,
                autoplay: true,
                autoplaySpeed: 2500,
                arrows: false,
            });

            if ($(window).width() <= 768) {
                $('.footer-contain').hide();
            }

            $('.main-footer .footer-title').click(function() {
                if ($(window).width() <= 768) {
                    let content = $(this).next('.footer-contain');
                    let icon = $(this).find('i');

                    content.slideToggle();

                    if (icon.hasClass('fa-chevron-down')) {
                        icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                    } else {
                        icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                    }
                }
            });
        });
    </script>

    <script>
        window.wishlistItems = @json(session()->get('wishlist', []));
        window.cart = @json(session()->get('cart', []));
    </script>
    @stack('scripts')
</body>
</html>