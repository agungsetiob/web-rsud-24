<div class="modal fade" id="createPublicationModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success text-white">
                <h5 class="modal-title" id="createModalLabel">Tambah Publikasi</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createPublicationForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_dokumen">Nama Dokumen</label>
                            <input type="text" name="nama_dokumen" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="produsen_data">Produsen Data</label>
                            <input type="text" name="produsen_data" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rencana_rilis">Rencana Rilis</label>
                            <input type="date" name="rencana_rilis" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_rilis">Tanggal Rilis</label>
                            <input type="date" name="tanggal_rilis" class="form-control">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="image">Upload Gambar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="imageInput"
                                    accept="image/*">
                                <label class="custom-file-label" for="imageInput">Pilih gambar...</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="file">Upload File Publikasi</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="fileInput"
                                    accept=".pdf,.doc,.docx,.xls,.xlsx">
                                <label class="custom-file-label" for="fileInput">Pilih file dokumen...</label>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="form-control"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success float-right">
                        <i class="fas fa-spinner fa-spin fa-xl d-none loading-spinner-create"></i>
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop()
        $(this).next('.custom-file-label').addClass("selected").html(fileName)
    })

    $('#createPublicationForm').on('submit', function (e) {
        e.preventDefault()
        const btn = $(this).find('button[type="submit"]')
        btn.prop('disabled', true)
        $('.loading-spinner-create').removeClass('d-none')

        const formData = new FormData(this)

        $.ajax({
            url: "{{ url('/api/publications') }}",
            method: "POST",
            headers: {
                Authorization: `Bearer ${WEBRSUD_TOKEN}`
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let nama = 'Data berhasil disimpan.'
                try {
                    if (response.data && response.data.nama_dokumen) {
                        nama = response.data.nama_dokumen
                    }
                } catch (e) {
                    console.error('Error parsing success response:', e)
                }

                Swal.fire({
                    title: 'Publikasi Ditambahkan!',
                    icon: 'success',
                    text: nama,
                }).then(() => location.reload())
            },
            error: function (xhr) {
                let message = 'Terjadi kesalahan.'
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors
                    message = Object.entries(errors)
                        .map(([field, msgs]) => `<strong>${field}:</strong> ${msgs.join(', ')}`)
                        .join('<br>')
                }
                Swal.fire({
                    title: 'Gagal!',
                    icon: 'error',
                    html: message
                })
            },
            complete: function () {
                btn.prop('disabled', false)
                $('.loading-spinner-create').addClass('d-none')
            }
        })
    })
</script>