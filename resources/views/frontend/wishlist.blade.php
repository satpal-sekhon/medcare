@extends('layouts.frontend-layout')
@section('title', 'Wishlist')

@section('content')
<section class="wishlist-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12 mb-3">
                <h2 class="text-center">Wishlist</h2>
            </div>
        </div>
        <wishlist-page :products="{{ json_encode($products) }}"></wishlist-page>
    </div>
</section>
@endsection