@extends('layouts.frontend-layout')
@section('title', 'Lab Test')

@section('content')
<section class="section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                @if($labPackages->count() > 0)
                    <div class="row product-list-section">
                        @foreach($labPackages as $labPackage)
                        <div class="col-md-6 mb-4">
                            <div class="product-box-3 row mx-1">
                                <div class="col-md-5 product-image d-flex align-items-center position-relative">
                                    <a href="#" class="d-block">
                                        <img src="{{ asset($labPackage->image) }}" onerror="this.onerror=null; this.src='{{ asset('assets/images/default/lab.jpg') }}';"
                                            class="img-fluid lazyload rounded" alt="{{ $labPackage->name }}">
                                    </a>
                                </div>
                                <div class="col-md-7 product-detail-wrapper d-flex flex-column justify-content-between p-3">
                                    <div class="product-detail mb-1">
                                        <h4 class="name fw-bold fs-4 text-dark">{{ $labPackage->name }}</h4>
                                        <p class="text-muted mb-2 text-truncate-multiline">{!! nl2br($labPackage->description) !!}</p>
                                        <div class="mb-2">
                                            <strong class="text-great">{{ $labPackage->package_title }}:</strong>
                                            <ul class="list-group-numbered ms-3 mb-0 text-muted">
                                                @foreach ($labPackage->labTests->take(4) as $labTest)
                                                    <li class="d-block">{{ $labTest->name }}</li>
                                                @endforeach
                                            </ul>

                                            @if($labPackage->labTests->count() > 4)
                                                <a href="{{ route('lab-package.show', $labPackage) }}" class="ms-3 mt-2">View More...</a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('lab-package.book', $labPackage->id) }}" class="btn theme-bg-color text-white px-3 py-2 fs-6 shadow-sm">
                                            <i class="fa fa-shopping-cart me-2"></i>
                                            Book Package
                                    </a>
                                        <a href="{{ route('lab-package.show', $labPackage->id) }}" class="btn btn-secondary text-white px-3 py-2 fs-6 shadow-sm">
                                            <i class="fa fa-info-circle me-2"></i>
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <x-warning-message message="We will launch lab tests shortly!"></x-warning-message>
                @endif

                {{ $labPackages->links() }}
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Book Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Buttons for guest and account creation -->
                <div class="d-flex justify-content-between mb-3">
                    <button type="button" class="btn btn-theme-outline">Continue as Guest</button>
                    <button type="button" class="btn btn-theme-outline">Create an Account</button>
                </div>
                
                <form id="bookingForm">
                    <div class="mb-3">
                        <label for="yourName" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="yourName" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phoneNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="instructions" class="form-label">Any Instructions</label>
                        <textarea class="form-control" id="instructions" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="bookingForm" class="btn theme-bg-color text-white">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection