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
                                                @if($service->doctor->photo)
                                                    <div class="doctor-photo mb-3">
                                                        <img src="{{ asset('storage/doctor/' . $service->doctor->photo) }}"
                                                            alt="{{ $service->doctor->name }}" class="img-fluid rounded-circle shadow-sm"
                                                            style="width: 100px; height: 100px; object-fit: cover;">
                                                    </div>
                                                @else
                                                    <div class="doctor-photo mb-3">
                                                        <img src="{{ asset('storage/logors.png') }}" alt="No Photo"
                                                            class="img-fluid rounded-circle shadow-sm"
                                                            style="width: 100px; height: 100px; object-fit: cover;">
                                                    </div>
                                                @endif
                                                <p class="doctor-name mb-0">{{ $service->doctor->name }}</p>
                                                <small class="specialization">{{ $service->doctor->specialization }}</small>
                                            @else
                                                <div class="doctor-photo mb-3">
                                                    <img src="{{ asset('storage/logors.png') }}" alt="No Photo"
                                                        class="img-fluid rounded-circle shadow-sm"
                                                        style="width: 100px; height: 100px; object-fit: cover;">
                                                </div>
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
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.57771 12.4905L9.04724 3.55141L8.16311 1.63635C7.7714 0.787885 6.50134 0.787885 6.10963 1.63635L2.43584 9.59392C1.48454 11.6545 2.16535 13.874 3.75242 15.2006C3.86477 14.2928 4.13345 13.379 4.57771 12.4905ZM5.91935 13.1613C5.45908 14.0818 5.22886 15.0355 5.19677 15.9705C5.07126 19.6271 7.97542 23 12 23C17.0538 23 20.3408 17.6815 18.0807 13.1613L12.8944 2.78884C12.5259 2.05179 11.4741 2.05179 11.1056 2.78884L5.91935 13.1613ZM19.4223 12.4905L14.9528 3.55141L15.8369 1.63635C16.2286 0.787885 17.4987 0.787885 17.8904 1.63635L21.5642 9.59392C22.5155 11.6545 21.8347 13.874 20.2476 15.2006C20.1352 14.2928 19.8666 13.379 19.4223 12.4905ZM12.3333 12C12.8856 12 13.3333 12.4477 13.3333 13V14.5667C13.3333 14.6219 13.3781 14.6667 13.4333 14.6667H15C15.5523 14.6667 16 15.1144 16 15.6667V16.3333C16 16.8856 15.5523 17.3333 15 17.3333H13.4333C13.3781 17.3333 13.3333 17.3781 13.3333 17.4333V19C13.3333 19.5523 12.8856 20 12.3333 20H11.6667C11.1144 20 10.6667 19.5523 10.6667 19V17.4333C10.6667 17.3781 10.6219 17.3333 10.5667 17.3333H9C8.44772 17.3333 8 16.8856 8 16.3333V15.6667C8 15.1144 8.44772 14.6667 9 14.6667H10.5667C10.6219 14.6667 10.6667 14.6219 10.6667 14.5667V13C10.6667 12.4477 11.1144 12 11.6667 12H12.3333Z"
                                        fill="black" />
                                </svg>
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