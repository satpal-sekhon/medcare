@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Bills</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="align-items-center btn btn-theme d-flex"
                                        href="{{ route('bills.create') }}">
                                        <i data-feather="plus-square"></i> Add New
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <x-success-message :message="session('success')" />

                    <div class="row">
                        <div class="col-md-4">
                            <label for="filterBillsBy">Filter Bills By</label>
                            <select name="filter_bills_by" id="filterBillsBy" class="form-control mb-3">
                                <option value="All">All</option>
                                <option value="Vendors">Vendors</option>
                                <option value="Self">Only my bills</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="table-responsive">
                            <table class="table theme-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bill From</th>
                                        <th>Bill To</th>
                                        <th>Bill to number</th>
                                        <th>Total Products</th>
                                        {{-- <th>Total</th> --}}
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
                $('#filterBillsBy').on('change', function() {
                    window.table.ajax.reload();
                });

                window.table = $('table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('bills.get') }}",
                        type: 'POST',
                        data: function(d){
                            d._token = "{{ csrf_token() }}",
                            d.filter_bills_by = $('#filterBillsBy').val()
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
                            data: null,
                            name: 'bill_from',
                            render: function(data, type, row) {
                                let userBadge = ``;

                                if(row.user){
                                    if(row.user.vendor){
                                        userBadge = `<span class="badge badge-success">#${row.user.vendor.vendor_code}</span>`;
                                    }/*  else {
                                        userBadge = `<span class="badge badge-success">#${row.user.user_code}</span>`;
                                    } */
                                }

                                return `${userBadge} ${row.bill_from}`;
                            }
                        },
                        {
                            data: 'bill_to_name',
                            name: 'bill_to_name'
                        },
                        {
                            data: 'bill_to_contact',
                            name: 'bill_to_contact'
                        },
                        {
                            data: 'products_count',
                            name: 'products_count'
                        },
                        /* {
                            data: 'products_sum_total',
                            name: 'products_sum_total',
                            render: function(data, type, row) {
                                return `₹${row.products_sum_total}`;
                            }
                        }, */
                        {
                            data: null,
                            name: 'actions',
                            orderable: false,
                            render: function(data, type, row) {
                                let viewUrl = `{{ route('bills.show', ':id') }}`.replace(':id', row.id);
                                let deleteUrl = `{{ route('bills.destroy', ':id') }}`.replace(':id', row.id);
                    
                                return `
                                <ul>
                                    <li>
                                        <a href="${viewUrl}">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <button class="btn p-0 fs-6 delete-btn" data-source="bill" data-endpoint="${deleteUrl}">
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
