@extends('layouts.frontend-layout')
@section('title', 'Doctors')

@section('content')
<img src="{{ asset('assets/images/banners/horizontal-4.png') }}" class="mw-100">

<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                @if ($doctors->count() > 0)
                <div
                    class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">

                    @foreach ($doctors as $doctor)
                    <div>
                        <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="product-header">
                                <div class="mb-3">
                                    <a href="#">
                                        <img src="{{ asset($doctor->image ?? 'assets/images/default/doctor.png') }}"
                                            class="img-fluid lazyload" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <a href="#">
                                        <h5 class="fw-bold">{{ $doctor->name }} ({{ $doctor->qualification }})</h5>
                                    </a>
                                    <p class="mt-1"><i class="fa-solid fa-certificate text-info"></i> Medical ID Verified</p>
					
                                    <p>
                                        {{ $doctor->doctorType->name ?? 'Not specified' }} 
                                        @if($doctor->experience)| {{ $doctor->experience }}+ Year of Experinece @endif
                                    </p>
                                    
                                    <button class="btn btn-animation w-100" type="submit">Consult Doctor</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else 
                <x-warning-message message="We will add doctors shortly!"></x-warning-message>
            @endif

                {{ $doctors->links() }}
            </div>
        </div>
    </div>
</section>

<section class="contact-box-section">
    <div class="container-fluid-lg">
        <div class="row g-lg-5 g-3">
            <div class="col-lg-8">
                <img src="{{ asset('assets/images/consult-doctor.png') }}" class="mw-100">
            </div>

            <div class="col-lg-4">
                <div class="right-sidebar-box">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-md-4 mb-3 custom-form">
                                <label for="user_name" class="form-label">Name</label>
                                <div class="custom-input">
                                    <input type="text" class="form-control" id="user_name" placeholder="Enter First Name">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-md-4 mb-3 custom-form">
                                <label for="user_number" class="form-label">Number</label>
                                <div class="custom-input">
                                    <input type="text" class="form-control" id="user_number" placeholder="Enter Phone Number">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-md-4 mb-3 custom-form">
                                <label for="user_email" class="form-label">Email Address</label>
                                <div class="custom-input">
                                    <input type="email" class="form-control" id="user_email" placeholder="Enter Email Address">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-md-4 mb-3 custom-form">
                                <label for="doctor_type" class="form-label">Select Doctor Type</label>
                                <div class="custom-textarea">
                                    <i style="padding: 15px;" class="fa-solid fa-chevron-down"></i>
                                    <select class="form-control" id="doctor_type" name="doctor_type">
                                        <option value="" selected>Select Doctor Type</option>
                                        @foreach ($doctorTypes as $doctorType)
                                            <option value="{{ $doctorType->id }}">{{ $doctorType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-animation btn-md fw-bold" style="width: 100%;">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
</section>

<img src="{{ asset('assets/images/consult-doctor-benefits.png') }}" alt="" class="mw-100">
@endsection