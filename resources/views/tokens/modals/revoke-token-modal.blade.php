<div class="modal fade" id="revokeTokenModal" tabindex="-1" role="dialog" aria-labelledby="revokeTokenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="revokeTokenModalLabel">Revoke API Token</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="revokeForm">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="revoke_user_id" class="form-label">ID atau Email User</label>
                        <input type="text" id="revoke_user_id" name="user_id" class="form-control" readonly>
                    </div>
                    <div class="form-group mb-4">
                        <label for="revoke_token_name" class="form-label">Nama Token</label>
                        <input type="text" id="revoke_token_name" name="token_name" class="form-control" readonly>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block" id="revokeButton">
                        <i class="fas fa-spinner fa-spin fa-xl loading-spinner-token d-none"></i>
                        Revoke Token
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.btn-revoke-token').on('click', function () {
        const user = $(this).data('user');
        const name = $(this).data('name');

        $('#revoke_user_id').val(user);
        $('#revoke_token_name').val(name);
        $('#tokenResult').addClass('d-none');
    });

    $('#revokeForm').on('submit', function (e) {
        e.preventDefault();

        $('#revokeButton').prop('disabled', true);
        $('.loading-spinner-token').removeClass('d-none');

        const user_id = $('#revoke_user_id').val();
        const token_name = $('#revoke_token_name').val();

        $.ajax({
            url: "{{ url('/revoke-token') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                user_id: user_id,
                token_name: token_name
            },
            success: function (response) {
                Swal.fire({
                    title: response.success ? 'Token Dicabut!' : 'Gagal!',
                    icon: response.success ? 'success' : 'error',
                    text: response.message,
                }).then(() => location.reload());
            },
            error: function (xhr) {
                let message = 'Terjadi kesalahan saat revoke token.';
                let title = 'Error';

                if (xhr.status === 403 || xhr.status === 401) {
                    title = 'Akses Ditolak';
                    message = xhr.responseJSON?.message ?? 'Anda tidak memiliki akses.';
                } else if (xhr.status === 404 && xhr.responseJSON?.message) {
                    title = 'User Tidak Ditemukan';
                    message = xhr.responseJSON.message;
                } else if (xhr.status === 422 && xhr.responseJSON.errors) {
                    title = 'Gagal';
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

                $('#revokeButton').prop('disabled', false);
                $('.loading-spinner-token').addClass('d-none');
            }
        });
    });
</script>
