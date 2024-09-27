@extends('layouts.header')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">File SKPD</h1>
                        @if (Auth::user()->role == 'admin')
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#uploadFile"><i class="fas fa-upload fa-sm text-white-50"></i> Upload File</a>
                        @endif
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar File</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama File</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($files as $file)
                                        <tr>
                                            <td> {{$file->name}} </td>
                                            <td> {{$file->created_at}} </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" title="hapus" href="#" data-toggle="modal" data-target="#deleteModal{{$file->id}}">
                                                <i class="fas fa-trash"></i> delete
                                                </button>
                                                <a class="btn btn-success btn-sm" title="download" href="{{Storage::url('docs/'. $file->file )}}" target="_blank">
                                                <i class="fas fa-download"></i> download
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data file Belum tersedia.
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

     <!-- Add Modal -->
    <div class="modal fade" id="uploadFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('upload/file') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">File name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                            <label for="photo">Choose file</label>
                            <div class="form-group">
                                <div class="input-group ">
                                    <label class="input-group-btn">
                                        <span class="btny btn-outline-primary">
                                            Browse<input accept="application/pdf" id="uploadBtn" type="file" style="display: none;" multiple name="file">
                                        </span>
                                    </label>
                                    <input id="uploadFile" type="text" class="form-control @error('photo') is-invalid @enderror" readonly placeholder="Choose a .pdf file">
                                </div>  
                            </div>
                            <script type="text/javascript">
                                document.getElementById("uploadBtn").onchange = function () {
                                document.getElementById("uploadFile").value = this.value;};
                            </script>
                        </div>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>

    <!-- delete Modal-->
    @foreach ($files as $file)
    <div class="modal fade" id="deleteModal{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" below if you are sure to delete this data.</div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{url('delete/docs', $file->id)}}" method="POST">
                        @csrf
                        @method ('delete')
                    <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection