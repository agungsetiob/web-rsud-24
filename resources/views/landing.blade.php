<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPLAYER - RSUD</title>
    <link rel="shortcut icon" href="https://rsud.tanahbumbukab.go.id/img/logo.png" type="image/x-icon" />
    <style>
        /* Your existing styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to right, violet, #00008b);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            overflow-x: hidden;
        }

        .container {
            max-width: 1000px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
            padding: 20px;
            width: 100%;
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
            transition: transform 0.3s ease, background-image 0.7s ease;
            max-width: 100%;
        }

        .card a {
            text-decoration: none;
        }

        .card img {
            width: 50px;
            height: 50px;
            transition: width 0.3s, height 0.3s;
            max-width: 100%;
            height: auto;
        }

        .card h3 {
            margin: 15px 0 0;
            font-size: 18px;
            color: #4A00E0;
        }

        .logo {
            grid-column: span 2;
            text-align: left;
            font-size: 29px;
            color: #FFEB3B;
            font-weight: bold;
        }

        .card:hover {
            background-color: #f0f0f0;
            background-image: linear-gradient(#0074e5, #ff8a00);
            transform: scale(1.05);
        }

        @media (min-width: 1024px) {
            .container {
                max-width: 1200px;
                grid-template-columns: repeat(2, 1fr);
            }

            .card {
                padding: 30px;
            }

            .card img {
                width: 100px;
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

        footer {
            color: white;
            padding: 15px 20px;
            text-align: center;
            font-size: 14px;
            width: 100%;
        }

        .disabled {
            cursor: not-allowed;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
            text-align: center;
            position: relative;
            animation: fadeIn 0.5s ease;
        }

        .modal-content img {
            width: 100px;
            height: auto;
            margin-bottom: 5px;
        }

        .modal-content h2 {
            color: #4A00E0;
            margin-top: 10px;
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            color: #333;
            cursor: pointer;
        }

        .pb {
            padding-bottom: 9px;
        }

        .pb a {
            text-decoration: none;
        }

        /* Keyframe animation for modal */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
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
                <img src="https://simgos.tanahbumbukab.go.id/apps/RegOnline/public/img/simgos-icon.png"
                    alt="SIMRS Icon">
                <h3>SIMRS (Sistem Informasi Manajemen Rumah Sakit)</h3>
            </a>
        </div>
        <!-- PAMANPENTOL Card -->
        <div class="card">
            <a href="javascript:void(0)" onclick="openModal()">
                <img src="{{asset('img/pamanpentol.png')}}" alt="Antrian Online Icon">
                <h3>PAMANPENTOL (Aplikasi Manajemen Antrian dan Pendaftaran Online)</h3>
            </a>
        </div>
        <div class="card disabled">
            <a class="disabled" href="javascript:void(0)">
                <img src="{{asset('img/palkon.png')}}" alt="Palkon Online Icon">
                <h3>SIPALKON (Sistem Pengingat Jadwal Kontrol)</h3>
            </a>
        </div>
        <div class="card disabled">
            <a class="disabled" href="javascript:void(0)">
                <img src="{{asset('img/supriadi.svg')}}" alt="Supriadi Online Icon">
                <h3>e-SUPRIADI (Surat Perintah Perjalanan Dinas Online)</h3>
            </a>
        </div>
        <div class="card disabled">
            <a class="disabled" href="javascript:void(0)">
                <h3 style="text-align: left; color: black;">Tentang Sistem</h3>
                <p style="text-align: justify; color: black;">
                    Sistem Integrasi Pelayanan dan Administrasi Elektronik (SIPLAYER)
                    merupakan sebuah inovasi dari RSUD dr. H. Andi Abdurrahman Noor untuk mengintegrasikan
                    pelayanan dan administrasi secara elektronik demi
                    mewujudkan pelayanan yang lebih baik untuk masyarakat.
                </p>
            </a>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal" id="pamanpentolModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <div class="pb">
                <a href="https://play.google.com/store/apps/details?id=app.bpjs.mobile&hl=id">
                    <img src="https://play-lh.googleusercontent.com/BlrmGYzr7rNTFMYLyNnk7RF2e8EpkY5aCI9kbXnhUZz9cZKW1vj9_ODLdTe3vDUy_Cg=w240-h480-rw" alt="Website RSUD Logo">
                    <h2>Mobile JKN</h2>
                </a>
                <p>Ambil antrian online via mobile jkn khusus untuk pasien bpjs</p>
            </div>
            <div class="pb">
                <a href="https://simgos.tanahbumbukab.go.id/apps/RegOnline/" style="margin-top: 20px;">
                    <img src="https://rsud.tanahbumbukab.go.id/storage/logors.png" alt="Website RSUD Logo">
                    <h2>Web Antrol</h2>
                </a>
                <p>Ambil antrian via web antrol untuk pasien umum dan bpjs</p>
            </div>
        </div>
    </div>


    <footer>
        <p>&copy; 2024 RSUD dr. H. Andi Abdurrahman Noor</p>
    </footer>

    <script>
        // JavaScript for modal functionality
        function openModal() {
            document.getElementById("pamanpentolModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("pamanpentolModal").style.display = "none";
        }

        // Close the modal when clicking outside the modal content
        window.onclick = function (event) {
            const modal = document.getElementById("pamanpentolModal");
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>