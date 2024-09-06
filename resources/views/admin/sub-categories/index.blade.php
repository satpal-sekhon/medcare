@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Sub Categories</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="align-items-center btn btn-theme d-flex"
                                        href="{{ route('sub-categories.create') }}">
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
                                        <th>Primary Category</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Image</th>
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
                        url: "{{ route('sub-categories.get') }}",
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
                            data: 'primary_category_name',
                            name: 'primary_category_name'
                        },
                        {
                            data: 'primary_category_name',
                            name: 'primary_category_name'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'image',
                            name: 'image',
                            orderable: false,
                            render: function(data, type, row) {
                                let defaultImagePath = 'assets/images/default-product.png';
                                let imageUrl = data ? data : defaultImagePath;

                                return `<img src="{{ asset('${imageUrl}') }}" alt="Category Image" class="dt-image">`;
                            }
                        },
                        {
                            data: null,
                            name: 'actions',
                            orderable: false,
                            render: function(data, type, row) {
                                let editUrl = `{{ route('sub-categories.edit', ':id') }}`.replace(':id', row.id);
                                let deleteUrl = `{{ route('sub-categories.destroy', ':id') }}`.replace(':id', row.id);
                    
                                return `
                                <ul>
                                    <li>
                                        <a href="${editUrl}">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <button class="btn p-0 fs-6 delete-btn" data-source="sub category" data-endpoint="${deleteUrl}">
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
