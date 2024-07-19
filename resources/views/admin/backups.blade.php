@extends('layouts.header')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Backups</h1>
        <a href="/backup/only-db" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Create Backup</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Backups</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Size</th>
                            <!-- <th>Created Date</th> -->
                            <th>Created Age</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($backups as $backup)
                        <tr>
                            <td> {{$backup['file_name']}} </td>
                            <td> {{ \App\Http\Controllers\BackupController::humanFilesize($backup['file_size']) }} </td>
                            <!-- <td> {{ date('F jS, Y, g:ia (T)',$backup['last_modified']) }} </td> -->
                            <td> {{ \Carbon\Carbon::parse($backup['last_modified'])->diffForHumans() }} </td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{ url('storage/RSUD/'.$backup['file_name']) }}"><i class="fa fa-download"></i> Download</a>

                                <a class="btn btn-danger btn-sm" onclick="return confirm('Do you really want to delete this file?')" data-button-type="delete"
                                href="{{ url('backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash"></i>
                            Delete</a> 
                            </td>      
                        </tr>
                        @empty
                        <div class="alert alert-danger">
                            No backup available.
                        </div>
                        @endforelse
                        @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                            @php
                            Session::forget('error');
                            @endphp
                        </div>
                        @elseif (Session::has('delete'))
                        <div class="alert alert-dark">
                            {{ Session::get('delete') }}
                            @php
                            Session::forget('delete');
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

@endsection 