
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
            background-color: #FF69B4;
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
            font-size: 24px;
            color: #FFEB3B;
            font-weight: bold;
        }

        /* Responsive styles */
        @media (min-width: 1024px) {
            .card img {
                width: 100px; /* Double the size for large screens */
                height: 100px;
            }
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: repeat(1, 1fr);
            }
            .logo {
                grid-column: span 1;
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
                <h3>SIMRS</h3>
            </a>
        </div>
        <div class="card">
            <a href="https://simgos.tanahbumbukab.go.id/apps/RegOnline" target="_blank">
                <img src="https://play-lh.googleusercontent.com/BlrmGYzr7rNTFMYLyNnk7RF2e8EpkY5aCI9kbXnhUZz9cZKW1vj9_ODLdTe3vDUy_Cg=w240-h480-rw" alt="Antrian Online Icon">
                <h3>Antrian Online</h3>
            </a>
        </div>
    </div>
</body>
</html>
