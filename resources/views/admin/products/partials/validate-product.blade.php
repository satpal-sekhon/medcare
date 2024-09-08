@push('scripts')
    <script>
         $.validator.addMethod('summernoteRequired', function(value, element) {
                console.log('element',element)
                var editorId = $(element).attr('id');
                return !$('#' + editorId).summernote('isEmpty');
            }, 'This field is required.');

        $(function() {
            initializeDatepickers();

            $('[name="stock_type"]').change(function(){
                if($(this).val()=='With Stock'){
                    $('.product-stock-quantity').removeClass('d-none');
                } else {
                    $('.product-stock-quantity').addClass('d-none')
                }
            })
            
           


            let deletedProductImages = [];
            $('[data-image-id]').click(function(){
                $(this).parents('.preview-container').remove();
                let image_id = $(this).attr('data-image-id');
                deletedProductImages.push(image_id)
            })


            $('#productForm').validate({
                rules: {
                    primary_category: "required",
                    category: "required",
                    brand: "required",
                    stock_type: "required",
                    name: {
                        required: true,
                        maxlength: 100
                    },
                    product_type: "required",
                    stock_quantity_for_customer: {
                        required: {
                            depends: function(element) {
                                return $('[name="stock_type"]').val() === 'With Stock'
                            }
                        },
                        number: true
                    },
                    stock_quantity_for_vendor: {
                        required: {
                            depends: function(element) {
                                return $('[name="stock_type"]').val() === 'With Stock'
                            }
                        },
                        number: true
                    },
                    unit: {
                        required: true,
                        maxlength: 100
                    },
                    mrp: "required",
                    thumbnail: {
                        required: {
                            depends: function(element) {
                                return $('[name="_method"]').val() !== 'PUT'
                            }
                        }
                    },
                    // composition: "required",
                    // ingredients: "required",
                    short_description: {
                        summernoteRequired: true
                    },
                    "diseases[]": "required",
                    customer_price: "required",
                    vendor_price: "required",
                    description: {
                        summernoteRequired: true
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
                    formData.append('deleted_images', deletedProductImages);

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
