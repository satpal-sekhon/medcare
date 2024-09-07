@extends('layouts.user-account')
@section('title', 'User Dashboard')

@section('my-account')
<div class="dashboard-address">
    <div class="title title-flex">
        <div>
            <h2>Save new Address</h2>
            <span class="title-leaf">
                <svg class="icon-width bg-gray">
                    <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                </svg>
            </span>
        </div>

        <a href="{{ route('addresses.create') }}" class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3">
            <i data-feather="arrow-left" class="me-2"></i>
            Back to Addresses
        </a>
    </div>
    <form action="{{ route('addresses.store') }}" method="post">
        @csrf
        @include('frontend.partials.my-account.address-form')
    </form>
</div>
@endsection