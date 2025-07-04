<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revoke API Token</title>
    <link rel="shortcut icon" href="{{ url('storage/logors.png') }}" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .card { border-radius: 15px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        .card-header { background-color: #c0392b; color: #fff; padding: 30px; border-bottom: 0; text-transform: uppercase; font-weight: 600; }
        .card-body { padding: 40px; }
        .form-label { font-weight: 600; }
        .form-control { border-radius: 10px; padding: 15px; border: 1px solid #ccc; }
        .btn-danger { background-color: #c0392b; border: none; border-radius: 10px; padding: 15px; width: 100%; font-size: 16px; transition: background-color 0.3s; }
        .btn-danger:hover { background-color: #96281b; }
        .footer-text { font-size: 14px; color: #555; }
        .footer-text a { color: #c0392b; text-decoration: none; }
        .footer-text a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-8 col-sm-10">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Revoke API Token</h3>
                </div>
                <div class="card-body">
                    <form id="revokeForm">
                        @csrf
                        <div class="mb-4">
                            <label for="user_id" class="form-label">ID atau Email User</label>
                            <input type="text" id="user_id" name="user_id" class="form-control" placeholder="Masukkan ID atau email user..." required>
                        </div>
                        <div class="mb-4">
                            <label for="token_name" class="form-label">Nama Token</label>
                            <input type="text" id="token_name" name="token_name" class="form-control" placeholder="Contoh: akses_vue_client" required>
                        </div>
                        <button type="submit" class="btn btn-danger" id="revokeButton">
                            <i class="fas fa-spinner fa-spin fa-xl loading-spinner-token d-none"></i>
                            Revoke Token
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <small class="footer-text">© 2024 API Management. Built with ❤️ by <a href="#">Agung Setio</a>.</small>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    $('#revokeForm').on('submit', function (e) {
        e.preventDefault();

        $('#revokeButton').prop('disabled', true);
        $('.loading-spinner-token').removeClass('d-none');

        const user_id = $('#user_id').val();
        const token_name = $('#token_name').val();

        $.ajax({
            url: "{{ url('/revoke-token') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                user_id: user_id,
                token_name: token_name
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Token Dicabut!',
                        icon: 'success',
                        text: response.message,
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        icon: 'error',
                        text: response.message,
                    });
                }

                $('#revokeButton').prop('disabled', false);
                $('.loading-spinner-token').addClass('d-none');
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    icon: 'error',
                    text: 'Terjadi kesalahan saat mencabut token.',
                });

                $('#revokeButton').prop('disabled', false);
                $('.loading-spinner-token').addClass('d-none');
            }
        });
    });
</script>
</body>
</html>
