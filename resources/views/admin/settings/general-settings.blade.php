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
                                    'default_primary_category_image' => 'Primary Category',
                                    'default_category_image' => 'Category',
                                    'default_brand_image' => 'Brand',
                                    'default_disease_image' => 'Disease',
                                    'default_product_image' => 'Product',
                                    'default_doctor_image' => 'Doctor',
                                    'default_lab_test_image' => 'Lab Test',
                                    'default_lab_package_image' => 'Lab Package',
                                    'default_user_image' => 'User',
                                    'default_pharmacy_image' => 'Pharmacy Store'
                                ] as $key => $label)
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label-title">Default {{ $label }} Image</label>
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
