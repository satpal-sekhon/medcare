@extends('layouts.frontend-layout')
@section('title', $category->name)

@section('content')
<section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain text-center">
                    <h2 class="mx-auto">Category: {{ $category->name }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <category-products :filter-param="'category_ids'" :filter-value="@json($category->id)"></category-products>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('assets/js/filter-sidebar.js') }}"></script>
@endpush
@endsection