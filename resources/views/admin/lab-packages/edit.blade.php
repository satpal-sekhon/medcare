@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Edit Lab Package</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('lab-packages.update', [$brand->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label-title mb-0">Brand Name</label>
                                <input type="text" name="name" placeholder="Category Name" maxlength="100"
                                    value="{{ old('name', $brand->name) }}" @class(['form-control', 'is-invalid' => $errors->first('name')])>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label-title">Brand Logo</label>
                                <div class="form-group">
                                    <input type="file" name="image" accept="image/*" @class(['form-control', 'is-invalid' => $errors->first('image')])>
                                    @if ($errors->has('image'))
                                        <div class="invalid-feedback d-block">{{ $errors->first('image') }}</div>
                                    @endif

                                    @if ($brand->image)
                                        <img src="{{ asset($brand->image) }}" alt=""
                                            style="width: 100px; height: auto;">
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-title mb-0">Short Description</label>
                                <textarea name="short_description" placeholder="Enter Short Description" @class([
                                    'form-control',
                                    'is-invalid' => $errors->first('short_description'),
                                ])>{{ old('short_description', $brand->short_description) }}</textarea>
                                @if ($errors->has('short_description'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('short_description') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn w-100 theme-bg-color text-white">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
