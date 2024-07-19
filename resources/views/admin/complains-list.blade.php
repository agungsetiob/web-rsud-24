@extends('layouts.header')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Complains</h1>
        <div class="input-group col-4">
            <label class="font-weight-bold col-5 mt-2 pl-4">Mulai tanggal :</label>
            <input type="date" name="startdate" class="form-controls col-7" id="startdate">
        </div>
        <div class="input-group col-4">
            <label class="font-weight-bold col-5 mt-2">Sampai tanggal :</label>
            <input type="date" name="enddate" class="form-controls col-7" id="enddate">
        </div>
        <a href="" onclick="this.href='laporan/'+ document.getElementById('startdate').value + '/' +document.getElementById('enddate').value" class="d-none d-sm-inline-block btn btn-warning shadow-sm" target="_blank"><i class="fas fa-print"></i> Cetak</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keluhan</th>
                            <th>No Hp</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($complains as $com)
                        <tr>
                            <td width="10"> {{$loop->iteration}} </td>
                            <td> {{$com->name}} </td>
                            <td> {{$com->complain}} </td>
                            <td> {{$com->phone}} </td>
                            <td> {{$com->date}} </td>      
                        </tr>
                        @empty
                        <div class="alert alert-danger">
                            Data  is not available.
                        </div>
                        @endforelse
                        @if(Session::has('success'))
                        <div class="alert alert-success data-dismiss">
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