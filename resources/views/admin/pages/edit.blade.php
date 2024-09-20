@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Edit {{ $page->name }} Page</h5>
                    </div>

                    <x-success-message :message="session('success')" />

                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('admin.pages.update', [$page->slug]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <x-form-input name="meta_title" label="Meta Title" :labelClass="'form-label-title'" value="{{ $page->meta_title }}"></x-form-input>
                            <x-form-input name="meta_description" label="Meta Description" :labelClass="'form-label-title'" value="{{ $page->meta_description }}"></x-form-input>
                            <x-form-input name="meta_tags" label="Meta Tags" :labelClass="'form-label-title'" value="{{ $page->meta_tags }}"></x-form-input>
                        
                            <textarea id="editor" name="content">{{ $page->content }}</textarea>

                            <div class="my-3">
                                <button type="submit" class="btn theme-bg-color text-white">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-include-plugins :plugins="['contentEditor']"></x-include-plugins>
@endsection
