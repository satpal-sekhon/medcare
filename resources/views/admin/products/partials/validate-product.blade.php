@push('scripts')
<script>
    $(function(){
        $('#productForm').validate({
            rules: {
                primary_category: "required",
                category: {
                    required: {
                        depends: function(element) {
                            return $.trim($('[name="primary_category"]').val()).length > 0;
                        }
                    }
                },
                brand: "required",
                name: "required",
                mrp: "required",
                thumbnail: "required",
                composition: "required",
                ingredients: "required",
                short_description: "required",
                diseases: "required",
                customer_price: "required",
                vendor_price: "required",
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
            },
            submitHandler: function(form) {
                let formData = new FormData(form);

                $.ajax({
                    url: $(form).attr('action'),
                    type: $(form).attr('method').toUpperCase(),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log('response', response);
                    },
                    error: function(xhr, status, error) {
                       console.error('error', error);
                    }
                });
            }
        });

        // Manually apply validation rules for existing variant rows
        $('#variantsContainer .variant-row').each(function() {
            const $row = $(this);
            const index = $row.attr('id').match(/\d+$/)[0]; // Extract the row number

            $('#productForm').validate().settings.rules[`variants[${index}][variant_name]`] = "required";
            $('#productForm').validate().settings.rules[`variants[${index}][price_customer]`] = "required";
            $('#productForm').validate().settings.rules[`variants[${index}][price_vendor]`] = "required";
            $('#productForm').validate().settings.rules[`variants[${index}][mrp]`] = "required";
            $('#productForm').validate().settings.rules[`variants[${index}][expiry_date]`] = "required";
        });
    })
</script>
@endpush