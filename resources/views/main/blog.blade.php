    @extends('layouts.page-layout')
        <!-- Header Start -->
        @section('content')
        @fragment('blog')
        <div id="app" data-loading-class="fade">
            <div id="blog-page" class="container-fluid bg-breadcrumb show">
                <div class="container text-center py-5" style="max-width: 900px;">
                    <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">News and Articles</h1>
                    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item active text-primary">Blog</li>
                    </ol>    
                </div>
            </div>
            <!-- Header End -->

            <!-- Blog Start -->
            <div id="blog" class="container-fluid service py-5" data-loading-class="fade">
                <div class="container py-5">
                    <div class="row g-4 justify-content-center">
                        @forelse($posts as $post)
                            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="service-item rounded">
                                    @if($post->image)
                                    <div class="service-img rounded-top" style="max-height: 187px; overflow: hidden;">
                                        <img src="{{ asset('storage/posts/'. $post->image)}}" class="img-fluid rounded-top w-100" alt="">
                                    </div>
                                    @else
                                    <div class="service-img rounded-top" style="max-height: 187px; overflow: hidden;">
                                        <img src="{{ asset('storage/posts/putih.jpg')}}" class="img-fluid rounded-top w-100" alt="">
                                    </div>
                                    @endif
                                    <div class="service-content rounded-bottom bg-light p-4">
                                        <div class="service-content-inner">
                                            <h5 class="mb-4">{{$post->title}}</h5>
                                            <a href="{{url('blog/'.$post->slug)}}" class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Read More</a>
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
                <div class="container">
                    <div class="w-full">
                        {{ $posts->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.onbeforeunload = function () {
                window.scrollTo(0, 0);
            }
        </script>
        @endfragment
        @endsection
        <!-- Blog End -->
