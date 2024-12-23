<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Rencana Kontrol</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{url ('storage/logors.png')}}" type="image/x-icon" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 20px;
        }

        .header {
            text-align: center;
            font-weight: bold;
            position: relative;
        }

        .header img {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 100px;
        }

        .header h5,
        .header h6 {
            margin: 0;
        }

        .no-surat {
            position: absolute;
            right: 0;
            top: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .info-table {
            margin-top: 20px;
            font-size: 14px;
        }

        .info-table td {
            padding: 5px;
            vertical-align: top;
        }

        .footer {
            margin-top: 50px;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
        }

        .footer .info {
            flex: 1;
        }

        .footer .signature {
            text-align: right;
            flex: 1;
        }

        .top {
            padding-top: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header top">
            <img src="https://bpjs-checkin.test/logors.png" alt="Logo RS">
            <div class="no-surat">
                {{ $data['noSuratKontrol'] }}
            </div>
            <h5><strong>RSUD DR. H. ANDI ABDURRAHMAN NOOR</strong></h5>
            <h6><strong>SURAT RENCANA KONTROL</strong></h6>
        </div>
        <div class="info-table">
            <p>Surat Keterangan Rencana Kontrol ini digunakan 1 (Satu) kali kunjungan pada:</p>
            <table class="table table-borderless">
                <tr>
                    <td width="20%">Tanggal</td>
                    <td>: {{ $data['tglRencanaKontrol'] }} & Estimasi Jam Pelayanan Belum ada, Silahkan ambil antrian</td>
                </tr>
            </table>
            <p>Untuk Pasien dengan:</p>
            <table class="table table-borderless">
                <tr>
                    <td width="20%">No. Kartu</td>
                    <td>: {{ $data['noKartu'] }}</td>
                </tr>
                <tr>
                    <td>Nama / NO. RM</td>
                    <td>: {{ $data['nama'] }} / {{ $data['no_rm'] }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>: {{ $data['tanggal_lahir'] }}</td>
                </tr>
                <tr>
                    <td>Tujuan</td>
                    <td>: {{ $data['tujuan'] }}</td>
                </tr>
                <tr>
                    <td>Dokter</td>
                    <td>: {{ $data['dokter'] }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <div class="info">
                <p><strong>Untuk Pasien berusia diatas 17 Tahun wajib melakukan Verifikasi Sidik Jari sebelum melakukan pendaftaran</strong></p>
            </div>
            <div class="signature">
                <p style="padding-bottom:50px;">{{ $data['dokter'] }}</p>
                <p class="signature">TANAH BUMBU, {{ $data['tanggal_surat'] }}</p>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
