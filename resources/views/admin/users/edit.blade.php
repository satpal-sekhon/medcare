@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Edit User</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('users.update', [$user->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="role" value="Customer">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label-title mb-0">User Name</label>
                                        <input type="text" name="name" placeholder="User Name" value="{{ old('name', $user->name) }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('name')])>
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label-title mb-0">Email Address</label>
                                        <input type="text" name="email" placeholder="Email Address" value="{{ old('email', $user->email) }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('email')])>
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label-title mb-0">Phone Number</label>
                                        <input type="text" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number', $user->phone_number) }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('phone_number')])>
                                        @if ($errors->has('phone_number'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('phone_number') }}</div>
                                        @endif
                                    </div>
                                </div>
                           
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label-title mb-0">Address</label>
                                        <input type="text" name="address" placeholder="Address" value="{{ old('address', $user->address) }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('address')])>
                                        @if ($errors->has('address'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label-title mb-0">City</label>
                                        <input type="text" name="city" placeholder="City" value="{{ old('city', $user->city) }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('city')])>
                                        @if ($errors->has('city'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label-title mb-0">Pincode</label>
                                        <input type="number" name="pincode" placeholder="Pincode" value="{{ old('pincode', $user->pincode) }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('pincode')])>
                                        @if ($errors->has('pincode'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('pincode') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label-title mb-0">State</label>
                                        <select name="state" @class(['form-control', 'is-invalid' => $errors->first('state')])>
                                            <option value="">Select State</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->name }}" @selected(old('state', $user->state) == $state->name)>{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('state'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('state') }}</div>
                                        @endif
                                    </div>
                                </div>
                           
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label-title mb-0">Enter Password</label>
                                        <input type="password" name="password" placeholder="Password" value="{{ old('password') }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('password')])>
                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label-title mb-0">Status</label>
                                        <select name="status" @class(['form-control', 'is-invalid' => $errors->first('status')])>
                                            <option value="Active" @selected(old('status', $user->status) == 'Active')>Active</option>
                                            <option value="Inactive" @selected(old('status', $user->status) == 'Inactive')>Inactive</option>
                                            <option value="Suspended" @selected(old('status', $user->status) == 'Suspended')>Suspended</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('status') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn w-100 theme-bg-color text-white">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
