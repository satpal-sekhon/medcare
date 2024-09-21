@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Lab Package Orders</h5>
                    </div>

                    <x-success-message :message="session('success')" />

                    <div>
                        <div class="table-responsive">
                            <table class="table theme-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Package Name</th>
                                        <th>Amount</th>
                                        <th>Status</th>
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
                        url: "{{ route('lab-package-orders.get') }}",
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
                            data: 'name',
                            name: 'name',
                            orderable: false,
                            render: function(data, type, row) {
                                let userBadge = ``;

                                if(!row.user_id){
                                    userBadge = `<span class="badge badge-warning">Guest</span>`;
                                }

                                return `${userBadge} ${row.name}`;
                            }
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone_number',
                            name: 'phone_number'
                        },
                        {
                            data: 'package_name',
                            name: 'package_name'
                        },
                        {
                            data: 'package_amount',
                            name: 'package_amount',
                            render: function(data, type, row) {
                                return formatCurrency(row.package_amount);
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            render: function(data, type, row) {
                                let options = `
                                    <select class="form-control" name="order-status" data-id="${row.id}" style="width: 145px">
                                        <option value="Awaiting Confirmation" ${row.status === 'Awaiting Confirmation' ? 'selected' : ''}>Awaiting Confirmation</option>
                                        <option value="Pending" ${row.status === 'Pending' ? 'selected' : ''}>Pending</option>
                                        <option value="Approved" ${row.status === 'Approved' ? 'selected' : ''}>Approved</option>
                                        <option value="Rejected" ${row.status === 'Rejected' ? 'selected' : ''}>Rejected</option>
                                    </select>
                                `;
                                return options;
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
                                let deleteUrl = `{{ route('lab-package-orders.destroy', ':id') }}`.replace(':id', row.id);
                    
                                return `
                                <ul>
                                    <li>
                                        <button class="btn p-0 fs-6 delete-btn" data-source="lab package order" data-endpoint="${deleteUrl}">
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

                $(document).on('change', '[name="order-status"]', function() {
                    let newStatus = $(this).val();
                    let id = $(this).data('id');
                    
                    $.ajax({
                        url: `{{ route('lab-package-orders.update-status') }}`,
                        method: 'POST',
                        data: {
                            id: id,
                            status: newStatus,
                            _token: `{{ csrf_token() }}`
                        }
                    })
                });

            });
        </script>
    @endpush
@endsection
