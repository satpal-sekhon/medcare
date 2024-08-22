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
                        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-2">
                                <label class="form-label-title col-sm-4 mb-0">Primary Category</label>
                                
                                <select name="primary_category" id="primary_category"  @class(['form-control', 'is-invalid' => $errors->first('primary_category')])>
                                    <option value="" selected disabled>Select Primary Category</option>
                                    @foreach ($primary_categories as $primary_category)
                                        <option value="{{ $primary_category->id }}">{{ $primary_category->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('primary_category'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('primary_category') }}</div>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label class="form-label-title col-sm-4 mb-0">Category</label>
                                
                                <select name="category" id="category"  @class(['form-control', 'is-invalid' => $errors->first('category')])>
                                    <option value="" selected disabled>Select Category</option>
                                </select>

                                @if ($errors->has('category'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('category') }}</div>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title mb-0">Category Name</label>
                                <input type="text" name="name" placeholder="Category Name" value="{{ old('name') }}"
                                    @class(['form-control', 'is-invalid' => $errors->first('name')])>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block`">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title">Category Image</label>
                                <div class="form-group">
                                    <input type="file" name="image" accept="image/*" @class(['form-control', 'is-invalid' => $errors->first('image')])>
                                    @if ($errors->has('image'))
                                        <div class="invalid-feedback d-block">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label-title mb-0">Description</label>
                                <textarea name="description" placeholder="Enter Description" @class([
                                    'form-control',
                                    'is-invalid' => $errors->first('description'),
                                ])>{{ old('description') }}</textarea>
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
            $(function(){
                $('[name="primary_category"]').change(function(){
                    $.ajax({
                        url: "{{ route('categories.get-by-primary-category') }}",
                        method: 'GET',
                        data: {
                            category_id: $(this).val()
                        },
                        success:function(response){
                            if(response.success){
                                let categories = response.categories;
                                $('[name="category"]').html(`<option value="" selected disabled>Select Category</option>`);

                                for(let i=0; i<categories.length; i++){
                                    $('[name="category"]').append(`<option value="${categories[i].id}">${categories[i].name}</option>`);
                                }
                            }
                        }
                    })
                })
            })
        </script>
    @endpush
@endsection
