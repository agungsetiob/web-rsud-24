<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\RencanaKontrolRepository;
use Illuminate\Http\Request;
use App\Models\JadwalKontrol;

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

        $suratKontrols = session('suratKontrols', []);
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

        $tanggalSurat = $suratKontrol['tglTerbitKontrol'] ?? date('Y-m-d');
        $tanggalSuratIndonesia = $this->formatTanggalIndonesia($tanggalSurat);
        $tanggalLahirIndonesia = $this->formatTanggalIndonesia($tanggal_lahir);

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
        $timestamp = strtotime($tanggal);
        if (!$timestamp) {
            return $tanggal;
        }

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
        $bulan = date('n', $timestamp); // Ambil bulan
        $tahun = date('Y', $timestamp); // Ambil tahun

        return "{$hari} {$bulanIndo[$bulan]} {$tahun}";
    }

    public function controlByDate()
    {
        return view('bpjs.control-by-date');
    }

    // public function getControlByDateRange(Request $request)
    // {
    //     $request->validate([
    //         'tglAwal' => 'required|date',
    //         'tglAkhir' => 'required|date|after_or_equal:tglAwal',
    //         'filter' => 'sometimes|integer'
    //     ]);

    //     try {
    //         $tglAwal = $request->input('tglAwal');
    //         $tglAkhir = $request->input('tglAkhir');
    //         $filter = $request->input('filter', 2);

    //         $data = $this->rencanaKontrolRepository->getByDateRange($tglAwal, $tglAkhir, $filter);

    //         return response()->json([
    //             'success' => true,
    //             'data' => $data,
    //             'message' => 'Data rencana kontrol berhasil ditemukan'
    //         ]);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal mengambil data rencana kontrol: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function getControlByDateRange(Request $request)
    {
        $request->validate([
            'tglAwal' => 'required|date',
            'tglAkhir' => 'required|date|after_or_equal:tglAwal',
            'filter' => 'sometimes|integer'
        ]);
    
        try {
            $tglAwal = $request->input('tglAwal');
            $tglAkhir = $request->input('tglAkhir');
            $filter = $request->input('filter', 2);
    
            $data = $this->rencanaKontrolRepository->getByDateRange($tglAwal, $tglAkhir, $filter);
    
            $hasData = isset($data['metaData']['code']) && 
                       $data['metaData']['code'] === '200' && 
                       !empty($data['response']['list']);
    
            return response()->json([
                'success' => $hasData,
                'data' => $data,
                'total_data' => $data['total_data'] ?? 0,
                'message' => $hasData 
                    ? 'Data rencana kontrol berhasil ditemukan' 
                    : 'Tidak ada data rencana kontrol yang memenuhi kriteria'
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data rencana kontrol: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cariKontrol()
    {
        return view('bpjs.fix-control');
    }

    public function search(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string',
        ]);
    
        $jadwal = JadwalKontrol::where('nomor', $request->nomor)->get();
    
        if ($jadwal->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $jadwal
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);
    
        try {
            $jadwal = JadwalKontrol::findOrFail($request->id);
            
            $jadwal->update(['SUDAH_DIGUNAKAN' => 0]);
    
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbaiki',
                'data' => $jadwal
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }    
    
}