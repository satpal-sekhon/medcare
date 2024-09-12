@extends('layouts.vendor-layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Welcome {{ auth()->user()->name }}!</h2>
    </div>
</div>
@endsection