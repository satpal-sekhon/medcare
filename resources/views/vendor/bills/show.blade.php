@extends('layouts.admin-layout')

@section('content')
<div class="row">
    <div class="col-sm-12 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-header-2">
                    <h5>View Bill</h5>
                </div>

                <div class="container text-dark" id="bill-section">
                    <div class="bill-header">
                        <p class="mb-1">Date: {{ $bill->created_at }}</p>
                        <p>Invoice #: INV-000{{ $bill->id }}</p>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5>Bill From</h5>
                            <p class="mb-1">Name: {{ $bill->bill_from }}</p>
                            <p>Address: {!! nl2br($bill->bill_from_address) !!}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Bill To</h5>
                            <p class="mb-1">Name: {{ $bill->bill_to_name }}</p>
                            <p>Address: {!! nl2br($bill->bill_to_address) !!}</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalSum = 0;
                                @endphp

                                @foreach($bill->products as $product)
                                <tr class="item-row">
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>₹{{ $product->price }}</td>
                                    <td>₹{{ $product->total }}</td>
                                </tr>

                                @php
                                    $totalSum += $product->total;
                                @endphp
                                
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-right total">Total:</td>
                                    <td class="total">₹{{ number_format($totalSum, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary" id="print-button"><i class="ri-printer-line me-2"></i>Print Bill</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
        $('#print-button').on('click', function() {
            var printContents = $('#bill-section').html();
            var originalContents = $('body').html();

            $('body').html(printContents);
            window.print();
            $('body').html(originalContents);
            window.location.reload(); // Optional: Reloads the page to reset any changes
        });
    });
    </script>
@endpush
@endsection