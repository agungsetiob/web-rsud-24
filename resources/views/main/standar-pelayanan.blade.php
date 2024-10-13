@extends('layouts.standar-pelayanan-layout')
@section('content')
@fragment('standar')
    <div id="app" data-loading-class="fade">
        <div id="blog-page" class="container-fluid bg-breadcrumb show">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Standar Pelayanan</h3>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active text-primary">Standar Pelayanan</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid team py-5">
            <div class="container py-5">
                <div class="row g-4 justify-content-center">
                    <table class="table table-borderless table-hover text-dark">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Instalasi/Unit</th>
                                <th>Deskripsi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($standards as $index => $st)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $st->name }}</td>
                                    <td>{{ $st->service_name }}</td>
                                    <td>
                                        <a href="{{Storage::url('sp/' . $st->file)}}"
                                            class="btn btn-primary btn-sm text-white">Lihat Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container">
                <div class="w-full">
                    {{ $standards->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endfragment
@endsection