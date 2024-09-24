@extends('layouts.user-account')
@section('title', 'User Dashboard')

@section('my-account')
<div class="dashboard-wishlist">
    <div class="title">
        <h2>My Wishlist</h2>
        <span class="title-leaf title-leaf-gray">
            <svg class="icon-width bg-gray">
                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
            </svg>
        </span>
    </div>

    <div class="row g-sm-4 g-3">
        <wishlist-page :products="{{ json_encode($products) }}" custom-grid-class="col-xxl-3 col-lg-4 col-md-4 col-6" additional-product-class="theme-bg-white"></wishlist-page>
    </div>
</div>
@endsection