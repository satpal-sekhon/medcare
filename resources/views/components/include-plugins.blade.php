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
        .catch(error => {
            console.error(error);
        });
    })
</script>
@endpush
@endif