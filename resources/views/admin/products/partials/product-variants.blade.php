<div class="card">
    <div class="card-body">
        <div class="card-header-2">
            <h5>Product Variants</h5>
        </div>

        <!-- Variants Container -->
        <div id="variantsContainer">
            @if($product)
            @foreach ($product->variants as $key => $variant)
            <div class="row mb-3 variant-row" id="{{$key}}">
                <div class="col-md-4 mb-3">
                    <label class="form-label-title" for="variantName{{$key}}">Variant Name</label>
                    <input type="text" name="variants[{{$key}}][variant_name]" id="variantName{{$key}}"
                        class="form-control" placeholder="Enter variant name" maxlength="100"
                        value="{{ $variant->name }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label-title" for="priceCustomer{{$key}}">Price for Customer</label>
                    <input type="number" name="variants[{{$key}}][price_customer]" id="priceCustomer{{$key}}"
                        class="form-control" placeholder="Enter amount" value="{{ $variant->customer_price }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label-title" for="priceVendo{{$key}}">Price for Vendor</label>
                    <input type="number" name="variants[{{$key}}][price_vendor]" id="priceVendor{{$key}}"
                        class="form-control" placeholder="Enter amount" value="{{ $variant->vendor_price }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label-title" for="mrp{{$key}}">MRP</label>
                    <input type="number" name="variants[{{$key}}][mrp]" id="mrp{{$key}}" class="form-control"
                        placeholder="Enter MRP" value="{{ $variant->mrp }}">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="mb-2">
                        <label class="form-label-title">Product Weight (in KG)</label>
                        <div class="form-group">
                            <input type="number" name="weight" class="form-control" placeholder="Weight" value="{{ $product->weight ?? '' }}" step="0.01">
                        </div>
                    </div>
                </div>
                <div @class(["col-md-4 mb-3 product-stock-quantity", "d-none" => $product->stock_type != 'With Stock'])>
                    <label class="form-label-title" for="stock_quantity_for_customer{{$key}}">Stock Quantity for Customer</label>
                    <input type="number" name="variants[{{$key}}][stock_quantity_for_customer]" id="stock_quantity_for_customer{{$key}}" class="form-control" placeholder="Enter Quantity" value="{{ $variant->stock_quantity_for_customer }}">
                </div>
                <div @class(["col-md-4 mb-3 product-stock-quantity", "d-none" => $product->stock_type != 'With Stock'])>
                    <label class="form-label-title" for="stock_quantity_for_vendor{{$key}}">Stock Quantity for Vendor</label>
                    <input type="number" name="variants[{{$key}}][stock_quantity_for_vendor]" id="stock_quantity_for_vendor{{$key}}" class="form-control" placeholder="Enter Quantity"  value="{{ $variant->stock_quantity_for_vendor }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label-title" for="expiryDate{{$key}}">Expiry Date</label>
                    <input type="text" name="variants[{{$key}}][expiry_date]" id="expiryDate{{$key}}"
                        class="form-control datepicker" placeholder="Enter expiry date" value="{{ $variant->expiry_date }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label-title">&nbsp;</label>
                    <button class="btn btn-secondary w-100 h-50 remove-btn" aria-label="Remove Variant">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
            @endforeach
            @endif
        </div>

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
        let rowCount = "{{ $key ?? 0 }}";
        $('#addVariantBtn').click(function() {
                let productStockQuantityAdditionalClass = `d-none`;

                if($('[name="stock_type"]').val() == 'With Stock'){
                    productStockQuantityAdditionalClass = ``;
                }

                rowCount++;
                const newRow = `
                <div class="row mb-3 variant-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title" for="variantName${rowCount}">Variant Name</label>
                        <input type="text" name="variants[${rowCount}][variant_name]" id="variantName${rowCount}" class="form-control" placeholder="Enter variant name">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title" for="priceCustomer${rowCount}">Price for Customer</label>
                        <input type="number" name="variants[${rowCount}][price_customer]" id="priceCustomer${rowCount}" class="form-control" placeholder="Enter amount">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title" for="priceVendor${rowCount}">Price for Vendor</label>
                        <input type="number" name="variants[${rowCount}][price_vendor]" id="priceVendor${rowCount}" class="form-control" placeholder="Enter amount">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title" for="mrp${rowCount}">MRP</label>
                        <input type="number" name="variants[${rowCount}][mrp]" id="mrp${rowCount}" class="form-control" placeholder="Enter MRP">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title" for="weight${rowCount}">Product Weight (in KG)</label>
                        <input type="number" name="variants[${rowCount}][weight]" id="weight${rowCount}" class="form-control" placeholder="Weight" step="0.01">
                    </div>
                    <div class="col-md-4 mb-3 product-stock-quantity ${productStockQuantityAdditionalClass}">
                        <label class="form-label-title" for="stock_quantity_for_customer${rowCount}">Stock Quantity for Customer</label>
                        <input type="number" name="variants[${rowCount}][stock_quantity_for_customer]" id="stock_quantity_for_customer${rowCount}" class="form-control" placeholder="Enter Quantity">
                    </div>
                    <div class="col-md-4 mb-3 product-stock-quantity ${productStockQuantityAdditionalClass}">
                        <label class="form-label-title" for="stock_quantity_for_vendor${rowCount}">Stock Quantity for Vendor</label>
                        <input type="number" name="variants[${rowCount}][stock_quantity_for_vendor]" id="stock_quantity_for_vendor${rowCount}" class="form-control" placeholder="Enter Quantity">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title" for="expiryDate${rowCount}">Expiry Date</label>
                        <input type="text" name="variants[${rowCount}][expiry_date]" id="expiryDate${rowCount}" class="form-control datepicker" placeholder="Enter expiry date">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-title">&nbsp;</label>
                        <button class="btn btn-secondary w-100 h-50 remove-btn" aria-label="Remove Variant">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>`;

                $('#variantsContainer').append(newRow);
                initializeDatepickers();

                // Add validation rules for the new fields
                $('#productForm').validate().settings.rules[`variants[${rowCount}][variant_name]`] = "required";
                $('#productForm').validate().settings.rules[`variants[${rowCount}][price_customer]`] = "required";
                $('#productForm').validate().settings.rules[`variants[${rowCount}][price_vendor]`] = "required";
               
                $('#productForm').validate().settings.rules[`variants[${rowCount}][stock_quantity_for_customer]`] =
                {
                    required: {
                        depends: function(element) {
                            return $('[name="stock_type"]').val() === 'With Stock'
                        }
                    },
                    number: true
                };

                $('#productForm').validate().settings.rules[`variants[${rowCount}][stock_quantity_for_vendor]`] =
                {
                    required: {
                        depends: function(element) {
                            return $('[name="stock_type"]').val() === 'With Stock'
                        }
                    },
                    number: true
                };

                $('#productForm').validate().settings.rules[`variants[${rowCount}][mrp]`] = "required";
            });

            $(document).on('click', '.remove-btn', function() {
                $(this).closest('.variant-row').remove();
            });
        });
</script>
@endpush