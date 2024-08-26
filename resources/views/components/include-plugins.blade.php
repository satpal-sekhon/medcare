@if($hasPlugin('dataTable'))
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
@endpush
@endif

@if($hasPlugin('ckEditor'))
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/ckeditor.js') }}"></script>
<script>
    $(function(){
        ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            // Ensure CKEditor instance is available
            window.editorInstance = editor;
        })
        .catch(error => {
            console.error(error);
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

@if($hasPlugin('select2'))
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
@endpush
@push('scripts')
<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
@endpush
@endif