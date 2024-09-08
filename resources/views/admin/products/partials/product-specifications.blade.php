<div class="card">
    <div class="card-body">
        <div class="card-header-2">
            <h5>Product Specifications</h5>
        </div>

        <!-- Specifications Container -->
        <div id="specificationsContainer">
            @if($product)
            @foreach ($product->specifications as $key => $specification)
            <div class="row mb-3 specification-row" id="{{$key}}">
                <div class="col-md-10 mb-3">
                    <label class="form-label-title" for="specTitle{{$key}}">Title</label>
                    <input type="text" name="specifications[{{$key}}][title]" id="specTitle{{$key}}"
                        class="form-control" placeholder="Enter title" maxlength="100"
                        value="{{ $specification->title }}">
                </div>
                <div class="col-md-2 mb-3">
                    <label>&nbsp;</label>
                    <button class="btn btn-secondary w-100 h-50 remove-btn" aria-label="Remove Specification">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label-title" for="specDescription{{$key}}">Description</label>
                    <textarea name="specifications[{{$key}}][description]" id="specDescription{{$key}}"
                        class="form-control specDescription" placeholder="Enter description">{{ $specification->description }}</textarea>
                </div>
            </div>
            @endforeach
            @endif
        </div>

        <!-- Add New Specification Button -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <button type="button" class="btn btn-primary w-100" aria-label="Add Specification" id="addSpecificationBtn">
                    <i class="fa fa-plus"></i>&nbsp; Add Specification
                </button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function() {
        function initializeSummerNote(){
            $('.specDescription').summernote({
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });
        }

        initializeSummerNote();
        
        let specificationRowCount = "{{ $key ?? 0 }}";

        $('#addSpecificationBtn').click(function() {
            specificationRowCount++;
            const newRow = `
            <div class="row mb-3 specification-row" id="${specificationRowCount}">
                <div class="col-md-10 mb-3">
                    <label class="form-label-title" for="specTitle${specificationRowCount}">Title</label>
                    <input type="text" name="specifications[${specificationRowCount}][title]" id="specTitle${specificationRowCount}"
                        class="form-control" placeholder="Enter title" maxlength="100">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label-title">&nbsp;</label>
                    <button class="btn btn-secondary w-100 h-50 remove-btn" aria-label="Remove Specification">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label-title" for="specDescription${specificationRowCount}">Description</label>
                    <textarea name="specifications[${specificationRowCount}][description]" id="specDescription${specificationRowCount}"
                        class="form-control specDescription" placeholder="Enter description"></textarea>
                </div>
                
            </div>`;

            $('#specificationsContainer').append(newRow);

            // Initialize Summernote for the newly added description field
            initializeSummerNote();

            // Add validation rules for the new fields (if needed)
            $('#productForm').validate().settings.rules[`specifications[${specificationRowCount}][title]`] = "required";
            $('#productForm').validate().settings.rules[`specifications[${specificationRowCount}][description]`] = "required";
        });

        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.specification-row').remove();
        });
    });
</script>
@endpush
