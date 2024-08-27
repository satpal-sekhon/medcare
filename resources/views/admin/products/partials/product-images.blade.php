<div class="card">
    <div class="card-body">
        <div class="card-header-2">
            <h5>Product Images</h5>
        </div>

        <div class="mb-3">
            <label class="form-label-title">Thumbnail</label>
            <div class="form-group">
                <input type="file" name="thumbnail" accept="image/*" class="form-control" id="thumbnailInput">
                <div id="thumbnailPreview" class="image-preview row">
                    @if ($product->thumbnail ?? '')
                        <div class="preview-container col-md-3 mt-2">
                            <img src="{{ asset('storage/'.$product->thumbnail) }}" class="preview-img">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mb-2">
            <label class="form-label-title">Product Images</label>
            <div class="form-group">
                <input type="file" name="images[]" accept="image/*" class="form-control" id="imagesInput" multiple>
                <div id="imagesPreview" class="image-preview row">
                    @if ($product->thumbnail ?? '')
                        @foreach($product->images as $image)
                        <div class="preview-container col-md-3 mt-2">
                            <img src="{{ asset('storage/'.$image->path) }}" class="preview-img">
                            <button type="button" class="btn btn-secondary btn-sm px-2 rounded-pill" data-image-id="{{ $image->id }}"><i class="fa fa-trash"></i></button>
                        </div>
                        @endforeach
                    @endif
                </div>
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
                // Check file size before preview
                if (file.size > 2.5 * 1024 * 1024) {
                    alert('File size must be less than 2.5 MB.');
                    return;
                }

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