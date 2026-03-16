<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::inRandomOrder()->limit(8)->get();

        return response()->json([
            'success' => true,
            'data'    => $doctors,
            'message' => 'Berhasil mengambil daftar dokter (acak)'
        ], 200);
    }

    public function spesialis()
    {
        $doctors = Doctor::latest()->where('category', 'spesialis')->get();

        return response()->json([
            'success' => true,
            'data'    => $doctors,
            'message' => 'Berhasil mengambil daftar dokter spesialis'
        ], 200);
    }

    public function umum()
    {
        $doctors = Doctor::latest()->where('category', 'umum')->get();

        return response()->json([
            'success' => true,
            'data'    => $doctors,
            'message' => 'Berhasil mengambil daftar dokter umum'
        ], 200);
    }
}
