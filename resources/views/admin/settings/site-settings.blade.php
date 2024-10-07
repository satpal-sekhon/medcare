@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Site Settings</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <x-success-message :message="session('success')" />
                        
                        <form action="{{ route('admin.settings.site.update') }}" method="post" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <x-form-input name="site_name" label="Site Name" value="{{ getSetting('site_name') ?? '' }}"></x-form-input>
                                </div>
                                
                                @foreach ([
                                    'site_logo_1' => 'Site Logo 1',
                                    'site_logo_2' => 'Site logo 2',
                                ] as $key => $label)
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label-title mb-0">Default {{ $label }} Image</label>
                                        <div class="form-group">
                                            <input type="file" name="{{ $key }}" accept="image/*" @class(['form-control', 'is-invalid' => $errors->has($key)])>
                                            @if ($errors->has($key))
                                                <div class="invalid-feedback d-block">{{ $errors->first($key) }}</div>
                                            @endif

                                            @if (isset($settings[$key]))
                                                <div @class(["my-2", "bg-primary" => $key=='site_logo_1'])>
                                                    <img src="{{ asset($settings[$key]) }}" alt="{{ $label }} Image" width="100">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-6 mb-2">
                                    <x-form-input name="site_contact_number" label="Site Contact Number" value="{{ getSetting('site_contact_number') ?? '' }}"></x-form-input>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <x-form-input name="site_contact_email" label="Site email address" value="{{ getSetting('site_contact_email') ?? '' }}"></x-form-input>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <x-textarea name="site_address" label="Site Address" value="{{ getSetting('site_address') ?? '' }}"></x-textarea>
                                </div>
                            </div>

                            <div class="mb-4 mt-2">
                                <button type="submit" class="btn theme-bg-color text-white">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
