@extends('layouts.header')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">API Tokens</h1>
            <button class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal"
                data-target="#generateTokenModal">
                <i class="fas fa-key me-1"></i> Generate Token
            </button>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Token</h6>
            </div>
            <div class="card-body">
                @if($tokens->isEmpty())
                    <div class="alert alert-danger">Tidak ada token ditemukan.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Token</th>
                                    <th>User</th>
                                    <th>Usia Token</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tokens as $token)
                                    <tr>
                                        <td>{{ $token->name }}</td>
                                        <td>{{ $token->tokenable->email ?? 'User Tidak Dikenal' }}</td>
                                        <td>{{ $token->created_at->diffForHumans() }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm btn-revoke-token" data-toggle="modal"
                                                data-target="#revokeTokenModal"
                                                data-user="{{ $token->tokenable->email ?? $token->tokenable->id }}"
                                                data-name="{{ $token->name }}">
                                                <i class="fa fa-ban"></i> Revoke
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('tokens.modals.generate-token-modal')
    @include('tokens.modals.revoke-token-modal')

@endsection