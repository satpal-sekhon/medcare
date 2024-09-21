@extends('layouts.frontend-layout')
@section('title', $page->name)

@section('content')

<img src="{{ getSetting('default_page_image') }}" alt="" class="mw-100">

<section class="container">
    {!! $page->content !!}
</section>
@endsection