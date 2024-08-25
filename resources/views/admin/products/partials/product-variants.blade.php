<div class="card">
    <div class="card-body">
        <div class="card-header-2">
            <h5>Product Variants</h5>
        </div>

        <!-- Variants Container -->
        <div id="variantsContainer"></div>
        
        <!-- Add New Variant Button -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <button type="button" class="btn btn-primary w-100" aria-label="Add Variant" id="addVariantBtn">
                    <i class="fa fa-plus"></i>&nbsp; Add Variant
                </button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function() {
        let rowCount = 0;

        $('#addVariantBtn').click(function() {
            rowCount++;
            const newRow = `
                <div class="row mb-3 variant-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title" for="variantName${rowCount}">Variant Name</label>
                        <input type="text" name="variants[${rowCount}][variant_name]" id="variantName${rowCount}" class="form-control" placeholder="Enter variant name">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title" for="priceCustomer${rowCount}">Price for Customer</label>
                        <input type="text" name="variants[${rowCount}][price_customer]" id="priceCustomer${rowCount}" class="form-control" placeholder="Enter amount">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title" for="priceVendor${rowCount}">Price for Vendor</label>
                        <input type="text" name="variants[${rowCount}][price_vendor]" id="priceVendor${rowCount}" class="form-control" placeholder="Enter amount">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title" for="mrp${rowCount}">MRP</label>
                        <input type="text" name="variants[${rowCount}][mrp]" id="mrp${rowCount}" class="form-control" placeholder="Enter MRP">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title" for="expiryDate${rowCount}">Expiry Date</label>
                        <input type="text" name="variants[${rowCount}][expiry_date]" id="expiryDate${rowCount}" class="form-control" placeholder="Enter expiry date">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title">&nbsp;</label>
                        <button class="btn btn-secondary w-100 h-50 remove-btn" aria-label="Remove Variant">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            $('#variantsContainer').append(newRow);

            // Add validation rules for the new fields
            $('#productForm').validate().settings.rules[`variants[${rowCount}][variant_name]`] = "required";
            $('#productForm').validate().settings.rules[`variants[${rowCount}][price_customer]`] = "required";
            $('#productForm').validate().settings.rules[`variants[${rowCount}][price_vendor]`] = "required";
            $('#productForm').validate().settings.rules[`variants[${rowCount}][mrp]`] = "required";
            $('#productForm').validate().settings.rules[`variants[${rowCount}][expiry_date]`] = "required";
        });

        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.variant-row').remove();
        });
    });
</script>
@endpush