@extends('layouts.user-account')
@section('title', 'User Dashboard')

@section('my-account')
<div class="dashboard-address">
    <x-success-message :message="session('success')" />
    <x-error-message :message="$errors->first('message')" />

    <div class="title title-flex">
        <div>
            <h2>My Address Book</h2>
            <span class="title-leaf">
                <svg class="icon-width bg-gray">
                    <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                </svg>
            </span>
        </div>

        <a href="{{ route('addresses.create') }}" class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3">
            <i data-feather="plus" class="me-2"></i>
            Add New Address
        </a>
    </div>

    <div class="row g-sm-4 g-3">
        @forelse ($addresses as $address)
        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-6">
            <div class="address-box">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" disabled @checked($address->is_default)>
                    </div>

                    <div class="label">
                        <label>{{ $address->address_type }}</label>
                    </div>

                    <div class="table-responsive address-table">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td colspan="2">{{ $address->name }}</td>
                                </tr>

                                <tr>
                                    <td>Address :</td>
                                    <td>
                                        <p>{{ $address->address_line_1 }}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Pin Code :</td>
                                    <td>{{ $address->pincode }}</td>
                                </tr>

                                <tr>
                                    <td>Phone :</td>
                                    <td>{{ $address->phone_number }}
                                    <td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="button-group">
                    <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-sm add-button w-100">
                        <i data-feather="edit"></i>
                        Edit
                    </a>
                    <button class="btn btn-sm add-button w-100" data-route="{{ route('addresses.destroy', $address->id) }}"
                        data-bs-toggle="modal" data-bs-target="#removeAddress">
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

{{-- Delete Address Confirmation --}}
<div class="modal fade theme-modal remove-profile" id="removeAddress" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="remove-box">
                    <p>Your address can't be recover once you deleted!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                <form id="deleteAddressForm" action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(function() {
        $('[data-bs-target="#removeAddress"]').on('click', function() {
            var action = $(this).data('route');
            $('#deleteAddressForm').attr('action', action);
        });
    });
</script>
@endpush
@endsection