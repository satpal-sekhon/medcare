@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Edit Sub Category</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <form id="edit-sub-category-form" action="{{ route('sub-categories.update', [$subCategory->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-2">
                                <label class="form-label-title col-sm-4 mb-0">Primary Category</label>
                                <select name="primary_category" id="primary_category" class="form-control {{ $errors->first('primary_category') ? 'is-invalid' : '' }}">
                                    <option value="" disabled>Select Primary Category</option>
                                    @foreach ($primaryCategories as $primary_category)
                                        <option value="{{ $primary_category->id }}" {{ $primary_category->id == $subCategory->primary_category_id ? 'selected' : '' }}>
                                            {{ $primary_category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('primary_category'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('primary_category') }}</div>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title col-sm-4 mb-0">Category</label>
                                <select name="category" id="category" class="form-control {{ $errors->first('category') ? 'is-invalid' : '' }}">
                                    <option value="" disabled>Select Category</option>
                                </select>
                                @if ($errors->has('category'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('category') }}</div>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title mb-0">Category Name</label>
                                <input type="text" name="name" placeholder="Category Name" value="{{ old('name', $subCategory->name) }}" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="mb-2 row">
                                <label class="form-label-title">Category Image</label>
                                <div class="form-group">
                                    <input type="file" name="image" accept="image/*" class="form-control {{ $errors->first('image') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('image'))
                                        <div class="invalid-feedback d-block">{{ $errors->first('image') }}</div>
                                    @endif

                                    @if ($subCategory->image)
                                        <img src="{{ asset($subCategory->image) }}" alt="" style="width: 100px; height: auto;">
                                    @endif
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title mb-0">Description</label>
                                <textarea name="description" placeholder="Enter Description" class="form-control {{ $errors->first('description') ? 'is-invalid' : '' }}">{{ old('description', $subCategory->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('description') }}</div>
                                @endif
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

    @push('scripts')
        <script>
            $(document).ready(function(){
                // Function to populate categories based on primary category
                function populateCategories(primaryCategoryId, selectedCategoryId) {
                    $.ajax({
                        url: "{{ route('categories.get-by-primary-category') }}",
                        method: 'GET',
                        data: {
                            category_id: primaryCategoryId
                        },
                        success: function(response){
                            if(response.success){
                                let categories = response.categories;
                                let $subCategorySelect = $('#category');
                                $subCategorySelect.html(`<option value="" disabled ${!selectedCategoryId ? 'selected' : ''}>Select Category</option>`);

                                categories.forEach(function(category){
                                    $subCategorySelect.append(`<option value="${category.id}" ${selectedCategoryId == category.id ? 'selected' : ''}>${category.name}</option>`);
                                });
                            }
                        }
                    });
                }

                // Get old primary category value and selected category value
                let oldPrimaryCategory = "{{ old('primary_category', $subCategory->primary_category_id) }}";
                let oldCategory = "{{ old('category', $subCategory->category_id) }}";

                // Populate categories if there's an old primary category
                if (oldPrimaryCategory) {
                    populateCategories(oldPrimaryCategory, oldCategory);
                }

                // On change event for primary category
                $('#primary_category').change(function(){
                    let selectedPrimaryCategoryId = $(this).val();
                    populateCategories(selectedPrimaryCategoryId, '');
                });
            });
        </script>
    @endpush
@endsection
