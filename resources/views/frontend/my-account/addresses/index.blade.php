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
                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal" data-bs-target="#removeProfile">
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
@endsection