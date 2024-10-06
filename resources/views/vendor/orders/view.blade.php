@extends('layouts.vendor-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-flex">
                        <h5 class="text-center">Order: #{{ $order->order_number }}</h5>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
                    </div>

                    @if ($order->update)
                        <div>
                            <p class="fs-6 text-body"><strong>Update:</strong> {{ $order->update }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-2">
        <h2 class="text-center mb-2">Order Summary</h2>
        <div class="row">
            <div class="col-md-8">
                <h3>Items Ordered</h3>
                <table class="table mt-2 table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td><img src="{{ asset($item->thumbnail) }}" alt="" class="img-fluid w-90px"></td>
                                <td>{{ $item->name }} - {{ $item->unit }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>₹{{ $item->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Sub Total</th>
                            <th>₹{{ $order->sub_total }}</th>
                        </tr>
                        @if ($order->coupon_code)
                        <tr>
                            <th colspan="3" class="text-end">Applied Coupon</th>
                            <th>{{ $order->coupon_code }}</th>
                        </tr>
                        @endif
                        @if ($order->discount)
                        <tr>
                            <th colspan="3" class="text-end">Discount</th>
                            <th>(-)₹{{ $order->discount }}</th>
                        </tr>
                        @endif
                        <tr>
                            <th colspan="3" class="text-end">Total</th>
                            <th>₹{{ $order->total }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="col-md-4">
                <div>
                    <h3>Payment Information</h3>
                    <ul class="list-group mt-2">
                        <li class="list-group-item">
                            <strong>Payment Method:</strong>
                            {{ $order->payment_method }}
                        </li>
                        @if ($order->transaction_id)
                        <li class="list-group-item">
                            <strong>Transaction ID:</strong>
                            {{ $order->transaction_id }}
                        </li>
                        @endif
                        <li class="list-group-item">
                            <strong>Payment Status:</strong>
                            {{ $order->payment_status }}
                        </li>
                    </ul>
                </div>
                
                <div class="mt-3">
                    <h3>Shipping Information</h3>
                    <ul class="list-group mt-2">
                        <li class="list-group-item">
                            <strong>Name:</strong>
                            {{ json_decode($order->shipping_address)->customerName }}
                        </li>
                        <li class="list-group-item">
                            <strong>Address:</strong>
                            {{ json_decode($order->shipping_address)->addressLine1 }}
                        </li>
                        <li class="list-group-item">
                            <strong>State:</strong>
                            {{ json_decode($order->shipping_address)->state }}
                        </li>
                        <li class="list-group-item">
                            <strong>Pin Code:</strong>
                            {{ json_decode($order->shipping_address)->pinCode }}
                        </li>
                        <li class="list-group-item">
                            <strong>Email:</strong>
                            {{ json_decode($order->shipping_address)->email }}
                        </li>
                        <li class="list-group-item">
                            <strong>Phone:</strong>
                            {{ json_decode($order->shipping_address)->phone }}
                        </li>
                        @if (json_decode($order->shipping_address)->instructions)                            
                        <li class="list-group-item">
                            <strong>Instructions:</strong> 
                            {!! nl2br(json_decode($order->shipping_address)->instructions) !!}
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
