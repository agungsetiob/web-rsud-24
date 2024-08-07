<div id="layanan" class="container-fluid feature py-5">
    <div class="container py-5">
        <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="sub-style">
                <h4 class="sub-title px-3 mb-0">Layanan</h4>
            </div>
            <h3 class="mb-4">Poliklinik dan Layanan Kami</h3>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse ($services as $service)
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row-cols-1 feature-item p-4">
                        <div class="col-12">
                            <div class="feature-icon mb-4">
                                <div class="p-3 d-inline-flex bg-white rounded">
                                    <i class="fas {{$service->icon}} fa-4x text-primary"></i>
                                </div>
                            </div>
                            <div class="feature-content d-flex flex-column">
                                <h5 class="mb-4">{{$service->name}}</h5>
                                <p class="mb-0">{{$service->desc}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="alert alert-danger">Data is not available.</div>
                </div>
            @endforelse
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                <a hx-get="{{url('/layanan')}}" hx-trigger="click" hx-target="#app" hx-swap="outerHTML transition:true"
                    hx-push-url="true" hx-indicator="#loadingIndicator"
                    class="btn btn-primary rounded-pill text-white py-3 px-5">Browse More</a>
            </div>
        </div>
    </div>
</div>