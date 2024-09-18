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

                    <div class="filter">
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label class="form-label-title mb-0">Primary Category</label>
                                <select name="primary_category" id="primary_category" class="form-control">
                                    <option value="">All Primary Categories</option>
                                    @foreach ($primaryCategories as $primary_category)
                                        <option value="{{ $primary_category->id }}">{{ $primary_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <div class="mb-3 col-md-3">
                                <label class="form-label-title mb-0">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">All Categories</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="form-label-title mb-0">Brand</label>
                                <select name="brand" id="brand" class="form-control">
                                    <option value="">All Brands</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="form-label-title col-sm-4 mb-0">Diseases</label>
                                <select name="diseases" id="diseases" class="form-control">
                                    <option value="">All Diseases</option>
                                    @foreach ($diseases as $disease)
                                        <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="table-responsive">
                            <table class="table w-100 theme-table table-product" id="table_id">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Thumbnail</th>
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
                        data: function(d) {
                            d._token = "{{ csrf_token() }}";
                            d.primary_category = $('#primary_category').val();
                            d.category = $('#category').val();
                            d.brand = $('#brand').val();
                            d.disease = $('#diseases').val();
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
                            className: 'product-thumbnail-column',
                            orderable: false,
                            render: function(data, type, row) {
                                let defaultImagePath = 'assets/images/default/product.jpg';
                                let imageUrl = data ? data : defaultImagePath;

                                return `<img src="{{ asset('${imageUrl}') }}" alt="Product Image" class="dt-image" onerror="this.onerror=null; this.src='{{ asset('${defaultImagePath}') }}';">`;
                            }
                        },
                        {
                            data: 'name',
                            name: 'name',
                            className: 'product-name-column',
                            render: function(data, type, row) {
                                let viewUrl = `{{ route('products.view', ':slug') }}`.replace(':slug', row.slug);
                                
                                return `<a href="${viewUrl}" target="_blank">${row.name}</a>`;
                            }
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
                                let viewUrl = `{{ route('products.view', ':slug') }}`.replace(':slug', row.slug);
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

                function populateCategories(primaryCategoryId, selectedCategoryId) {
                    $.ajax({
                        url: "{{ route('categories.get-by-primary-category') }}",
                        method: 'GET',
                        data: {
                            category_id: primaryCategoryId
                        },
                        success: function(response){
                            if(response.success){
                                let categories = response.categories;
                                let $categorySelect = $('#category');
                                $categorySelect.html('<option value="">All Categories</option>');

                                categories.forEach(function(category){
                                    $categorySelect.append(`<option value="${category.id}">${category.name}</option>`);
                                });
                            }
                        }
                    });
                }

                $('#primary_category').change(function(){
                    let selectedPrimaryCategoryId = $(this).val();
                    populateCategories(selectedPrimaryCategoryId, '');
                    window.table.ajax.reload();
                });

                $('#category, #brand , #diseases').change(function(){
                    window.table.ajax.reload();
                });
            });
        </script>
    @endpush
@endsection
