<div class="dashboard-address">
    <div class="title title-flex">
        <div>
            <h2>My Address Book</h2>
            <span class="title-leaf">
                <svg class="icon-width bg-gray">
                    <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                </svg>
            </span>
        </div>

        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3" data-bs-toggle="modal"
            data-bs-target="#add-address"><i data-feather="plus" class="me-2"></i> Add New Address</button>
    </div>

    <div class="row g-sm-4 g-3">
        @forelse ($addresses as $address)
            <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-6">
                <div class="address-box">
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jack" id="flexRadioDefault2"
                                checked>
                        </div>

                        <div class="label">
                            <label>Home</label>
                        </div>

                        <div class="table-responsive address-table">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="2">Rachi Sharma</td>
                                    </tr>

                                    <tr>
                                        <td>Address :</td>
                                        <td>
                                            <p>Noida, Sector 80, Gautam Budh Nagar, India</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Pin Code :</td>
                                        <td>201309</td>
                                    </tr>

                                    <tr>
                                        <td>Phone :</td>
                                        <td>+91874523698</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="button-group">
                        <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                            data-bs-target="#editProfile">
                            <i data-feather="edit"></i>
                            Edit
                        </button>
                        <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                            data-bs-target="#removeProfile">
                            <i data-feather="trash-2"></i>
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <h3 class="text-center">No addresses found.</h3>
        @endforelse
    </div>
</div>


<div class="modal fade theme-modal" id="add-address" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('addresses.create') }}" id="create-address-form" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-4 theme-form-floating">
                        <input type="text" name="name" class="form-control" id="addressName"
                            placeholder="Enter First Name">
                        <label for="addressName">Name</label>
                    </div>

                    <div class="form-floating mb-4 theme-form-floating">
                        <textarea class="form-control" name="address" placeholder="Enter Address" id="address" style="height: 100px"></textarea>
                        <label for="address">Enter Address</label>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="text" name="city" class="form-control" id="pin"
                                    placeholder="Enter Pin Code">
                                <label for="pin">City</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-4 theme-form-floating">
                                <input type="text" name="state" class="form-control" id="pin"
                                    placeholder="Enter Pin Code">
                                <label for="pin">State</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-4 theme-form-floating">
                        <input type="text" name="pincode" class="form-control" id="pin"
                            placeholder="Enter Pin Code">
                        <label for="pin">Pin Code</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn theme-bg-color btn-md text-white">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-include-plugins :plugins="['jQueryValidate']"></x-include-plugins>

@push('scripts')
    <script>
        $(function() {
            $('#create-address-form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    address: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    pincode: {
                        required: true,
                        digits: true,
                        minlength: 6,
                        maxlength: 6
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Name must be at least 2 characters long"
                    },
                    address: "Please enter your address",
                    city: "Please enter your city",
                    state: "Please enter your state",
                    pincode: {
                        required: "Please enter your pin code",
                        digits: "Please enter a valid pin code",
                        minlength: "Please enter a valid pin code",
                        maxlength: "Please enter a valid pin code"
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
                    // Perform AJAX request
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            $('#create-address-form')[0].reset();
                        },
                        error: function(xhr) {
                            // Handle errors
                            alert('An error occurred: ' + xhr.responseText);
                        }
                    });
                }
            });
        })
    </script>
@endpush
