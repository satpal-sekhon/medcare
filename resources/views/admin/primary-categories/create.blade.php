@extends('layouts.admin-layout')

@section('content')
<div class="row">
    <div class="col-sm-8 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-header-2">
                    <h5>Create Primary Category</h5>
                </div>

                <div class="theme-form theme-form-2 mega-form">
                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Category Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text"
                                placeholder="Category Name">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title">Category
                            Image</label>
                        <div class="form-group col-sm-9">
                            <input class="form-control" type="file">
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label class="form-label-title col-sm-3 mb-0">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                    
                    <div class="mb-4 row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button class="btn w-100 theme-bg-color text-white">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection