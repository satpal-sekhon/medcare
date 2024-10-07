<form action="{{ route('bills.store') }}" method="post" enctype="multipart/form-data" id="billingForm">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <h4>Bill From</h4>
            <div class="mb-2">
                <x-form-input name="bill_from" label="Name" value="{{ getSetting('site_name') }}"></x-form-input>
            </div>

            <div class="mb-2">
                <x-textarea name="bill_from_address" label="Address" value="{{ getSetting('site_address') }}">
                </x-textarea>
            </div>

            <div class="mb-2">
                <x-form-input name="bill_from_contact" label="Contact Number"
                    value="{{ getSetting('site_contact_number') }}"></x-form-input>
            </div>
        </div>

        <!-- Bill To Section -->
        <div class="col-md-6 mb-3">
            <h4>Bill To</h4>
            <div class="mb-2">
                <label for="customerSelect" class="form-label mb-0">Select Customer</label>
                <select class="form-select chosen" name="customer" id="customerSelect" aria-label="Select customer">
                    <option value="">Select a customer</option>
                    @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">#{{ $customer->user_code }} {{ $customer->name }}</option>
                    @endforeach
                    <option value="custom">Add Custom Customer</option>
                </select>
                <input type="text" class="form-control mt-2 d-none" name="custom_name" id="customCustomer"
                    placeholder="Enter custom customer name">
            </div>

            <div class="mb-2">
                <x-textarea name="bill_to_address" label="Address" placeholder="Enter customer address"></x-textarea>
            </div>

            <div class="mb-2">
                <x-form-input type="number" name="bill_to_contact" label="Contact Number" placeholder="Enter customer contact number">
                </x-form-input>
            </div>
        </div>
    </div>


    <div id="productList mt-2">
        <div class="row mb-3 align-items-end">
            <div class="col-md-5">
                <div class="mb-2">
                    <label for="product" class="form-label mb-0">Product</label>
                    <select class="form-select chosen" id="product" aria-label="Select product">
                        <option value="">Select product</option>
                        <option value="product1">Product 1</option>
                        <option value="product2">Product 2</option>
                        <option value="product3">Product 3</option>
                        <option value="custom">Add Custom Product</option>
                    </select>
                    <input type="text" class="form-control mt-2 d-none" id="customProduct"
                        placeholder="Enter custom product name">
                </div>
            </div>
            <div class="col-md-3">
                <x-form-input type="number" name="quantity" label="Quantity" placeholder="Enter quantity" min="1">
                </x-form-input>
            </div>
            <div class="col-md-3">
                <x-form-input type="number" name="price" label="Price per Unit" placeholder="Enter price per unit"
                    step="0.01" min="0"></x-form-input>
            </div>
            <div class="col-md-1">
                <div class="form-group mb-2">
                    <button type="button" class="btn btn-info mt-3" id="addProduct">Add</button>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mt-4 mb-2">Products Added</h4>
    <table class="table mb-4">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="addedProducts"></tbody>
    </table>

    <h4>Total Amount: <span id="totalAmount">₹0.00</span></h4>
    <button type="submit" class="btn btn-primary mt-3">Generate Bill</button>
</form>


@push('scripts')
<script>
    $(function(){
        $('.chosen').chosen({
            width: '100%',
        });

        $('#billingForm').validate({
            rules: {
                bill_from: 'required',
                bill_from_address: 'required',
                bill_from_contact: 'required',
                bill_to_address: 'required',
                bill_to_contact: 'required',
                quantity: 'required',
                price: 'required'
            },
            errorPlacement: function(error, element) {
                // Create a new div with the class invalid-feedback if it doesn't exist
                var errorContainer = element.siblings('.invalid-feedback');
                if (errorContainer.length === 0) {
                    errorContainer = $('<span class="invalid-feedback d-block"></span>');
                    element.after(errorContainer);
                }
                // Clear any existing content and append the error message directly
                errorContainer.text(error.text());
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');

                // Find the error container and remove it if the error text is empty
                var errorContainer = $(element).siblings('.invalid-feedback');
                if (errorContainer.length > 0 && !$(element).hasClass('is-invalid')) {
                    errorContainer.remove();
                }
            },
            submitHandler: function(form) {
                if(!$('#customerSelect').val()){
                    alert('Please select customer');
                    return;
                }

                if($('#customerSelect').val()=='custom' && !$('#customCustomer').val()){
                    alert('Please enter customer name');
                    return;
                }

                if(!$('#product').val()){
                    alert('Please select product');
                    return;
                }

                if($('#product').val()=='custom' && !$('#customProduct').val()){
                    alert('Please enter product name');
                    return;
                }

                $.ajax({
                    url: $(form).attr('action'),
                    type: $(form).attr('method'),
                    data: $(form).serialize(),
                    success: function(response) {
                        alert('Bill generated successfully!');
                        //form.reset();
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred. Please try again.');
                    }
                });
                return false;
            }
        });
    })
</script>


<script>
    $(document).ready(function() {
        let totalAmount = 0;

        $('#customerSelect').change(function() {
            if ($(this).val() === 'custom') {
                $('#customCustomer').removeClass('d-none').val('');
            } else {
                $('#customCustomer').addClass('d-none').val('');
            }
        });

        $('#product').change(function() {
            if ($(this).val() === 'custom') {
                $('#customProduct').removeClass('d-none').val('');
            } else {
                $('#customProduct').addClass('d-none').val('');
            }
        });

        $('#addProduct').click(function() {
            const product = $('#product').val() === 'custom' ? $('#customProduct').val() : $('#product option:selected').text();
            const quantity = Number($('#quantity').val());
            const price = Number($('#price').val());
            const total = (quantity * price).toFixed(2);

            if (product && quantity > 0 && price >= 0) {
                $('#addedProducts').append(`<tr>
                    <td>${product}</td>
                    <td>${quantity}</td>
                    <td>${price.toFixed(2)}</td>
                    <td>${total}</td>
                </tr>`);

                totalAmount += Number(total);
                $('#totalAmount').text(`₹${totalAmount.toFixed(2)}`);

                // Clear inputs
                $('#product').val('');
                $('#quantity').val('');
                $('#price').val('');
                $('#customProduct').val('').addClass('d-none');
            } else {
                alert('Please fill out all fields correctly.');
            }
        });
    });
</script>
@endpush

<x-include-plugins :plugins="['chosen', 'jQueryValidate']" />