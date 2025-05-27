<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if ($data['jnsKontrol'] == '1')
            Surat Rencana Inap
        @elseif ($data['jnsKontrol'] == '2')
            Surat Rencana Kontrol
        @else
            Surat Rencana
        @endif
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{ url('storage/logors.png') }}" type="image/x-icon" />
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
            @if ($data['jnsKontrol'] == '1')
                <h6><strong>SURAT RENCANA INAP</strong></h6>
            @elseif ($data['jnsKontrol'] == '2')
                <h6><strong>SURAT RENCANA KONTROL</strong></h6>
            @else
                <h6><strong>SURAT RENCANA</strong></h6>
            @endif
        </div>

        <div class="info-table">
            @if ($data['jnsKontrol'] == '1')
                <p>Surat ini merupakan surat rencana rawat inap yang diberikan kepada pasien dengan jadwal masuk rawat inap sebagai berikut:</p>
                <table class="table table-borderless">
                    <tr>
                        <td width="20%">Tanggal Masuk</td>
                        <td>: {{ $data['tglRencanaKontrol'] }} (Estimasi waktu masuk akan diinformasikan lebih lanjut)</td>
                    </tr>
                </table>
            @elseif ($data['jnsKontrol'] == '2')
                <p>Surat Keterangan Rencana Kontrol ini digunakan untuk 1 (satu) kali kunjungan kontrol pada:</p>
                <table class="table table-borderless">
                    <tr>
                        <td width="20%">Tanggal</td>
                        <td>: {{ $data['tglRencanaKontrol'] }} & Estimasi Jam Pelayanan Belum tersedia, silakan ambil antrian</td>
                    </tr>
                </table>
            @endif

            <p>Data pasien sebagai berikut:</p>
            <table class="table table-borderless">
                <tr>
                    <td width="20%">No. Kartu</td>
                    <td>: {{ $data['noKartu'] }}</td>
                </tr>
                <tr>
                    <td>Nama / No. RM</td>
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
                @if ($data['jnsKontrol'] == '2')
                    <p><strong>Untuk pasien berusia di atas 17 tahun wajib melakukan verifikasi sidik jari sebelum melakukan pendaftaran.</strong></p>
                @endif
            </div>
            <div class="signature">
                <p style="padding-bottom:50px;">{{ $data['dokter'] }}</p>
                <p>TANAH BUMBU, {{ $data['tanggal_surat'] }}</p>
            </div>
        </div>
    </div>

    <script>
        window.onload = function () {
            window.print();
        }
    </script>
</body>

</html>
