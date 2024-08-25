<div class="card">
    <div class="card-body">
        <div class="card-header-2">
            <h5>Product Images</h5>
        </div>

        <div class="mb-3">
            <label class="form-label-title">Thumbnail</label>
            <div class="form-group">
                <input type="file" name="thumbnail" accept="image/*" class="form-control">
                @if ($errors->has('thumbnail'))
                <div class="invalid-feedback d-block">{{ $errors->first('thumbnail') }}</div>
                @endif
            </div>
        </div>

        <div class="mb-2">
            <label class="form-label-title">Product Images</label>
            <div class="form-group">
                <input type="file" name="images[]" accept="image/*" class="form-control" multiple>
                @if ($errors->has('images'))
                <div class="invalid-feedback d-block">{{ $errors->first('images') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>