@extends('layouts.frontend-layout')
@section('title', 'Change Password')

@section('content')
<section class="log-in-section section-b-space forgot-section">
    <div class="container-fluid-lg w-100">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('assets/images/page/forgot.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                <div class="d-flex align-items-center justify-content-center h-100">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h4>Change password</h4>
                        </div>

                        <div class="input-box">
                            <form class="row g-4" id="change-password-form" action="{{ route('password') }}" method="post">
                                @csrf
                                <input type="hidden" name="email" value="{{$email}}">
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="password" class="form-control" id="new-password" name="new_password" placeholder="Password">
                                        <label for="password">New Password</label>
                                        @if ($errors->has('new_password'))
                                            <span class="invalid-feedback d-block">{{ $errors->first('new_password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm Password">
                                        <label for="confirm-password">Confirm Password</label>
                                        @if ($errors->has('confirm_password'))
                                            <span class="invalid-feedback d-block">{{ $errors->first('confirm_password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-animation w-100" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection