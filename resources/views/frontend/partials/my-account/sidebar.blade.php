<div class="dashboard-left-sidebar">
    <div class="close-button d-flex d-lg-none">
        <button class="close-sidebar">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="profile-box">
        <div class="cover-image">
            <img src="{{ asset('assets/images/page/cover-img.jpg') }}" class="img-fluid lazyload" alt="">
        </div>

        <div class="profile-contain">
            <div class="profile-image">
                <div class="position-relative">
                    <img src="{{ asset('assets/images/default/user.jpg') }}" class="lazyload update_img" alt="">
                    <div class="cover-icon">
                        <i class="fa-solid fa-pen">
                            <input type="file" onchange="readURL(this,0)">
                        </i>
                    </div>
                </div>
            </div>

            <div class="profile-name">
                <h3>{{ auth()->user()->name }}</h3>
                <h6 class="text-content">{{ auth()->user()->email }}</h6>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills user-nav-pills">
        <li class="nav-item">
            <a href="{{ route('my-account') }}" @class(["nav-link", 'active' => request()->routeIs('my-account')])>
                <i data-feather="home"></i>
                DashBoard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('my-account.orders') }}" @class(["nav-link", 'active' => request()->routeIs('my-account.orders')])>
                <i data-feather="shopping-bag"></i>
                Orders
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('my-account.wishlist') }}" @class(["nav-link", 'active' => request()->routeIs('my-account.wishlist')])>
                <i data-feather="heart"></i>
                Wishlist
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('my-account.addresses') }}" @class(["nav-link", 'active' => request()->routeIs('my-account.addresses')])>
                <i data-feather="map-pin"></i>
                Address
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('my-account.profile') }}" @class(["nav-link", 'active' => request()->routeIs('my-account.profile')])>
                <i data-feather="user"></i>
                Profile
            </a>
        </li>
    </ul>
</div>