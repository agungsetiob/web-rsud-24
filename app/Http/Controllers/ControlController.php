<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\RencanaKontrolRepository;
use Illuminate\Http\Request;
use Bpjs\Bridging\Vclaim\BridgeVclaim;

class ControlController extends Controller
{

    protected $rencanaKontrolRepository;

    public function __construct(RencanaKontrolRepository $rencanaKontrolRepository)
    {
        $this->rencanaKontrolRepository = $rencanaKontrolRepository;
    }

    public function index()
    {
        return view('bpjs.controls');
    }

    public function list(Request $request)
    {
        $noKartu = $request->input('noKartu');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun', date('Y'));

        if (!$noKartu || !$bulan || !$tahun) {
            return response()->json([
                'message' => 'Nomor Kartu, Bulan, dan Tahun harus diisi!',
            ], 400);
        }

        $response = $this->rencanaKontrolRepository->getByNomorKartu($bulan, $tahun, $noKartu);

        if (isset($response['metaData']['code']) && $response['metaData']['code'] == 200) {
            session(['suratKontrols' => $response['response']['list']]);
            return response()->json([
                'suratKontrols' => $response['response']['list'],
            ]);
        }

        return response()->json([
            'message' => $response['metaData']['message'] ?? 'Terjadi kesalahan.',
            'suratKontrols' => [],
        ], 400);
    }

    public function cetakSuratKontrol(Request $request)
    {
        $noSuratKontrol = $request->query('noSuratKontrol');

        // Validasi input
        if (!$noSuratKontrol) {
            return abort(400, 'Nomor Surat Kontrol harus diisi!');
        }

        // Ambil data JSON dari sesi atau permintaan sebelumnya
        $suratKontrols = session('suratKontrols', []); // Pastikan data ini telah disimpan di sesi
        $suratKontrol = collect($suratKontrols)->firstWhere('noSuratKontrol', $noSuratKontrol);

        if (!$suratKontrol) {
            return abort(404, 'Data Surat Kontrol tidak ditemukan.');
        }

        // Ambil data peserta melalui RencanaKontrolRepository
        $noKartu = $suratKontrol['noKartu'] ?? '-';
        $pesertaData = $this->rencanaKontrolRepository->pesertaByNomor($noKartu);

        if (
            !$pesertaData ||
            !isset($pesertaData['metaData']['code']) ||
            $pesertaData['metaData']['code'] != 200
        ) {
            return abort(500, 'Gagal mendapatkan data peserta.');
        }

        $peserta = $pesertaData['response']['peserta'];
        $no_rm = $peserta['mr']['noMR'] ?? '-';
        $tanggal_lahir = $peserta['tglLahir'] ?? '-';

        // Ubah tanggal surat dan tanggal lahir ke format Indonesia
        $tanggalSurat = $suratKontrol['tglTerbitKontrol'] ?? date('Y-m-d');
        $tanggalSuratIndonesia = $this->formatTanggalIndonesia($tanggalSurat);
        $tanggalLahirIndonesia = $this->formatTanggalIndonesia($tanggal_lahir);

        // Persiapkan data untuk view
        $data = [
            'noSuratKontrol' => $suratKontrol['noSuratKontrol'] ?? '-',
            'tglRencanaKontrol' => $suratKontrol['tglRencanaKontrol'],
            'noKartu' => $suratKontrol['noKartu'] ?? '-',
            'nama' => $suratKontrol['nama'] ?? '-',
            'no_rm' => $no_rm,
            'tanggal_lahir' => $tanggalLahirIndonesia,
            'tujuan' => $suratKontrol['namaPoliTujuan'] ?? '-',
            'dokter' => $suratKontrol['namaDokter'] ?? '-',
            'tanggal_surat' => $tanggalSuratIndonesia,
        ];

        return view('bpjs.surkon', compact('data'));
    }

    private function formatTanggalIndonesia($tanggal)
    {
        // Validasi format tanggal
        $timestamp = strtotime($tanggal); // Konversi string tanggal menjadi timestamp
        if (!$timestamp) {
            return $tanggal; // Kembalikan input asli jika konversi gagal
        }

        // Nama bulan dalam bahasa Indonesia
        $bulanIndo = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $hari = date('d', $timestamp); // Ambil tanggal
        $bulan = date('n', $timestamp); // Ambil bulan (tanpa leading zero)
        $tahun = date('Y', $timestamp); // Ambil tahun

        return "{$hari} {$bulanIndo[$bulan]} {$tahun}";
    }

}