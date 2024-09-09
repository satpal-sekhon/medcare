@extends('layouts.frontend-layout')
@section('title', 'Consult with Doctor')

@section('content')
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                <div class="row g-4">
                    <div class="col-xl-7 wow fadeInUp">
                        <div class="right-box-contain">
                            <h2 class="name">{{ $doctor->name }}</h2>
                            
                            <div class="price-rating">
                                <h3 class="theme-color price">₹{{ $doctor->fee }}</h3>
                            </div>

                            <div class="product-contain mb-3">
                                <h5 class="mt-2 fw-bold">{{ $doctor->doctorType->name }}</h5>
                                @if ($doctor->description)
                                <p>{{ $doctor->description }}</p>
                                @endif
                            </div>

                            <div class="product-main-1 no-arrow">
                                <div class="slider-image">
                                    <img src="{{ asset($doctor->image ?? 'assets/images/default/doctor.png') }}"
                                        data-zoom-image="{{ asset($doctor->image ?? 'assets/images/default/doctor.png') }}"
                                        class="img-fluid image_zoom_cls-0 lazyload w-75" alt="">
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

                            <form action="{{ route('doctors.bookConsultation') }}" method="POST" @class(["mb-4", "d-none"=>
                                !auth()->check() && !$errors->count() ]) id="bookdoctor">
                                @csrf

                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

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
                                    <label for="doctorType" class="form-label">Doctor Type</label>
                                    <select name="doctor_type" id="doctorType" @class(['form-control', 'is-invalid'=> $errors->first('doctor_type')])>
                                        <option value="">Select Doctor Type</option>
                                        @foreach ($doctorTypes as $doctorType)
                                            <option value="{{ $doctorType->id }}" @selected(old('doctor_type') == $doctorType->id)>{{ $doctorType->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('doctor_type'))
                                    <span class="invalid-feedback">{{ $errors->first('doctor_type') }}</span>
                                    @endif
                                </div>

                                <button class="btn theme-bg-color text-white w-100">Consult Doctor</button>
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
                $('#bookdoctor').removeClass('d-none');
                $('#checkoutConfirmation').addClass('d-none');
            })
        })
</script>
@endpush
@endsection