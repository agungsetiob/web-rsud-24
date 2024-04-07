<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>{{$title}}</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
        <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon"/>
        <script src="{{asset('vendor/tanbu/tanbu.min.js')}}"></script>
        <script src="{{asset('vendor/tanbu/loading-states.js')}}"></script>
    </head>

    <body hx-ext="loading-states">

        <!-- Topbar Start -->
        <div id="beranda" class="container-fluid bg-dark px-5 d-none d-lg-block">
            <div class="row gx-0 align-items-center" style="height: 45px;">
                <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <a href="https://maps.app.goo.gl/Q1FrsSHqmTuKRU776" class="text-light me-4" target="_blank"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find Us</a>
                        <a href="#" class="text-light me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+628115040540</a>
                        <a href="#" class="text-light me-0"><i class="fas fa-envelope text-primary me-2"></i>rsud.tanbu@gmail.com</a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/rsud_tanah_bumbu/" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-instagram"></i></a>
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="{{url ('/#beranda')}}" class="nav-item nav-link">Beranda</a>
                        <a href="{{url ('/#blog')}}" class="nav-item nav-link">Blog</a>
                        <a href="{{url ('/#profil')}}" class="nav-item nav-link">Profil</a>
                        <a href="{{url ('/#layanan')}}" class="nav-item nav-link">Layanan</a>
                        <a href="{{url ('/#kontak')}}" class="nav-item nav-link">Kontak</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="appointment.html" class="dropdown-item">Appointment</a>
                                <a href="feature.html" class="dropdown-item">Features</a>
                                <a href="blog.html" class="dropdown-item">Our Blog</a>
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">Login</a>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->

        @yield('content')

        {{-- <div data-loading-class="loading-overlay"></div>--}}
        <div data-loading-class-remove="d-none" class="d-none d-flex align-items-center justify-content-center" style="position: fixed; top: 30%; left: 50%; transform: translate(-50%, -50%); z-index: 100001;">
            <i class="fas fa-circle-notch fa-spin fa-4x text-primary"></i>
        </div>
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row g-4 align-items-center justify-content-center">
                    <div class="col-md-6 text-center mb-md-0">
                        <span class="text-white"><a href="#"><i class="fas fa-copyright text-light me-2"></i>IT PDE</a> RSUD RS Amanah Husada</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('lib/wow/wow.min.js')}}"></script>
        <script src="{{asset('lib/easing/easing.min.js')}}"></script>
        <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
        <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    
        <!-- Template Javascript -->
        <script src="{{ asset('js/main.js') }}"></script>
        
    </body>

</html>