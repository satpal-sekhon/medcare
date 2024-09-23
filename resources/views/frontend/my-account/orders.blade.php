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
                    @forelse ($orders as $order)
                    <div class="mb-3 pb-2" style="background: #f8f8f8">
                        <div class="order-container ps-3 pt-4 pb-3">
                            <div class="order-icon">
                                <i data-feather="box"></i>
                            </div>
                            
                            <div class="order-detail">
                                <h4>#{{ $order->order_number }} <span>{{ $order->status }}</span></h4>
                                <h6 class="text-content">Product is Under Process & It Will be Delivered to you on Time.</h6>
                                <h6 class="text-content"><strong class="fw-bold">Ordered On:</strong> {{ $order->created_at->format('F j, Y') }}</h6>

                                @if ($order->update)                                    
                                <h6 class="text-content fw-bold m-0 p-0"><span class="text-danger">Order Update:</span> {{ $order->update }}</h6>
                                @endif
                            </div>
                        </div>

                        @foreach($order->items as $item)
                            <div class="product-order-detail m-3 bg-white">
                                <a href="#" class="order-image w-120px">
                                    <img src="{{ asset($item->thumbnail) }}" class="lazyload w-120px" alt="">
                                </a>

                                <div class="order-wrap">
                                    <a href="#">
                                        <h3>{{ $item->name }}</h3>
                                    </a>
                                    {{-- <p class="text-content">Use with Care, Product Descrption & Short Details</p> --}}
                                    <ul class="product-size">
                                        <li>
                                            <div class="size-box">
                                                <h6 class="text-content">Price : </h6>
                                                <h5>₹{{ $item->price }}</h5>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="size-box">
                                                <h6 class="text-content">Brand : </h6>
                                                <h5>{{ $item->brand_name }}</h5>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="size-box">
                                                <h6 class="text-content">Quantity : </h6>
                                                <h5>{{ $item->quantity }}</h5>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                        <div class="px-3">
                            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                            <p><strong>Sub Total:</strong> ₹{{ $order->sub_total }}</p>
                            @if ($order->discount)
                            <p><strong>Applied Coupon Code:</strong> ₹{{ $order->coupon_code }}</p>
                            <p><strong>Discount:</strong> ₹{{ $order->discount }}</p>
                            @endif
                            <p><strong>Shipping Charges:</strong> ₹{{ $order->total - $order->sub_total }}</p>
                            <p><strong>Total:</strong> ₹{{ $order->total }}</p>
                        </div>
                    </div>
                        @empty
                        <div class="p-md-4">
                            <x-warning-message message="You don't have any products order yet"></x-warning-message>
                        </div>
                    @endforelse

                </div>

                <div class="tab-pane fade" id="quick-orders" role="tabpanel">
                    @forelse($quickOrders as $order)
                    <div class="product-order-detail">
                        <div class="order-wrap">
                            <ul class="product-size">
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Order ID:</h6>
                                        <h5>#{{ $order->order_number }}</h5>
                                    </div>
                                </li>
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
                                    <div class="size-box">
                                        <h6 class="text-content">Status:</h6>
                                        <h5>{{ $order->status }}</h5>
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
                                <h5 class="fw-bold">{{ $order->package_name }}</h5>
                            </a>
                            <ul class="product-size mt-2">
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Order ID: </h6>
                                        <h5>#ODR-101{{ $order->id }}</h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Price: </h6>
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
                            <a href="javascript:void(0)">
                                <h5 class="fw-bold">#{{ $order->order_number }}</h5>
                            </a>

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