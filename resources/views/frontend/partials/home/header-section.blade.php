<section class="home-section pt-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="slick-slider">
                    <div>
                        <img src="{{ asset('assets/images/banners/1.jpg') }}" class="img-fluid" alt="Banner Image 1">
                    </div>
                    <div>
                        <img src="{{ asset('assets/images/banners/1.jpg') }}" class="img-fluid" alt="Banner Image 2">
                    </div>
                    <div>
                        <img src="{{ asset('assets/images/banners/1.jpg') }}" class="img-fluid" alt="Banner Image 3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(function(){
        $('.home-section .slick-slider').slick({
            arrows: false,
            infinite: true,
            dots: true,
            autoplay: true,
            autoplaySpeed: 2500
        });
    });
</script>
@endpush
