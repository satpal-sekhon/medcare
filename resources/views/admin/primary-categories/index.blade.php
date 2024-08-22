@extends('layouts.admin-layout')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title d-sm-flex d-block">
                    <h5>Primary Categories</h5>
                    <div class="right-options">
                        <ul>
                            <li>
                                <a class="align-items-center btn btn-theme d-flex" href="{{ route('admin.primary-categories.create') }}">
                                    <i data-feather="plus-square"></i> Add New
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div>
                    <div class="table-responsive">
                        <table class="table all-package theme-table">
                            <thead>
                                <tr>
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
        $(document).ready(function () {
            $('table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('primary-categories.get') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    }
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { 
                        data: 'image', 
                        name: 'image',
                        render: function(data, type, row) {
                            let defaultImagePath = 'assets/images/default-product.png';
                            let imageUrl = data ? 'storage/' + data : defaultImagePath;

                            return `<img src="{{ asset('${imageUrl}') }}" alt="Category Image" style="width: 100px; height: auto;">`;
                        }
                    },
                    {
                        data: null,
                        name: 'actions',
                        render: function(data, type, row) {
                            return `
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalToggle">
                                            <i class="ri-delete-bin-line"></i>
                                        </a>
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