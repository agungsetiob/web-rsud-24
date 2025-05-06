@extends('layouts.bpjs')

@section('title', 'BPJS Rencana Kontrol')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card">
                <div class="card-header text-white text-center">
                    <h4>BPJS Rencana Kontrol</h4>
                </div>
                <div class="card-body">
                    <form id="rencanaKontrolForm">
                        @csrf
                        <div class="mb-4">
                            <label for="tglAwal" class="form-label">Tanggal Awal</label>
                            <input type="date" id="tglAwal" name="tglAwal" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label for="tglAkhir" class="form-label">Tanggal Akhir</label>
                            <input type="date" id="tglAkhir" name="tglAkhir" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label for="filter" class="form-label">Filter</label>
                            <select id="filter" name="filter" class="form-control">
                                <!-- <option value="1">Tanggal Entri</option> -->
                                <option value="2" selected>Tanggal Rencana</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Tampilkan Data</button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <small class="footer-text">© 2024 BPJS Integration. Built with ❤️ by <a href="#">Agung Setio</a>.</small>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header card-header text-white" style="border-top-left-radius: 10px; border-top-right-radius:10px">
                <h5 class="modal-title" id="resultModalLabel">Hasil Rencana Kontrol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Pasien</th>
                                <th>No Kartu</th>
                                <th>Poli Tujuan</th>
                                <th>Tanggal Rencana</th>
                                <th>Tanggal Terbit</th>
                                <th>Asal</th>
                                <th>Kunjungan</th>
                                <th>Dokter</th>
                            </tr>
                        </thead>
                        <tbody id="kontrolList">
                            <!-- Data will be appended here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#rencanaKontrolForm').on('submit', function (e) {
        e.preventDefault();

        const tglAwal = $('#tglAwal').val();
        const tglAkhir = $('#tglAkhir').val();
        const filter = $('#filter').val();

        if (!tglAwal || !tglAkhir) {
            Swal.fire('Peringatan', 'Tanggal awal dan akhir wajib diisi.', 'warning');
            return;
        }

        if (new Date(tglAkhir) < new Date(tglAwal)) {
            Swal.fire('Peringatan', 'Tanggal akhir tidak boleh sebelum tanggal awal.', 'warning');
            return;
        }

        $.ajax({
            url: "{{ route('controlsByDateRange') }}",
            method: "GET",
            data: {
                tglAwal: tglAwal,
                tglAkhir: tglAkhir,
                filter: filter
            },
            beforeSend: function () {
                Swal.fire({
                    title: 'Memuat data...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function (response) {
                Swal.close();
                
                console.log('Full API Response:', response);
                
                if (response.success && response.data && 
                    response.data.metaData && response.data.metaData.code === "200" && 
                    response.data.response && response.data.response.list) {
                    
                    $('#kontrolList').empty();
                    
                    response.data.response.list.forEach((item) => {
                        $('#kontrolList').append(`
                            <tr>
                                <td>${item.nama}</td>
                                <td>${item.noKartu}</td>
                                <td>${item.namaPoliTujuan}</td>
                                <td>${item.tglRencanaKontrol}</td>
                                <td>${item.tglTerbitKontrol}</td>
                                <td>${item.jnsPelayanan}</td>
                                <td>${item.tglSEP}</td>
                                <td>${item.namaDokter}</td>
                            </tr>
                        `);
                    });

                    $('#resultModalLabel').html(`Hasil Rencana Kontrol (Total: ${response.total_data})`);
                    $('#resultModal').modal('show');
                } else {
                    const errorMsg = response.message ||
                                'Tidak ada data rencana kontrol untuk periode yang dipilih.';
                    Swal.fire('Info', errorMsg, 'info');
                }
            },
            error: function (xhr) {
                Swal.fire('Error', xhr.responseJSON?.message || 'Terjadi kesalahan saat memuat data.', 'error');
            }
        });
    });
});

</script>
@endpush
