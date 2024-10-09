@extends('layouts.frontend-layout')
@section('title', 'Log In')

@section('content')
<section class="log-in-section background-image-2 section-b-space">
    <div class="container-fluid-lg w-100">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('assets/images/page/log-in.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                <x-success-message :message="session('success')" />
                <x-error-message :message="$errors->first('message')" />

                <div class="log-in-box">
                    <div class="log-in-title">
                        <h4>Log In Your Account</h4>
                    </div>

                    <div class="input-box">
                        <form class="row g-4" method="POST" action="{{ route('authenticate') }}">
                            @csrf

                            <div class="col-12">
                                <div class="">
                                    <label for="email">Email Address</label>

                                    <input type="email" name="email" id="email"
                                        placeholder="Email Address" value="{{ old('email') }}"
                                        @class(['form-control', 'is-invalid'=> $errors->has('email')])>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback d-block">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="">
                                    <label for="password">Password</label>

                                    <div class="input-group">
                                        <input type="password" name="password" id="password" placeholder="Password"
                                            value="{{ old('password') }}" @class(['form-control', 'is-invalid'=>
                                        $errors->has('password')])>
                                        <button type="button" class="btn btn-theme-outline btn-sm togglePassword">
                                            <i class="fas fa-eye fs-5"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="forgot-box">
                                    <div class="form-check ps-0 m-0 remember-box">
                                        <input class="checkbox_animated check-box" type="checkbox" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <a href="{{ route('forgot-password') }}" class="forgot-password">Forgot Password?</a>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-animation w-100 justify-content-center">Log
                                    In</button>
                            </div>
                        </form>
                    </div>

                    <div class="other-log-in">
                        <h6></h6>
                    </div>

                    <div class="sign-up-box">
                        <h4>Don't have an account?</h4>
                        <a href="{{ route('sign-up') }}">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@push('scripts')
<script>
    $(document).ready(function() {
            $('.togglePassword').on('click', function() {
            // Find the corresponding password input
            var passwordInput = $(this).siblings('input[type="password"], input[type="text"]');
            
            // Toggle the type attribute between 'password' and 'text'
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
@endpush
@endsection