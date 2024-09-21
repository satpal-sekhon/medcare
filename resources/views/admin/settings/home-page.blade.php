@extends('layouts.admin-layout')

@section('content')
<div class="row">
    <div class="col-sm-12 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-header-2">
                    <h5>Manage Home Page</h5>
                </div>

                <x-success-message :message="session('success')" />

                <div class="theme-form theme-form-2 mega-form">
                    <form action="{{ route('admin.settings.home-page.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <fieldset class="border p-4 my-2">
                            <legend class="fs-5 fw-bold">Top Header Text</legend>
                            <div id="text-inputs">
                                @foreach (json_decode($settings->top_header_text) as $key => $header_text)
                                    <div class="d-flex gap-2 mb-2">
                                        <div class="form-group w-100">
                                            <input type="text" name="top_header_text[{{$key}}]" class="form-control"
                                                placeholder="Enter text here" value="{{ $header_text }}">
                                        </div>
                                        <button type="button" class="btn btn-danger remove-btn">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-primary mt-2 mb-3 h-75" id="add-btn">Add Text Input</button>
                        </fieldset>

                        @foreach ([
                        'Main Banner' => ['prefix' => 'home_main_banner', 'count' => 3],
                        'Offer Images' => ['prefix' => 'home_offer', 'count' => 4],
                        'Horizontal Images' => ['prefix' => 'home_horizontal', 'count' => 3]
                        ] as $section => $info)
                        <fieldset class="border p-4 my-2">
                            <legend class="fs-5 fw-bold">{{ $section }}</legend>
                            @for ($i = 1; $i <= $info['count']; $i++)
                            <div class="row">
                                <div class="col-md-6">
                                    <x-form-input type="file" label="Image {{ $i }}"
                                        name="{{ $info['prefix'] }}_image_{{ $i }}" :labelClass="'form-label-title'">
                                    </x-form-input>

                                    @php
                                        $image_column = $info['prefix'].'_image_'.$i;
                                    @endphp

                                    <img src="{{ asset($settings->$image_column) }}" alt="" class="img-fluid w-50 mb-3">
                                </div>
                                <div class="col-md-6">
                                    @php
                                        $column_name = $info['prefix'].'_image_'.$i.'_link';
                                    @endphp
                                    <x-form-input label="Image {{ $i }} Link" value="{{ $settings->$column_name }}"
                                        name="{{ $info['prefix'] }}_image_{{ $i }}_link" class="h-75"
                                        :labelClass="'form-label-title'"></x-form-input>
                                </div>
                            </div>
                            @endfor
                        </fieldset>
                        @endforeach

                        <button class="btn theme-bg-color text-white mt-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<x-include-plugins :plugins="['jQueryValidate']"></x-include-plugins>

@push('scripts')
<script>
    $(document).ready(function() {
        let inputCount = {{ count(json_decode($settings->top_header_text, true)) }};
        
        $('form').validate({
            rules: {
                'top_header_text[]': {
                    required: true
                }
            },
            messages: {
                'top_header_text[]': {
                    required: "This field is required."
                }
            },
            errorElement: 'div',
            errorClass: 'invalid-feedback',
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
                // Submit form via AJAX
                const formData = new FormData(form);
                
                $.ajax({
                    type: 'POST',
                    url: $(form).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success (e.g., display success message)
                        // You can redirect or update the UI as needed
                        alert(response.message); // Adjust this as needed
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., display error messages)
                        const errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            $(`[name="${field}"]`).addClass('is-invalid');
                            $(`[name="${field}"]`).after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                        }
                    }
                });
            }
        });

        
        for(let i=0; i<inputCount; i++){
            $('form').validate().settings.rules[`top_header_text[${i}]`] = {
                required: true
            };
        }

        $('#add-btn').click(function() {
            const inputRow = $('<div class="d-flex gap-2 mb-2"></div>');
            const formGroup = $('<div class="form-group w-100"></div>');
            const input = $(`<input type="text" name="top_header_text[${inputCount}]" class="form-control" placeholder="Enter text here" required>`);
            const removeBtn = $('<button type="button" class="btn btn-danger remove-btn h-75">Remove</button>');

            removeBtn.click(function() {
                inputRow.remove();
            });

            // Append the input to the form group
            formGroup.append(input);
            // Append form group and remove button to the row
            inputRow.append(formGroup).append(removeBtn);
            // Append the whole row to the inputs container
            $('#text-inputs').append(inputRow);

            $('form').validate().settings.rules[`top_header_text[${inputCount}]`] = {
                required: true
            };

            inputCount++;

        });

        // Delegate event for dynamically added remove buttons
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.d-flex').remove();
        });
    });
</script>
@endpush
@endsection