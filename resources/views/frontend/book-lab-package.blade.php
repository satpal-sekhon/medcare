@extends('layouts.frontend-layout')
@section('title', 'Order Lab Package')

@section('content')
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                <div class="row g-4">
                    <div class="col-xl-7 wow fadeInUp">
                        <div class="right-box-contain">
                            <h2 class="name">{{ $labPackage->name }}</h2>
                            <div class="price-rating">
                                <h3 class="theme-color price">₹{{ $labPackage->amount }}</h3>
                            </div>

                            <div class="product-contain">
                                <p>{{ $labPackage->description }}</p>
                            </div>


                            <div class="pickup-box">
                                <div class="product-title">
                                    <h4>{{ $labPackage->package_title }}:</h4>
                                </div>

                                <div class="product-info">
                                    <ul class="product-info-list product-info-list-2">
                                        @foreach ($labPackage->labTests as $labTest)
                                        <li>
                                            <a href="javascript:void(0)">{{ $labTest->name }} : </a>
                                            {{ $labTest->description }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="right-box-contain">
                            @guest
                            <div class="d-flex justify-content-between mb-3" id="checkoutConfirmation">
                                <button id="continueOrderAsGuest" type="button" class="btn btn-theme-outline">Continue as Guest</button>
                                <a href="{{ route('sign-up') }}" class="btn btn-theme-outline">Create an Account</a>
                            </div>
                            @endguest


                            <form action="{{ route('lab-package.order') }}" method="POST" @class(["mb-4", "d-none" => !auth()->check() ]) id="bookLabPackage">
                                @csrf

                                <div class="mb-3">
                                    <label for="customerName" class="form-label">Your Name</label>
                                    <input type="text" name="customer_name" class="form-control" id="customerName"
                                        value="{{ old('customer_name', auth()->user()->name ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input type="tel" name="phone_number" class="form-control" id="phoneNumber"
                                        value="{{ old('phone_number', auth()->user()->phone_number ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control" id="email"
                                        value="{{ old('email', auth()->user()->email ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="instructions" class="form-label">Any Instructions</label>
                                    <textarea name="instructions" class="form-control" id="instructions"
                                        rows="3">{{ old('instructions') }}</textarea>
                                </div>

                                <button class="btn theme-bg-color text-white w-100">Book Package</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        $(function(){
            $('#continueOrderAsGuest').click(function(){
                $('#bookLabPackage').removeClass('d-none');
                $('#checkoutConfirmation').addClass('d-none');
            })
        })
    </script>
@endpush
@endsection