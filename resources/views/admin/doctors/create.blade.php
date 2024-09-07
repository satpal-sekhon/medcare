@extends('layouts.admin-layout')

@section('content')
<div class="row">
    <div class="col-sm-8 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-header-2">
                    <h5>Add New Doctor</h5>
                </div>

                <div class="theme-form theme-form-2 mega-form">
                    <form action="{{ route('doctors.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('admin.doctors.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection