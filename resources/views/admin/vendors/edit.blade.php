@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Edit Vendor Details</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('vendors.update', [$vendor->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="role" value="Vendor">
                            
                            @include('admin.vendors.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
