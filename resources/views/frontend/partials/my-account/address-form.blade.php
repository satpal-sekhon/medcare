@csrf
<div class="form-floating mb-4 theme-form-floating">
    <input type="text" name="name" class="form-control" id="addressName" placeholder="Enter First Name">
    <label for="addressName">Name</label>
</div>

<div class="form-floating mb-4 theme-form-floating">
    <textarea class="form-control" name="address" placeholder="Enter Address" id="address"
        style="height: 100px"></textarea>
    <label for="address">Enter Address</label>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-floating mb-4 theme-form-floating">
            <input type="text" name="city" class="form-control" id="city" placeholder="Enter City">
            <label for="pin">City</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-4 theme-form-floating">
            <select name="state" class="form-control" id="state">
                <option value="">Select State</option>
                @foreach ($states as $state)
                <option value="{{ $state->name }}">{{ $state->name }}</option>
                @endforeach
            </select>
            <label for="state">State</label>
        </div>
    </div>
</div>

<div class="form-floating mb-4 theme-form-floating">
    <input type="text" name="pincode" class="form-control" id="pin" placeholder="Enter Pin Code">
    <label for="pin">Pin Code</label>
</div>

<button type="submit" class="btn theme-bg-color btn-md text-white">
    Save New Address
</button>