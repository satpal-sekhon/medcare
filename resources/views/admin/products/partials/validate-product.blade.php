@push('scripts')
    <script>
        $(function() {
            // Add custom validation method for Chosen
            $.validator.addMethod("ckeditorRequired", function(value, element) {
                // Ensure CKEditor instance is available
                if (window.editorInstance) {
                    var editor = window.editorInstance;
                    return editor.getData().trim() !== '';
                }
                return false;
            }, "This field is required.");


            $('#productForm').validate({
                rules: {
                    primary_category: "required",
                    category: "required",
                    brand: "required",
                    name: "required",
                    mrp: "required",
                    thumbnail: {
                        required: {
                            depends: function(element) {
                                return $('[name="_method"]').val() !== 'PUT'
                            }
                        }
                    },
                    composition: "required",
                    ingredients: "required",
                    short_description: "required",
                    "diseases[]": "required",
                    customer_price: "required",
                    vendor_price: "required",
                    description: {
                        ckeditorRequired: true
                    },
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
                    let formData = new FormData(form);

                    $.ajax({
                        url: $(form).attr('action'),
                        type: $(form).attr('method').toUpperCase(),
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Success!',
                                    `${response.message}`,
                                    'success'
                                );

                                setTimeout(() => {
                                    window.location =
                                        "{{ route('admin.products.index') }}";
                                }, 2000);
                            } else {
                                Swal.fire(
                                    'Oops!',
                                    'Something went wrong...',
                                    'error'
                                );
                            }
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
                console.log('__',$row)
                const index = $row.attr('id').match(/\d+$/)[0]; // Extract the row number

                $('#productForm').validate().settings.rules[`variants[${index}][variant_name]`] =
                    "required";
                $('#productForm').validate().settings.rules[`variants[${index}][price_customer]`] =
                    "required";
                $('#productForm').validate().settings.rules[`variants[${index}][price_vendor]`] =
                    "required";
                $('#productForm').validate().settings.rules[`variants[${index}][mrp]`] = "required";
            });
        })
    </script>
@endpush
