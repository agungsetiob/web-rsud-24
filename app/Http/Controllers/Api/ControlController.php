<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JadwalKontrol;
use App\Repositories\RencanaKontrolRepository;
use Illuminate\Http\Request;

class ControlController extends Controller
{
    protected $rencanaKontrolRepository;

    public function __construct(RencanaKontrolRepository $rencanaKontrolRepository)
    {
        $this->rencanaKontrolRepository = $rencanaKontrolRepository;
    }

    public function list(Request $request)
    {
        $noKartu = $request->input('noKartu');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun', date('Y'));

        if (!$noKartu || !$bulan || !$tahun) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor Kartu, Bulan, dan Tahun harus diisi!',
            ], 400);
        }

        $response = $this->rencanaKontrolRepository->getByNomorKartu($bulan, $tahun, $noKartu);

        if (isset($response['metaData']['code']) && $response['metaData']['code'] == 200) {
            return response()->json([
                'success'       => true,
                'suratKontrols' => $response['response']['list'],
                'message'       => 'Daftar surat kontrol berhasil diambil'
            ], 200);
        }

        return response()->json([
            'success'       => false,
            'message'       => $response['metaData']['message'] ?? 'Terjadi kesalahan pada repository.',
            'suratKontrols' => [],
        ], 400);
    }

    public function getControlByDateRange(Request $request)
    {
        $request->validate([
            'tglAwal'  => 'required|date',
            'tglAkhir' => 'required|date|after_or_equal:tglAwal',
            'filter'   => 'sometimes|integer'
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
                'success'    => $hasData,
                'data'       => $data,
                'total_data' => $data['total_data'] ?? 0,
                'message'    => $hasData 
                    ? 'Data rencana kontrol berhasil ditemukan' 
                    : 'Tidak ada data rencana kontrol yang memenuhi kriteria'
            ], $hasData ? 200 : 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data rencana kontrol: ' . $e->getMessage()
            ], 500);
        }
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
                'data'    => $jadwal,
                'message' => 'Data jadwal kontrol ditemukan'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'data'    => [],
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
                'data'    => $jadwal,
                'message' => 'Status berhasil diperbaiki'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
