<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuranController extends Controller
{
    public function index()
    {
        $response = Http::withoutVerifying()->get('https://equran.id/api/surat');

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data dari API Al-Quran'
            ], 502);
        }

        return response()->json([
            'success' => true,
            'data'    => $response->json(),
            'message' => 'Daftar surat Al-Quran berhasil diambil'
        ], 200);
    }

    public function detailSurah(int $surah)
    {
        $response = Http::withoutVerifying()->get('https://equran.id/api/surat/' . $surah);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data surat'
            ], 502);
        }

        return response()->json([
            'success' => true,
            'data'    => $response->json(),
            'message' => "Detail Surat #{$surah} berhasil diambil"
        ], 200);
    }

    public function cariSurah(Request $request)
    {
        $request->validate([
            'cari' => 'required|string'
        ]);

        $ch = curl_init("https://al-quran-8d642.firebaseio.com/data.json?pretty=true");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data Al-Quran'
            ], 502);
        }

        $cari = trim(strtolower($request->cari));
        $found = [];
        foreach ($data as $v) {
            $nama = strtolower($v['nama']);
            if (strpos($nama, $cari) !== false) {
                $found[] = $v;
            }
        }

        return response()->json([
            'success' => true,
            'keyword' => $request->cari,
            'data'    => $found,
            'count'   => count($found),
            'message' => count($found) > 0 ? 'Hasil pencarian ditemukan' : 'Surah tidak ditemukan'
        ], 200);
    }
}
