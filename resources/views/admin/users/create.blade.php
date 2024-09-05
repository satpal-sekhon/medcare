@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Create User</h5>
                    </div>
 
                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="role" value="Customer">

                            <div class="mb-3">
                                <label class="form-label-title mb-0">User Name</label>
                                <input type="text" name="name" placeholder="User Name" value="{{ old('name') }}"
                                    @class(['form-control', 'is-invalid' => $errors->first('name')])>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label-title mb-0">Email Address</label>
                                        <input type="text" name="email" placeholder="Email Address" value="{{ old('email') }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('email')])>
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label-title mb-0">Phone Number</label>
                                        <input type="text" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('phone_number')])>
                                        @if ($errors->has('phone_number'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('phone_number') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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
                                        <label class="form-label-title mb-0">Confirm Password</label>
                                        <input type="password" name="confirm_password" placeholder="Confirm Password" value="{{ old('confirm_password') }}"
                                            @class(['form-control', 'is-invalid' => $errors->first('confirm_password')])>
                                        @if ($errors->has('confirm_password'))
                                            <div class="invalid-feedback d-block`">{{ $errors->first('confirm_password') }}</div>
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
