@extends('layouts.frontend-layout')
@section('title', 'Contact Us')

@section('content')
<section class="contact-box-section">
    <div class="container-fluid-lg">
        <div class="row g-lg-5 g-3">
            <div class="col-lg-6">
                <div class="left-sidebar-box">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="contact-title">
                                <h3>Get In Touch</h3>
                            </div>

                            <div class="contact-detail">
                                <div class="row g-4">
                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                        <div class="contact-detail-box">
                                            <div class="contact-icon">
                                                <i class="fa-solid fa-phone"></i>
                                            </div>
                                            <div class="contact-detail-title">
                                                <h4>Phone</h4>
                                            </div>

                                            <div class="contact-detail-contain">
                                                <a href="tel:{{ getSetting('site_contact_number') }}">{{ getSetting('site_contact_number') }}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                        <div class="contact-detail-box">
                                            <div class="contact-icon">
                                                <i class="fa-solid fa-envelope"></i>
                                            </div>
                                            <div class="contact-detail-title">
                                                <h4>Email</h4>
                                            </div>

                                            <div class="contact-detail-contain">
                                                <a href="mailto:{{ getSetting('site_email') }}">{{ getSetting('site_contact_email') }}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-12 col-lg-12 col-sm-12">
                                        <div class="contact-detail-box">
                                            <div class="contact-icon">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>
                                            <div class="contact-detail-title">
                                                <h4>Office</h4>
                                            </div>

                                            <div class="contact-detail-contain">
                                                <p>{!! nl2br(getSetting('site_address')) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="title d-xxl-none d-block">
                    <h2>Contact Us</h2>
                </div>
                <div class="right-sidebar-box">
                    <x-success-message :message="session('success')" />
                    
                    <form action="{{ route('contact-us.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <div class="custom-input">
                                        <input type="text" name="first_name" id="firstName" placeholder="Enter First Name"
                                        value="{{ old('first_name') }}" @class(['form-control', 'is-invalid'=> $errors->has('first_name')])>
                                        <i class="fa-solid fa-user"></i>
                                    </div>

                                    @if ($errors->has('first_name'))
                                    <span class="invalid-feedback d-block">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <div class="custom-input">
                                        <input type="text" name="last_name" id="lastName" placeholder="Enter Last Name"
                                        value="{{ old('last_name') }}" @class(['form-control', 'is-invalid'=> $errors->has('last_name')])>
                                        <i class="fa-solid fa-user"></i>
                                    </div>

                                    @if ($errors->has('last_name'))
                                    <span class="invalid-feedback d-block">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="emailAddress" class="form-label">Email Address</label>
                                    <div class="custom-input">
                                        <input type="email" name="email_address" id="emailAddress" placeholder="Enter Email Address"
                                        value="{{ old('email_address') }}" @class(['form-control', 'is-invalid'=> $errors->has('email_address')])>
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    
                                    @if ($errors->has('email_address'))
                                    <span class="invalid-feedback d-block">{{ $errors->first('email_address') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <div class="custom-input">
                                        <input type="tel" name="phone_number" id="phoneNumber" @class(['form-control', 'is-invalid'=> $errors->has('phone_number')])
                                        value="{{ old('phone_number') }}" placeholder="Enter Your Phone Number" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                            this.value.slice(0, this.maxLength);">
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                    </div>
                                    
                                    @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback d-block">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="message" class="form-label">Message</label>
                                    <div class="custom-textarea">
                                        <textarea name="message" id="message" placeholder="Enter Your Message" rows="6"
                                        @class(['form-control', 'is-invalid'=> $errors->has('message')])>{{ old('message') }}</textarea>
                                        <i class="fa-solid fa-message"></i>
                                    </div>
                                    
                                    @if ($errors->has('message'))
                                    <span class="invalid-feedback d-block">{{ $errors->first('message') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-animation btn-md fw-bold ms-auto">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="map-section">
    <div class="container-fluid p-0">
        <div class="map-box">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d2994.3803116994895!2d55.29773782339708!3d25.222534631321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m5!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sDubai%20-%20United%20Arab%20Emirates!3m2!1d25.2048493!2d55.2707828!4m0!5e1!3m2!1sen!2sin!4v1652217109535!5m2!1sen!2sin"
                style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>
@endsection