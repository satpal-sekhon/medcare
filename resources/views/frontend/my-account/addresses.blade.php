@extends('layouts.frontend-layout')
@section('title', 'User Dashboard')

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('frontend.partials.my-account.sidebar')
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                    Menu</button>
                <div class="dashboard-right-sidebar">
                    @include('frontend.partials.my-account.addresses')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection