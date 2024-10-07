@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Create Bill</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        @include('admin.bills.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
