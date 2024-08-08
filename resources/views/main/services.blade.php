@extends('layouts.page-layout')
@section('content')
@fragment('services')
    <div id="app" data-loading-class="fade">
        <div id="blog-page" class="container-fluid bg-breadcrumb show">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Layanan Kami</h1>
                    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item active text-primary">Layanan</li>
                    </ol>
            </div>
        </div>
        <div id="layanan" class="container-fluid feature py-5">
            <div class="container py-5">
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
                </div>
            </div>
        </div>
    </div>
@endfragment
@endsection