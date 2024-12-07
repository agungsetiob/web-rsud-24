<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPJS Check-In</title>
    <link rel="shortcut icon" href="{{asset('logors.png')}}" type="image/x-icon" />
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
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <small class="footer-text">© 2024 BPJS Integration. Built with ❤️ by <a href="#">Agung
                            Setio</a>.</small>
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

                // Show loading spinner and disable the button
                $('#submitButton').prop('disabled', true);
                $('.loading-spinner').removeClass('d-none');

                let kodebooking = $('#kodebooking').val();

                // Check if Geolocation is supported
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            // Retrieve latitude and longitude
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;

                            // Send the AJAX request with geolocation data
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
                                error: function (xhr) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Failed to process your request. Please try again later.',
                                        icon: 'error',
                                        confirmButtonText: 'Retry',
                                    });

                                    $('.loading-spinner').addClass('d-none');
                                    $('#submitButton').prop('disabled', false);
                                },
                            });
                        },
                        function (error) {
                            // Handle geolocation errors
                            let errorMessage = '';
                            switch (error.code) {
                                case error.PERMISSION_DENIED:
                                    errorMessage = 'You have denied access to location. Please enable it to proceed.';
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    errorMessage = 'Location information is unavailable.';
                                    break;
                                case error.TIMEOUT:
                                    errorMessage = 'Location request timed out.';
                                    break;
                                default:
                                    errorMessage = 'An unknown error occurred while accessing location.';
                                    break;
                            }

                            Swal.fire({
                                title: 'Location Error',
                                text: errorMessage,
                                icon: 'warning',
                                confirmButtonText: 'OK',
                            });

                            $('.loading-spinner').addClass('d-none');
                            $('#submitButton').prop('disabled', false);
                        }
                    );
                } else {
                    Swal.fire({
                        title: 'Geolocation Not Supported',
                        text: 'Your browser does not support geolocation. Please use a supported browser.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });

                    $('.loading-spinner').addClass('d-none');
                    $('#submitButton').prop('disabled', false);
                }
            });
        });

    </script>

</body>

</html>