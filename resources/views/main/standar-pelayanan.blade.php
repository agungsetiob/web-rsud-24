@extends('layouts.standar-pelayanan-layout')

@section('content')
    @fragment('standar')
        <div id="app" data-loading-class="fade">
            {{-- Breadcrumb Section --}}
            <div id="blog-page" class="container-fluid bg-breadcrumb show">
                <div class="container text-center py-5" style="max-width: 900px;">
                    <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Standar Pelayanan</h3>
                    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item active text-primary">Standar Pelayanan</li>
                    </ol>
                </div>
            </div>

            {{-- Service Standards Section --}}
            <div class="container-fluid py-2">
                <div class="container py-2">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 700px;">
                        <h2 class="mb-4">Daftar Standar Pelayanan Kami</h2>
                        <p class="mb-0">Temukan informasi lengkap mengenai standar pelayanan dari berbagai instalasi dan unit
                            kami. Klik "Lihat Detail" untuk mengunduh dokumen standar pelayanan.</p>
                    </div>

                    <div class="row g-4 justify-content-center">
                        @forelse($standards as $index => $st)
                            <div class="col-lg-6 col-md-10 wow fadeInUp" data-wow-delay="{{ 0.1 * ($index % 2 + 1) }}s">
                                <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0 me-3">
                                                <span class="fs-4 text-primary fw-bold">{{ $index + 1 }}.</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="card-title text-dark mb-1">{{ $st->name }}</h5>
                                                <p class="card-text text-muted mb-0">{{ $st->service_name }}</p>
                                            </div>
                                        </div>
                                        <div class="text-end mt-3">
                                            <a href="{{ Storage::url('sp/' . $st->file) }}"
                                                class="btn btn-primary btn-sm text-white rounded-pill px-3" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fas fa-eye me-1"></i> Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="lead text-muted">Belum ada standar pelayanan yang tersedia saat ini.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    <div class="container">
                        <div class="w-full mt-3">
                            {{ $standards->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endfragment
@endsection

@push('styles')
    <style>
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush