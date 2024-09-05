<div class="card">
    <div class="card-body">
        <div class="card-header-2">
            <h5>Additional Details</h5>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label-title mb-0">Enter Composition</label>
                <textarea name="composition" placeholder="Enter Composition"
                    class="form-control">{{ $product->composition ?? '' }}</textarea>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label-title col-sm-4 mb-0">Ingredients</label>
                <textarea name="ingredients" placeholder="Enter ingredients"
                    class="form-control">{{ $product->ingredients ?? '' }}</textarea>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label-title mb-0">Short Description</label>
            <textarea name="short_description" placeholder="Enter Short Description"
                class="form-control">{{ $product->short_description ?? '' }}</textarea>
        </div>
    </div>
</div>