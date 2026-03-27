<div class="modal fade" id="deleteCarousel" tabindex="-1" aria-labelledby="deleteCarouselLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="deleteCarouselForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCarouselLabel">Hapus Carousel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus carousel <strong id="deleteCarouselTitle"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // script untuk set action form delete
    $('.deleteCarouselBtn').on('click', function() {
        var id = $(this).data('id');
        var title = $(this).data('title');
        $('#deleteCarouselTitle').text(title);
        $('#deleteCarouselForm').attr('action', '/carousels/' + id);
        $('#deleteCarousel').modal('show');
    });
</script>
