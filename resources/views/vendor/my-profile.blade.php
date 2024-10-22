@extends('layouts.vendor-layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('vendor.update-profile') }}" method="post">
                    @csrf
                    <div class="row">
                        <h4 class="fw-bold mb-3 text-center">My Profile</h4>
                    
                        <div class="col-md-6">
                            <x-form-input name="user_name" label="User Name" value="{{ auth()->user()->name }}"
                                :labelClass="'form-label-title'"></x-form-input>
                        </div>
                    
                        <div class="col-md-6">
                            <x-form-input name="email" label="Email Address" value="{{ auth()->user()->email }}"
                                :labelClass="'form-label-title'"></x-form-input>
                        </div>
                        <div class="col-md-6">
                            <x-form-input type="number" name="phone_number" label="Phone Number"
                                value="{{ auth()->user()->phone_number }}" :labelClass="'form-label-title'"></x-form-input>
                        </div>
                    
                        <div class="col-md-6">
                            <x-form-input name="address" label="Address" value="{{ auth()->user()->address }}"
                                :labelClass="'form-label-title'"></x-form-input>
                        </div>
                        <div class="col-md-6">
                            <x-form-input name="city" label="City" value="{{ auth()->user()->city }}"
                                :labelClass="'form-label-title'"></x-form-input>
                        </div>
                    
                        <div class="col-md-6">
                            <x-form-input name="pincode" label="Pincode" value="{{ auth()->user()->pincode }}"
                                :labelClass="'form-label-title'"></x-form-input>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label-title mb-0">State</label>
                                <select name="state" @class(['form-control', 'is-invalid'=> $errors->first('state')])>
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state->name }}" @selected(old('state', auth()->user()->state) ==
                                        $state->name)>{{
                                        $state->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state'))
                                <div class="invalid-feedback d-block`">{{ $errors->first('state') }}</div>
                                @endif
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <x-form-input type="password" name="new_password" label="Password" :labelClass="'form-label-title'"></x-form-input>
                        </div>
                    
                        <div class="col-md-6">
                            <x-form-input type="password" name="confirm_password" label="Confirm Password" :labelClass="'form-label-title'"></x-form-input>
                        </div>
                    </div>

                    <button class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection