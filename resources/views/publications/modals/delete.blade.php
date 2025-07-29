<div class="modal fade" id="deletePublicationModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin ingin menghapus publikasi <strong id="deletePublicationName"></strong>?</p>
                <input type="hidden" id="deletePublicationId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="fas fa-spinner fa-spin fa-sm d-none loading-spinner-delete"></i>
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete-btn').on('click', function () {
        const id = $(this).data('id')
        const nama = $(this).data('nama')
        $('#deletePublicationId').val(id)
        $('#deletePublicationName').text(nama)
    })

    $('#confirmDeleteBtn').on('click', function () {
        const id = $('#deletePublicationId').val()
        const btn = $(this)
        btn.prop('disabled', true)
        $('.loading-spinner-delete').removeClass('d-none')

        $.ajax({
            url: `{{ url('/api/publications') }}/${id}`,
            method: 'DELETE',
            headers: {
                Authorization: `Bearer ${WEBRSUD_TOKEN}`
            },
            success: function () {
                Swal.fire('Dihapus!', 'Publikasi berhasil dihapus.', 'success').then(() => location.reload())
            },
            error: function () {
                Swal.fire('Gagal!', 'Gagal menghapus publikasi.', 'error')
            },
            complete: function () {
                btn.prop('disabled', false)
                $('.loading-spinner-delete').addClass('d-none')
            }
        })
    })
</script>
