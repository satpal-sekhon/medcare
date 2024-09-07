<div class="row">
    <div class="col-md-6 mb-2">
        <label class="form-label-title col-sm-4 mb-0">Doctor Type</label>

        <select name="doctor_type" id="doctor_type" @class(['form-control', 'is-invalid'=>
            $errors->first('doctor_type')])>
            <option value="" selected disabled>Select Doctor Type</option>
            @foreach ($doctorTypes as $doctorType)
            <option value="{{ $doctorType->id }}" @selected(old('doctor_type', ($doctor->doctor_type_id ?? 0))==$doctorType->id)>{{ $doctorType->name }}
            </option>
            @endforeach
        </select>

        @if ($errors->has('doctor_type'))
        <div class="invalid-feedback d-block`">{{ $errors->first('doctor_type') }}</div>
        @endif
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label-title mb-0">Doctor Name</label>
        <input type="text" name="name" placeholder="Doctor Name" value="{{ old('name', ($doctor->name ?? '')) }}"
            @class(['form-control', 'is-invalid'=> $errors->first('name')]) maxlength="50">

        @if ($errors->has('name'))
        <div class="invalid-feedback d-block`">{{ $errors->first('name') }}</div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-2">
        <label class="form-label-title mb-0">Doctor Email</label>
        <input type="text" name="email" placeholder="Doctor Email" value="{{ old('email', ($doctor->email ?? '')) }}"
            @class(['form-control', 'is-invalid'=> $errors->first('email')]) maxlength="100">

        @if ($errors->has('email'))
        <div class="invalid-feedback d-block`">{{ $errors->first('email') }}</div>
        @endif
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label-title mb-0">Doctor Phone Number</label>
        <input type="text" name="phone_number" placeholder="Doctor Phone Number" value="{{ old('phone_number', ($doctor->phone_number ?? '')) }}"
            @class(['form-control', 'is-invalid'=> $errors->first('phone_number')])>

        @if ($errors->has('phone_number'))
        <div class="invalid-feedback d-block`">{{ $errors->first('phone_number') }}</div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-2">
        <label class="form-label-title mb-0">Doctor Qualification</label>
        <input type="text" name="qualification" placeholder="Doctor Qualification" value="{{ old('qualification', ($doctor->qualification ?? '')) }}"
            @class(['form-control', 'is-invalid'=> $errors->first('qualification')]) maxlength="100">

        @if ($errors->has('qualification'))
        <div class="invalid-feedback d-block`">{{ $errors->first('qualification') }}</div>
        @endif
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label-title">Doctor Image</label>
        <div class="form-group">
            <input type="file" name="image" accept="image/*" @class(['form-control', 'is-invalid'=>
            $errors->first('image')])>

            @if ($errors->has('image'))
                <div class="invalid-feedback d-block">{{ $errors->first('image') }}</div>
            @endif

            @if ($doctor->image ?? '')
                <img src="{{ asset($doctor->image) }}" alt="" style="width: 100px; height: auto;">
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-2">
        <label class="form-label-title mb-0">Total Experience</label>
        <input type="number" name="experience" placeholder="Total Experience" value="{{ old('experience', ($doctor->experience ?? '')) }}"
            @class(['form-control', 'is-invalid'=> $errors->first('experience')]) step="0.1">

        @if ($errors->has('experience'))
        <div class="invalid-feedback d-block`">{{ $errors->first('experience') }}</div>
        @endif
    </div>
</div>

<div class="mb-2">
    <label class="form-label-title mb-0">Description</label>
    <textarea name="description" placeholder="Enter Description" @class([ 'form-control'
        , 'is-invalid'=> $errors->first('description')])>{{ old('description', ($doctor->description ?? '')) }}</textarea>
    @if ($errors->has('description'))
    <div class="invalid-feedback d-block">{{ $errors->first('description') }}</div>
    @endif
</div>

<div class="mb-4">
    <button type="submit" class="btn w-100 theme-bg-color text-white">Save</button>
</div>