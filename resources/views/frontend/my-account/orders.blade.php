@extends('layouts.user-account')
@section('title', 'User Dashboard')

@section('my-account')
<div class="dashboard-order">
    <div class="title">
        <h2>My Orders History</h2>
        <span class="title-leaf title-leaf-gray">
            <svg class="icon-width bg-gray">
                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
            </svg>
        </span>
    </div>

    <x-success-message :message="session('success')" />


    <div class="order-contain">
        <div class="order-box dashboard-bg-box w-100">
            <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="products-tab" data-bs-toggle="tab" data-bs-target="#products"
                        type="button" role="tab">Products</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="quick-orders-tab" data-bs-toggle="tab" data-bs-target="#quick-orders"
                        type="button" role="tab">Quick Orders</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="lab-packages-tab" data-bs-toggle="tab" data-bs-target="#lab-packages"
                        type="button" role="tab">Lab Packages</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="doctor-consultations-tab" data-bs-toggle="tab"
                        data-bs-target="#doctor-consultations" type="button" role="tab">Doctor Consultations</button>
                </li>
            </ul>

            <div class="tab-content custom-tab">
                <div class="tab-pane fade show active" id="products" role="tabpanel">
                    <div class="p-md-4">
                        <x-warning-message message="You don't have any products order yet"></x-warning-message>
                    </div>

                    {{-- <div class="order-container pt-4">
                        <div class="order-icon">
                            <i data-feather="box"></i>
                        </div>

                        <div class="order-detail">
                            <h4>Delivers <span>Pending</span></h4>
                            <h6 class="text-content">Product is Under Process & It Will be Delivered to you on Time. &
                                Product is Under Process & It Will be Delivered to you on Time.</h6>
                        </div>
                    </div>

                    <div class="product-order-detail">
                        <a href="#" class="order-image">
                            <img src="{{ asset('assets/images/product/1.png') }}" class="lazyload" alt="">
                        </a>

                        <div class="order-wrap">
                            <a href="#">
                                <h3>Product 1 Name</h3>
                            </a>
                            <p class="text-content">Use with Care, Product Descrption & Short Details</p>
                            <ul class="product-size">
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Price : </h6>
                                        <h5>₹20.68</h5>
                                    </div>
                                </li>

                                <!-- <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Rate : </h6>
                                        <div class="product-rating ms-2">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li> -->

                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Sold By : </h6>
                                        <h5>Seller Name</h5>
                                    </div>
                                </li>

                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Quantity : </h6>
                                        <h5>250 G</h5>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}

                </div>

                <div class="tab-pane fade" id="quick-orders" role="tabpanel">
                    @forelse($quickOrders as $order)
                    <div class="product-order-detail">
                        <div class="order-wrap">
                            <ul class="product-size">
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Customer Name:</h6>
                                        <h5>{{ $order->name }}</h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Phone Number:</h6>
                                        <h5>{{ $order->phone_number }}</h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Email:</h6>
                                        <h5>{{ $order->email }}</h5>
                                    </div>
                                </li>
                                <li>
                                    <div @class(["size-box", "d-block" => getFileTypeByMimeType($order->mime_type) == 'image'])>
                                        <h6 class="text-content">Prescription: </h6>
                                        @if(getFileTypeByMimeType($order->mime_type) == 'image')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{ asset($order->prescription_path) }}" alt="" class="img-fluid mt-2">
                                            </div>
                                        </div>
                                        @else
                                            <h5><a href="{{ asset($order->prescription_path) }}" target="_blank">Click here to view prescription</a></h5>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @empty
                    <div class="p-md-4">
                        <x-warning-message message="You don't have placed any quick order yet"></x-warning-message>
                    </div>
                    @endforelse
                </div>

                <div class="tab-pane fade" id="lab-packages" role="tabpanel">
                    @forelse($labPackageOrders as $order)
                    <div class="product-order-detail">
                        <a href="{{ route('lab-package.show', $order->lab_package_id ?? '0') }}"
                            class="order-image w-25">
                            <img src="{{ asset($order->package_image) }}"
                                onerror="this.onerror=null; this.src='{{ asset('assets/images/default/lab.jpg') }}';"
                                class="img-fluid lazyload" alt="">
                        </a>

                        <div class="order-wrap">
                            <a href="{{ route('lab-package.show', $order->lab_package_id ?? '0') }}">
                                <h3>{{ $order->package_name }}</h3>
                            </a>
                            <ul class="product-size">
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Price : </h6>
                                        <h5>₹{{ $order->package_amount }}</h5>
                                    </div>
                                </li>
                            </ul>
                            <ul class="product-size mt-2">
                                <h5 class="fw-bold">{{ $order->package_title }}</h5>

                                @foreach (json_decode($order->included_tests) as $key => $test)
                                <li>
                                    <div class="size-box">
                                        <h5>{{ ++$key }}. {{ $test }}</h5>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    @empty
                    <div class="p-md-4">
                        <x-warning-message message="You don't have booked any lab package yet"></x-warning-message>
                    </div>
                    @endforelse
                </div>

                <div class="tab-pane fade" id="doctor-consultations" role="tabpanel">
                    @forelse($doctorConsultationOrders as $order)
                    <div class="product-order-detail">
                        <a href="{{ route('doctors.consult', $order->doctor_id ?? '0') }}" class="order-image w-25">
                            <img src="{{ asset($order->doctor_image) }}"
                                onerror="this.onerror=null; this.src='{{ asset('assets/images/default/doctor.png   ') }}';"
                                class="img-fluid lazyload" alt="">
                        </a>

                        <div class="order-wrap">
                            <a href="{{ route('doctors.consult', $order->doctor_id ?? '0') }}">
                                <h3>
                                    {{ $order->doctor_name }} 
                                    @if($order->doctor_qualification)
                                        ({{ $order->doctor_qualification }})
                                    @endif
                                </h3>
                            </a>
                            <h5 class="fw-bold">{{ $order->doctor_type }}</h5>

                            <ul class="product-size mt-2">
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Experience : </h6>
                                        <h5>{{ $order->doctor_experience }} years</h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Price : </h6>
                                        <h5>₹{{ $order->amount_paid }}</h5>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @empty
                    <div class="p-md-4">
                        <x-warning-message message="You don't consulted wit doctor"></x-warning-message>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection