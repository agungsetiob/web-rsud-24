<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate API Token</title>
    <link rel="shortcut icon" href="{{ url('storage/logors.png') }}" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #005b96;
            color: #fff;
            padding: 30px;
            border-bottom: 0;
            text-transform: uppercase;
            font-weight: 600;
        }

        .card-body {
            padding: 40px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #ccc;
        }

        .btn-primary {
            background-color: #005b96;
            border: none;
            border-radius: 10px;
            padding: 15px;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #004080;
        }

        .footer-text {
            font-size: 14px;
            color: #555;
        }

        .footer-text a {
            color: #005b96;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 20px;
            }

            .footer-text {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Generate API Token</h3>
                    </div>
                    <div class="card-body">
                        <form id="tokenForm">
                            @csrf
                            <div class="mb-4">
                                <label for="user_id" class="form-label">ID atau Email User</label>
                                <input type="text" id="user_id" name="user_id" class="form-control"
                                    placeholder="Masukkan email user">
                            </div>
                            <div class="mb-4">
                                <label for="token_name" class="form-label">Nama Token</label>
                                <input type="text" id="token_name" name="token_name" class="form-control"
                                    placeholder="Contoh: akses_vue_client">
                            </div>

                            <button type="submit" class="btn btn-primary" id="generateTokenButton">
                                <i class="fas fa-spinner fa-spin fa-xl loading-spinner-token d-none"></i>
                                Generate Token
                            </button>
                        </form>

                        <div class="mt-4 d-none" id="tokenResult">
                            <label for="tokenOutput" class="form-label">Token Anda:</label>
                            <div class="input-group">
                                <input type="text" id="tokenOutput"
                                    class="form-control form-control fw-semibold bg-light text-dark border" readonly>
                                <button class="btn btn-outline-secondary" type="button" id="copyTokenBtn" title="Salin Token">
                                    <i class="fas fa-copy me-1 fa-2x"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="text-center mt-3">
                    <small class="footer-text">© 2024 API Management. Built with ❤️ by <a href="#">Agung
                            Setio</a>.</small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

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
                        // Akses tidak diizinkan
                        title = 'Akses Ditolak';
                        message = xhr.responseJSON?.message ?? 'Anda tidak memiliki akses.';
                    } else if (xhr.status === 404 && xhr.responseJSON?.message) {
                        // User tidak ditemukan
                        title = 'User Tidak Ditemukan';
                        message = xhr.responseJSON.message;
                    } else if (xhr.status === 422 && xhr.responseJSON.errors) {
                        // Validasi gagal
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
            // Copy to clipboard function
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
        });
    </script>
</body>

</html>