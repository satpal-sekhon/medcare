<div class="row">
    <div class="col-md-6">
        <x-form-input name="name" label="Shop Name" value="{{ $pharmacy->name }}"
            :labelClass="'form-label-title'"></x-form-input>
    </div>

    <div class="col-md-6">
        <x-form-input name="email" label="Email Address" value="{{ $pharmacy->email }}"
            :labelClass="'form-label-title'"></x-form-input>
    </div>
    <div class="col-md-6">
        <x-form-input type="number" name="phone_number" label="Phone Number" value="{{ $pharmacy->phone_number }}"
            :labelClass="'form-label-title'"></x-form-input>
    </div>

    <div class="col-md-6">
        <x-form-input name="address" label="Address" value="{{ $pharmacy->address }}"
            :labelClass="'form-label-title'"></x-form-input>
    </div>
    <div class="col-md-6">
        <x-form-input name="city" label="City" value="{{ $pharmacy->city }}" :labelClass="'form-label-title'">
        </x-form-input>
    </div>

    <div class="col-md-6">
        <x-form-input name="pincode" label="Pincode" value="{{ $pharmacy->pincode }}"
            :labelClass="'form-label-title'"></x-form-input>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label-title mb-0">State</label>
            <select name="state" @class(['form-control', 'is-invalid'=> $errors->first('state')])>
                <option value="">Select State</option>
                @foreach ($states as $state)
                <option value="{{ $state->name }}" @selected(old('state', $pharmacy->state) ==
                    $state->name)>{{
                    $state->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('state'))
            <div class="invalid-feedback d-block`">{{ $errors->first('state') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6 mb-2">
        <label for="business_type" class="form-label-title mb-0">Shop Type</label>
        <select name="shop_type" id="shop_type" @class(['form-control'])>
            <option value="Owned" @selected($pharmacy->shop_type=='Owned')>Owned</option>
            <option value="Rented" @selected($pharmacy->shop_type=='Rented')>Rented</option>
        </select>
    </div>


    <div class="col-md-6">
        <x-form-input type="file" name="store_image" label="Store Image" :labelClass="'form-label-title'"
            accept="image/*"></x-form-input>

        @if ($pharmacy->image)
        <img src="{{ asset($pharmacy->image) }}" alt="" style="width: 100px; height: auto;">
        @endif
    </div>
</div>

<div class="my-3">
    <button type="submit" class="btn w-50 theme-bg-color text-white">Save</button>
</div>