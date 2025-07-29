@extends('layouts.standar-pelayanan-layout')

@section('content')
    @fragment('publikasi')
        <div id="app" data-loading-class="fade">
            {{-- Breadcrumb Section --}}
            <div id="blog-page" class="container-fluid bg-breadcrumb show">
                <div class="container text-center py-5" style="max-width: 900px;">
                    <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Publikasi</h3>
                    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item active text-primary">Publikasi</li>
                    </ol>
                </div>
            </div>

            {{-- Publications Section --}}
            <div class="container-fluid py-3">
                <div class="container py-3">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 700px;">
                        <h2 class="mb-4">Daftar Publikasi RSUD</h2>
                        <p class="mb-0 text-muted">Telusuri berbagai data dan dokumen resmi yang dirilis oleh unit dan instalasi RSUD kami. Publikasi ini mencakup informasi penting dan laporan terbaru.</p>
                    </div>

                    <div class="row g-4 justify-content-center">
                        @forelse($publications as $index => $pub)
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.1 * ($index % 3 + 1) }}s">
                                <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden">
                                    @if($pub->image)
                                        <img src="{{ asset('storage/' . $pub->image) }}" alt="{{ $pub->nama_dokumen }}" class="card-img-top img-fluid" style="object-fit: cover; height: 200px;">
                                    @else
                                        <img src="{{ asset('img/publication-placeholder.jpg') }}" alt="Placeholder Publikasi" class="card-img-top img-fluid" style="object-fit: cover; height: 200px;">
                                    @endif

                                    <div class="card-body p-4 d-flex flex-column">
                                        <h5 class="card-title text-primary mb-2">{{ $pub->nama_dokumen }}</h5>
                                        <div class="d-flex align-items-center text-muted mb-3">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            <small>{{ \Carbon\Carbon::parse($pub->created_at)->format('d F Y') }}</small>
                                        </div>

                                        <p class="card-text text-secondary flex-grow-1 mb-4">{{ Str::limit($pub->deskripsi, 120, '...') }}</p>

                                        <div class="mt-auto text-end">
                                            <a href="{{ route('publications.show', $pub->slug) }}" class="btn btn-primary btn-sm text-white rounded-pill px-4">
                                                <i class="fas fa-arrow-right me-2"></i> Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="lead text-muted">Belum ada publikasi yang tersedia saat ini.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    <div class="container">
                        <div class="w-full mt-3">
                            {{ $publications->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endfragment
@endsection
