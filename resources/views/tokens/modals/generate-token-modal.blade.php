<div class="modal fade" id="generateTokenModal" tabindex="-1" role="dialog" aria-labelledby="generateTokenModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="generateTokenModalLabel">Generate API Token</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tokenForm">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="user_id" class="form-label">ID atau Email User</label>
                        <input type="text" id="user_id" name="user_id" class="form-control"
                            placeholder="Masukkan email user">
                    </div>
                    <div class="form-group mb-4">
                        <label for="token_name" class="form-label">Nama Token</label>
                        <input type="text" id="token_name" name="token_name" class="form-control"
                            placeholder="Contoh: akses_vue_client">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" id="generateTokenButton">
                        <i class="fas fa-spinner fa-spin fa-xl loading-spinner-token d-none"></i>
                        Generate Token
                    </button>
                </form>

                <div class="mt-4 d-none" id="tokenResult">
                    <label for="tokenOutput" class="form-label">Token Anda:</label>
                    <div class="input-group">
                        <input type="text" id="tokenOutput"
                            class="form-control font-weight-bold bg-light text-dark border" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="copyTokenBtn"
                                title="Salin Token">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#tokenForm').on('submit', function (e) {
        e.preventDefault();

        $('#generateTokenButton').prop('disabled', true);
        $('.loading-spinner-token').removeClass('d-none');

        let user_id = $('#user_id').val();
        let token_name = $('#token_name').val();

        $.ajax({
            url: "{{ url('/generate-token') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                user_id: user_id,
                token_name: token_name
            },
            success: function (response) {
                if (response.success) {
                    $('#tokenOutput').val(response.token);
                    $('#tokenResult').removeClass('d-none');

                    Swal.fire({
                        title: 'Token Berhasil Dibuat!',
                        icon: 'success',
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        icon: 'error',
                        text: response.message,
                    });
                }

                $('#generateTokenButton').prop('disabled', false);
                $('.loading-spinner-token').addClass('d-none');
            },
            error: function (xhr) {
                let message = 'Terjadi kesalahan saat generate token.';
                let title = 'Error';

                if (xhr.status === 403 || xhr.status === 401) {
                    title = 'Akses Ditolak';
                    message = xhr.responseJSON?.message ?? 'Anda tidak memiliki akses.';
                } else if (xhr.status === 404 && xhr.responseJSON?.message) {
                    title = 'User Tidak Ditemukan';
                    message = xhr.responseJSON.message;
                } else if (xhr.status === 422 && xhr.responseJSON.errors) {
                    title = 'Validasi Gagal';
                    const errors = xhr.responseJSON.errors;
                    message = Object.entries(errors)
                        .map(([field, msgs]) => `<strong>${field}:</strong> ${msgs.join(', ')}`)
                        .join('<br>');
                }

                Swal.fire({
                    title: title,
                    icon: 'error',
                    html: message,
                });

                $('#generateTokenButton').prop('disabled', false);
                $('.loading-spinner-token').addClass('d-none');
            }
        });
    });

    $('#copyTokenBtn').on('click', function () {
        let tokenField = document.getElementById("tokenOutput");
        tokenField.select();
        tokenField.setSelectionRange(0, 99999);

        document.execCommand("copy");

        Swal.fire({
            title: 'Token Tersalin!',
            icon: 'success',
            text: 'Token berhasil disalin ke clipboard.',
            timer: 1500,
            showConfirmButton: false
        });
    });
</script>