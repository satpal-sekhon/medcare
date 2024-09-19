@extends('layouts.admin-layout')

@section('content')
    <div class="title-header option-title d-sm-flex d-block">
        <h5>{{ $user->name }} Orders</h5>
    </div>

    <div class="row">
        <div class="col-sm-12">
            @if($totalOrdersCount > 0)
            @include('admin.users.partials.product-orders')
            @endif

            @if ($quickOrdersCount > 0)
                @include('admin.users.partials.quick-orders')
            @endif

            @if ($labPackageOrdersCount > 0)
                @include('admin.users.partials.lab-package-orders')
            @endif

            @if ($doctorConsultationOrdersCount > 0)
                @include('admin.users.partials.doctor-consultations')
            @endif
        </div>
    </div>

    <x-include-plugins :plugins="['dataTable']" />
@endsection
