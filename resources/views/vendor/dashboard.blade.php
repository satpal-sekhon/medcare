@extends('layouts.vendor-layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Welcome {{ auth()->user()->name }}!</h2>
        
        <h5 class="mt-3">Your vendor ID is {{ auth()->user()->vendor->vendor_code }}</h5>
    </div>
</div>
@endsection