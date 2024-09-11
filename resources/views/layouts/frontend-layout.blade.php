<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Heal Deal</title>

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

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">

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
            <div class="header-top">
                <div class="container-fluid-lg">
                    <div class="row">
                        <div class="col-xxl-12 col-lg-12 d-lg-block d-none mx-auto">
                            <div class="header-offer">
                                <div class="notification-slider">
                                    <div>
                                        <div class="timer-notification text-center">
                                            <h6><strong class="me-1">Welcome to Medine Shop!</strong>Wrap new
                                                offers/gift every single day on Weekends.<strong class="ms-1">New Coupon Code: Med2589
                                                </strong>
                                            </h6>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="timer-notification text-center">
                                            <h6>Extra 50% Off on All Generic Medicine
                                                <a href="#" class="text-white">Buy Now !</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
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
                                    <img src="{{ asset('assets/images/logo/1.png') }}"
                                        class="img-fluid lazyload" alt="">
                                </a>

                                <div class="middle-box">
                                    <div class="search-box">
                                        <div class="input-group">
                                            <input type="search" class="form-control"
                                                placeholder="I'm searching for...">
                                            <button class="btn" type="button" id="button-addon2">
                                                <i data-feather="search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

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
                                            <a href="#" class="delivery-login-box">
                                                <div class="delivery-icon">
                                                    <i data-feather="phone-call"></i>
                                                </div>
                                                <div class="delivery-detail">
                                                    <h6>24/7 Delivery</h6>
                                                    <h5>+91 888 104 2340</h5>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="right-side">
                                            <a href="{{ route('wishlist.index') }}"
                                                class="btn p-0 position-relative header-wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                        <li class="right-side">
                                            <div class="onhover-dropdown header-badge">
                                                <button type="button" class="btn p-0 position-relative header-wishlist">
                                                    <i data-feather="shopping-cart"></i>
                                                    <span
                                                        class="position-absolute top-0 start-100 translate-middle badge">2
                                                        <span class="visually-hidden">unread messages</span>
                                                    </span>
                                                </button>

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
                                                    <h5>My Account</h5>
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

            <div class="container-fluid-lg py-2">
                <div class="row">
                    <div class="col-12">
                        <div class="header-nav">
                            <div class="header-nav-left">
                                <button class="dropdown-category text-uppercase">
                                    <i data-feather="align-left"></i>
                                    <span>Wellness</span>
                                </button>

                                <div class="category-dropdown">
                                    <div class="category-title">
                                        <h5>Categories</h5>
                                        <button type="button" class="btn p-0 close-button text-content">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>

                                    @if(isset($menuPrimaryCategories))
                                        <ul class="category-list">
                                            @foreach ($menuPrimaryCategories as $menuPrimaryCategory)
                                            <li class="onhover-category-list">
                                                <a href="javascript:void(0)" class="category-name">
                                                    <h6>{{ $menuPrimaryCategory->name }}</h6>
                                                    <i class="fa-solid fa-angle-right"></i>
                                                </a>

                                                <div class="onhover-category-box">
                                                    <div class="list-1">
                                                        <ul>
                                                            @foreach($menuPrimaryCategory->categories->take(8) as $category)
                                                                <li>
                                                                    <a href="#">{{ $category->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                    <div class="list-2">
                                                        <ul>
                                                            @foreach($menuPrimaryCategory->categories->skip(8)->take(8) as $category)
                                                                <li>
                                                                    <a href="#">{{ $category->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
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
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                        data-bs-toggle="dropdown">Search Medicine</a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('search-medicines') }}">Generic Medicine</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('products.index') }}">All Products</a>
                                                        </li>
                                                    </ul>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('brands.index') }}">Brands</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('lab-test.index') }}">Lab
                                                        Test</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link"
                                                        href="{{ route('pharmacy.index') }}">Pharmacy</a>
                                                </li>

                                                <li class="nav-item dropdown new-nav-item">
                                                    <label class="new-dropdown">New</label>
                                                    <a class="nav-link" href="{{ route('doctors.index') }}">Doctors</a>
                                                </li>

                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                        data-bs-toggle="dropdown">Company +</a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('about') }}">About
                                                                Us</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('faq') }}">FAQs</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('contact-us') }}">Contact Us</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="header-nav-right">
                                <a href="{{ route('quick-order') }}">
                                    <button class="btn deal-button">
                                        <i data-feather="zap"></i>
                                        <span>Quick Order</span>
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
                        <span>Category</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="search-box">
                        <i class="iconly-Search icli"></i>
                        <span>Search</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="notifi-wishlist">
                        <i class="iconly-Heart icli"></i>
                        <span>My Wish</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="iconly-Bag-2 icli fly-cate"></i>
                        <span>Cart</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- mobile fix menu end -->

        @hasSection('title')
        <section class="breadcrumb-section pt-0">
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
        </section>
        @endif

        @yield('content')

        <!-- Footer Section Start -->
        <footer class="section-t-space">
            <div class="container-fluid-lg">
                <div class="service-section">
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

                <div class="main-footer section-b-space section-t-space">
                    <div class="row g-md-4 g-3">
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="footer-logo">
                                <div class="theme-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('assets/images/logo/2.png') }}" class="lazyload"
                                            alt="">
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
                            <div class="footer-title">
                                <h4>Categories</h4>
                            </div>

                            <div class="footer-contain">
                                <ul>
                                    <li>
                                        <a href="#" class="text-content">Medicines</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">Cosmetic</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">Suppliments</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">Surgical Items</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">Vitamins</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">Baby Products</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl col-lg-2 col-sm-3">
                            <div class="footer-title">
                                <h4>Useful Links</h4>
                            </div>

                            <div class="footer-contain">
                                <ul>
                                    <li>
                                        <a href="{{ route('home') }}" class="text-content">Home</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">Shop</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">About Us</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">Blog</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-sm-3">
                            <div class="footer-title">
                                <h4>Help Center</h4>
                            </div>

                            <div class="footer-contain">
                                <ul>
                                    <li>
                                        <a href="#" class="text-content">Your Order</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">Your Account</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">Track Order</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('wishlist.index') }}" class="text-content">Your Wishlist</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">Search</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-content">FAQ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="footer-title">
                                <h4>Contact Us</h4>
                            </div>

                            <div class="footer-contact">
                                <ul>
                                    <li>
                                        <div class="footer-number">
                                            <i data-feather="phone"></i>
                                            <div class="contact-number">
                                                <h6 class="text-content">Hotline 24/7 :</h6>
                                                <h5>+91 888 104 2340</h5>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="footer-number">
                                            <i data-feather="mail"></i>
                                            <div class="contact-number">
                                                <h6 class="text-content">Email Address :</h6>
                                                <h5>Mediacllife@hotmail.com</h5>
                                            </div>
                                        </div>
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
        });
    </script>

    @stack('scripts')
</body>

</html>