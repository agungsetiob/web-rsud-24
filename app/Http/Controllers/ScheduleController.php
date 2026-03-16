<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('doctor')->get();
        $doctors = Doctor::all();
        return view('schedules.index', compact('schedules', 'doctors'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        return view('schedules.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit(Schedule $schedule)
    {
        $doctors = Doctor::all();
        return view('schedules.edit', compact('schedule', 'doctors'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus');
    }
}
