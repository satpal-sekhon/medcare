@extends('layouts.frontend-layout')
@section('title', 'Doctors')

@section('content')
<img src="{{ asset('assets/images/banners/horizontal-4.png') }}" class="mw-100">

<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                <x-success-message :message="session('success')"></x-success-message>
                
                @if($errors->count() > 0)
                <x-error-message message="Please enter valid form to consult with doctor"></x-error-message>
                @endif

                @if ($doctors->count() > 0)
                <div
                    class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">

                    @foreach ($doctors as $doctor)
                    <div>
                        <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="product-header">
                                <div class="mb-3">
                                    <a href="{{ route('doctors.consult', $doctor->id) }}">
                                        <img src="{{ asset($doctor->image ?? 'assets/images/default/doctor.png') }}"
                                            class="img-fluid lazyload" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <a href="{{ route('doctors.consult', $doctor->id) }}">
                                        <h5 class="fw-bold">{{ $doctor->name }} ({{ $doctor->qualification }})</h5>
                                    </a>
                                    <p class="mt-1"><i class="fa-solid fa-certificate text-info"></i> Medical ID Verified</p>
					
                                    <p>
                                        {{ $doctor->doctorType->name ?? 'Not specified' }} 
                                        @if($doctor->experience)| {{ $doctor->experience }}+ Year of Experinece @endif
                                    </p>
                                    
                                    <a href="{{ route('doctors.consult', $doctor->id) }}" class="btn btn-animation text-white w-100">Consult Doctor</a>
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
                    <form action="{{ route('doctors.bookConsultation') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-2 custom-form">
                                    <label for="customerName" class="form-label">Name</label>
                                    <div @class(['custom-input', 'form-control is-invalid p-0'=> $errors->first('customer_name')])>
                                        <input type="text" name="customer_name" id="customerName" placeholder="Enter Customer Name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" class="form-control">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    @if ($errors->has('customer_name'))
                                    <span class="invalid-feedback">{{ $errors->first('customer_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-2 custom-form">
                                    <label for="phoneNumber" class="form-label">Number</label>
                                    <div @class(['custom-input', 'form-control is-invalid p-0'=> $errors->first('phone_number')])>
                                        <input type="text" name="phone_number" class="form-control" id="phoneNumber" placeholder="Enter Phone Number" value="{{ old('phone_number', auth()->user()->phone_number ?? '') }}">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-2 custom-form">
                                    <label for="emailAddress" class="form-label">Email Address</label>
                                    <div @class(['custom-input', 'form-control is-invalid p-0'=> $errors->first('email')])>
                                        <input type="text" name="email" class="form-control" id="emailAddress" placeholder="Enter Email Address" value="{{ old('email', auth()->user()->email ?? '') }}">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-2 custom-form">
                                    <label for="doctorType" class="form-label">Select Doctor Type</label>
                                    <div @class(['custom-input', 'form-control is-invalid p-0'=> $errors->first('doctor_type')])>
                                        <i class="fa-solid fa-chevron-down"></i>

                                        <select name="doctor_type" class="form-control" id="doctorType">
                                            <option value="">Select Doctor Type</option>
                                            @foreach ($doctorTypes as $doctorType)
                                                <option value="{{ $doctorType->id }}" @selected(old('doctor_type') == $doctorType->id)>{{ $doctorType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('doctor_type'))
                                    <span class="invalid-feedback">{{ $errors->first('doctor_type') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-animation btn-md fw-bold w-100">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<img src="{{ asset('assets/images/consult-doctor-benefits.png') }}" alt="" class="mw-100">
@endsection