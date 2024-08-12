@if ($hasPlugin('dataTable'))
@push('styles')
<link rel="stylesheet" type="text/css" href="assets/css/datatables.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
@endpush
@endif