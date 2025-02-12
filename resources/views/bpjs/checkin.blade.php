<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPJS Check-In</title>
    <link rel="shortcut icon" href="{{url ('storage/logors.png')}}" type="image/x-icon" />
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
        .btn-danger {
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

        .loading-spinner {
            /* display: none; */
            margin-right: 10px;
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
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>BPJS Check-In</h3>
                    </div>
                    <div class="card-body">
                        <form id="checkinForm">
                            @csrf
                            <div class="mb-4">
                                <label for="kodebooking" class="form-label">Kode Booking</label>
                                <input type="text" id="kodebooking" name="kodebooking" class="form-control"
                                    placeholder="Masukkan kode booking..." required>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submitButton">
                                <i class="fas fa-spinner fa-spin fa-xl loading-spinner d-none"></i>
                                Check-In
                            </button>
                            <button type="button" class="btn btn-danger mt-2" id="cancelButton">
                                <i class="fas fa-spinner fa-spin fa-xl loading-spinner-cancel d-none"></i>
                                Batal Antrian
                            </button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <small class="footer-text">© 2024 BPJS Integration. Built with ❤️ by <a href="#">Agung Setio</a>.</small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#checkinForm').on('submit', function (e) {
                e.preventDefault();

                $('#submitButton').prop('disabled', true);
                $('.loading-spinner').removeClass('d-none');

                let kodebooking = $('#kodebooking').val();

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;

                            $.ajax({
                                url: "{{ url('/check-in') }}",
                                method: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    kodebooking: kodebooking,
                                    latitude: latitude,
                                    longitude: longitude,
                                },
                                success: function (response) {
                                    let iconType = response.metadata.code === 200 ? 'success' : 'warning';
                                    let title = response.metadata.code === 200
                                        ? `Checkin Kode Booking <span style='color:blue'>${kodebooking}</span> Berhasil`
                                        : 'Oops!';
                                    let message = response.metadata.message;

                                    Swal.fire({
                                        title: title,
                                        text: message,
                                        icon: iconType,
                                        confirmButtonText: 'OK',
                                    });

                                    $('.loading-spinner').addClass('d-none');
                                    $('#submitButton').prop('disabled', false);
                                },
                                error: function () {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Gagal melakukan check-in, coba lagi nanti.',
                                        icon: 'error',
                                        confirmButtonText: 'Retry',
                                    });

                                    $('.loading-spinner').addClass('d-none');
                                    $('#submitButton').prop('disabled', false);
                                },
                            });
                        },
                        function (error) {
                            Swal.fire({
                                title: 'Error Lokasi',
                                text: 'Gagal mendapatkan lokasi, silakan aktifkan GPS!',
                                icon: 'warning',
                                confirmButtonText: 'OK',
                            });

                            $('.loading-spinner').addClass('d-none');
                            $('#submitButton').prop('disabled', false);
                        }
                    );
                }
            });

            $('#cancelButton').on('click', function () {
                let kodebooking = $('#kodebooking').val();

                if (!kodebooking) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Kode Booking harus diisi!',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                    return;
                }

                $('#cancelButton').prop('disabled', true);
                $('.loading-spinner-cancel').removeClass('d-none');

                $.ajax({
                    url: "{{ url('/batal-antrian') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodebooking: kodebooking,
                    },
                    success: function (response) {
                        let iconType = response.metadata.code === 200 ? 'success' : 'warning';
                        let title = response.metadata.code === 200
                            ? `Antrian Kode Booking <span style='color:red'>${kodebooking}</span> Dibatalkan`
                            : 'Oops!';
                        let message = response.metadata.message;

                        Swal.fire({
                            title: title,
                            text: message,
                            icon: iconType,
                            confirmButtonText: 'OK',
                        });

                        $('.loading-spinner-cancel').addClass('d-none');
                        $('#cancelButton').prop('disabled', false);
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal membatalkan antrian, coba lagi nanti.',
                            icon: 'error',
                            confirmButtonText: 'Retry',
                        });

                        $('.loading-spinner-cancel').addClass('d-none');
                        $('#cancelButton').prop('disabled', false);
                    },
                });
            });
        });
    </script>
</body>
</html>