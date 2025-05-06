<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BPJS Rencana Kontrol')</title>
    
    <!-- Bootstrap & SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/logors.png') }}" type="image/x-icon" />
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 50px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .modal-content {
            border-radius: 10px;
        }
        .card-header {
            background-color: #005b96;
            color: #fff;
            padding: 30px;
            border-bottom: 0;
            text-transform: uppercase;
            font-weight: 600;
        }
        .form-control {
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #ccc;
        }
        .form-label {
            font-weight: 600;
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
        .modal-header .total-count {
            font-size: 0.8em;
            opacity: 0.8;
            margin-left: 10px;
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
    
    @stack('styles')
</head>
<body>
    @yield('content')
    
    <!-- jQuery, Bootstrap & SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    
    @stack('scripts')
</body>
</html>
