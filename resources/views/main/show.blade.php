@extends('layouts.show-layout')
@section('content')
    <div id="app" data-loading-class="fade">
        <div id="show-page" class="container-fluid bg-breadcrumb show">
            <div class="container text-center py-5">
                <h1 class="text-white mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ $post->title }}</h1>
            </div>
        </div>
        <!-- Header End -->

        <!-- Blog Start -->
        <div id="blog" class="container-fluid service" data-loading-class="fade">
            <div class="container py-3">
                <div class="row g-4">
                    <!-- Article Section -->
                    <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="rounded p-3">
                            <div class="service-content-inner">
                                @if($post->image)
                                    <div class="mb-4">
                                        <img src="{{ asset('storage/posts/' . $ogImage)}}" class="img-fluid w-100"
                                            alt="{{ $title }}">
                                    </div>
                                @else
                                    <div class="mb-4" style="max-height: 300px; overflow: hidden;">
                                        <img src="{{ asset('storage/posts/putih.jpg')}}" class="img-fluid w-100"
                                            alt="{{ $title }}">
                                    </div>
                                @endif
                                <p>{!! $post->content !!}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Popular Articles Section -->
                    <div class="col-md-12 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="container py-3">
                            <div class="row g-4 justify-content-center">
                                <h4 class="mb-2">Related Articles</h4>
                                @forelse($relatedPosts as $post)
                                    <div class="wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="service-item rounded">
                                            @if($post->image)
                                                <div class="service-img rounded-top" style="max-height: 187px; overflow: hidden;">
                                                    <img src="{{ asset('storage/posts/' . $post->image) }}"
                                                        class="img-fluid rounded-top w-100" alt="">
                                                </div>
                                            @else
                                                <div class="service-img rounded-top" style="max-height: 187px; overflow: hidden;">
                                                    <img src="{{ asset('storage/posts/putih.jpg') }}"
                                                        class="img-fluid rounded-top w-100" alt="">
                                                </div>
                                            @endif
                                            <div class="service-content rounded-bottom bg-light p-4">
                                                <div class="service-content-inner">
                                                    <h5 class="mb-4">{{ $post->title }}</h5>
                                                    <a href="{{ url('blog/' . $post->slug) }}"
                                                        class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-danger">
                                        Data is not available.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid service" data-loading-class="fade">
            <div class="container py-3">
                <div class="row g-4 justify-content-center">
                    <h4 class="mb-2">Popular Articles</h4>
                    @forelse($popularPosts as $post)
                        <div class="col-md-12 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item rounded">
                                @if($post->image)
                                    <div class="service-img rounded-top" style="max-height: 187px; overflow: hidden;">
                                        <img src="{{ asset('storage/posts/' . $post->image) }}" class="img-fluid rounded-top w-100"
                                            alt="">
                                    </div>
                                @else
                                    <div class="service-img rounded-top" style="max-height: 187px; overflow: hidden;">
                                        <img src="{{ asset('storage/posts/putih.jpg') }}" class="img-fluid rounded-top w-100"
                                            alt="">
                                    </div>
                                @endif
                                <div class="service-content rounded-bottom bg-light p-4">
                                    <div class="service-content-inner">
                                        <h5 class="mb-4">{{ $post->title }}</h5>
                                        <a href="{{ url('blog/' . $post->slug) }}"
                                            class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger">
                            Data is not available.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onbeforeunload = function () {
            window.scrollTo(0, 0);
        }
    </script>
@endsection