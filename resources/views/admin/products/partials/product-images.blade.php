<div class="card">
    <div class="card-body">
        <div class="card-header-2">
            <h5>Product Images</h5>
        </div>

        <div class="mb-3">
            <label class="form-label-title">Thumbnail</label>
            <div class="form-group">
                <input type="file" name="thumbnail" accept="image/*" class="form-control" id="thumbnailInput">
                <div id="thumbnailPreview" class="image-preview row"></div>
                @if ($errors->has('thumbnail'))
                <div class="invalid-feedback d-block">{{ $errors->first('thumbnail') }}</div>
                @endif
            </div>
        </div>

        <div class="mb-2">
            <label class="form-label-title">Product Images</label>
            <div class="form-group">
                <input type="file" name="images[]" accept="image/*" class="form-control" id="imagesInput" multiple>
                <div id="imagesPreview" class="image-preview row"></div>
                @if ($errors->has('images'))
                <div class="invalid-feedback d-block">{{ $errors->first('images') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        // Maintain a list of files
        let fileArray = [];

        function updateFileInput(input, files) {
            const dataTransfer = new DataTransfer();
            files.forEach(file => dataTransfer.items.add(file));
            $(input).get(0).files = dataTransfer.files;
        }

        function previewImages(input, previewContainer) {
            $(previewContainer).empty(); // Clear existing previews

            const files = Array.from(input.files);
            fileArray = files.slice(); // Update the fileArray

            files.forEach(function(file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = $('<img>').attr('src', e.target.result).addClass('preview-img');
                        const deleteBtn = $('<button class="btn btn-secondary btn-sm px-2 rounded-pill"><i class="fa fa-trash"></i></button>');
                        
                        const container = $('<div>').addClass('preview-container col-md-3 mt-2');
                        container.append(img).append(deleteBtn);
                        $(previewContainer).append(container);

                        deleteBtn.on('click', function() {
                            // Remove file from fileArray
                            fileArray = fileArray.filter(f => f !== file);
                            updateFileInput(input, fileArray);
                            container.remove(); // Remove preview
                        });
                    };

                    reader.readAsDataURL(file);
                }
            });
        }

        // Handle thumbnail input change
        $('#thumbnailInput').on('change', function() {
            previewImages(this, '#thumbnailPreview');
        });

        // Handle product images input change
        $('#imagesInput').on('change', function() {
            previewImages(this, '#imagesPreview');
        });
    });
</script>
@endpush
