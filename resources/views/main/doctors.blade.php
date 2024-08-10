@extends('layouts.page-layout')
@section('content')
@fragment('doctor')
    <div id="app" data-loading-class="fade">
        <div id="blog-page" class="container-fluid bg-breadcrumb show">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Dokter Kami</h1>
                    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item active text-primary">Dokter</li>
                    </ol>
            </div>
        </div>
        <div class="container-fluid team py-5">
            <div class="container py-5">
                <div class="row g-4 justify-content-center">
                    @foreach($doctors as $doc)
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item rounded">
                                <div class="team-img rounded-top h-100 border border-primary border-bottom-0">
                                    @if($doc->photo)
                                        <img src="{{url('storage/doctor/' . $doc->photo)}}" class="img-fluid rounded-top w-100"
                                            alt="">
                                    @else
                                        <img src="{{url('storage/logors.png')}}" class="img-fluid rounded-top w-100" alt="">
                                    @endif
                                    <div class="team-icon d-flex justify-content-center">
                                        <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href=""><i
                                                class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href=""><i
                                                class="fab fa-twitter"></i></a>
                                        <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href=""><i
                                                class="fab fa-instagram"></i></a>
                                        <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href=""><i
                                                class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                                <div class="team-content text-center border border-primary border-top-0 rounded-bottom p-4">
                                    <h5>{{$doc->name}}</h5>
                                    <p class="mb-0">Dokter {{$doc->specialization}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                        <div class="d-flex flex-column flex-md-row justify-content-center">
                            <div class="col-md-6 col-sm-12 mx-2 mb-2 mb-md-0">
                                <a class="btn btn-primary rounded-pill text-white py-3 px-2 w-100" href="#"
                                    hx-get="{{url('/spesialis')}}" hx-trigger="click" hx-target="#app"
                                    hx-swap="outerHTML transition:true" hx-push-url="true"
                                    hx-indicator="#loadingIndicator">Lihat Dokter Spesialis</a>
                            </div>
                            <div class="col-md-6 col-sm-12 mx-2">
                                <a class="btn btn-primary rounded-pill text-white py-3 px-2 w-100" href="#"
                                    hx-get="{{url('/dokter-umum')}}" hx-trigger="click" hx-target="#app"
                                    hx-swap="outerHTML transition:true" hx-push-url="true"
                                    hx-indicator="#loadingIndicator">Lihat Dokter Umum</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endfragment
@endsection