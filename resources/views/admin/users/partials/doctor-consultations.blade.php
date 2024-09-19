<div class="card card-table">
    <div class="card-body">
        <div class="title-header option-title d-sm-flex d-block">
            <h5>Doctor Consultations</h5>
        </div>
        <div>
            <div class="table-responsive">
                <table class="table doctor-consultations theme-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Doctor Type</th>
                            <th>Doctor Name</th>
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
        if(!str){
            return ``;
        }

        return str.replace(/\n/g, '<br>');
    }

    $(document).ready(function() {
        window.doctorConsultationsTable = $('.doctor-consultations').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('doctor-consultations.get') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: "{{ $user->id }}"
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
                    data: 'doctor_type',
                    name: 'doctor_type'
                },
                {
                    data: 'doctor_name',
                    name: 'doctor_name',
                    render: function(data, type, row) {
                        return row.doctor_name ? doctor_name : 'N/A'
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
                        let deleteUrl = `{{ route('doctor-consultations.destroy', ':id') }}`.replace(':id', row.id);
            
                        return `
                        <ul>
                            <li>
                                <button class="btn p-0 fs-6 delete-btn" data-source="doctor consultation" data-endpoint="${deleteUrl}">
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