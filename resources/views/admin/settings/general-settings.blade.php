@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>General Settings</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('admin.settings.general.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                @foreach ([
                                    'primary_category_image' => 'Primary Category',
                                    'category_image' => 'Category',
                                    'brand_image' => 'Brand',
                                    'disease_image' => 'Disease',
                                    'product_image' => 'Product',
                                    'doctor_image' => 'Doctor',
                                    'lab_package_image' => 'Lab Package'
                                ] as $key => $label)
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label-title">{{ $label }} Default Image</label>
                                        <div class="form-group">
                                            <input type="file" name="{{ $key }}" accept="image/*" @class(['form-control', 'is-invalid' => $errors->has($key)])>
                                            @if ($errors->has($key))
                                                <div class="invalid-feedback d-block">{{ $errors->first($key) }}</div>
                                            @endif
                                            @if (isset($settings[$key]))
                                                <div class="mt-2">
                                                    <img src="{{ asset($settings[$key]) }}" alt="{{ $label }} Image" width="100">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                    
                                <div class="mb-4">
                                    <button type="submit" class="btn w-100 theme-bg-color text-white">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
