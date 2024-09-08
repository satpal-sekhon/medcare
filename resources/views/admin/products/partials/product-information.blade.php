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
                    <option value="{{ $primary_category->id }}"  @selected($primary_category->id == ($product->primary_category_id ?? 0))>
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
                    <option value="{{ $brand->id }}" @selected($brand->id==($product->brand_id ?? 0))>
                        {{ $brand->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label-title col-sm-4 mb-0">Select Diseases</label>
                <select name="diseases[]" id="diseases" class="form-control" multiple>
                    @foreach ($diseases as $disease)
                        <option value="{{ $disease->id }}" @selected(in_array($disease->id, ($product ? $product->diseaseIds() : [])))>{{ $disease->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6">
                <label for="stock_type" class="form-label-title mb-0">Stock Type</label>
                <select name="stock_type" id="stock_type" class="form-control">
                    <option value="" selected disabled>Select Stock Type</option>
                    <option value="With Stock" @selected(($product->stock_type ?? '') == 'With Stock')>With Stock</option>
                    <option value="Without Stock" @selected(($product->stock_type ?? '') == 'Without Stock')>Without Stock</option>
                </select>
            </div>
            
            <div class="mb-3 col-md-6">
                <label for="product_type" class="form-label-title mb-0">Product Type</label>
                <select name="product_type" id="product_type" class="form-control">
                    <option value="">Select Product Type</option>
                    <option value="General" @selected(($product->product_type ?? '') == 'General')>General Product</option>
                    <option value="Generic" @selected(($product->product_type ?? '') == 'Generic')>Generic Medicine</option>
                </select>
            </div>

            <div class="mb-3 col-md-12">
                <label class="form-label-title mb-0">Product Name</label>
                <input type="text" name="name" placeholder="Product Name" value="{{ $product->name ?? '' }}" class="form-control" maxlength="100">
            </div>


            <div class="mb-3 col-md-6">
                <label class="form-label-title mb-0">Enter Unit</label>
                <input type="text" name="unit" placeholder="Unit" value="{{ $product->unit ?? '' }}" class="form-control" maxlength="100">
            </div>

            <div class="mb-3 col-md-6">
                <label for="flag" class="form-label-title mb-0">Select Flag</label>
                <select name="flag" id="flag" class="form-control">
                    <option value="">Select Flag</option>
                    <option value="Trending" @selected(($product->flag ?? '') == 'Trending')>Trending</option>
                    <option value="On Sale" @selected(($product->flag ?? '') == 'On Sale')>On Sale</option>
                    <option value="Casual" @selected(($product->flag ?? '') == 'Casual')>Casual</option>
                </select>
            </div>
        </div>


        <div class="row">
            <div class="d-flex gap-4 align-items-center col-md-6">
                <label class="form-label-title">Is prescription required</label>
                <label class="switch">
                    <input type="checkbox" name="is_prescription_required" value="1" @checked(($product->is_prescription_required ?? 0)==1)><span class="switch-state"></span>
                </label>
            </div>
            <div class="d-flex gap-4 align-items-center col-md-6">
                <label class="form-label-title">Show On Homepage</label>
                <label class="switch">
                    <input type="checkbox" name="show_on_homepage" value="1" @checked(($product->show_on_homepage ?? 0))><span class="switch-state"></span>
                </label>
            </div>        
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(function(){
        $('#diseases').chosen({
            width: '100%',
            placeholder_text_multiple: 'Select Diseases'
        });
    })
</script>
@endpush