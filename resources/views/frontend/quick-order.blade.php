@extends('layouts.frontend-layout')
@section('title', 'Quick Order')

@section('content')
<section class="log-in-section background-image-2 section-b-space">
    <div class="container-fluid-lg w-100">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('assets/images/prescription-guide.png') }}" class="img-fluid"
                        alt="Prescription Order Image">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                <div class="log-in-box">
                    <div class="log-in-title">
                        <h4>Order With Prescription</h4>
                    </div>

                    <x-error-message :message="session('error')" />
                    <x-success-message :message="session('success')" />

                    <div class="input-box">
                        @if (!$errors->count())
                        @guest
                        <div class="d-flex justify-content-between mb-3" id="guestConfirmation">
                            <button id="continueOrderAsGuest" type="button" class="btn btn-sm btn-theme-outline">Continue
                                as Guest</button>
                            <a href="{{ route('sign-up') }}" class="btn btn-sm btn-theme-outline">Create an Account</a>
                        </div>
                        @endguest
                        @endif

                        <form method="POST" action="{{ route('quick-order.store') }}" enctype="multipart/form-data"
                            @class(["row", "d-none"=> !auth()->check() && !$errors->count() ]) id="orderForm">
                            @csrf

                            <div class="col-12 mb-2">
                                <x-form-input name="customer_name" label="Name" value="{{ auth()->user()->name ?? '' }}"></x-form-input>
                            </div>
                            <div class="col-12 mb-2">
                                <x-form-input name="email" label="Email Address" value="{{ auth()->user()->email ?? '' }}"></x-form-input>
                            </div>
                            <div class="col-12 mb-2">
                                <x-form-input name="phone_number" label="Phone Number" value="{{ auth()->user()->phone_number ?? '' }}"></x-form-input>
                            </div>
                            <div class="col-12 mb-2">
                                <x-form-input type="file" name="prescription" label="Upload Prescription"
                                    accept=".pdf,.jpg,.jpeg,.png"></x-form-input>
                            </div>
                            <div class="col-12 mb-2">
                                <x-textarea name="instructions" label="Enter Instructions (If any)"></x-textarea>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-animation w-100 justify-content-center"
                                    type="submit">Submit</button>
                            </div>
                        </form>
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
            $('#guestConfirmation').addClass('d-none');
            $('#orderForm').removeClass('d-none');
        })
    })
</script>
@endpush
@endsection