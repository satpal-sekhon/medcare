@if($message)
<div @class(["alert alert-warning alert-dismissible fade show", $class]) role="alert">
    {{ $message }}
</div>
@endif