<div class="dashboard-profile">
    <div class="title">
        <h2>My Profile</h2>
        <span class="title-leaf">
            <svg class="icon-width bg-gray">
                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
            </svg>
        </span>
    </div>

    <div class="profile-detail dashboard-bg-box">
        <div class="dashboard-title">
            <h3>Profile Name</h3>
        </div>
        <div class="profile-name-detail">
            <div class="d-sm-flex align-items-center d-block">
                <h3>{{ auth()->user()->name }}</h3>
            </div>

            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editProfile">Edit</a>
        </div>

        <div class="location-profile">
            <ul>
                @if(auth()->user()->address)
                <li>
                    <div class="location-box">
                        <i data-feather="map-pin"></i>
                        <h6>{{ auth()->user()->address }}</h6>
                    </div>
                </li>
                @endif

                <li>
                    <div class="location-box">
                        <i data-feather="mail"></i>
                        <h6>{{ auth()->user()->name }}</h6>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="profile-about dashboard-bg-box">
        <div class="row">
            <div class="col-xxl-7">
                <div class="dashboard-title mb-3">
                    <h3>Profile About</h3>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            {{-- <tr>
                                <td>Gender :</td>
                                <td>Female</td>
                            </tr>
                            <tr>
                                <td>Birthday :</td>
                                <td>21/05/1997</td>
                            </tr> --}}
                            <tr>
                                <td>Phone Number :</td>
                                <td>
                                    <a href="javascript:void(0)">{{ auth()->user()->phone_number }}</a>
                                </td>
                            </tr>
                            @if(auth()->user()->address)
                                <tr>
                                    <td>Address :</td>
                                    <td>{{ auth()->user()->address }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="dashboard-title mb-3">
                    <h3>Login Details</h3>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Email :</td>
                                <td>
                                    <a href="javascript:void(0)">
                                        {{ auth()->user()->email }}
                                        <span data-bs-toggle="modal" data-bs-target="#editProfile">Edit</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Password :</td>
                                <td>
                                    <a href="javascript:void(0)">
                                        ●●●●●●
                                        <span data-bs-toggle="modal" data-bs-target="#editProfile">Edit</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-xxl-5">
                <div class="profile-image">
                    <img src="../assets/images/inner-page/dashboard-profile.png" class="img-fluid blur-up lazyload"
                        alt="">
                </div>
            </div>
        </div>

    </div>
</div>