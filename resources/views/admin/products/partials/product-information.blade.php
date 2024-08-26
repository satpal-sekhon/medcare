<div class="card">
    <div class="card-body">
        <div class="card-header-2">
            <h5>Product Information</h5>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label-title mb-0">Primary Category</label>
                <select name="primary_category" id="primary_category" class="form-control">
                    <option value="" selected disabled>Select Primary Category</option>
                    @foreach ($primaryCategories as $primary_category)
                    <option value="{{ $primary_category->id }}" {{ old('primary_category')==$primary_category->id ?
                        'selected' : '' }}>
                        {{ $primary_category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label-title mb-0">Category</label>
                <select name="category" id="category" class="form-control">
                    <option value="" selected disabled>Select Category</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label-title mb-0">Brand</label>
                <select name="brand" id="brand" class="form-control">
                    <option value="" selected disabled>Select Brand</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @selected(old('brand')==$brand->id)>
                        {{ $brand->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label-title mb-0">Stock Status</label>
                <select name="stock_status" id="stock_status" class="form-control">
                    <option value="In Stock">In Stock</option>
                    <option value="Out of Stock">Out of Stock</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label-title mb-0">Product Name</label>
            <input type="text" name="name" placeholder="Product Name" value="{{ old('name') }}" class="form-control">
        </div>

        <div class="d-flex gap-4 align-items-center">
            <label class="form-label-title">Is prescription required</label>
            <label class="switch">
                <input type="checkbox" name="is_prescription_required" value="1"><span class="switch-state"></span>
            </label>
        </div>
    </div>
</div>