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
                                <img src="{{url('storage/doctor/' . $doc->photo)}}" class="img-fluid rounded-top w-100" alt="">
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
                        <a class="btn btn-primary rounded-pill text-white py-3 px-2 w-100" href="#">Lihat Dokter Spesialis</a>
                    </div>
                    <div class="col-md-6 col-sm-12 mx-2">
                        <a class="btn btn-primary rounded-pill text-white py-3 px-2 w-100" href="#">Lihat Dokter Umum</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>