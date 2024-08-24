@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Edit Category</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('categories.update', [$category->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <label class="form-label-title col-sm-4 mb-0">Primary Category</label>

                                <select name="primary_category" id="primary_category" @class([
                                    'form-control',
                                    'is-invalid' => $errors->first('primary_category'),
                                ])>
                                    <option value="" disabled>Select Primary Category</option>
                                    @foreach ($primaryCategories as $primary_category)
                                        <option value="{{ $primary_category->id }}" @selected($primary_category->id == $category->primary_category_id)>{{ $primary_category->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('primary_category'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('primary_category') }}</div>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label class="form-label-title mb-0">Category Name</label>
                                <input type="text" name="name" placeholder="Category Name"
                                    value="{{ old('name', $category->name) }}" @class(['form-control', 'is-invalid' => $errors->first('name')])>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="mb-2 row">
                                <label class="form-label-title">Category Image</label>
                                <div class="form-group">
                                    <input type="file" name="image" accept="image/*" @class(['form-control', 'is-invalid' => $errors->first('image')])>
                                    @if ($errors->has('image'))
                                        <div class="invalid-feedback d-block">{{ $errors->first('image') }}</div>
                                    @endif

                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt=""
                                            style="width: 100px; height: auto;">
                                    @endif
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title mb-0">Description</label>
                                <textarea name="description" placeholder="Enter Description" @class([
                                    'form-control',
                                    'is-invalid' => $errors->first('description'),
                                ])>{{ old('description', $category->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('description') }}</div>
                                @endif
                            </div>

                            <div class="mb-3 d-flex align-items-center gap-4">
                                <label class="form-label-title">Show On Homepage</label>
                                <label class="switch">
                                    <input type="checkbox" name="flag" value="SHOW_ON_HOMEPAGE" @checked($category->flag == 'SHOW_ON_HOMEPAGE')>
                                    <span class="switch-state"></span>
                                </label>
                            </div>

                            <div class="mb-2">
                                <button type="submit" class="btn w-100 theme-bg-color text-white">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
