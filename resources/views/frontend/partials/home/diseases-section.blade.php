<div class="product-wrapper no-arrow mt-3 d-flex">
    @foreach ($diseases as $disease)
    <div style="width: 162px;">
        <a href="#" class="category-box category-dark">
            <div>
                <img src="{{ asset($disease->image ?? 'assets/images/default/disease.png') }}" class="lazyload" alt="{{ $disease->name }}">
                <h5 class="h5cat">{{ $disease->name }}</h5>
            </div>
        </a>
    </div>
    @endforeach
</div>
