@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Suspended Vendors</h5>
                    </div>

                    <x-success-message :message="session('success')" />

                    <div>
                        <div class="table-responsive">
                            <table class="table theme-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Business Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
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
                        url: "{{ route('users.get') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            role: "Vendor",
                            status: "Suspended"
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
                            name: 'name'
                        },
                        {
                            data: 'name',
                            name: 'name'
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
                            data: null,
                            name: 'status',
                            render: function(data, type, row, meta) {
                                let badgeClass = '';

                                switch (row.status) {
                                    case 'Active':
                                        badgeClass = 'badge bg-success';
                                        break;
                                    case 'Inactive':
                                        badgeClass = 'badge bg-warning';
                                        break;
                                    case 'Suspended':
                                        badgeClass = 'badge bg-danger';
                                        break;
                                    default:
                                        badgeClass = 'badge bg-light';
                                }

                                return `<span class="${badgeClass}">${row.status}</span>`;
                            }
                        },
                        {
                            data: null,
                            name: 'actions',
                            orderable: false,
                            render: function(data, type, row) {
                                let editUrl = `{{ route('vendors.edit', ':id') }}`.replace(':id', row.vendor?.id);
                                let deleteUrl = `{{ route('vendors.destroy', ':id') }}`.replace(':id', row.vendor?.id);
                    
                                return `
                                <ul>
                                    <li>
                                        <a href="${editUrl}">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <button class="btn p-0 fs-6 delete-btn" data-source="vendor" data-endpoint="${deleteUrl}">
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
