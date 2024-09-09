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
                            @if (!$errors->count())
                                @guest
                                <div class="d-flex justify-content-between mb-3" id="checkoutConfirmation">
                                    <button id="continueOrderAsGuest" type="button" class="btn btn-theme-outline">Continue
                                        as Guest</button>
                                    <a href="{{ route('sign-up') }}" class="btn btn-theme-outline">Create an Account</a>
                                </div>
                                @endguest
                            @endif

                            <form action="{{ route('lab-package.order') }}" method="POST" @class(["mb-4", "d-none"=>
                                !auth()->check() && !$errors->count() ]) id="bookLabPackage">
                                @csrf

                                <input type="hidden" name="lab_package_id" value="{{ $labPackage->id }}">

                                <div class="mb-3">
                                    <label for="customerName" class="form-label">Your Name</label>
                                    <input type="text" name="customer_name" id="customerName"
                                        @class(['form-control', 'is-invalid'=> $errors->first('customer_name')])
                                        value="{{ old('customer_name', auth()->user()->name ?? '') }}">

                                    @if ($errors->has('customer_name'))
                                    <span class="invalid-feedback">{{ $errors->first('customer_name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input type="number" name="phone_number" id="phoneNumber"
                                        @class(['form-control', 'is-invalid'=> $errors->first('phone_number')])
                                        value="{{ old('phone_number', auth()->user()->phone_number ?? '') }}">

                                    @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" id="email"
                                        @class(['form-control', 'is-invalid'=> $errors->first('email')])
                                        value="{{ old('email', auth()->user()->email ?? '') }}">

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                    @endif
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