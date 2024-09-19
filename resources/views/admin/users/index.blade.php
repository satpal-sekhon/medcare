@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title d-sm-flex d-block">
                        <h5>Manage Users</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="align-items-center btn btn-theme d-flex" href="{{ route('users.create') }}">
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
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Total Orders</th>
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

    <!-- Notification Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('notification.send') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Send notification to <span class="selected-user-name"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id">
                        <x-form-input name="message" label="Enter Notification"></x-form-input>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-include-plugins :plugins="['dataTable', 'jQueryValidate']" />

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
                            role: "Customer",
                            status_exclude: 'Suspended'
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
                            data: 'user_code',
                            name: 'user_code'
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
                            name: 'total_orders',
                            render: function(data, type, row, meta) {
                                let totalOrders = row.orders_count + row.lab_package_orders_count + row
                                    .quick_orders_count + row.doctor_consultation_orders_count;
                                let viewUserOrdersLink = `{{ route('admin.user.orders', ':userId') }}`
                                    .replace(':userId', row.id);
                                if (!totalOrders) {
                                    viewUserOrdersLink = `#`;
                                }
                                return `<a href="${viewUserOrdersLink}">${totalOrders}</a>`;
                            }
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
                                let editUrl = `{{ route('users.edit', ':id') }}`.replace(':id', row.id);
                                let deleteUrl = `{{ route('users.destroy', ':id') }}`.replace(':id', row.id);

                                return `
                                <ul>
                                    <button type="button" data-user-id="${row.id}" data-user-name="${row.name}" class="btn p-0 fs-6 notification-btn" data-bs-toggle="modal" data-bs-target="#notificationModal">
                                        <i class="ri-notification-line"></i>
                                    </button>
                                    <li>
                                        <a href="${editUrl}">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <button class="btn p-0 fs-6 delete-btn" data-source="user" data-endpoint="${deleteUrl}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </li>
                                </ul>
                            `;
                            }
                        }
                    ]
                });

                $(document).on('click', '.notification-btn', function() {
                    let user_id = $(this).attr('data-user-id');
                    let user_name = $(this).attr('data-user-name');

                    $('.selected-user-name').html(user_name);
                    $('[name="user_id"]').val(user_id);
                });

                $('#notificationModal form').validate({
                    rules: {
                        message: {
                            required: true,
                            minlength: 5
                        }
                    },
                    messages: {
                        message: {
                            required: "Please enter a notification.",
                            minlength: "Notification must be at least 5 characters long."
                        }
                    },
                    errorPlacement: function(error, element) {
                        // Create a new div with the class invalid-feedback if it doesn't exist
                        var errorContainer = element.siblings('.invalid-feedback');
                        if (errorContainer.length === 0) {
                            errorContainer = $('<span class="invalid-feedback d-block"></span>');
                            element.after(errorContainer);
                        }
                        // Clear any existing content and append the error message directly
                        errorContainer.text(error.text());
                    },
                    highlight: function(element) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element) {
                        $(element).removeClass('is-invalid');

                        // Find the error container and remove it if the error text is empty
                        var errorContainer = $(element).siblings('.invalid-feedback');
                        if (errorContainer.length > 0 && !$(element).hasClass('is-invalid')) {
                            errorContainer.remove();
                        }
                    },
                    submitHandler: function(form) {
                        let formData = new FormData(form);
                        $('#notificationModal [type="submit"]').attr('disabled', 'disabled');

                        $.ajax({
                            url: $(form).attr('action'),
                            type: $(form).attr('method').toUpperCase(),
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                if(response.success){
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Notification sent successfully',
                                        icon: 'success',
                                        timer: 2500,
                                        timerProgressBar: true,
                                        willClose: () => {
                                            $('#notificationModal [name="message"]').val('');
                                            $('#notificationModal [type="submit"]').removeAttr('disabled');
                                            $('#notificationModal').modal('hide');
                                        }
                                    });
                                }

                                $('#notificationModal [type="submit"]').removeAttr('disabled');
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
