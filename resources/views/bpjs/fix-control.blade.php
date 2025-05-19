@extends('layouts.bpjs')

@section('title', 'Cari Jadwal Kontrol')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card">
                <div class="card-header text-white text-center">
                    <h4>Cari Surat Kontrol</h4>
                </div>
                <div class="card-body">
                    <form id="searchJadwalKontrol">
                        @csrf
                        <div class="mb-4">
                            <label for="nomorKontrol" class="form-label">Nomor Kontrol</label>
                            <input type="text" id="nomorKontrol" name="nomorKontrol" class="form-control" placeholder="Masukkan Nomor Kontrol" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Cari</button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <small class="footer-text">© 2024 BPJS Integration. Built with ❤️ by <a href="#">Agung Setio</a>.</small>
            </div>
        </div>
    </div>
</div>

<!-- Modal to Show Search Results -->
<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header card-header text-white" style="border-top-left-radius: 10px; border-top-right-radius:10px">
                <h5 class="modal-title" id="resultModalLabel">Hasil Pencarian Jadwal Kontrol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nomor Kontrol</th>
                            <th>Nomor Referensi</th>
                            <th>Tanggal Kontrol</th>
                            <th>Jam</th>
                            <th>Deskripsi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="kontrolList">
                        <!-- Data will be appended dynamically via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#searchJadwalKontrol').on('submit', function (e) {
        e.preventDefault();

        const nomorKontrol = $('#nomorKontrol').val();

        if (!nomorKontrol) {
            Swal.fire('Peringatan', 'Nomor Kontrol wajib diisi.', 'warning');
            return;
        }

        $.ajax({
            url: "{{ route('jadwalKontrol.search') }}",
            method: "GET",
            data: { nomor: nomorKontrol },
            beforeSend: function () {
                Swal.fire({
                    title: 'Mencari...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function (response) {
                Swal.close();

                if (response.success && response.data.length > 0) {
                    $('#kontrolList').html('');

                    response.data.forEach((item) => {
                        $('#kontrolList').append(`
                            <tr>
                                <td>${item.ID}</td>
                                <td>${item.NOMOR}</td>
                                <td>${item.NOMOR_REFERENSI || '-'}</td>
                                <td>${item.TANGGAL}</td>
                                <td>${item.JAM}</td>
                                <td>${item.DESKRIPSI}</td>
                                <td>
                                    ${item.SUDAH_DIGUNAKAN ? 
                                        `<button class="btn btn-warning fixStatus" data-id="${item.ID}">Perbaiki</button>` :
                                        '<span class="text-success">Aman</span>'
                                    }
                                </td>
                            </tr>
                        `);
                    });

                    $('#resultModal').modal('show');
                } else {
                    Swal.fire('Info', response.message || 'Data tidak ditemukan.', 'info');
                }
            },
            error: function (xhr) {
                Swal.fire('Error', xhr.responseJSON?.message || 'Terjadi kesalahan saat mencari data.', 'error');
            }
        });
    });

    $(document).on('click', '.fixStatus', function () {
        const id = $(this).data('id');
        const button = $(this);

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin memperbaiki status?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Perbaiki',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('jadwalKontrol.update') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        button.prop('disabled', true).text('Memproses...');
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Berhasil', response.message, 'success');
                            // Replace button with success message
                            button.replaceWith('<span class="text-success">Sudah Diperbaiki</span>');
                        } else {
                            Swal.fire('Error', response.message, 'error');
                            button.prop('disabled', false).text('Perbaiki');
                        }
                    },
                    error: function (xhr) {
                        let errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan.';
                        Swal.fire('Error', errorMessage, 'error');
                        button.prop('disabled', false).text('Perbaiki');
                        console.error(xhr); // Log error for debugging
                    }
                });
            }
        });
    });

});
</script>
@endpush
