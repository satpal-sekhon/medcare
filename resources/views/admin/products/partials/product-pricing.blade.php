<div class="card">
    <div class="card-body">
        <div class="card-header-2">
            <h5>Product Pricing</h5>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label-title">Price For Customer</label>
                    <div class="form-group">
                        <input type="number" name="customer_price" class="form-control" placeholder="Enter amount" value="{{ $product->customer_price ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-4">
                <div class="mb-2">
                    <label class="form-label-title">Price For Vendor</label>
                    <div class="form-group">
                        <input type="number" name="vendor_price" class="form-control" placeholder="Enter amount" value="{{ $product->vendor_price ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-4">
                <div class="mb-2">
                    <label class="form-label-title">MRP</label>
                    <div class="form-group">
                        <input type="number" name="mrp" class="form-control" placeholder="Enter amount" value="{{ $product->mrp ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-4">
                <div class="mb-2">
                    <label class="form-label-title">Product Weight (in KG)</label>
                    <div class="form-group">
                        <input type="number" name="weight" class="form-control" placeholder="Weight" value="{{ $product->weight ?? '' }}" step="0.01">
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-4 product-stock-quantity d-none">
                <div class="mb-2">
                    <label class="form-label-title">Stock Quantity for Customer</label>
                    <div class="form-group">
                        <input type="number" name="stock_quantity_for_customer" class="form-control" placeholder="Enter Stock Quantity" value="{{ $product->stock_quantity_for_customer ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-4 product-stock-quantity d-none">
                <div class="mb-2">
                    <label class="form-label-title">Stock Quantity for Vendor</label>
                    <div class="form-group">
                        <input type="number" name="stock_quantity_for_vendor" class="form-control" placeholder="Enter Stock Quantity" value="{{ $product->stock_quantity_for_vendor ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label-title mb-2">Expiry Date</label>
                <input type="text" name="expiry_date" placeholder="Expiry Date" value="{{ old('expiry_date') }}"
                    class="form-control datepicker" value="{{ $product->expiry_date ?? '' }}">
            </div>
        </div>
    </div>
</div>