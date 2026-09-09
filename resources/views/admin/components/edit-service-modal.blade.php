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
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon1"
                                    value="fa-user-doctor" required>
                                <label class="form-check-label" for="edit_icon1">
                                    <i class="fas fa-user-md"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon2"
                                    value="fa-truck-medical" required>
                                <label class="form-check-label" for="edit_icon2">
                                    <i class="fa-solid fa-ambulance"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon3"
                                    value="fa-hospital" required>
                                <label class="form-check-label" for="edit_icon3">
                                    <i class="fa-solid fa-hospital"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon4"
                                    value="fa-briefcase-medical" required>
                                <label class="form-check-label" for="edit_icon4">
                                    <i class="fa-solid fa-briefcase-medical"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon5"
                                    value="fa-stethoscope" required>
                                <label class="form-check-label" for="edit_icon5">
                                    <i class="fa-solid fa-stethoscope"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="icon" id="edit_icon6"
                                    value="fa-diagnoses" required>
                                <label class="form-check-label" for="edit_icon6">
                                    <i class="fa-solid fa-diagnoses"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <div>
                            <!-- Jenis radio buttons -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis" id="edit_jenis1"
                                    value="klinik" required>
                                <label class="form-check-label" for="edit_jenis1">
                                    <p class="mb-0">Klinik</p>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis" id="edit_jenis2"
                                    value="non-klinik" required>
                                <label class="form-check-label" for="edit_jenis2">
                                    <p class="mb-0">Non Klinik</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_schedule_date">Tanggal Jadwal</label>
                        <input type="date" name="schedule_date" class="form-control" id="edit_schedule_date" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_doctor_id">Dokter Jaga</label>
                        <select name="doctor_id" id="edit_doctor_id" class="form-control">
                            <option value="" disabled>Pilih Dokter</option>
                            @foreach($doctors as $doc)
                            <option value="{{ $doc->id }}">{{ $doc->name }} - {{ $doc->specialization }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="btn btn-warning" id="closeClinicBtn">Tutup Klinik</button>
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
                $('input[name="jenis"][value="' + data.jenis + '"]').prop('checked', true);

                var selectizeDoctor = $('#edit_doctor_id')[0].selectize;
                if (selectizeDoctor) {
                    selectizeDoctor.setValue(data.doctor_id);
                } else {
                    $('#edit_doctor_id').val(data.doctor_id);
                }

                if (data.schedule_date) {
                    $('#edit_schedule_date').val(data.schedule_date);
                }

                $('#editServiceForm').attr('action', '/our-services/' + serviceId);
            });
        });

        $('#edit_doctor_id').selectize({
            create: false,
            sortField: 'text',
            placeholder: 'Cari Dokter...'
        });

        $('#editServiceForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(resp) {
                    showAlert('success', 'Service updated successfully!');
                    $('#editService').modal('hide');
                    location.reload();
                },
                error: function() {
                    $('<div class="alert alert-danger mt-3">Gagal memperbarui jadwal!</div>')
                        .insertAfter('#editServiceForm')
                        .delay(3000).fadeOut();
                }
            });
        });

        $('#closeClinicBtn').on('click', function() {
            var serviceId = $('#edit_id').val();
            $.ajax({
                url: "{{ url('our-services') }}/" + serviceId,
                type: 'PUT',
                data: {
                    _token: $('input[name="_token"]').val(),
                    _method: 'PUT',
                    name: $('#edit_name').val(),
                    desc: $('#edit_desc').val(),
                    icon: $('input[name="icon"]:checked').val(),
                    jenis: $('input[name="jenis"]:checked').val(),
                    doctor_id: null,
                    schedule_date: $('#edit_schedule_date').val()
                },
                success: function() {
                    $('<div class="alert alert-success mt-3">Klinik berhasil ditutup & jadwal diperbarui!</div>')
                        .insertAfter('#editServiceForm')
                        .delay(3000).fadeOut();
                },
                error: function() {
                    $('<div class="alert alert-danger mt-3">Gagal menutup klinik</div>')
                        .insertAfter('#editServiceForm')
                        .delay(3000).fadeOut();
                }
            });
        });

        function showAlert(type, message) {
            var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            $('<div class="alert ' + alertClass + ' mt-3">' + message + '</div>')
                .insertBefore('#dataTable')
                .delay(3000).fadeOut();
        }
    });
</script>