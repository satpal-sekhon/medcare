<div class="card card-table">
    <div class="card-body">
        <div class="title-header option-title d-sm-flex d-block">
            <h5>Quick Orders</h5>
        </div>
        <div>
            <div class="table-responsive">
                <table class="table quick-orders theme-table" data-table="quickOrderstable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
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
            if (!str) {
                return ``;
            }

            return str.replace(/\n/g, '<br>');
        }

        $(document).ready(function() {
            window.quickOrderstable = $('.quick-orders').DataTable({
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
                        render: function(data, type, row) {
                            return `#${row.order_number}`;
                        }
                    },
                    {
                        data: 'instructions',
                        name: 'instructions',
                        orderable: false,
                        render: function(data, type, row) {
                            return nl2br(row.instructions) || `N/A`;
                        }
                    },
                    {
                        data: 'prescription',
                        name: 'prescription',
                        orderable: false,
                        render: function(data, type, row) {
                            let attachmentType = getFileTypeByMimeType(row.mime_type);
                            if (attachmentType == 'image') {
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
