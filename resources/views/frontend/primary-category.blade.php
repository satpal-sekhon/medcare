@extends('layouts.frontend-layout')
@section('title', $primaryCategory->name)

@section('content')
<section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain text-center">
                    <h2 class="mx-auto">Primary Category: {{ $primaryCategory->name }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <category-products :filter-param="'primary_category_ids'" :filter-value="@json($primaryCategory->id)"></category-products>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('assets/js/filter-sidebar.js') }}"></script>
@endpush
@endsection