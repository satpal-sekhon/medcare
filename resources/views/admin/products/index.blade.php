@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Products List</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-solid" href="{{ route('products.create') }}">Add Product</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table w-100 theme-table table-product" id="table_id">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Stock Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-include-plugins :plugins="['dataTable']" />

    @push('scripts')
        <script>
            $(document).ready(function() {
                window.table = $('table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('products.get') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}"
                        }
                    },
                    columns: [
                        {
                            data: null,
                            name: 'id',
                            render: function(data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            data: 'thumbnail',
                            name: 'thumbnail',
                            orderable: false,
                            render: function(data, type, row) {
                                let defaultImagePath = 'assets/images/default/product.png';
                                let imageUrl = data ? data : defaultImagePath;

                                return `<img src="{{ asset('${imageUrl}') }}" alt="Product Image" class="dt-image">`;
                            }
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'brand_name',
                            name: 'brand_name'
                        },
                        {
                            data: 'price',
                            name: 'price',
                            render: function(data, type, row) {
                                let priceHtml = `<p>Customer Price: ₹${row.customer_price}</p>`;
                                priceHtml += `<p>Vendor Price: ₹${row.vendor_price}</p>`;
                                priceHtml += `<p>MRP: ₹${row.mrp}</p>`;
                                return priceHtml;
                            }
                        },
                        {
                            data: null,
                            name: 'stock_status',
                            render: function(data, type, row){
                                let customerBadgeClass = '';
                                let customerBadgeText = '';

                                let vendorBadgeClass = '';
                                let vendorBadgeText = '';

                                // Determine customer stock badge
                                if (row.stock_type === 'Without Stock') {
                                    customerBadgeClass = 'badge-success';
                                    customerBadgeText = 'In Stock';
                                } else if (row.stock_type === 'With Stock') {
                                    if (row.stock_quantity_for_customer > 50) {
                                        customerBadgeClass = 'badge-success';
                                        customerBadgeText = 'In Stock';
                                    } else if (row.stock_quantity_for_customer <= 50 && row.stock_quantity_for_customer > 10) {
                                        customerBadgeClass = 'badge-warning';
                                        customerBadgeText = 'Limited Stock';
                                    } else if (row.stock_quantity_for_customer <= 10) {
                                        customerBadgeClass = 'badge-danger';
                                        customerBadgeText = 'Low Stock';
                                    }
                                } else {
                                    customerBadgeClass = 'badge-secondary';
                                    customerBadgeText = 'Out of Stock';
                                }

                                // Determine vendor stock badge
                                if (row.stock_type === 'Without Stock') {
                                    vendorBadgeClass = 'badge-success';
                                    vendorBadgeText = 'In Stock';
                                } else if (row.stock_type === 'With Stock') {
                                    if (row.stock_quantity_for_vendor > 50) {
                                        vendorBadgeClass = 'badge-success';
                                        vendorBadgeText = 'In Stock';
                                    } else if (row.stock_quantity_for_vendor <= 50 && row.stock_quantity_for_vendor > 10) {
                                        vendorBadgeClass = 'badge-warning';
                                        vendorBadgeText = 'Limited Stock';
                                    } else if (row.stock_quantity_for_vendor <= 10) {
                                        vendorBadgeClass = 'badge-danger';
                                        vendorBadgeText = 'Low Stock';
                                    }
                                } else {
                                    vendorBadgeClass = 'badge-secondary';
                                    vendorBadgeText = 'Out of Stock';
                                }

                                // Return both badges
                                return `
                                    <div>
                                        <span class="badge ${customerBadgeClass}">Customer: ${customerBadgeText}</span>
                                    </div>
                                    <div>
                                        <span class="badge ${vendorBadgeClass}">Vendor: ${vendorBadgeText}</span>
                                    </div>`;
                            }
                        },
                        {
                            data: null,
                            name: 'actions',
                            orderable: false,
                            render: function(data, type, row) {
                                let viewUrl = `{{ route('products.show', ':id') }}`.replace(':id', row.id);
                                let editUrl = `{{ route('products.edit', ':id') }}`.replace(':id', row.id);
                                let deleteUrl = `{{ route('products.destroy', ':id') }}`.replace( ':id', row.id);

                                return `
                                <ul>
                                    <!-- <li>
                                        <a href="${viewUrl}">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </li> -->
                                    <li>
                                        <a href="${editUrl}">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <button class="btn p-0 fs-6 delete-btn" data-source="product" data-endpoint="${deleteUrl}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </li>
                                </ul>
                            `;
                            }
                        }
                    ],
                    order: [[0, 'desc']]
                });
            });
        </script>
    @endpush
@endsection
