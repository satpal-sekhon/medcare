@extends('layouts.vendor-layout')

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
                                        <th>Items</th>
                                        <th>Status</th>
                                        <th>Update</th>
                                        {{-- <th>Options</th> --}}
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
                            _token: "{{ csrf_token() }}",
                            user_id: "{{ auth()->user()->id }}"
                        }
                    },
                    columns: [{
                            data: null,
                            name: 'id',
                            render: function(data, type, row, meta) {
                                let viewUrl = `{{ route('vendor.view-order', ':id') }}`.replace(':id', row.id);

                                return `<a href="${viewUrl}">#${row.order_number}</a>`;
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
                            data: 'update',
                            name: 'update',
                            orderable: false,
                            render: function(data, type, row) {
                                return `${row.update ? row.update : '-'}`;
                            }
                        },
                        /* {
                            data: null,
                            name: 'actions',
                            orderable: false,
                            render: function(data, type, row) {
                                let viewUrl = `{{ route('vendor.view-order', ':id') }}`.replace(':id', row.order_number);
                    
                                return `
                                <ul>
                                    <li>
                                        <a href="${viewUrl}">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </li>
                                </ul>
                            `;
                            }
                        } */
                    ],
                    order: [[0, 'desc']]
                });
            });
        </script>
    @endpush
@endsection
