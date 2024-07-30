@extends('layouts.header')
@section('content')
                <!-- Begin Page Content -->
                @foreach ($profiles as $p)
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">About us</h1>
                        <a href="{{url('setting/profile/'. $p->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-pen fa-sm text-white-50"></i> Update Profil RSUD</a>
                    </div>
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">{{$p->heading}}</h6>
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('storage/posts/'.$p->image) }}" class="rounded img-fluid mx-auto d-block p-2">
                        </div>
                        <div class="card-body">
                            <p class="text-justify">
                                {!!$p->about!!}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
@endsection