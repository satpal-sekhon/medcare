@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Create Sub Category</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('sub-categories.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-2">
                                <label class="form-label-title col-sm-4 mb-0">Primary Category</label>
                                <select name="primary_category" id="primary_category" class="form-control">
                                    <option value="" selected disabled>Select Primary Category</option>
                                    @foreach ($primaryCategories as $primary_category)
                                        <option value="{{ $primary_category->id }}"  @selected(old('primary_category')==$primary_category->id)>
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
                                <select name="category" id="category" class="form-control">
                                    <option value="" selected disabled>Select Category</option>
                                </select>
                                @if ($errors->has('category'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('category') }}</div>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title mb-0">Category Name</label>
                                <input type="text" name="name" placeholder="Category Name" value="{{ old('name') }}" class="form-control">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title">Category Image</label>
                                <div class="form-group">
                                    <input type="file" name="image" accept="image/*" class="form-control">
                                    @if ($errors->has('image'))
                                        <div class="invalid-feedback d-block">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title mb-0">Description</label>
                                <textarea name="description" placeholder="Enter Description" class="form-control">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('description') }}</div>
                                @endif
                            </div>

                            <div class="mb-4">
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
                                let $categorySelect = $('#category');
                                $categorySelect.html('<option value="" selected disabled>Select Category</option>');

                                categories.forEach(function(category){
                                    $categorySelect.append(`<option value="${category.id}" ${selectedCategoryId == category.id ? 'selected' : ''}>${category.name}</option>`);
                                });
                            }
                        }
                    });
                }

                // Get old primary category value
                let oldPrimaryCategory = "{{ old('primary_category') }}";
                let oldCategory = "{{ old('category') }}";

                // If there's an old primary category, populate categories on load
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
