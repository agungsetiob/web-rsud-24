@extends('layouts.header')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Publikasi</h1>
            <div class="d-flex">
                <button class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target="#createPublicationModal">
                    <i class="fas fa-plus"></i> Tambah Publikasi
                </button>
                <button class="btn btn-sm btn-secondary" id="viewJsonBtn">
                    <i class="fas fa-code"></i> Lihat JSON
                </button>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Publikasi</h6>
            </div>
            <div class="card-body">
                @if($publications->isEmpty())
                    <div class="alert alert-warning">Belum ada publikasi.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-hover" id="dataTable" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th>Produsen</th>
                                    <th>Tanggal Rilis</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($publications as $pub)
                                    <tr>
                                        <td>{{ $pub->nama_dokumen }}</td>
                                        <td>{{ $pub->slug }}</td>
                                        <td>{{ $pub->produsen_data }}</td>
                                        <td>{{ $pub->tanggal_rilis }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info edit-btn" data-id="{{ $pub->id }}"
                                                data-nama="{{ $pub->nama_dokumen }}" data-slug="{{ $pub->slug }}"
                                                data-produsen="{{ $pub->produsen_data }}" data-rilis="{{ $pub->tanggal_rilis }}"
                                                data-deskripsi="{{ $pub->deskripsi }}" data-rencana="{{ $pub->rencana_rilis }}"
                                                data-image="{{ $pub->image }}" data-file="{{ $pub->file }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button class="btn btn-sm btn-danger delete-btn" data-toggle="modal"
                                                data-target="#deletePublicationModal" data-id="{{ $pub->id }}"
                                                data-nama="{{ $pub->nama_dokumen }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="btn btn-sm btn-secondary view-json-btn" data-id="{{ $pub->id }}">
                                                <i class="fas fa-code"></i>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $publications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        const WEBRSUD_TOKEN = "{{ env('WEBRSUD_TOKEN') }}";
        function formatDateOnly(dateString) {
            if (!dateString) return '';
            return dateString.split(' ')[0];
        }

        $('.edit-btn').on('click', function () {
            const btn = $(this);
            $('#editPublicationId').val(btn.data('id'));
            $('#edit_nama_dokumen').val(btn.data('nama'));
            $('#edit_produsen_data').val(btn.data('produsen'));
            $('#edit_rencana_rilis').val(formatDateOnly(btn.data('rencana')));
            $('#edit_tanggal_rilis').val(formatDateOnly(btn.data('rilis')));
            $('#edit_deskripsi').val(btn.data('deskripsi') ?? '');
            $('#edit_image_preview img').attr('src', btn.data('image') || '#');
            $('#edit_file_preview a').attr('href', btn.data('file') || '#');

            $('#editPublicationModal').modal('show');
        });

        $('.delete-btn').on('click', function () {
            const id = $(this).data('id')
            const nama = $(this).data('nama')
            $('#deletePublicationId').val(id)
            $('#deletePublicationName').text(nama)
            $('#deletePublicationModal').modal('show')
        });
        $('.view-json-btn').on('click', function () {
            const id = $(this).data('id');
            $.ajax({
                url: `/api/publications/${id}`,
                type: 'GET',
                headers: {
                    Authorization: 'Bearer ' + WEBRSUD_TOKEN
                },
                success: function (response) {
                    const json = JSON.stringify(response, null, 2);
                    $('#jsonContent').text(json);
                    $('#viewJsonModal').modal('show');
                },
                error: function () {
                    alert('Gagal mengambil data publikasi.');
                }
            });
        });
        
        // Untuk semua data
        $('#viewJsonBtn').on('click', function () {
            $('#jsonContentAll').text('Loading...');

            $.ajax({
                url: `{{ url('/api/publications') }}`,
                method: 'GET',
                headers: {
                    Authorization: `Bearer ${WEBRSUD_TOKEN}`
                },
                success: function (response) {
                    $('#jsonContentAll').text(JSON.stringify(response, null, 4));
                    $('#jsonModal').modal('show');
                },
                error: function (xhr) {
                    $('#jsonContentAll').text(`Error ${xhr.status}: ${xhr.responseText}`);
                    $('#jsonModal').modal('show');
                }
            });
        });

    </script>
    @include('publications.modals.create')
    @include('publications.modals.update')
    @include('publications.modals.delete')
    @include('publications.modals.json-per-item')
    @include('publications.modals.all-json')

@endsection