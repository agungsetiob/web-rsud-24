<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.title') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="rsud tanah bumbu" name="keywords">
    <meta content="rumah sakit umum daerah dr h andi abdurrahman noor tanah bumbu" name="description">
    <meta property="og:image" content="{{asset('img/logo.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon" />
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('vendor/tanbu/tanbu.min.js')}}"></script>
    <script src="{{asset('vendor/tanbu/loading-states.js')}}"></script>
</head>

<body id="home" hx-ext="loading-states">

    <!-- Topbar Start -->
    <div id="beranda" class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0 align-items-center" style="height: 45px;">
            <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                <div class="d-flex flex-wrap">
                    <a href="https://maps.app.goo.gl/Q1FrsSHqmTuKRU776" class="text-light me-4" target="_blank"><i
                            class="fas fa-map-marker-alt text-primary me-2"></i>Find Us</a>
                    <a href="#" class="text-light me-4"><i
                            class="fas fa-phone-alt text-primary me-2"></i>+628115040540</a>
                    <a href="#" class="text-light me-4"><i
                            class="fas fa-envelope text-primary me-2"></i>rsud.tanbu@gmail.com</a>
                    <a href="https://lapor.go.id" class="text-light me-0" target="_blank"><img class="me-2"
                            src="{{asset('img/lapor-color.png')}}" alt="Lapor" style="height:21px;"></a>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-flex align-items-center justify-content-end">
                    <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/rsud_tanah_bumbu/"
                        class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
            <a href="/" class="navbar-brand p-0">
                <!-- <h1 class="text-primary m-0"><i class="fas fa-star-of-life me-3"></i>Terapia</h1> -->
                <img src="{{url('storage/logors.png')}}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                title="navbar toggle">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="#" class="nav-item nav-link" hx-get="{{url('/home')}}" hx-trigger="click" hx-target="#app"
                        hx-swap="outerHTML transition:true" hx-push-url="true"
                        hx-indicator="#loadingIndicator">Beranda</a>
                    <a href="" class="nav-item nav-link" hx-get="{{url('/blog')}}" hx-trigger="click" hx-target="#app"
                        hx-swap="outerHTML transition:true" hx-push-url="true" hx-indicator="#loadingIndicator">Blog</a>
                    <a href="#" class="nav-item nav-link" hx-get="{{url('/profil')}}" hx-trigger="click"
                        hx-target="#app" hx-swap="outerHTML transition:true" hx-push-url="true"
                        hx-indicator="#loadingIndicator">Profil</a>
                    <a href="#" class="nav-item nav-link" hx-get="{{url('/layanan')}}" hx-trigger="click"
                        hx-target="#app" hx-swap="outerHTML transition:true" hx-push-url="true"
                        hx-indicator="#loadingIndicator">Layanan</a>
                    <a href="#" class="nav-item nav-link" hx-get="{{url('/dokter')}}" hx-trigger="click"
                        hx-target="#app" hx-swap="outerHTML transition:true" hx-push-url="true"
                        hx-indicator="#loadingIndicator">Dokter</a>
                    <a href="#" class="nav-item nav-link" hx-get="{{url('/faq')}}" hx-trigger="click" hx-target="#app"
                        hx-swap="outerHTML transition:true" hx-push-url="true" hx-indicator="#loadingIndicator">Faq</a>
                    <a id="kontak" href="" class="nav-item nav-link" hx-get="{{url('/kontak')}}" hx-trigger="click"
                        hx-target="#app" hx-swap="outerHTML transition:true" hx-push-url="true"
                        hx-indicator="#loadingIndicator">Kontak</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{url('quran')}}" class="dropdown-item">Al-Qur'an Digital</a>
                            <a href="" class="dropdown-item" hx-get="{{url('/standar-pelayanan')}}"
                                hx-trigger="click" hx-target="#app" hx-swap="outerHTML transition:true"
                                hx-push-url="true" hx-indicator="#loadingIndicator">Standar Pelayanan</a>
                            <a href="" class="dropdown-item" hx-get="{{url('/publikasi')}}" hx-trigger="click"
                                hx-target="#app" hx-swap="outerHTML transition:true" hx-push-url="true"
                                hx-indicator="#loadingIndicator">Publikasi</a>
                            <a href="#" class="dropdown-item">Survey</a>
                            <a href="#" class="dropdown-item" hx-get="{{url('/document')}}"
                                hx-trigger="click" hx-target="#app" hx-swap="outerHTML transition:true"
                                hx-push-url="true" hx-indicator="#loadingIndicator">Dokumen Publik</a>
                            <a href="#" class="dropdown-item">Top Author</a>
                        </div>
                    </div>
                </div>
                <a href="/login"
                    class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">Login</a>
            </div>
        </nav>
    </div>

    @yield('content')
    @include('main.partials.hx-indicator')
    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center justify-content-center">
                <div class="col-md-6 text-center mb-md-0">
                    <span class="text-white"><a href="#"><i class="fas fa-copyright text-light me-2"></i>IT</a> RSUD dr.
                        H. Andi Abdurrahman Noor</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>