<div class="container-fluid py-5 wow zoomInDown testimonial" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title mb-5">
            <div class="sub-style">
                <h4 class="sub-title text-white px-3 mb-0">Frequently Asked Questions</h4>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($faqs as $faq)
            <div class="accordion col-md-12 col-lg-6 col-xl-6" id="faqAccordion">   
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{$loop->index}}">
                        <button class="accordion-button bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->index}}" aria-expanded="true" aria-controls="collapse{{$loop->index}}">
                            <h5 class="text-white">{{$faq->question}}</h5>
                        </button>
                    </h2>
                    <div id="collapse{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="heading{{$loop->index}}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body bg-white text-dark">
                            {{$faq->answer}}
                        </div>
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
<style type="text/css">
    .accordion-button {
        border-radius:10px ;
    }
    .accordion-button:not(.collapsed) {
        color: white;
    }
    .accordion-body {
        border-radius: 10px;
    }

</style>