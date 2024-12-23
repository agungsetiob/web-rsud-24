<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPJS Rencana Kontrol</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="shortcut icon" href="{{url ('storage/logors.png')}}" type="image/x-icon" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 50px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-content {
            border-radius: 10px;
        }

        .card-header {
            background-color: #005b96;
            color: #fff;
            padding: 30px;
            border-bottom: 0;
            text-transform: uppercase;
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #ccc;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-primary {
            background-color: #005b96;
            border: none;
            border-radius: 10px;
            padding: 15px;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #004080;
        }

        .footer-text {
            font-size: 14px;
            color: #555;
        }

        .footer-text a {
            color: #005b96;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 20px;
            }

            .footer-text {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-header text-white text-center" style="border-top-">
                        <h4>BPJS Rencana Kontrol</h4>
                    </div>
                    <div class="card-body">
                        <form id="rencanaKontrolForm">
                            @csrf
                            <div class="mb-4">
                                <label for="noKartu" class="form-label">Nomor BPJS</label>
                                <input type="text" id="noKartu" name="noKartu" class="form-control" placeholder="Masukkan nomor kartu BPJS" required>
                            </div>
                            <div class="mb-4">
                                <label for="bulan" class="form-label">Bulan</label>
                                <select id="bulan" name="bulan" class="form-control" required>
                                <option value="" disabled selected>Pilih Bulan</option>
                                    @php
                                        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    @endphp
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ sprintf('%02d', $i) }}">{{ $bulan[$i-1] }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" id="tahun" name="tahun" class="form-control" placeholder="Masukkan Tahun (e.g., 2024)" value="{{ date('Y') }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Tampilkan Data</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <small class="footer-text">© 2024 BPJS Integration. Built with ❤️ by <a href="#">Agung
                            Setio</a>.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header card-header text-white" style="border-top-left-radius: 10px; border-top-right-radius:10px">
                    <h5 class="modal-title" id="resultModalLabel">Hasil Rencana Kontrol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <!-- <th>No</th> -->
                                <th>No Surat Kontrol</th>
                                <th>Nama Pasien</th>
                                <th>Poli</th>
                                <th>Tanggal Kontrol</th>
                                <th>Jenis</th>
                                <th>Dokter</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody id="kontrolList">
                            <!-- Data -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#rencanaKontrolForm').on('submit', function (e) {
                e.preventDefault();

                const noKartu = $('#noKartu').val();
                const bulan = $('#bulan').val();
                const tahun = $('#tahun').val();

                if (!noKartu || !bulan || !tahun) {
                    Swal.fire('Peringatan', 'Semua field wajib diisi.', 'warning');
                    return;
                }

                $.ajax({
                    url: "{{ route('controls.list') }}",
                    method: "GET",
                    data: {
                        noKartu: noKartu,
                        bulan: bulan,
                        tahun: tahun,
                    },
                    beforeSend: function () {
                        Swal.showLoading();
                    },
                    success: function (response) {
                        Swal.close();

                        if (response && response.suratKontrols && response.suratKontrols.length > 0) {
                            $('#kontrolList').html('');
                            response.suratKontrols.forEach((item, index) => {
                                $('#kontrolList').append(`
                                    <tr>
                                        <td>${item.noSuratKontrol}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.namaPoliTujuan}</td>
                                        <td>${item.tglRencanaKontrol}</td>
                                        <td>${item.namaJnsKontrol}</td>
                                        <td>${item.namaDokter}</td>
                                        <td>
                                            <button type="submit" class="btn btn-danger cetakButton" data-surat-kontrol='${JSON.stringify(item)}'>Cetak</button>
                                        </td>
                                    </tr>
                                `);
                            });
                            $('#resultModal').modal('show');
                        } else {
                            Swal.fire('Info', 'Tidak ada data untuk bulan dan tahun yang dipilih.', 'info');
                        }
                    },
                    error: function (xhr) {
                        Swal.fire('Error', xhr.responseJSON.message || 'Terjadi kesalahan.', 'error');
                    }
                });
            });

            $(document).on('click', '.cetakButton', function () { 
                const suratKontrol = $(this).data('surat-kontrol'); 
                if (suratKontrol) { 
                    window.open(`/cetak-surat-kontrol?noSuratKontrol=${suratKontrol.noSuratKontrol}`, '_blank'); 
                } });
        });
    </script>
</body>

</html>