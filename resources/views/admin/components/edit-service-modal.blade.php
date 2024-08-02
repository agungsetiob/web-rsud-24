<div class="modal fade" id="editService" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editServiceForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" name="name" class="form-control" id="edit_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_desc">Deskripsi dan jadwal</label>
                        <input type="text" name="desc" class="form-control" id="edit_desc" required>
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <div>
                            <!-- Icon radio buttons -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon1" value="fa-user-doctor" required>
                                <label class="form-check-label" for="edit_icon1">
                                    <i class="fas fa-user-md"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon2" value="fa-truck-medical" required>
                                <label class="form-check-label" for="edit_icon2">
                                    <i class="fa-solid fa-ambulance"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon3" value="fa-hospital" required>
                                <label class="form-check-label" for="edit_icon3">
                                    <i class="fa-solid fa-hospital"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon4" value="fa-briefcase-medical" required>
                                <label class="form-check-label" for="edit_icon4">
                                    <i class="fa-solid fa-briefcase-medical"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon5" value="fa-stethoscope" required>
                                <label class="form-check-label" for="edit_icon5">
                                    <i class="fa-solid fa-stethoscope"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon6" value="fa-diagnoses" required>
                                <label class="form-check-label" for="edit_icon6">
                                    <i class="fa-solid fa-diagnoses"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.editServiceBtn').on('click', function() {
            var serviceId = $(this).data('id');
            $('#editService').modal('show');

            $.get('/our-services/' + serviceId + '/edit', function(data) {
                $('#edit_id').val(data.id);
                $('#edit_name').val(data.name);
                $('#edit_desc').val(data.desc);
                $('input[name="icon"][value="' + data.icon + '"]').prop('checked', true);
                $('#editService').modal('show');
                $('#editServiceForm').attr('action', '/our-services/' + serviceId);
            });
        });
    });
</script>

