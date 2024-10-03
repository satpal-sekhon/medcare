@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>FAQs</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="align-items-center btn btn-theme d-flex"
                                        href="{{ route('faq.create') }}">
                                        <i data-feather="plus-square"></i> Add New
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <x-success-message :message="session('success')" />

                    <div>
                        <div class="table-responsive">
                            <table class="table theme-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
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
                        url: "{{ route('faqs.get') }}",
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
                            data: 'question',
                            name: 'question'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            render: function(data, type, row) {
                                if(row.active != '1'){
                                    return `<span class="badge badge-danger">Inactive</span>`;
                                }

                                return `<span class="badge badge-success">Active</span>`;
                            }
                        },
                        {
                            data: null,
                            name: 'actions',
                            orderable: false,
                            render: function(data, type, row) {
                                let editUrl = `{{ route('faq.edit', ':id') }}`.replace(':id', row.id);
                                let deleteUrl = `{{ route('faq.destroy', ':id') }}`.replace(':id', row.id);
                    
                                return `
                                <ul>
                                    <li>
                                        <a href="${editUrl}">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <button class="btn p-0 fs-6 delete-btn" data-source="FAQ" data-endpoint="${deleteUrl}">
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
