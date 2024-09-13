@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Create Brand</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('brands.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label-title mb-0">Brand Name</label>
                                <input type="text" name="name" placeholder="Brand Name" value="{{ old('name') }}"
                                    @class(['form-control', 'is-invalid' => $errors->first('name')]) maxlength="100">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <x-form-input type="file" name="image" label="Brand Logo" accept="image/*" labelClass="form-label-title"></x-form-input>
                                    @if ($errors->has('image'))
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-form-input type="file" name="banner_image" label="Banner Image" accept="image/*" labelClass="form-label-title"></x-form-input>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-title mb-0">Description</label>
                                <textarea name="description" placeholder="Enter Description" @class([
                                    'form-control',
                                    'is-invalid' => $errors->first('description'),
                                ])>{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('description') }}</div>
                                @endif
                            </div>

                            <div class="mb-3 d-flex align-items-center gap-4">
                                <label class="form-label-title">Show On Homepage</label>
                                <label class="switch">
                                    <input type="checkbox" name="show_on_homepage" value="1"><span class="switch-state"></span>
                                </label>
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
