@extends('layouts.admin-layout')

@section('content')
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Create FAQ</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">
                        <form action="{{ route('faq.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <x-form-input name="question" label="Question" placeholder="Enter Question"></x-form-input>
                            </div>

                            <div class="mb-3">
                                <x-textarea name="answer" label="Answer" placeholder="Enter Answer"></x-textarea>
                            </div>

                            <div class="mb-3 d-flex align-items-center gap-4">
                                <label class="form-label-title">Active</label>
                                <label class="switch">
                                    <input type="checkbox" name="active" value="1" @checked(old('active') === '1')><span class="switch-state"></span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn w-100 theme-bg-color text-white">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
