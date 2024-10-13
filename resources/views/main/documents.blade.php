@extends('layouts.standar-pelayanan-layout')
@section('content')
@fragment('docs')
    <div id="app" data-loading-class="fade">
        <div id="blog-page" class="container-fluid bg-breadcrumb show">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Dokumen Publik</h3>
                    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item active text-primary">Dokumen Publik</li>
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
                                <th>Nama Dokumen</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $index => $fi)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $fi->name }}</td>
                                    <td>
                                        <a href="{{Storage::url('docs/' . $fi->file)}}" target="_blank" class="btn btn-primary btn-sm text-white">Lihat Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endfragment
@endsection
