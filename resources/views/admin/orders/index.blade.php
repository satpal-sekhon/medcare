@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Orders</h5>
                    </div>

                    <x-success-message :message="session('success')" />

                    <div>
                        <div class="table-responsive">
                            <table class="table theme-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Items</th>
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
            function nl2br(str) {
                if(!str){
                    return ``;
                }

                return str.replace(/\n/g, '<br>');
            }

            $(document).ready(function() {
                window.table = $('table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('orders.get') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}"
                        }
                    },
                    columns: [{
                            data: null,
                            name: 'id',
                            render: function(data, type, row, meta) {
                                let editUrl = `{{ route('orders.edit', ':id') }}`.replace(':id', row.id);

                                return `<a href="${editUrl}">#${row.order_number}</a>`;
                            }
                        },
                        {
                            data: 'name',
                            name: 'name',
                            render: function(data, type, row) {
                                let userBadge = ``;

                                if(!row.user_id){
                                    userBadge = `<span class="badge badge-warning">Guest</span>`;
                                } else if(row.user){
                                    userBadge = `<span class="badge badge-success">#${row.user.user_code}</span>`;
                                }

                                return `${userBadge} ${JSON.parse(row.shipping_address).customerName}`;
                            }
                        },
                        {
                            data: 'email',
                            name: 'email',
                            render: function(data, type, row) {
                                return `${JSON.parse(row.shipping_address).email}`;
                            }
                        },
                        {
                            data: 'phone_number',
                            name: 'phone_number',
                            render: function(data, type, row) {
                                return `${JSON.parse(row.shipping_address).phone}`;
                            }
                        },
                        {
                            data: 'address',
                            name: 'address',
                            render: function(data, type, row) {
                                return `${JSON.parse(row.shipping_address).addressLine1}`;
                            }
                        },
                        {
                            data: 'order_items',
                            name: 'order_items',
                            render: function(data, type, row) {
                                return `${row.total_quantity}`;
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            render: function(data, type, row) {
                                return `${row.status}`;
                            }
                        },
                        {
                            data: null,
                            name: 'actions',
                            orderable: false,
                            render: function(data, type, row) {
                                let editUrl = `{{ route('orders.edit', ':id') }}`.replace(':id', row.id);
                                let deleteUrl = `{{ route('orders.destroy', ':id') }}`.replace(':id', row.id);
                    
                                return `
                                <ul>
                                    <li>
                                        <a href="${editUrl}">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <button class="btn p-0 fs-6 delete-btn" data-source="order" data-endpoint="${deleteUrl}">
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
