@extends('layouts.frontend-layout')
@section('title', $page->name)

@section('content')
@push('meta')
<meta name="title" content="{{ $page->meta_title }}">
<meta name="keywords" content="{{ $page->meta_tags }}">
<meta name="description" content="{{ $page->meta_description }}">
@endpush

<img src="{{ getSetting('default_page_image') }}" alt="" class="mw-100">

<section class="container">
    {!! $page->content !!}
</section>
@endsection