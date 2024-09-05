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
        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-6">
            <div class="address-box">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jack" id="flexRadioDefault2" checked>
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
                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal" data-bs-target="#editProfile">
                        <i data-feather="edit"></i>
                        Edit
                    </button>
                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal" data-bs-target="#removeProfile">
                        <i data-feather="trash-2"></i>
                        Remove
                    </button>
                </div>
            </div>
        </div>

        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-6">
            <div class="address-box">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jack" id="flexRadioDefault3">
                    </div>

                    <div class="label">
                        <label>Office</label>
                    </div>

                    <div class="table-responsive address-table">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td colspan="2">Shivam</td>
                                </tr>

                                <tr>
                                    <td>Address :</td>
                                    <td>
                                        <p>Noida, Sector 88, India</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Pin Code :</td>
                                    <td>201312</td>
                                </tr>

                                <tr>
                                    <td>Phone :</td>
                                    <td>+91874523699</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="button-group">
                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal" data-bs-target="#editProfile"><i
                            data-feather="edit"></i>
                        Edit</button>
                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                        data-bs-target="#removeProfile"><i data-feather="trash-2"></i>
                        Remove</button>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade theme-modal" id="add-address" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-4 theme-form-floating">
                    <input type="text" class="form-control" id="addressName" placeholder="Enter First Name">
                    <label for="addressName">Name</label>
                </div>

                <div class="form-floating mb-4 theme-form-floating">
                    <textarea class="form-control" placeholder="Enter Address" id="address"
                        style="height: 100px"></textarea>
                    <label for="address">Enter Address</label>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="pin" placeholder="Enter Pin Code">
                            <label for="pin">City</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="pin" placeholder="Enter Pin Code">
                            <label for="pin">State</label>
                        </div>
                    </div>
                </div>
            
                <div class="form-floating mb-4 theme-form-floating">
                    <input type="text" class="form-control" id="pin" placeholder="Enter Pin Code">
                    <label for="pin">Pin Code</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn theme-bg-color btn-md text-white" data-bs-dismiss="modal">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>