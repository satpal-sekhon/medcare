@extends('layouts.admin-layout')

@section('content')
<div id="vue-components">
    <media-library></media-library>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

@endpush
@endsection