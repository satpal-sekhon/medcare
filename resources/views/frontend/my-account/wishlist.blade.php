@extends('layouts.user-account')
@section('title', 'User Dashboard')

@section('my-account')
<div class="dashboard-wishlist">
    <div class="title">
        <h2>My Wishlist History</h2>
        <span class="title-leaf title-leaf-gray">
            <svg class="icon-width bg-gray">
                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
            </svg>
        </span>
    </div>

    <h4 class="text-center fw-bold text-success">Wishlist feature will be implemented soon</h4>
</div>
@endsection