<div class="modal fade" id="editPublicationModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-warning text-white">
                <h5 class="modal-title" id="editModalLabel">Edit Publikasi</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPublicationForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- akan diganti dengan JS --}}
                    <input type="hidden" name="publication_id" id="editPublicationId">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_nama_dokumen">Nama Dokumen</label>
                            <input type="text" name="nama_dokumen" id="edit_nama_dokumen" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_produsen_data">Produsen Data</label>
                            <input type="text" name="produsen_data" id="edit_produsen_data" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_rencana_rilis">Rencana Rilis</label>
                            <input type="date" name="rencana_rilis" id="edit_rencana_rilis" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_tanggal_rilis">Tanggal Rilis</label>
                            <input type="date" name="tanggal_rilis" id="edit_tanggal_rilis" class="form-control">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="edit_image">Ganti Gambar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="edit_image" accept="image/*">
                                <label class="custom-file-label" for="edit_image">Pilih gambar...</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="edit_file">Ganti File Publikasi</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="edit_file"
                                    accept=".pdf,.doc,.docx,.xls,.xlsx">
                                <label class="custom-file-label" for="edit_file">Pilih file dokumen...</label>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="edit_deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" id="edit_deskripsi" class="form-control"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning float-right">
                        <i class="fas fa-spinner fa-spin fa-xl d-none loading-spinner-edit"></i>
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Ganti label saat upload file di edit modal
    $('#editPublicationModal .custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop()
        $(this).next('.custom-file-label').addClass("selected").html(fileName)
    })

    // Tampilkan data ke form edit
    function showEditModal(data) {
        $('#editPublicationId').val(data.id)
        $('#edit_nama_dokumen').val(data.nama_dokumen)
        $('#edit_produsen_data').val(data.produsen_data)
        $('#edit_rencana_rilis').val(data.rencana_rilis)
        $('#edit_tanggal_rilis').val(data.tanggal_rilis)
        $('#edit_deskripsi').val(data.deskripsi)

        $('#editPublicationModal').modal('show')
    }

    // Submit update
    $('#editPublicationForm').on('submit', function (e) {
        e.preventDefault()

        const id = $('#editPublicationId').val()
        const btn = $(this).find('button[type="submit"]')
        btn.prop('disabled', true)
        $('.loading-spinner-edit').removeClass('d-none')

        const formData = new FormData(this)
        formData.append('_method', 'PUT')

        $.ajax({
            url: `{{ url('/api/publications') }}/${id}`,
            method: "POST",
            headers: {
                Authorization: `Bearer ${WEBRSUD_TOKEN}`
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire({
                    title: 'Publikasi Diupdate!',
                    icon: 'success',
                    text: response.data?.nama_dokumen ?? 'Data berhasil diperbarui.',
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
                $('.loading-spinner-edit').addClass('d-none')
            }
        })
    })
</script>
