@extends('layouts.frontend-layout')
@section('title', 'Verify Email')

@section('content')
<section class="log-in-section otp-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('assets/images/page/otp.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <div class="log-in-box">
                        <x-success-message :message="session('success')" />
                        <x-error-message :message="session('error')" />

                        <form action="{{ route('verify-otp') }}" id="otp-form" class="signin-form" method="post">
                            @csrf
                            <div class="log-in-title">
                                <h3 class="text-title">Please enter the OTP to verify your account</h3>
                                <h5 class="text-content">A code has been sent to <span>{{ $email }}</span></h5>
                            </div>

                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="text" id="otp" name="otp" class="form-control" maxlength="6" pattern="\d*" inputmode="numeric" aria-label="OTP" placeholder="Enter OTP">
                            <div class="send-box pt-4">
                                <h5>Didn't get the code?
                                    <a href="{{ route('resend-verification-email') }}" class="theme-color fw-bold">Resend It</a>
                                </h5>
                            </div>

                            <button type="submit" class="btn btn-animation w-100 mt-3">Validate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection