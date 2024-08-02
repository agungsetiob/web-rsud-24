@extends('layouts.header')
@section('content') 
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Layanan Kami</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addService"><i class="fas fa-hand-holding-medical fa-sm text-white-50"></i> Tambah Layanan</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Our Services</h6>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success mt-3">
                                    {{ Session::get('success') }}
                                </div>
                                @php
                                    Session::forget('success');
                                @endphp
                            @elseif(Session::has('error'))
                                <div class="alert alert-danger mt-3">
                                    {{ Session::get('error') }}
                                </div>
                                @php
                                    Session::forget('error');
                                @endphp
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
                                            <th>Nama Layanan</th>
                                            <th>Deskripsi</th>
                                            <th>Icon</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($services as $service)
                                        <tr>
                                            <td> {{$service->name}} </td>
                                            <td> {{$service->desc}} </td>
                                            <td> {{$service->icon}} </td>
                                            <td>
                                                <a href="{{ route('our-services.edit', $service->id) }}" class="btn btn-success btn-sm" title="edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4">
                                                <div class="alert alert-danger">
                                                    Data is not available.
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Add Modal -->
    <div class="modal fade" id="addService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('our-services.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>   
                        </div>
                        <div class="form-group">
                            <label for="desc">Deskripsi dan jadwal</label>
                            <input type="text" name="desc" class="form-control" id="desc" required>   
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Icon</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('icon') is-invalid @enderror" type="radio" name="icon" id="icon1" value="fa-user-doctor" {{ old('icon') == "fa-user-doctor" ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="icon1">
                                        <i class="fas fa-user-md"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('icon') is-invalid @enderror" type="radio" name="icon" id="icon2" value="fa-truck-medical" {{ old('icon') == "fa-truck-medical" ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="icon2">
                                        <i class="fa-solid fa-truck-medical"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('icon') is-invalid @enderror" type="radio" name="icon" id="icon3" value="fa-hospital" {{ old('icon') == "fa-hospital" ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="icon3">
                                        <i class="fa-solid fa-hospital"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('icon') is-invalid @enderror" type="radio" name="icon" id="icon4" value="fa-briefcase-medical" {{ old('icon') == "fa-briefcase-medical" ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="icon4">
                                        <i class="fa-solid fa-briefcase-medical"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('icon') is-invalid @enderror" type="radio" name="icon" id="icon5" value="fa-stethoscope" {{ old('icon') == "fa-stethoscope" ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="icon5">
                                        <i class="fa-solid fa-stethoscope"></i>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('icon') is-invalid @enderror" type="radio" name="icon" id="icon6" value="fa-diagnoses" {{ old('icon') == "fa-diagnoses" ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="icon6">
                                        <i class="fa-solid fa-diagnoses"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
@endsection