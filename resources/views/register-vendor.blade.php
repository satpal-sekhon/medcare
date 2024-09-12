@extends('layouts.frontend-layout')
@section('title', 'Partner with Us')

@section('content')
<img src="{{ asset('assets/images/banners/become-a-partner.png') }}" class="w-100" />

<section class="section-b-space">
    <div class="container-fluid-lg w-100">
        <form method="POST" action="{{ route('create-vendor-account') }}">
            @csrf

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>About You</h2>
                            <div class="row mt-4">
                                <div class="col-md-6 mb-1">
                                    <x-form-input name="full_name" label="Full Name"></x-form-input>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <x-form-input name="email" label="Email Address"></x-form-input>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <x-form-input name="phone_number" label="Phone Number"></x-form-input>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <x-form-input name="city" label="City"></x-form-input>
                                </div>
                                <div class="col-12 mb-1">
                                    <x-textarea name="address" label="Address"></x-textarea>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <select name="state" id="state" @class(['form-control', 'is-invalid'=> $errors->first('state')])>
                                            <option value="">Select State</option>
                                            @foreach ($states as $state)
                                            <option value="{{ $state->name }}" @selected(old('state', ($address->state ?? '')) == $state->name)>{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('state'))
                                        <span class="invalid-feedback">{{ $errors->first('state') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 mb-1">
                                    <x-form-input name="pincode" label="Pin Code"></x-form-input>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2>About Your Business</h2>
                            <div class="row mt-4">
                                <div class="col-md-6 mb-1">
                                    <x-form-input name="business_name" label="Business Name"></x-form-input>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <x-form-input name="business_email" label="Business Email Address"></x-form-input>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <x-form-input name="buiness_phone_number" label="Business Phone Number"></x-form-input>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <x-form-input name="business_city" label="Business City"></x-form-input>
                                </div>
                                <div class="col-12 mb-1">
                                    <x-textarea name="business_address" label="Business Address"></x-textarea>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label for="business_state">State</label>
                                        <select name="business_state" id="business_state" @class(['form-control', 'is-invalid'=> $errors->first('business_state')])>
                                            <option value="">Select State</option>
                                            @foreach ($states as $state)
                                            <option value="{{ $state->name }}" @selected(old('business_state') == $state->name)>{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('business_state'))
                                        <span class="invalid-feedback">{{ $errors->first('business_state') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <x-form-input name="business_pincode" label="Business Pincode"></x-form-input>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label for="business_type">Business Type</label>
                                    <select name="business_type" id="business_type" @class(['form-control'])>
                                        <option value="Pharmacy Store">Pharmacy Store</option>
                                        <option value="Channel Partner">Channel Partner</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label for="shop_type">Shop Type</label>
                                    <select name="shop_type" id="shop_type" @class(['form-control'])>
                                        <option value="Owned">Owned</option>
                                        <option value="Rented">Rented</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <x-form-input name="license_number" label="License Number"></x-form-input>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <x-form-input type="file" name="documents" label="Upload Documents"></x-form-input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-animation mt-4">Submit</button>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection
