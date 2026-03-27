<div class="modal fade" id="addCarousel" tabindex="-1" aria-labelledby="addCarouselLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('carousels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addCarouselLabel">Tambah Carousel</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="title" class="form-control" placeholder="Masukkan judul kecil">
                    </div>
                    <div class="form-group">
                        <label>Sub Judul</label>
                        <input type="text" name="subtitle" class="form-control" placeholder="Masukkan judul besar">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="carouselImage" required>
                            <label class="custom-file-label" for="carouselImage">Pilih file gambar...</label>
                        </div>
                        <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#carouselImage').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });
</script>
