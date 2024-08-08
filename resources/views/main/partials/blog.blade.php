<div id="blog" class="container-fluid service py-5" data-loading-class="fade">
    <div class="container py-5">
        <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.2s">
            <div class="sub-style">
                <h4 class="sub-title px-3 mb-0">News and Articles</h4>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($posts as $post)
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded">
                        @if($post->image)
                            <div class="service-img rounded-top" style="max-height: 187px; overflow: hidden;">
                                <img src="{{ asset('storage/posts/' . $post->image)}}" class="img-fluid rounded-top w-100"
                                    alt="">
                            </div>
                        @else
                            <div class="service-img rounded-top" style="max-height: 187px; overflow: hidden;">
                                <img src="{{ asset('storage/posts/putih.jpg')}}" class="img-fluid rounded-top w-100" alt="">
                            </div>
                        @endif
                        <div class="service-content rounded-bottom bg-light p-4">
                            <div class="service-content-inner">
                                <h5 class="mb-4">{{$post->title}}</h5>
                                <a href="{{url('blog/' . $post->slug)}}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger text-center">
                    No data available.
                </div>
            @endforelse
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s" data-loading-class="d-none">
                <a class="btn btn-primary rounded-pill text-white py-3 px-5" hx-get="{{url('/blog')}}"
                    hx-trigger="click" hx-target="#app" hx-swap="outerHTML transition:true" hx-push-url="true"
                    hx-indicator="#loadingIndicator">Browse More</a>
            </div>
        </div>
    </div>
</div>