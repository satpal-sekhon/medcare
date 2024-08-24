@extends('layouts.admin-layout')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title d-sm-flex d-block">
                    <h5>Products List</h5>
                    <div class="right-options">
                        <ul>
                            <li>
                                <a class="btn btn-solid" href="{{ route('products.create') }}">Add Product</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table all-package theme-table table-product" id="table_id">
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <div class="table-image">
                                            <img src="{{ asset('admin-assets/images/product/1.png') }}" class="img-fluid"
                                                alt="">
                                        </div>
                                    </td>

                                    <td>Aata Buscuit</td>
                                    <td>Buscuit</td>
                                    <td class="td-price">$95.97</td>
                                    <td class="status-danger">
                                        <span>Pending</span>
                                    </td>

                                    <td>
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="table-image">
                                            <img src="{{ asset('admin-assets/images/product/2.png') }}" class="img-fluid"
                                                alt="">
                                        </div>
                                    </td>

                                    <td>Cold Brew Coffee</td>
                                    <td>Drinks</td>
                                    <td class="td-price">$95.97</td>

                                    <td class="status-close">
                                        <span>Approved</span>
                                    </td>

                                    <td>
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)">
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
</div>@endsection