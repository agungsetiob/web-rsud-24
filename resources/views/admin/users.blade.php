@extends('layouts.header')
@section('content')
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Users</h1>
                        <a href="{{route('register')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add User</a>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Users</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                        <tr>
                                            <td> {{$user->name}} </td>
                                            <td> {{$user->username}} </td>
                                            <td> {{$user->email}} </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{$user->status}}
                                                    </button>
                                                    @if ($user->status == 'inactive')
                                                    <form method="POST" action="{{url('activate/'. $user->id)}}">
                                                        @csrf
                                                        <div class="dropdown-menu animated--fade-in bg-gray-400" aria-labelledby="dropdownMenuButton">
                                                            <button class="dropdown-item">Activate</button>
                                                        </div>
                                                    </form>
                                                    @elseif ($user->status == 'active')
                                                    <form method="POST" action="{{url('deactivate/'. $user->id)}}">
                                                        @csrf
                                                        <div class="dropdown-menu animated--fade-in bg-gray-400" aria-labelledby="dropdownMenuButton">
                                                            <button class="dropdown-item">Deactivate</button>
                                                        </div>
                                                    </form>
                                                    @endif
                                                </div>
                                            </td>       
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
@endsection