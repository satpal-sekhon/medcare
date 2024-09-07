<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-2">
            <label for="personName">Name</label>
            <input type="text" name="name" id="personName" value="{{ old('name', ($address->name ?? '')) }}"
                @class(['form-control', 'is-invalid'=> $errors->first('name')])>
            @if ($errors->has('name'))
            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2">
            <label for="phoneNumber">Phone Number</label>
            <input type="text" name="phone_number" id="phoneNumber" value="{{ old('phone_number', ($address->phone_number ?? '')) }}"
                @class(['form-control', 'is-invalid'=> $errors->first('phone_number')])>
            @if ($errors->has('phone_number'))
            <span class="invalid-feedback">{{ $errors->first('phone_number') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-2">
            <label for="addressLine1">Address Line 1</label>
            <input type="text" name="address_line_1" id="addressLine1" value="{{ old('address_line_1', ($address->address_line_1 ?? '')) }}"
                @class(['form-control', 'is-invalid'=> $errors->first('address_line_1')])>
            @if ($errors->has('address_line_1'))
            <span class="invalid-feedback">{{ $errors->first('address_line_1') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2">
            <label for="addressLine2">Address Line 2</label>
            <input type="text" name="address_line_2" id="addressLine2" value="{{ old('address_line_2', ($address->address_line_2 ?? '')) }}"
                @class(['form-control', 'is-invalid'=> $errors->first('address_line_2')])>
            @if ($errors->has('address_line_2'))
            <span class="invalid-feedback">{{ $errors->first('address_line_2') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-2">
            <label for="city">City</label>
            <input type="text" name="city" id="city" value="{{ old('city', ($address->name ?? '')) }}" @class(['form-control', 'is-invalid'=>
            $errors->first('city')])>
            @if ($errors->has('city'))
            <span class="invalid-feedback">{{ $errors->first('city') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2">
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
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-2">
            <label for="pinCode">Pin Code</label>
            <input type="number" name="pincode" id="pinCode" value="{{ old('pincode', ($address->pincode ?? '')) }}"
                @class(['form-control', 'is-invalid'=> $errors->first('pincode')])>
            @if ($errors->has('pincode'))
            <span class="invalid-feedback">{{ $errors->first('pincode') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2">
            <label for="pinCode">Address Type</label>
            <select name="address_type" id="addressType" @class(['form-control', 'is-invalid'=>
                $errors->first('address_type')])>
                <option value="" selected disabled>Select Address Type</option>
                <option value="Home" @selected(old('address_type', ($address->address_type ?? '')) == 'Home')>Home</option>
                <option value="Office" @selected(old('address_type', ($address->address_type ?? '')) == 'Office')>Office</option>
                <option value="Other" @selected(old('address_type', ($address->address_type ?? '')) == 'Other')>Other</option>
            </select>
            @if ($errors->has('address_type'))
            <span class="invalid-feedback">{{ $errors->first('address_type') }}</span>
            @endif
        </div>
    </div>
</div>

<div @class(["form-group mb-2 company-name-container", "d-none" => old('address_type', ($address->address_type ?? '')) !== 'Office'])>
    <label for="companyName">Company Name</label>
    <input type="text" name="company_name" id="companyName" value="{{ old('company_name', ($address->company_name ?? '')) }}" @class(['form-control', 'is-invalid'=>
    $errors->first('company_name')])>
    @if ($errors->has('company_name'))
    <span class="invalid-feedback">{{ $errors->first('company_name') }}</span>
    @endif
</div>

<div class="form-group mb-2">
    <label for="instructions">Instructions</label>
    <textarea name="instructions" class="form-control h-100" id="instructions" @class(['form-control', 'is-invalid'=> $errors->first('instructions')])>
        {{ old('instructions', ($address->instructions ?? '')) }}
    </textarea>
    @if ($errors->has('instructions'))
    <span class="invalid-feedback">{{ $errors->first('instructions') }}</span>
    @endif
</div>

<div class="form-check mb-2 ps-0">
    <input type="checkbox" name="is_default" class="checkbox_animated" id="isDefault" value="1" @disabled(($address->is_default ?? false)) @checked(old('is_default', ($address->is_default ?? false)))>
    <label class="form-check-label" for="isDefault">
        <span class="name">Use this address as the default address</span>
    </label>
</div>

<button type="submit" class="btn theme-bg-color btn-md text-white">
    Save Address
</button>

@push('scripts')
    <script>
        $(function(){
            $('[name="address_type"]').change(function(){
                if($(this).val()=='Office'){
                    $('.company-name-container').removeClass('d-none')
                } else{
                    $('.company-name-container').addClass('d-none')
                }
            })
        })
    </script>
@endpush