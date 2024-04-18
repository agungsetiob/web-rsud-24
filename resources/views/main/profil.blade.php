@extends('layouts.page-layout')
        @section('content')
            @fragment('profil')
            <div id="app" data-loading-class="fade">
                <div id="profile-page" class="container-fluid bg-breadcrumb to-top">
                    <div class="container text-center py-5" style="max-width: 900px;">
                        <h3 class="text-white display-5 mb-4 wow fadeInDown" data-wow-delay="0.1s">RSUD Rumah Sehat Amanah Husada</h1>
                        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item active text-primary">Profil</li>
                        </ol>    
                    </div>
                </div>
                <div id="profil" class="container-fluid about bg-light py-5">
                    <div class="container py-5">
                        @foreach ($profiles as $p)
                            <div class="row g-5">
                                {{--<div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.2s">
                                    <div class="about-img pb-5 ps-5">
                                        <img src="{{url('storage/posts/'.$p->image)}}" class="img-fluid rounded w-100" style="object-fit: cover;" alt="Image">
                                        <div class="about-img-inner">
                                            <img src="{{asset('img/about.png')}}" class="img-fluid rounded-circle w-75 h-75" alt="logo-profil">
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="col-lg-12 wow fadeInRight" data-wow-delay="0.4s">
                                    <div class="section-title text-start mb-5">
                                        <h4 class="sub-title pe-3 mb-0 pb-3 text-center">Profil</h4>
                                        <img src="{{url('storage/posts/'.$p->image)}}" class="img-fluid w-100 pb-3" style="object-fit: cover;" alt="sotk rsud">
                                        <h3 class="mb-2">{{$p->heading}}</h3>
                                        <p class="mb-2">{!!$p->about!!}</p>
                                        <div class="mb-2">
                                            <h6 class="mb-2">Visi</h6>
                                            <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Terwujudnya Rumah Sakit handal dan kebanggaan masyarakat Tanah Bumbu</p>
                                            <h6 class="mb-2">Misi</h6>
                                            <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Meningkatkan Pelayanan Kesehatan Rujukan Yang Berkualitas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <script>
                    window.onbeforeunload = function () {
                        window.scrollTo(0, 0);
                    }
                </script>
            </div>
            @endfragment
        @endsection