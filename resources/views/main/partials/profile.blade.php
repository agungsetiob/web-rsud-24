<div id="profil" class="container-fluid about bg-light py-5" data-loading-class="fade">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="about-img pb-5 ps-5">
                    <img src="{{url('storage/about.jpeg')}}" class="img-fluid rounded w-100" style="object-fit: cover;"
                        alt="Image">
                    <div class="about-img-inner">
                        <img src="{{url('storage/logors.png')}}" class="img-fluid rounded-circle w-75 h-75"
                            alt="logo-profil">
                    </div>
                </div>
            </div>
            <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.4s">
                <div class="section-title text-start mb-5">
                    <h4 class="sub-title pe-3 mb-0">About Us</h4>
                    <h3 class="mb-2">Sekilas tentang RSUD Rumah Sehat Amanah Husada</h3>
                    <p class="mb-2">Sejak berdirinya Kabupaten Tanah Bumbu pada tanggal 8 April 2003, RSUD Amanah Husada
                        ditetapkan sebagai RSUD Kabupaten Tanah Bumbu sesuai SK Bupati Tanah Bumbu Nomor 25 Tahun 2003
                        tentang Penunjukan RSUD dan SK Bupati Nomor 26 Tahun 2003 tentang Izin Operasional RSUD Amanah
                        Husada.</p>
                    <div class="mb-2">
                        <h6 class="mb-2">Visi</h6>
                        <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Terwujudnya Rumah Sakit
                            handal dan kebanggaan masyarakat Tanah Bumbu</p>
                        <h6 class="mb-2">Misi</h6>
                        <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Meningkatkan Pelayanan
                            Kesehatan Rujukan Yang Berkualitas</p>
                    </div>
                    <a class="btn btn-primary rounded-pill text-white py-3 px-5" hx-get="{{url('profil')}}"
                        hx-trigger="click" hx-target="#app" hx-swap="outerHTML transition:true" hx-push-url="true"
                        hx-indicator="#loadingIndicator">Discover More</a>
                </div>
            </div>
        </div>
    </div>
</div>