@extends('layouts.frontend-layout')
@section('title', 'FAQs')

@section('content')
<section class="faq-box-contain container">
    <div class="row">
        <!-- FAQ Accordion Section -->
        <div id="faq">
            <h2 class="mb-4">Frequently Asked Questions</h2>
            <div class="faq-accordion">
                <div class="accordion" id="accordionExample">
                    @foreach ($faqs as $key => $faq)
                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header" id="heading{{$key}}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{$key}}" aria-expanded="{{ $key===0 ? "true" : 'false' }}" aria-controls="collapse{{$key}}">
                                    {{ $faq->question }}

                                    <i @class(["fa-solid", 'fa-angle-down' => $key===0, 'fa-angle-up' => $key!==0])></i>
                                </button>
                            </h2>
                            <div id="collapse{{$key}}" @class(["accordion-collapse collapse", 'show' => $key===0]) aria-labelledby="heading{{$key}}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! nl2br($faq->question) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection