@extends('layouts.user-account')
@section('title', 'User Dashboard')

@section('my-account')
<div class="dashboard-home">
    <div class="title">
        <h2>My Dashboard</h2>
        <span class="title-leaf">
            <svg class="icon-width bg-gray">
                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
            </svg>
        </span>
    </div>

    <div class="dashboard-user-name">
        <h6 class="text-content">Hello, <b class="text-title">{{ auth()->user()->name }}</b></h6>
        <p class="text-content">From your My Account Dashboard you have the ability to
            view a snapshot of your recent account activity and update your account
            information. Select a link below to view or edit information.</p>
    </div>

    <div class="total-box">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                <div class="total-contain">
                    <img src="{{ asset('assets/svg/order.svg') }}" class="img-1 lazyload" alt="">
                    <img src="{{ asset('assets/svg/order.svg') }}" class="lazyload" alt="">
                    <div class="total-detail">
                        <h5>Total Order</h5>
                        <h3>{{ $totalOrders }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                <div class="total-contain">
                    <img src="{{ asset('assets/svg/pending.svg') }}" class="img-1 lazyload" alt="">
                    <img src="{{ asset('assets/svg/pending.svg') }}" class="lazyload" alt="">
                    <div class="total-detail">
                        <h5>Total Pending Order</h5>
                        <h3>254</h3>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                <div class="total-contain">
                    <img src="{{ asset('assets/svg/wishlist.svg') }}" class="img-1 lazyload" alt="">
                    <img src="{{ asset('assets/svg/wishlist.svg') }}" class="lazyload" alt="">
                    <div class="total-detail">
                        <h5>Total Wishlist</h5>
                        <h3>32158</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-title">
        <h3>Account Information</h3>
    </div>

    <div class="row g-4">
        <div class="col-xxl-12">
            <div class="dashboard-content-title">
                <h4>Contact Information <a href="javascript:void(0)" data-bs-toggle="modal"
                        data-bs-target="#editProfile">Edit</a>
                </h4>
            </div>
            <div class="dashboard-detail">
                <h6 class="text-content">{{ auth()->user()->name }}</h6>
                <h6 class="text-content">{{ auth()->user()->email }}</h6>
                <a href="javascript:void(0)">Change Password</a>
            </div>
        </div>

        <div class="col-12">
            <div class="dashboard-content-title">
                <h4>Address Book <a href="javascript:void(0)" data-bs-toggle="modal"
                        data-bs-target="#editProfile">Edit</a></h4>
            </div>

            <div class="row g-4">
                <div class="col-xxl-6">
                    <div class="dashboard-detail">
                        <h6 class="text-content">Default Address</h6>
                        <h6 class="text-content">You have not set a default address.</h6>
                        <a href="javascript:void(0)">Edit Address</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection