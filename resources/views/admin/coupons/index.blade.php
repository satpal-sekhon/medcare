@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Coupons/Offers</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="align-items-center btn btn-theme d-flex"
                                        href="{{ route('coupons.create') }}">
                                        <i data-feather="plus-square"></i> Add New
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <x-success-message :message="session('success')" />

                    <div>
                        <div class="table-responsive">
                            <table class="table theme-table w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Coupon Code</th>
                                        <th>Discount</th>
                                        <th>Status</th>
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
                        url: "{{ route('coupons.get') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}"
                        }
                    },
                    columns: [{
                            data: null,
                            name: 'id',
                            render: function(data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: null,
                            name: 'discount',
                            render: function(data, type, row, meta) {
                                let discount = ``;
                                
                                if (row.discount_type === 'amount') {
                                    discount += `₹${row.discount_amount}`;
                                } else if (row.discount_type === 'percentage') {
                                    discount += `${Math.round(row.discount_amount)}%`;
                                } else {
                                    discount += 'N/A';
                                }

                                return `${discount} `;
                            }
                        },
                        {
                            data: null,
                            name: 'status',
                            render: function(data, type, row, meta) {
                                let statusClass = row.is_active ? 'badge-success' : 'badge-danger';
                                let statusText = row.is_active ? 'Active' : 'Inactive';

                                return `<span class="badge ${statusClass}">${statusText}</span>`;
                            }
                        },
                        {
                            data: null,
                            name: 'actions',
                            orderable: false,
                            render: function(data, type, row) {
                                let editUrl = `{{ route('coupons.edit', ':id') }}`.replace(':id', row.id);
                                let deleteUrl = `{{ route('coupons.destroy', ':id') }}`.replace(':id', row.id);
                    
                                return `
                                <ul>
                                    <li>
                                        <a href="${editUrl}">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <button class="btn p-0 fs-6 delete-btn" data-source="coupon" data-endpoint="${deleteUrl}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </li>
                                </ul>
                            `;
                            }
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
