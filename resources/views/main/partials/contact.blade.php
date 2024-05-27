<div id="kontak" class="container-fluid appointment py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2">
                <div class="section-title text-start">
                    <h4 class="sub-title pe-3 mb-0">Kontak Kami</h4>
                    <h3 class="mb-4">Silahkan hubungi kami melalui kanal berikut:</h3>
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4">
                                    <h5 class="mb-3"><i class="fa fa-check text-primary me-2"></i> Phone/WA</h5>
                                    <p class="mb-0">+62 8125040540</p>
                                </div>
                                <div class="mb-4">
                                    <h5 class="mb-3"><i class="fa fa-check text-primary me-2"></i> Email</h5>
                                    <p class="mb-0">rsud.tanbu@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="video h-100">
                                <img src="{{asset('img/logo.png')}}" class="img-fluid rounded w-100 h-100"
                                    style="object-fit: cover;" alt="logo tanbu">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.4s">
                <div class="appointment-form rounded p-5">
                    <h3 class="mb-4">Pertanyaan atau Pengaduan</h3>
                    <form id="contactForm" method="POST">
                        @csrf
                        <div class="row gy-3 gx-4">
                            <div class="col-xl-12">
                                <input type="text" name="name" id="name"
                                    class="form-control py-3 border-primary bg-transparent text-dark"
                                    placeholder="Nama lengkap" autocomplete="on">
                                    <div class="text-danger mt-2 d-none" role="alert" id="alert-name"></div>
                            </div>
                            <div class="col-xl-12">
                                <input type="email" name="email" id="email"
                                    class="form-control py-3 border-primary bg-transparent text-dark"
                                    placeholder="Email">
                                    <div class="text-danger mt-2 d-none" role="alert" id="alert-email"></div>
                            </div>
                            <div class="col-xl-12">
                                <input type="tel" name="phone" id="phone"
                                    class="form-control py-3 border-primary bg-transparent text-dark"
                                    placeholder="No hp/wa">
                                    <div class="text-danger mt-2 d-none" role="alert" id="alert-phone"></div>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-primary bg-transparent text-dark" name="message"
                                    id="message" cols="30" rows="5"
                                    placeholder="Pertanyaan/keluhan/pesan">{{ old('message') }}</textarea>
                                    <div class="text-danger mt-2 d-none" role="alert" id="alert-message"></div>
                            </div>
                            <div>
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
                                <span id="success-message"></span>
                            </div>
                            <div id="error-alert" class="alert alert-danger d-none">
                                <span id="error-message"></span>
                            </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" id="submitButton" class="btn btn-primary text-white w-100 py-3 px-5">KIRIM</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/contact.js') }}"></script>