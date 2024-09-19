<div class="card card-table">
    <div class="card-body">
        <div class="title-header option-title d-sm-flex d-block">
            <h5>Product Orders</h5>
        </div>
        <div>
            <div class="table-responsive">
                <table class="table product-orders theme-table" data-table="productOrdersTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Address</th>
                            <th>Items</th>
                            <th>Order Total</th>
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


@push('scripts')
<script>
    $(document).ready(function() {
        window.productOrdersTable = $('.product-orders').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('orders.get') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: '{{ $user->id }}'
                }
            },
            columns: [{
                    data: null,
                    name: 'id',
                    render: function(data, type, row, meta) {
                        return `#${row.order_number}`;
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
                    data: 'total',
                    name: 'order_total',
                    render: function(data, type, row) {
                        return `${formatCurrency(row.total)}`;
                    }
                },
                {
                    data: null,
                    name: 'actions',
                    orderable: false,
                    render: function(data, type, row) {
                        let deleteUrl = `{{ route('orders.destroy', ':id') }}`.replace(':id',
                            row.id);

                        return `
                        <ul>
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
            order: [
                [0, 'desc']
            ]
        });
    });
</script>
@endpush