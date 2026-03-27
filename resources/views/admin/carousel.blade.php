@extends('layouts.header')
@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0">Carousel</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                data-target="#addCarousel"><i class="fas fa-images fa-sm text-white-50"></i> Tambah Carousel</a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Carousel Items</h6>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <div class="alert alert-success mt-3">
                        {{ Session::get('success') }}
                    </div>
                    @php Session::forget('success'); @endphp
                @elseif(Session::has('error'))
                    <div class="alert alert-danger mt-3">
                        {{ Session::get('error') }}
                    </div>
                    @php Session::forget('error'); @endphp
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Sub Judul</th>
                                <th>Gambar</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($carousels as $carousel)
                                <tr>
                                    <td>{{ $carousel->title }}</td>
                                    <td>{{ $carousel->subtitle }}</td>
                                    <td>
                                        <img src="{{ asset('storage/'.$carousel->image) }}" alt="carousel" width="120">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary editCarouselBtn"
                                            data-id="{{ $carousel->id }}"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger deleteCarouselBtn"
                                            data-id="{{ $carousel->id }}" data-title="{{ $carousel->title }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="alert alert-danger">Data carousel tidak tersedia.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.components.add-carousel-modal')
    @include('admin.components.delete-carousel-modal')
@endsection
