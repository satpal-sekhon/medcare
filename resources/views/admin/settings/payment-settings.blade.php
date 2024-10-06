@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Payment Settings</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <x-success-message :message="session('success')" />
                        
                        <form action="{{ route('admin.settings.payment.update') }}" method="post" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <x-form-input type="number" name="vendor_cod_charges" label="COD Charges For Vendor" value="{{ getSetting('vendor_cod_charges') ?? '' }}"></x-form-input>
                                </div>
                                <div class="col-md-6">
                                    <x-form-input type="number" name="cod_charges" label="COD Charges For Customer" value="{{ getSetting('cod_charges') ?? '' }}"></x-form-input>
                                </div>
                            </div>

                            <h4 class="fw-bold mt-3 mb-1">Payment Gateways</h4>

                            <h5 class="fw-bold mb-1">Razorpay</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <x-form-input name="razorpay_key_id" label="Key ID" value="{{ getSetting('razorpay_key_id') ?? '' }}"></x-form-input>
                                </div>
                                <div class="col-md-6">
                                    <x-form-input name="razorpay_key_secret" label="Key Secret" value="{{ getSetting('razorpay_key_secret') ?? '' }}"></x-form-input>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label-title" for="razorpayEnvironment">Environment</label>
                                    <select name="razorpay_environment" id="razorpayEnvironment" class="form-control">
                                        <option value="Production" @selected(getSetting('razorpay_environment') === "Production")>Production</option>
                                        <option value="Sandbox" @selected(getSetting('razorpay_environment') === "Sandbox")>Sandbox</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label-title" for="razorpayForVendor">Enable for Vendor</label>
                                    <select name="razorpay_for_vendor" id="razorpayForVendor" class="form-control">
                                        <option value="1" @selected(getSetting('razorpay_for_vendor') === "1")>Yes</option>
                                        <option value="" @selected(!getSetting('razorpay_for_vendor'))>No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-title" fpr="razorpayForCustomer">Enable for Customer</label>
                                    <select name="razorpay_for_customer" id="razorpayForCustomer" class="form-control">
                                        <option value="1" @selected(getSetting('razorpay_for_customer') === "1")>Yes</option>
                                        <option value="" @selected(!getSetting('razorpay_for_customer'))>No</option>
                                    </select>
                                </div>
                            </div>

                            <h5 class="fw-bold mb-1 mt-3">PayTM</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <x-form-input name="paytm_merchant_id" label="Merchant ID" value="{{ getSetting('paytm_merchant_id') ?? '' }}"></x-form-input>
                                </div>
                                <div class="col-md-6">
                                    <x-form-input name="paytm_merchant_key" label="Merchant Key" value="{{ getSetting('paytm_merchant_key') ?? '' }}"></x-form-input>
                                </div>
                                <div class="col-md-6">
                                    <x-form-input name="paytm_channel_id" label="Channel ID" value="{{ getSetting('paytm_channel_id') ?? '' }}"></x-form-input>
                                </div>
                                <div class="col-md-6">
                                    <x-form-input name="paytm_industry_type" label="Industry Type" value="{{ getSetting('paytm_industry_type') ?? '' }}"></x-form-input>
                                </div>
                                <div class="col-md-6">
                                    <x-form-input name="paytm_website" label="Website" value="{{ getSetting('paytm_website') ?? '' }}"></x-form-input>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-title" for="paytm_environment">Environment</label>
                                    <select name="paytm_environment" id="paytm_environment" class="form-control">
                                        <option value="Production" @selected(getSetting('paytm_environment') === "Production")>Production</option>
                                        <option value="Sandbox" @selected(getSetting('paytm_environment') === "Sandbox")>Sandbox</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-4 mt-2">
                                <button type="submit" class="btn theme-bg-color text-white">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
