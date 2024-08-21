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
                <div>
                    <div class="table-responsive">
                        <table class="table all-package theme-table table-product" id="table_id">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Buscuit</td>
                                    <td>
                                        <div class="table-image">
                                            <img src="{{ asset('admin-assets/images/product/1.png') }}" class="img-fluid"
                                                alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="order-detail.html">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-include-plugins :plugins="['dataTable']" />
@endsection