<div class="card">
    <div class="card-body">
        <div class="card-header-2">
            <h5>Product Information</h5>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label-title col-sm-4 mb-0">Primary Category</label>
                <select name="primary_category" id="primary_category" class="form-control">
                    <option value="" selected disabled>Select Primary Category</option>
                    @foreach ($primaryCategories as $primary_category)
                    <option value="{{ $primary_category->id }}" {{ old('primary_category')==$primary_category->id ?
                        'selected' : '' }}>
                        {{ $primary_category->name }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('primary_category'))
                <div class="invalid-feedback d-block">{{ $errors->first('primary_category') }}</div>
                @endif
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label-title col-sm-4 mb-0">Category</label>
                <select name="category" id="category" class="form-control">
                    <option value="" selected disabled>Select Category</option>
                </select>
                @if ($errors->has('category'))
                <div class="invalid-feedback d-block">{{ $errors->first('category') }}</div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label-title col-sm-4 mb-0">Brand</label>
                <select name="brand" id="brand" class="form-control">
                    <option value="" selected disabled>Select Brand</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @selected(old('brand')==$brand->id)>
                        {{ $brand->name }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('brand'))
                <div class="invalid-feedback d-block">{{ $errors->first('brand') }}</div>
                @endif
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label-title col-sm-4 mb-0">Stock Status</label>
                <select name="brand" id="brand" class="form-control">
                    <option value="In Stock">In Stock</option>
                    <option value="Out of Stock">Out of Stock</option>
                </select>
                @if ($errors->has('brand'))
                <div class="invalid-feedback d-block">{{ $errors->first('brand') }}</div>
                @endif
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label-title mb-0">Product Name</label>
            <input type="text" name="name" placeholder="Product Name" value="{{ old('name') }}" class="form-control">
            @if ($errors->has('name'))
            <div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label-title mb-0">Enter Composition</label>
            <textarea name="composition" placeholder="Enter Composition"
                class="form-control">{{ old('composition') }}</textarea>
            @if ($errors->has('composition'))
            <div class="invalid-feedback d-block">{{ $errors->first('composition') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label-title mb-0">Short Description</label>
            <textarea name="short_description" placeholder="Enter Short Description"
                class="form-control">{{ old('short_description') }}</textarea>
            @if ($errors->has('short_description'))
            <div class="invalid-feedback d-block">{{ $errors->first('short_description') }}</div>
            @endif
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label-title col-sm-4 mb-0">Ingredients</label>
                <textarea name="ingredients" placeholder="Enter ingredients"
                    class="form-control">{{ old('ingredients') }}</textarea>
                @if ($errors->has('ingredients'))
                <div class="invalid-feedback d-block">{{ $errors->first('ingredients') }}</div>
                @endif
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label-title col-sm-4 mb-0">Select Disease</label>
                <select name="disease" id="disease" class="form-control">
                    <option value="" selected disabled>Select Disease</option>
                </select>
                @if ($errors->has('disease'))
                <div class="invalid-feedback d-block">{{ $errors->first('disease') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>