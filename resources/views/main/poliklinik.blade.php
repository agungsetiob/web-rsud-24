@extends('layouts.page-layout')
@section('content')
    @fragment('poliklinik')
        <div id="app" data-loading-class="fade">
            <div class="container-fluid schedule-hero py-5">
                <div class="container text-center pt-5">
                    <div class="badge-custom-yellow mt-5">JADWAL POLIKLINIK</div>
                    <h2 class="text-white display-5 fw-bold mb-2">RSUD Dr. H. Andi Abdurrahman Noor</h2>
                    <h4 class="text-white">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</h4>
                </div>
            </div>

            <div class="container-fluid py-4 bg-soft-blue">
                <div class="container-fluid px-4">
                    @if($today === 'Minggu')
                        <div class="alert alert-warning border-0 shadow-sm text-center mb-5 rounded-pill">
                            <i class="fas fa-info-circle me-2"></i> Semua poliklinik tutup pada hari Minggu.
                        </div>
                    @endif

                    <div class="row g-4 justify-content-center">
                        @forelse ($services as $service)
                            @php
                                $isOpen = ($service->doctor && $today !== 'Minggu');
                            @endphp
                            <div class="col-md-6 col-lg-3">
                                <div class="doctor-card h-100 {{ $isOpen ? 'active' : 'closed' }}">
                                    <div class="card-header-accent"></div>
                                    <div class="card-body p-4 text-center">
                                        <h5 class="clinic-name">{{ $service->name }}</h5>

                                        <div class="doctor-info-wrapper mt-3">
                                            @if($isOpen)
                                                <p class="doctor-name mb-0">{{ $service->doctor->name }}</p>
                                            @else
                                                <div class="closed-status">
                                                    <span class="badge rounded-pill bg-danger-subtle text-danger px-4 py-2">Tutup</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <img src="https://illustrations.popsy.co/blue/medical-care.svg" style="width: 200px;" alt="empty">
                                <p class="text-muted mt-3 font-italic">Data poliklinik tidak tersedia untuk saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <style>
            .bg-soft-blue {
                background: linear-gradient(180deg, #e0f2fe 0%, #ffffff 100%);
                min-height: auto;
                padding-bottom: 2rem;
            }

            .schedule-hero {
                background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
                border-bottom: 8px solid #facc15;
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }

            .badge-custom-yellow {
                display: inline-block;
                background: #facc15;
                color: #1e3a8a;
                padding: 8px 30px;
                border-radius: 50px;
                font-weight: 800;
                font-size: 1.2rem;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }

            .doctor-card {
                background: white;
                border-radius: 20px;
                border: none;
                box-shadow: 0 10px 25px rgba(30, 58, 138, 0.1);
                transition: transform 0.3s ease;
                overflow: hidden;
                position: relative;
                border: 1px solid #e2e8f0;
            }

            .doctor-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 15px 35px rgba(30, 58, 138, 0.15);
            }

            .card-header-accent {
                height: 12px;
                background: #1e3a8a;
                width: 100%;
            }

            .clinic-name {
                color: #1e3a8a;
                font-weight: 800;
                font-size: 1.25rem;
                margin-bottom: 0.5rem;
            }

            .doctor-name {
                font-size: 1rem;
                font-weight: 700;
                color: #334155;
            }

            .specialization {
                color: #64748b;
                font-size: 0.85rem;
                display: block;
                margin-top: 4px;
            }

            .doctor-card.closed {
                opacity: 0.8;
            }

            .doctor-card.closed .card-header-accent {
                background: #ef4444;
            }

            .closed-status {
                padding: 10px 0;
                font-weight: 700;
            }

            @media (max-width: 768px) {
                .badge-custom-yellow {
                    font-size: 1rem;
                }

                .display-5 {
                    font-size: 1.8rem;
                }
            }
        </style>
    @endfragment
@endsection