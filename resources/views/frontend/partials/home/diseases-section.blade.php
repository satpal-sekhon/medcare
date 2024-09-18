<div class="px-2">
<div class="product-wrapper no-arrow mt-3 overflow-hidden diseases-section">
    @foreach ($diseases as $disease)
    <div style="width: 162px;">
        <a href="{{ route('diseases.view', $disease->slug) }}" class="category-box category-dark">
            <div>
                <img src="{{ asset($disease->image ?? 'assets/images/default/disease.png') }}" class="lazyload"
                    alt="{{ $disease->name }}">
                <h5 class="h5cat">{{ $disease->name }}</h5>
            </div>
        </a>
    </div>
    @endforeach
</div>
</div>


@push('scripts')
<script>
  $(document).ready(function(){
    function initializeSlick() {
      if ($(window).width() <= 767) {
        if (!$('.diseases-section').hasClass('slick-initialized')) {
          $('.diseases-section').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            infinite: true,
            arrows: true, // Show navigation arrows
            dots: true, // Show pagination dots
            adaptiveHeight: true, // Adjust height to the current slide
            variableWidth: true, // Allow slides to have different widths
            autoplay: true,
            autoplaySpeed: 2500
          });
        }
      } else {
        if ($('.diseases-section').hasClass('slick-initialized')) {
          $('.diseases-section').slick('unslick'); // Destroy the slider on larger screens
        }
      }
    }

    initializeSlick(); // Initialize on document ready

    // Reinitialize Slick on window resize with debounce
    let resizeTimer;
    $(window).resize(function() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(initializeSlick, 200);
    });
  });
</script>
@endpush