<div class="header-carousel owl-carousel">
    @foreach($carousels as $carousel)
        <div class="header-carousel-item">
            <img src="{{ asset('storage/'.$carousel->image) }}" class="img-fluid w-100" alt="Image">
            <div class="carousel-caption">
                <div class="carousel-caption-content p-3">
                    <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">
                        {{ $carousel->title }}
                    </h5>
                    <h3 class="display-3 text-capitalize text-white mb-4">
                        {{ $carousel->subtitle }}
                    </h3>
                </div>
            </div>
        </div>
    @endforeach
</div>
