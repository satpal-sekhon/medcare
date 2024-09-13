<div class="row">
    <div class="col-md-6">
        <div class="row">
            <h4 class="fw-bold mb-3 text-center">Vendor Detaills</h4>

            <div class="col-md-6">
                <x-form-input name="user_name" label="User Name" value="{{ $vendor->user->name }}"
                    :labelClass="'form-label-title'"></x-form-input>
            </div>

            <div class="col-md-6">
                <x-form-input name="email" label="Email Address" value="{{ $vendor->user->email }}"
                    :labelClass="'form-label-title'"></x-form-input>
            </div>
            <div class="col-md-6">
                <x-form-input type="number" name="phone_number" label="Phone Number"
                    value="{{ $vendor->user->phone_number }}" :labelClass="'form-label-title'"></x-form-input>
            </div>

            <div class="col-md-6">
                <x-form-input name="address" label="Address" value="{{ $vendor->user->address }}"
                    :labelClass="'form-label-title'"></x-form-input>
            </div>
            <div class="col-md-6">
                <x-form-input name="city" label="City" value="{{ $vendor->user->city }}"
                    :labelClass="'form-label-title'"></x-form-input>
            </div>

            <div class="col-md-6">
                <x-form-input name="pincode" label="Pincode" value="{{ $vendor->user->pincode }}"
                    :labelClass="'form-label-title'"></x-form-input>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label-title mb-0">State</label>
                    <select name="state" @class(['form-control', 'is-invalid'=> $errors->first('state')])>
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->name }}" @selected(old('state', $vendor->user->state) ==
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
                <div class="mb-3">
                    <label class="form-label-title mb-0">Status</label>
                    <select name="status" @class(['form-control', 'is-invalid'=> $errors->first('status')])>
                        <option value="Active" @selected(old('status', $vendor->user->status) == 'Active')>
                            Active
                        </option>

                        <option value="Inactive" @selected(old('status', $vendor->user->status) == 'Inactive')>
                            Inactive
                        </option>

                        <option value="Pending Approval" 
                            @selected(old('status', $vendor->user->status) == 'Pending Approval')>
                            Pending Approval
                        </option>

                        <option value="Suspended"
                            @selected(old('status', $vendor->user->status) == 'Suspended')>
                            Suspended
                        </option>
                    </select>
                    @if ($errors->has('status'))
                    <div class="invalid-feedback d-block`">{{ $errors->first('status') }}</div>
                    @endif
                </div>
            </div>
            
            <div class="col-md-6">
                <x-form-input name="new_password" label="Password" :labelClass="'form-label-title'"></x-form-input>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <h4 class="fw-bold mb-3 text-center">Business Detaills</h4>
        <div class="row">
            <div class="col-md-6">
                <x-form-input name="business_name" label="Business User Name" value="{{ $vendor->name }}"
                    :labelClass="'form-label-title'"></x-form-input>
            </div>

            <div class="col-md-6">
                <x-form-input name="business_email" label="Business Email Address" value="{{ $vendor->email }}"
                    :labelClass="'form-label-title'"></x-form-input>
            </div>
            <div class="col-md-6">
                <x-form-input type="number" name="business_phone_number" label="Business Phone Number"
                    value="{{ $vendor->phone_number }}" :labelClass="'form-label-title'"></x-form-input>
            </div>

            <div class="col-md-6">
                <x-form-input name="business_address" label="Business Address" value="{{ $vendor->address }}"
                    :labelClass="'form-label-title'"></x-form-input>
            </div>
            <div class="col-md-6">
                <x-form-input name="business_city" label="Business City" value="{{ $vendor->city }}"
                    :labelClass="'form-label-title'"></x-form-input>
            </div>

            <div class="col-md-6">
                <x-form-input name="business_pincode" label="Business Pincode" value="{{ $vendor->pincode }}"
                    :labelClass="'form-label-title'"></x-form-input>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label-title mb-0">Business State</label>
                    <select name="business_state" @class(['form-control', 'is-invalid'=> $errors->first('state')])>
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->name }}" @selected(old('state', $vendor->state) == $state->name)>{{
                            $state->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('state'))
                    <div class="invalid-feedback d-block`">{{ $errors->first('state') }}</div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <x-form-input name="license_number" label="License Number" value="{{ $vendor->license_number }}"
                    :labelClass="'form-label-title'"></x-form-input>
            </div>

            <div class="col-md-6 mb-2">
                <label for="business_type" class="form-label-title mb-0">Business Type</label>
                <select name="business_type" id="business_type" @class(['form-control'])>
                    <option value="Pharmacy Store" @selected($vendor->type=='Pharmacy Store')>Pharmacy Store</option>
                    <option value="Channel Partner" @selected($vendor->type=='Channel Partner')>Channel Partner</option>
                    <option value="Other" @selected($vendor->type=='Other')>Other</option>
                </select>
            </div>

            <div class="col-md-6 mb-2">
                <label for="business_type" class="form-label-title mb-0">Shop Type</label>
                <select name="shop_type" id="shop_type" @class(['form-control'])>
                    <option value="Owned" @selected($vendor->shop_type=='Owned')>Owned</option>
                    <option value="Rented" @selected($vendor->shop_type=='Rented')>Rented</option>
                </select>
            </div>

            
            <div class="col-md-6">
                <x-form-input type="file" name="store_image" label="Store Image" :labelClass="'form-label-title'" accept="image/*"></x-form-input>

                @if ($vendor->image)
                    <img src="{{ asset($vendor->image) }}" alt="" style="width: 100px; height: auto;">
                @endif
            </div>
            <div class="col-md-6">
                <x-form-input type="file" name="documents" label="Upload Documents" :labelClass="'form-label-title'" multiple="true">
                </x-form-input>

                @if ($errors->has('documents.*'))
                    @foreach ($errors->get('documents.*') as $messages)
                        @foreach ($messages as $message)
                            <span class="text-danger d-block">{{ $message }}</span><br>
                        @endforeach
                    @endforeach
                @endif
                
                <div class="d-block">
                    @foreach ($vendor->assets as $key => $asset)
                        <div class="d-flex justify-content-between">
                            <div class="document-name">
                                <a href="{{ asset($asset->path) }}" target="_blank">Document {{ ++$key }}</a>
                            </div>
                            <div class="document-action">
                                <label>
                                    <input type="checkbox" name="delete_documents[]" value="{{ $asset->id }}"> Delete
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-3">
    <button type="submit" class="btn w-50 mx-auto theme-bg-color text-white">Save</button>
</div>