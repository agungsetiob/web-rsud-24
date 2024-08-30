<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSUD DHAAN</title>
    <link rel="shortcut icon" href="https://rsud.tanahbumbukab.go.id/img/logo.png" type="image/x-icon"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to right, violet, #00008b);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }
        .container {
            max-width: 1000px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
            padding: 20px;
        }
        .card {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .card a {
            text-decoration: none;
        }
        .card img {
            width: 50px;
            height: 50px;
            transition: width 0.3s, height 0.3s; /* Smooth transition for resizing */
        }
        .card h3 {
            margin: 15px 0 0;
            font-size: 18px;
            color: #4A00E0;
        }
        .logo {
            grid-column: span 3;
            text-align: left;
            font-size: 29px;
            color: #FFEB3B;
            font-weight: bold;
        }

        /* Effect when hovering */
        .card:hover {
            background-color: #f0f0f0;
            transform: scale(1.05); /* Slight zoom effect */
        }

        /* Responsive styles */
        @media (min-width: 1024px) {
            .container {
                max-width: 1200px;
                grid-template-columns: repeat(3, 1fr);
            }
            .card {
                padding: 30px;
            }
            .card img {
                width: 100px; /* Double the size for large screens */
                height: 100px;
            }
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: repeat(2, 1fr);
            }
            .logo {
                grid-column: span 2;
            }
        }

        @media (max-width: 480px) {
            .container {
                grid-template-columns: 1fr;
            }
            .logo {
                grid-column: span 1;
                text-align: center;
            }
            .card h3 {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">RSUD dr. H. Andi Abdurrahman Noor</div>
        <div class="card">
            <a href="/home" target="_blank">
                <img src="https://rsud.tanahbumbukab.go.id/storage/logors.png" alt="Website RSUD Icon">
                <h3>Website RSUD</h3>
            </a>
        </div>
        <div class="card">
            <a href="https://simgos.tanahbumbukab.go.id/" target="_blank">
                <img src="https://simgos.tanahbumbukab.go.id/apps/RegOnline/public/img/simgos-icon.png" alt="SIMRS Icon">
                <h3>SIMRS (Sistem Informasi Manajemen Rumah Sakit)</h3>
            </a>
        </div>
        <div class="card">
            <a href="https://simgos.tanahbumbukab.go.id/apps/RegOnline" target="_blank">
                <img src="{{asset('img/pentol.png')}}" alt="Antrian Online Icon">
                <h3>PAMANPENTOL (Aplikasi Manajemen Antrian dan Pendaftaran Online)</h3>
            </a>
        </div>
    </div>
</body>
</html>
