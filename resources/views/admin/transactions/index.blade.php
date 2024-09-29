@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Transactions</h5>
                    </div>

                    <x-success-message :message="session('success')" />

                    <div>
                        <div class="table-responsive">
                            <table class="table theme-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Payment through</th>
                                        <th>Transaction ID</th>
                                        <th>Status</th>
                                        <th>Transaction Date</th>
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
                        url: "{{ route('transactions.get') }}",
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
                            data: 'payment_method',
                            name: 'payment_method',
                            render: function(data, type, row) {
                                return `${row.payment_method}`;
                            }
                        },
                        {
                            data: 'transaction_id',
                            name: 'transaction_id',
                            orderable: false,
                            render: function(data, type, row) {
                                return `${row.transaction_id}`;
                            }
                        },
                        {
                            data: 'payment_status',
                            name: 'payment_status',
                            orderable: false,
                            render: function(data, type, row) {
                                return `${row.payment_status}`;
                            }
                        },
                        {
                            data: 'transaction_date',
                            name: 'transaction_date',
                            render: function(data, type, row) {
                                const createdAt = new Date(row.created_at);
                                
                                const options = {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric',
                                    hour: 'numeric',
                                    minute: 'numeric',
                                    hour12: true, // Use 12-hour clock
                                };
                                
                                const invoiceDate = createdAt.toLocaleString('en-US', options);
                                return `${invoiceDate}`;
                            }
                        }
                    ],
                    order: [[0, 'desc']]
                });
            });
        </script>
    @endpush
@endsection
