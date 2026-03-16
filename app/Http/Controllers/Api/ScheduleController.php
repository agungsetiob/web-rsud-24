<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Schedule, Doctor};

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('doctor')->get()->groupBy('day');

        return response()->json([
            'success' => true,
            'data'    => $schedules,
            'message' => 'Jadwal dokter berhasil diambil'
        ], 200);
    }

    public function byDoctor($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Dokter tidak ditemukan',
            ], 404);
        }

        $schedules = Schedule::where('doctor_id', $id)->get();

        return response()->json([
            'success' => true,
            'data'    => [
                'doctor'    => $doctor,
                'schedules' => $schedules,
            ],
            'message' => 'Jadwal dokter berhasil diambil'
        ], 200);
    }

    public function byDay($day)
    {
        $schedules = Schedule::with('doctor')
            ->where('day', $day)
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $schedules,
            'message' => "Jadwal hari $day berhasil diambil"
        ], 200);
    }
}
