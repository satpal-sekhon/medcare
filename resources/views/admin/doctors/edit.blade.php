@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Edit Doctor</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('doctors.update', [$category->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <label class="form-label-title col-sm-4 mb-0">Doctor Type</label>

                                <select name="doctor_type" id="doctor_type" @class([
                                    'form-control',
                                    'is-invalid' => $errors->first('doctor_type'),
                                ])>
                                    <option value="" disabled>Select Doctor Type</option>
                                    @foreach ($doctorTypes as $doctorType)
                                        <option value="{{ $doctorType->id }}" @selected($doctorType->id == $doctor->doctor_type_id)>{{ $doctorType->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('doctor_type'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('doctor_type') }}</div>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title mb-0">Doctor Name</label>
                                <input type="text" name="name" placeholder="Doctor Name" maxlength="100"
                                    value="{{ old('name', $doctor->name) }}" @class(['form-control', 'is-invalid' => $errors->first('name')])>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title mb-0">Doctor Qualification</label>
                                <input type="text" name="qualification" placeholder="Doctor Qualification" value="{{ old('qualification', $doctor->qualification) }}"
                                    @class(['form-control', 'is-invalid' => $errors->first('qualification')]) maxlength="100">
                                @if ($errors->has('qualification'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('qualification') }}</div>
                                @endif
                            </div>

                            <div class="mb-2 row">
                                <label class="form-label-title">Doctor Image</label>
                                <div class="form-group">
                                    <input type="file" name="image" accept="image/*" @class(['form-control', 'is-invalid' => $errors->first('image')])>
                                    @if ($errors->has('image'))
                                        <div class="invalid-feedback d-block">{{ $errors->first('image') }}</div>
                                    @endif

                                    @if ($doctor->image)
                                        <img src="{{ asset($doctor->image) }}" alt=""
                                            style="width: 100px; height: auto;">
                                    @endif
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title mb-0">Description</label>
                                <textarea name="description" placeholder="Enter Description" @class([
                                    'form-control',
                                    'is-invalid' => $errors->first('description'),
                                ])>{{ old('description', $doctor->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('description') }}</div>
                                @endif
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
