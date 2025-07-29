@extends('layouts.standar-pelayanan-layout')

@section('content')
    @fragment('publication-detail')
        <div id="app" data-loading-class="fade">
            <!-- Breadcrumb -->
            <div id="breadcrumb-section" class="container-fluid bg-breadcrumb show">
                <div class="container text-center py-5" style="max-width: 900px;">
                    <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ $publication->nama_dokumen }}
                    </h3>
                    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('publikasi.index') }}">Publikasi</a></li>
                        <li class="breadcrumb-item active text-primary">{{ Str::limit($publication->nama_dokumen, 30, '...') }}
                        </li>
                    </ol>
                </div>
            </div>

            <!-- Konten utama -->
            <div class="container-fluid py-5">
                <div class="container py-5">
                    <div class="row gx-lg-5 gy-5">
                        <!-- Kolom Kiri: Detail Publikasi -->
                        <div class="col-lg-8">
                            <div class="bg-white shadow-sm border-0 rounded-lg overflow-hidden wow fadeInUp"
                                data-wow-delay="0.1s">
                                @if($publication->image)
                                    <img src="{{ asset('storage/' . $publication->image) }}" alt="{{ $publication->nama_dokumen }}"
                                        class="img-fluid detail-img">
                                @else
                                    <img src="{{ asset('img/publication-placeholder.jpg') }}" alt="Placeholder Publikasi"
                                        class="img-fluid detail-img">
                                @endif

                                <div class="card-body p-4 p-md-5">
                                    <h1 class="card-title text-dark mb-3">{{ $publication->nama_dokumen }}</h1>

                                    <div class="d-flex flex-wrap align-items-center text-muted mb-3">
                                        <div class="me-4 mb-2 mb-md-0 d-flex align-items-center">
                                            <i class="fas fa-building me-2 text-primary"></i>
                                            <small><strong>Produsen:</strong> {{ $publication->produsen_data }}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                            <small><strong>Tanggal Rilis:</strong>
                                                {{ \Carbon\Carbon::parse($publication->tanggal_rilis)->format('d F Y') }}</small>
                                        </div>
                                    </div>

                                    <hr class="mb-4">

                                    <h5 class="mb-3 text-secondary">Deskripsi</h5>
                                    <p class="card-text mb-5">{{ $publication->deskripsi }}</p>

                                    <div class="text-center">
                                        <a href="{{ asset($publication->file) }}"
                                            class="btn btn-primary btn-lg text-white rounded-pill px-5 py-3" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fas fa-download me-2"></i> Unduh Dokumen Lengkap
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Publikasi Lainnya -->
                        <div class="col-lg-4">
                            @if($others->count())
                                <h4 class="mb-4">Publikasi Lainnya</h4>
                                @foreach($others as $pub)
                                    <div class="card mb-3 border-0 shadow-sm rounded-lg overflow-hidden">
                                        @if($pub->image)
                                            <img src="{{ asset('storage/' . $pub->image) }}" alt="{{ $pub->nama_dokumen }}"
                                                class="card-img-top" style="object-fit: cover; height: 150px;">
                                        @endif
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-1">{{ $pub->nama_dokumen }}</h6>
                                            <p class="small text-muted mb-1">Rilis:
                                                {{ \Carbon\Carbon::parse($pub->tanggal_rilis)->format('d M Y') }}</p>
                                            <a href="{{ route('publications.show', $pub->slug) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endfragment
@endsection
@push('styles')
    <style>
        /* Untuk menggantikan .rounded-lg */
        .rounded-lg {
            border-radius: 0.75rem;
        }

        /* Untuk menggantikan .shadow-sm */
        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        /* Untuk card dan elemen lainnya agar tetap punya style soft */
        .card.shadow-sm {
            border: none;
        }

        /* Untuk .text-primary sebagai active breadcrumb */
        .breadcrumb-item.active.text-primary {
            color: #0d6efd;
        }

        /* Untuk placeholder image agar tidak terlalu datar */
        .detail-img {
            max-height: 400px;
            object-fit: cover;
            width: 100%;
        }

        /* WOW.js animation fallback jika tidak pakai WOW.js */
        .wow {
            opacity: 1;
            transform: none;
        }

        /* Optional: FadeIn animasi manual jika WOW.js tidak digunakan */
        .fadeInDown {
            animation: fadeInDown 0.6s ease both;
        }

        .fadeInUp {
            animation: fadeInUp 0.6s ease both;
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush