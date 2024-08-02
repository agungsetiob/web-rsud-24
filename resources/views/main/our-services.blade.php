@extends('layouts.header')
@section('content') 
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Layanan Kami</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#addService"><i class="fas fa-hand-holding-medical fa-sm text-white-50"></i> Tambah Layanan</a>
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
                <table class="table table-borderless table-striped table-hover" id="dataTable" width="100%"
                    cellspacing="0">
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
                                <td> <i class="fas {{$service->icon}}"></i> </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary editServiceBtn"
                                        data-id="{{ $service->id }}"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger deleteServiceBtn"
                                        data-id="{{ $service->id }}" data-name="{{ $service->name }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
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
@include('admin.components.add-service-modal')
@include('admin.components.edit-service-modal')
@include('admin.components.delete-service-modal')
@endsection