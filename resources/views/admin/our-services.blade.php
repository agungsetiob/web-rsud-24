@extends('layouts.header')
@section('content') 
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Layanan Kami</h1>
                        <a href="{{ route('our-services.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-hand-holding-medical fa-sm text-white-50"></i> Tambah Layanan</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Our Services</h6>
                        </div>
                        <div class="card-body">
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

                                                <!-- <button class="btn btn-danger btn-circle btn-sm" title="hapus" data-toggle="modal" onclick="deleteservice({{$service->id}})"><i class="fas fa-trash"></i></button> -->
                                                
                                                <a href="{{ route('our-services.edit', $service->id) }}" class="btn btn-success btn-sm" title="edit"><i class="fas fa-pencil-alt"></i></a>
                                        </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data is not available.
                                            </div>
                                        @endforelse
                                        @if(Session::has('success'))
                                            <div class="alert alert-success">
                                                {{ Session::get('success') }}
                                                    @php
                                                        Session::forget('success');
                                                    @endphp
                                            </div>
                                        @elseif (Session::has('error'))
                                            <div class="alert alert-danger">
                                                {{ Session::get('error') }}
                                                    @php
                                                        Session::forget('error');
                                                    @endphp
                                            </div>
                                        @endif
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
@endsection