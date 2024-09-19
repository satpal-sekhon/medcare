<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Heal Deal</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin-assets/css/linearicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/vendors/font-awesome.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/ratio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/remixicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/custom.css') }}">

    @stack('styles')
</head>

<body>
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>

    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('layouts.partials.admin-header')

        <div class="page-body-wrapper">
            @include('layouts.partials.admin-sidebar')

            <div class="page-body">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="logoutModalLabel">Logging Out</h5>
                    <p>Are you sure you want to log out?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="button-box">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                        <a href="{{ route('admin.logout') }}" class="btn  btn--yes btn-primary">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin-assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/icons/feather-icon/feather-icon.js') }}"></script>

    <script src="{{ asset('admin-assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('admin-assets/js/scrollbar/custom.js') }}"></script>
    <script src="{{ asset('admin-assets/js/config.js') }}"></script>

    <script src="{{ asset('admin-assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('admin-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/custom-slick.js') }}"></script>
    <script src="{{ asset('admin-assets/js/sidebareffect.js') }}"></script>
    <script src="{{ asset('admin-assets/js/script.js') }}"></script>
    <script src="{{ asset('admin-assets/js/custom.js') }}"></script>

    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>

    <script>
        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-IN', {
                style: 'currency',
                currency: 'INR',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(amount);
        }
    </script>
    @stack('scripts')

    <script>
        $(function() {
            $(document).on('click', '.delete-btn', function() {
                let source = $(this).data('source');
                let endpoint = $(this).data('endpoint');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `Do you really want to delete this ${source}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: endpoint,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                let capitalized_source = source.charAt(0).toUpperCase() + source.slice(1);

                                window.table.ajax.reload();
                                Swal.fire(
                                    'Deleted!',
                                    `${capitalized_source} has been deleted.`,
                                    'success'
                                );
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            })
        })
    </script>
</body>

</html>
