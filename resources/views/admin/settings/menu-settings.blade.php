@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-12 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Menu Settings</h5>
                    </div>

                    <x-success-message :message="session('success')" />
                    
                    <div class="theme-form theme-form-2 mega-form">
                        @foreach ($menuItems as $item)
                        <form action="{{ route('admin.settings.menu.update', $item->id) }}" class="mb-3" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <x-form-input name="label[{{$item->id}}]" label="Page Title" value="{{ $item->label }}" :labelClass="'form-label-title'"></x-form-input>
                                </div>
                            </div>

                            @if($item->meta_tags && !$item->is_dropdown)
                                <div class="row">
                                    @foreach(json_decode($item->meta_tags) as $key => $meta_tag)
                                    <div class="col-md-6">
                                        <x-form-input name="{{ $key }}[{{$item->id}}]" label="{{ ucwords(str_replace('_', ' ', $key)) }}" value="{{ $meta_tag }}" :labelClass="'form-label-title'"></x-form-input>
                                    </div>
                                    @endforeach
                                </div>
                            @endif

                            @foreach($item->children as $children)
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="my-1 fw-bold">Submenu</h5>
                                    <x-form-input name="label[{{$children->id}}]" label="Page Title" :labelClass="'form-label-title'" value="{{ $children->label}}"></x-form-input>
                                </div>
                            </div>

                            @if($children->meta_tags)
                                <div class="row">
                                    @foreach(json_decode($children->meta_tags) as $key=> $meta_tag)
                                    <div class="col-md-6">
                                        <x-form-input name="{{ $key }}[{{$children->id}}]" label="{{ ucwords(str_replace('_', ' ', $key)) }}" value="{{ $meta_tag }}" :labelClass="'form-label-title'"></x-form-input>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                            @endforeach
                            
                            <button class="btn theme-bg-color text-white">Update</button>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
