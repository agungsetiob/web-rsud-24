    @extends('layouts.main-layout')
        @section('content')
        <!-- Carousel Start -->
        <div id="top-page">
            <div class="header-carousel owl-carousel">
                <div class="header-carousel-item">
                    <img src="{{asset('img/carousel-1.jpg')}}" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                            <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">RSUD Rumah Sehat Amanah Husada</h5>
                            <h1 class="display-1 text-capitalize text-white mb-4">Senyum Santun Sapa</h1>
                        </div>
                    </div>
                </div>
                <div class="header-carousel-item">
                    <img src="{{asset('img/carousel-2.jpg')}}" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                            <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">RSUD Rumah Sehat Amanah Husada</h5>
                            <h1 class="display-1 text-capitalize text-white mb-4">Senyum Santun Sapa</h1>
                        </div>
                    </div>
                </div>
                <div class="header-carousel-item">
                    <img src="{{asset('img/carousel-3.png')}}" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                            <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">RSUD Rumah Sehat Amanah Husada</h5>
                            <h1 class="display-1 text-capitalize text-white mb-4">Senyum Santun Sapa</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel End -->

            <!-- Blog Start -->
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
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                            <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="#"
                            hx-get="{{url('blog/')}}" 
                            hx-trigger="click" 
                            hx-target="#top-page" 
                            hx-swap="outerHTML transition:true"
                            hx-push-url="true"
                            data-loading-class="d-none">Browse More</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blog End -->

            <!-- Profile Start -->
            <div id="profil" class="container-fluid about bg-light py-5" data-loading-class="fade">
                <div class="container py-5">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.2s">
                            <div class="about-img pb-5 ps-5">
                                <img src="{{url('storage/about.jpeg')}}" class="img-fluid rounded w-100" style="object-fit: cover;" alt="Image">
                                <div class="about-img-inner">
                                    <img src="{{asset('img/about.png')}}" class="img-fluid rounded-circle w-75 h-75" alt="logo-profil">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.4s">
                            <div class="section-title text-start mb-5">
                                <h4 class="sub-title pe-3 mb-0">About Us</h4>
                                <h3 class="mb-2">Sekilas tentang RSUD Rumah Sehat Amanah Husada</h3>
                                <p class="mb-2">Sejak berdirinya Kabupaten Tanah Bumbu pada tanggal 8 April 2003, RSUD Amanah Husada ditetapkan sebagai RSUD Kabupaten Tanah Bumbu sesuai SK Bupati Tanah Bumbu Nomor 25 Tahun 2003 tentang Penunjukan RSUD dan SK Bupati Nomor 26 Tahun 2003 tentang Izin Operasional RSUD Amanah Husada.</p>
                                <div class="mb-2">
                                    <h6 class="mb-2">Visi</h6>
                                    <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Terwujudnya Rumah Sakit handal dan kebanggaan masyarakat Tanah Bumbu</p>
                                    <h6 class="mb-2">Misi</h6>
                                    <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Meningkatkan Pelayanan Kesehatan Rujukan Yang Berkualitas</p>
                                </div>
                                <a href="#" class="btn btn-primary rounded-pill text-white py-3 px-5"
                                hx-get="{{url('profil')}}" 
                                hx-trigger="click" 
                                hx-target="#top-page" 
                                hx-swap="outerHTML transition:true"
                                hx-push-url="true">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile End -->

            <!-- Layanan Start -->
            <div id="layanan" class="container-fluid feature py-5">
                <div class="container py-5">
                    <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="sub-style">
                            <h4 class="sub-title px-3 mb-0">Layanan</h4>
                        </div>
                        <h3 class="mb-4">Poliklinik dan Layanan Kami</h3>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="row-cols-1 feature-item p-4">
                                <div class="col-12">
                                    <div class="feature-icon mb-4">
                                        <div class="p-3 d-inline-flex bg-white rounded">
                                            <i class="fas fa-diagnoses fa-4x text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="feature-content d-flex flex-column">
                                        <h5 class="mb-4">Lab Patologi Klinis</h5>
                                        <p class="mb-0">Dolor, sit amet consectetur adipisicing elit. Soluta inventore cum accusamus,</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                            <a href="#" class="btn btn-primary rounded-pill text-white py-3 px-5">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Feature End -->


            <!-- Book Appointment Start -->
            <div class="container-fluid appointment py-5">
                <div class="container py-5">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2">
                            <div class="section-title text-start">
                                <h4 class="sub-title pe-3 mb-0">Solutions To Your Pain</h4>
                                <h3 class="mb-4">Best Quality Services With Minimal Pain Rate</h3>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat deleniti amet at atque sequi quibusdam cumque itaque repudiandae temporibus, eius nam mollitia voluptas maxime veniam necessitatibus saepe in ab? Repellat!</p>
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100">
                                            <div class="mb-4">
                                                <h5 class="mb-3"><i class="fa fa-check text-primary me-2"></i> Body Relaxation</h5>
                                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et deserunt qui cupiditate veritatis enim ducimus.</p>
                                            </div>
                                            <div class="mb-4">
                                                <h5 class="mb-3"><i class="fa fa-check text-primary me-2"></i> Body Relaxation</h5>
                                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et deserunt qui cupiditate veritatis enim ducimus.</p>
                                            </div>
                                            <div class="text-start mb-4">
                                                <a href="#" class="btn btn-primary rounded-pill text-white py-3 px-5">More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="video h-100">
                                            <img src="{{asset('img/logo.png')}}" class="img-fluid rounded w-100 h-100" style="object-fit: cover;" alt="">
                                            <button type="button" class="btn btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                                                <span></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.4s">
                            <div class="appointment-form rounded p-5">
                                <p class="fs-4 text-uppercase text-primary">Get In Touch</p>
                                <h3 class="mb-4">Get Appointment</h3>
                                <form>
                                    <div class="row gy-3 gx-4">
                                        <div class="col-xl-6">
                                            <input type="text" class="form-control py-3 border-primary bg-transparent text-white" placeholder="First Name">
                                        </div>
                                        <div class="col-xl-6">
                                            <input type="email" class="form-control py-3 border-primary bg-transparent text-white" placeholder="Email">
                                        </div>
                                        <div class="col-xl-6">
                                            <input type="phone" class="form-control py-3 border-primary bg-transparent" placeholder="Phone">
                                        </div>
                                        <div class="col-xl-6">
                                            <select class="form-select py-3 border-primary bg-transparent" aria-label="Default select example">
                                                <option selected>Your Gender</option>
                                                <option value="1">Male</option>
                                                <option value="2">FeMale</option>
                                                <option value="3">Others</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6">
                                            <input type="date" class="form-control py-3 border-primary bg-transparent">
                                        </div>
                                        <div class="col-xl-6">
                                            <select class="form-select py-3 border-primary bg-transparent" aria-label="Default select example">
                                                <option selected>Department</option>
                                                <option value="1">Physiotherapy</option>
                                                <option value="2">Physical Helth</option>
                                                <option value="2">Treatments</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <textarea class="form-control border-primary bg-transparent text-white" name="text" id="area-text" cols="30" rows="5" placeholder="Write Comments"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary text-white w-100 py-3 px-5">SUBMIT NOW</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Video -->
            <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- 16:9 aspect ratio -->
                            <div class="ratio ratio-16x9">
                                <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                    allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Book Appointment End -->


            <!-- Our Doctor -->
            <div class="container-fluid team py-5">
                <div class="container py-5">
                    <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="sub-style">
                            <h4 class="sub-title px-3 mb-0">Our Medical Doctors</h4>
                        </div>
                        <h3 class="mb-4">Health Services from Professional </h3>
                    </div>
                    <div class="row g-4 justify-content-center">
                        @foreach($doctors as $doc)
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item rounded">
                                <div class="team-img rounded-top h-100 border border-primary border-bottom-0">
                                    @if($doc->photo)
                                    <img src="{{url('storage/doctor/'. $doc->photo)}}" class="img-fluid rounded-top w-100" alt="">
                                    @else
                                    <img src="{{url('storage/logors.png')}}" class="img-fluid rounded-top w-100" alt="">
                                    @endif
                                    <div class="team-icon d-flex justify-content-center">
                                        <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                        <a class="btn btn-square btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                                <div class="team-content text-center border border-primary border-top-0 rounded-bottom p-4">
                                    <h5>{{$doc->name}}</h5>
                                    <p class="mb-0">Dokter {{$doc->specialization}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                    <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="#">Browse More</a>
                </div>
            </div>
            <!-- Team End -->


            <!-- Testimonial Start -->
            <div class="container-fluid testimonial py-5 wow zoomInDown" data-wow-delay="0.1s">
                <div class="container py-5">
                    <div class="section-title mb-5">
                        <div class="sub-style">
                            <h4 class="sub-title text-white px-3 mb-0">Frequenly Asked Questions</h4>
                        </div>
                        <h3 class="mb-4">What Clients are Say</h3>
                    </div>
                    <div class="testimonial-carousel owl-carousel">
                        @foreach($faqs as $f)
                        <div class="testimonial-item">
                            <div class="testimonial-inner p-5">
                                <p class="text-white fs-7">{{$f->question}}
                                </p>
                                <div class="text-center">
                                    <h5 class="mb-2">{{$f->answer}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                    <a class="btn btn-secondary rounded-pill text-white py-3 px-5" href="#">Browse More</a>
                </div>
            </div>
            <!-- Testimonial End -->
        </div>
        @endsection