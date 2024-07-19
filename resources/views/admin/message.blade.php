@extends('layouts.header')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Messages</h1>
        <div class="input-group col-4">
            <label class="font-weight-bold col-5 mt-2 pl-4">Mulai tanggal :</label>
            <input type="date" name="startdate" class="form-controls col-7" id="startdate">
        </div>
        <div class="input-group col-4">
            <label class="font-weight-bold col-5 mt-2">Sampai tanggal :</label>
            <input type="date" name="enddate" class="form-controls col-7" id="enddate">
        </div>
        <a href="" onclick="this.href='messages/laporan/'+ document.getElementById('startdate').value + '/' +document.getElementById('enddate').value" class="d-none d-sm-inline-block btn btn-info shadow-sm" target="_blank"><i class="fas fa-print"></i> Cetak</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gradient-warning">
            <h6 class="m-0 font-weight-bold text-primary">List of messages</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $mes)
                        <tr>
                            <td> {{$mes->name}} </td>
                            <td> {{$mes->email}} </td>
                            <td> {{$mes->message}} </td>
                            <td> {{$mes->created_at}} </td>
                            <td>
                                <button class="btn btn-danger btn-sm" title="hapus" data-toggle="modal" onclick="deleteMessage({{$mes->id}})"><i class="fas fa-trash"></i></button>       
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

<!-- delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tenane Lur?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Select "Delete" below if you are sure to delete this data.</div>
        <div class="modal-footer">
            <button class="btn btn-success" type="button" data-dismiss="modal">Cancel</button>
            @csrf
            @method ('delete')
            <a id="deleteLink" class="btn btn-danger" type="button">Delete</a>
        </div>
    </div>
</div>
</div>

<!-- delete modal script -->
<script>
    function deleteMessage(id){
        var link = document.getElementById('deleteLink')
        link.href = "{{ url('delete/message')}}/" + id
        $('#deleteModal').modal('show')
    }
</script>
@endsection