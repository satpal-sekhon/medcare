<div class="dashboard-left-sidebar">
    <div class="close-button d-flex d-lg-none">
        <button class="close-sidebar">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="profile-box">
        <div class="cover-image">
            <img src="../assets/images/inner-page/cover-img.jpg" class="img-fluid blur-up lazyload" alt="">
        </div>

        <div class="profile-contain">
            <div class="profile-image">
                <div class="position-relative">
                    <img src="../assets/images/inner-page/user/1.jpg" class="blur-up lazyload update_img" alt="">
                    <div class="cover-icon">
                        <i class="fa-solid fa-pen">
                            <input type="file" onchange="readURL(this,0)">
                        </i>
                    </div>
                </div>
            </div>

            <div class="profile-name">
                <h3>Vicki E. Pope</h3>
                <h6 class="text-content">vicki.pope@gmail.com</h6>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                data-bs-target="#pills-dashboard" type="button"><i data-feather="home"></i>
                DashBoard</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill" data-bs-target="#pills-order"
                type="button"><i data-feather="shopping-bag"></i>Order</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-wishlist-tab" data-bs-toggle="pill" data-bs-target="#pills-wishlist"
                type="button"><i data-feather="heart"></i>
                Wishlist</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-address-tab" data-bs-toggle="pill" data-bs-target="#pills-address"
                type="button" role="tab"><i data-feather="map-pin"></i>Address</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                type="button" role="tab"><i data-feather="user"></i>
                Profile</button>
        </li>
    </ul>
</div>