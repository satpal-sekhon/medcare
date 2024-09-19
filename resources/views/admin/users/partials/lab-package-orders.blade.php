<div class="card card-table">
    <div class="card-body">
        <div class="title-header option-title d-sm-flex d-block">
            <h5>Lab Package Orders</h5>
        </div>
        <div>
            <div class="table-responsive">
                <table class="table lab-package-orders theme-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Package Name</th>
                            <th>Amount</th>
                            <th>Instructions</th>
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
        function nl2br(str) {
            if (!str) {
                return ``;
            }

            return str.replace(/\n/g, '<br>');
        }

        $(document).ready(function() {
            window.labPackageOrders = $('.lab-package-orders').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('lab-package-orders.get') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    }
                },
                columns: [{
                        data: null,
                        name: 'id',
                        render: function(data, type, row) {
                            return `#${row.order_number}`;
                        }
                    },
                    {
                        data: 'package_name',
                        name: 'package_name'
                    },
                    {
                        data: 'package_amount',
                        name: 'package_amount',
                        render: function(data, type, row, meta) {
                            return formatCurrency(row.package_amount);
                        }
                    },
                    {
                        data: 'instructions',
                        name: 'instructions',
                        orderable: false,
                        render: function(data, type, row) {
                            return nl2br(row.instructions) || `N/A`
                        }
                    },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        render: function(data, type, row) {
                            let deleteUrl = `{{ route('quick-orders.destroy', ':id') }}`.replace(
                                ':id', row.id);

                            return `
                                <ul>
                                    <li>
                                        <button class="btn p-0 fs-6 delete-btn" data-source="quick order" data-endpoint="${deleteUrl}">
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
