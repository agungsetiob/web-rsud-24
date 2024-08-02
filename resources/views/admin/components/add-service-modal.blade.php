<div class="modal fade" id="addService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('our-services.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="desc">Deskripsi dan jadwal</label>
                        <input type="text" name="desc" class="form-control" id="desc" required>
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('icon') is-invalid @enderror" type="radio"
                                    name="icon" id="icon1" value="fa-user-doctor" {{ old('icon') == "fa-user-doctor" ? 'checked' : '' }} required>
                                <label class="form-check-label" for="icon1">
                                    <i class="fas fa-user-md"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('icon') is-invalid @enderror" type="radio"
                                    name="icon" id="icon2" value="fa-truck-medical" {{ old('icon') == "fa-truck-medical" ? 'checked' : '' }} required>
                                <label class="form-check-label" for="icon2">
                                    <i class="fa-solid fa-ambulance"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('icon') is-invalid @enderror" type="radio"
                                    name="icon" id="icon3" value="fa-hospital" {{ old('icon') == "fa-hospital" ? 'checked' : '' }} required>
                                <label class="form-check-label" for="icon3">
                                    <i class="fa-solid fa-hospital"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('icon') is-invalid @enderror" type="radio"
                                    name="icon" id="icon4" value="fa-briefcase-medical" {{ old('icon') == "fa-briefcase-medical" ? 'checked' : '' }} required>
                                <label class="form-check-label" for="icon4">
                                    <i class="fa-solid fa-briefcase-medical"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('icon') is-invalid @enderror" type="radio"
                                    name="icon" id="icon5" value="fa-stethoscope" {{ old('icon') == "fa-stethoscope" ? 'checked' : '' }} required>
                                <label class="form-check-label" for="icon5">
                                    <i class="fa-solid fa-stethoscope"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('icon') is-invalid @enderror" type="radio"
                                    name="icon" id="icon6" value="fa-diagnoses" {{ old('icon') == "fa-diagnoses" ? 'checked' : '' }} required>
                                <label class="form-check-label" for="icon6">
                                    <i class="fa-solid fa-diagnoses"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>