@extends('layouts.admin-layout')

@section('content')
<div class="row">
    <div class="col-sm-8 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-header-2">
                    <h5>Edit Primary Category</h5>
                </div>

                <div class="theme-form theme-form-2 mega-form">
                    <form action="{{ route('primary-categories.update', [$primaryCategory->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 row">
                            <label class="form-label-title col-sm-3 mb-0">Category Name</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    name="name" 
                                    placeholder="Category Name" 
                                    value="{{ old('name', $primaryCategory->name) }}" 
                                    @class(["form-control", "is-invalid"=> $errors->first('name')])
                                >
                                @if($errors->has('name'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            
                        </div>

                        <div class="mb-4 row">
                            <label class="col-sm-3 col-form-label form-label-title">Category Image</label>
                            <div class="form-group col-sm-9">
                                <input 
                                    type="file" 
                                    name="image" 
                                    accept="image/*" 
                                    @class(["form-control", "is-invalid"=> $errors->first('image')])
                                >
                                @if ($errors->has('image'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('image') }}</div>
                                @endif

                                @if ($primaryCategory->image)
                                    <img src="{{ asset('storage/'.$primaryCategory->image) }}" alt="" style="width: 100px; height: auto;">
                                @endif
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="form-label-title col-sm-3 mb-0">Description</label>
                            <div class="col-sm-9">
                                <textarea 
                                    name="description" 
                                    placeholder="Enter Description" 
                                    @class(["form-control", "is-invalid"=> $errors->first('description')])
                                >{{ old('description', $primaryCategory->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn w-100 theme-bg-color text-white">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection