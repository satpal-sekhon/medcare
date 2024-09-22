@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Quick Orders</h5>
                    </div>

                    <x-success-message :message="session('success')" />

                    <div>
                        <div class="table-responsive">
                            <table class="table theme-table">
                                <thead>
                                    <tr>
                                        <th>Order No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
                                        <th>Instructions</th>
                                        <th>Prescription</th>
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
            function getFileTypeByMimeType(mimeType) {
                // Define a mapping of MIME types to general file types
                const mimeTypeToFileType = {
                    'image/jpeg': 'image',
                    'image/png': 'image',
                    'image/gif': 'image',
                    'text/plain': 'text',
                    'text/html': 'text',
                    'application/pdf': 'document',
                    'application/zip': 'archive',
                    'application/vnd.ms-excel': 'spreadsheet',
                    'application/msword': 'document',
                    'application/json': 'data',
                    'audio/mpeg': 'audio',
                    'video/mp4': 'video',
                    'application/xml': 'data',
                };

                // Return the general file type or 'unknown' if the MIME type is not in the object
                return mimeTypeToFileType[mimeType] || 'unknown';
            }

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
                        url: "{{ route('quick-orders.get') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}"
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
                            data: 'name',
                            name: 'name',
                            orderable: false,
                            render: function(data, type, row) {
                                let userBadge = ``;

                                if(!row.user_id){
                                    userBadge = `<span class="badge badge-warning">Guest</span>`;
                                } else if(row.user){
                                    userBadge = `<span class="badge badge-success">#${row.user.user_code}</span>`;
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
                                return nl2br(row.instructions)
                            }
                        },
                        {
                            data: 'prescription',
                            name: 'prescription',
                            orderable: false,
                            render: function(data, type, row) {
                                let attachmentType = getFileTypeByMimeType(row.mime_type);
                                if(attachmentType=='image'){
                                    return `<img src="{{ asset('${row.prescription_path}') }}" alt="Uploaded prescription" class="dt-image">`;
                                } else {
                                    return `<a href="{{ asset('${row.prescription_path}') }}" target="_blank">Click here to view</a>`;
                                }

                            }
                        },
                        {
                            data: null,
                            name: 'actions',
                            orderable: false,
                            render: function(data, type, row) {
                                let deleteUrl = `{{ route('quick-orders.destroy', ':id') }}`.replace(':id', row.id);
                    
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
                    order: [[0, 'desc']]
                });

                $(document).on('change', '[name="order-status"]', function() {
                    let newStatus = $(this).val();
                    let id = $(this).data('id');
                    
                    $.ajax({
                        url: `{{ route('quick-orders.update-status') }}`,
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
