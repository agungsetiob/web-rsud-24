@extends('layouts.header')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Publikasi</h1>
            <div class="d-flex">
                <button class="btn btn-sm btn-secondary" id="refreshBtn">
                    <i class="fas fa-sync"></i> Reload Data
                </button>
            </div>
        </div>

        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Publikasi</h6>
            </div>
            <div class="card-body">
                <div id="loading" class="text-center d-none"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-borderless table-striped table-hover" id="ajaxTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 200px;">Nama</th>
                                <th style="width: 350px;">Deskripsi</th>
                                <th style="width: 300px;">Produsen</th>
                                <th style="width: 120px;">Tanggal Rilis</th>
                                <th style="width: 100px;">Gambar</th>
                                <th style="width: 100px;">File</th>
                            </tr>
                        </thead>
                        <tbody id="ajaxBody">
                            <!-- Data dari AJAX akan ditampilkan di sini -->
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            function loadPublikasi() {
                $('#loading').removeClass('d-none');
                $.ajax({
                    url: '/proxy-publikasi',
                    method: 'GET',
                    dataType: 'json',
                    success: function (res) {
                        $('#loading').addClass('d-none');
                        if (res.status === 'success') {
                            let rows = '';
                            res.data.forEach(function (pub) {
                                rows += `
                                <tr>
                                    <td>
                                        <div style="max-width: 200px;" title="${pub.nama_dokumen}">
                                            ${pub.nama_dokumen}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="truncate" style="max-width: 350px;" title="${pub.deskripsi}">
                                            ${pub.deskripsi}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="truncate" style="max-width: 300px;" title="${pub.produsen_data}">
                                            ${pub.produsen_data}
                                        </div>
                                    </td>
                                    <td>${pub.tanggal_rilis}</td>
                                    <td>
                                        <img src="${pub.image_url}" alt="Gambar Publikasi" width="70" class="img-thumbnail">
                                    </td>
                                    <td>
                                        <a href="${pub.file_url}" class="btn btn-sm btn-success" target="_blank">
                                            <i class="fas fa-download"></i> File
                                        </a>
                                    </td>
                                </tr>
                                `;
                            });
                            $('#ajaxBody').html(rows);
                        } else {
                            Swal.fire('Oops!', 'Gagal memuat data publikasi.', 'error');
                        }
                    },
                    error: function () {
                        $('#loading').addClass('d-none');
                        Swal.fire('Gagal!', 'Tidak bisa mengambil data dari server.', 'error');
                    }
                });
            }

            function viewJSON(data) {
                Swal.fire({
                    title: 'Data JSON Publikasi',
                    html: `<pre>${JSON.stringify(data, null, 2)}</pre>`,
                    width: '60%',
                });
            }

            $('#refreshBtn').click(function () {
                loadPublikasi();
            });

            loadPublikasi(); // Load awal
        });
    </script>
    <style>
        #ajaxTable {
            table-layout: fixed;
        }

        #ajaxTable td,
        #ajaxTable th {
            vertical-align: top;
        }

        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block;
        }
    </style>
@endsection