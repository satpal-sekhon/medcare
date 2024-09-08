@if($hasPlugin('dataTable'))
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
@endpush
@endif

@if($hasPlugin('contentEditor'))
@push('styles')
<link href="{{ asset('assets/css/summernote/summernote-lite.min.css') }}" rel="stylesheet">

@endpush
@push('scripts')
<script src="{{ asset('assets/js/summernote/summernote-lite.min.js') }}"></script>
<script>
    $(function(){
        $('#editor').summernote({
            height: 400,
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
    })
</script>
@endpush
@endif

@if($hasPlugin('jQueryValidate'))
@push('scripts')
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
@endpush
@endif

@if($hasPlugin('chosen'))
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
@endpush
@push('scripts')
<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
@endpush
@endif

@if($hasPlugin('slickSlider'))
@push('scripts')
<script src="{{ asset('assets/js/slick/slick.js') }}"></script>
<script src="{{ asset('assets/js/slick/slick-animation.min.js') }}"></script>
@endpush
@endif

@if($hasPlugin('datePicker'))
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/flatpickr/flatpickr.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/flatpickr/flatpickr.min.js') }}"></script>
<script>
    function initializeDatepickers() {
            $('.datepicker').each(function() {
                flatpickr(this, {
                    dateFormat: "Y-m-d",
                    minDate: "today"
                });
            });
        }
</script>
@endpush
@endif