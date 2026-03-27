<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    public function index(Request $request)
    {
        $today = \Carbon\Carbon::now()->translatedFormat('l');

        $services = Service::with('doctor')
            ->where('jenis', 'klinik')
            ->get();

        if ($today === 'Minggu') {
            foreach ($services as $service) {
                $service->doctor_id = null;
                $service->setRelation('doctor', null);
            }
        }
        if ($request->header('HX-Request')) {
            return view('main.poliklinik', compact('services', 'today'))->fragment('poliklinik');
        } else {
            return view('main.poliklinik', compact('services', 'today'));
        }
    }
}
