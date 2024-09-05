@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Edit Coupon</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('coupons.update', [$coupon->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <label class="form-label-title mb-0">Coupon Code</label>
                                <input type="text" name="code" placeholder="Coupon Code" value="{{ old('code',  $coupon->code) }}"
                                    @class(['form-control', 'is-invalid' => $errors->first('code')]) maxlength="50">
                                @if ($errors->has('code'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('code') }}</div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label-title mb-0">Discount Amount</label>
                                        <input type="text" name="discount_amount" placeholder="Discount Amount" value="{{ old('discount_amount',  $coupon->discount_amount) }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('discount_amount')])>
                                        @if ($errors->has('discount_amount'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('discount_amount') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label-title mb-0">Discount Type</label>
                                        <select name="discount_type" @class(['form-control', 'is-invalid' => $errors->first('discount_type')])>
                                            <option value="">Select Discount Type</option>
                                            <option value="amount" @selected(old('discount_type',  $coupon->discount_type) == 'amount')>Amount</option>
                                            <option value="percentage" @selected(old('discount_type',  $coupon->discount_type) == 'percentage')>Percentage</option>
                                        </select>
                                        @if ($errors->has('discount_type'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('discount_type') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label-title mb-0">Start Date</label>
                                        <input type="date" name="start_date" placeholder="Start Date" value="{{ old('start_date',  $coupon->start_date) }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('start_date')])>
                                        @if ($errors->has('start_date'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('start_date') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label-title mb-0">Expires At</label>
                                        <input type="date" name="expires_at" placeholder="Expires At" value="{{ old('expires_at',  $coupon->expires_at) }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('expires_at')])>
                                        @if ($errors->has('expires_at'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('expires_at') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            

                            <div class="mb-3 mt-2 d-flex align-items-center gap-4">
                                <label class="form-label-title">Active</label>
                                <label class="switch">
                                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active',  $coupon->is_active==1))><span class="switch-state"></span>
                                </label>
                            </div>

                            <div class="mb-2">
                                <button type="submit" class="btn w-100 theme-bg-color text-white">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
