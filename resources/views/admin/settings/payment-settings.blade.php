@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Payment Settings</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <x-success-message :message="session('success')" />
                        
                        <form action="{{ route('admin.settings.payment.update') }}" method="post" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <x-form-input type="number" name="cod_charges" label="COD Charges" value="{{ getSetting('cod_charges') ?? '' }}"></x-form-input>
                                </div>
                    
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
