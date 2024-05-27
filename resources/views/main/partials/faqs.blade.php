<div class="container-fluid testimonial py-5 wow zoomInDown" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title mb-5">
            <div class="sub-style">
                <h4 class="sub-title text-white px-3 mb-0">Frequenly Asked Questions</h4>
            </div>
            <h3 class="mb-4">What Clients are Say</h3>
        </div>
        <div class="testimonial-carousel owl-carousel">
            @foreach($faqs as $faq)
                <div class="testimonial-item">
                    <div class="testimonial-inner p-5">
                        <p class="text-white fs-7">{{$faq->question}}
                        </p>
                        <div class="text-center">
                            <h5 class="mb-2">{{$faq->answer}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
        <a href="/" class="btn btn-secondary rounded-pill text-white py-3 px-5">Browse More</a>
    </div>
</div>