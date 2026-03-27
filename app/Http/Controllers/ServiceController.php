<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;
use Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            // ambil service beserta dokter
            $services = Service::with('doctor')->get();
            $doctors = Doctor::all(); // untuk dropdown di view
            return view('admin.our-services', compact('services', 'doctors'));
        } else {
            return redirect()->back()->with(['error' => 'ojo dibandingke!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:services|string|max:255',
            'desc' => 'required|string',
            'icon' => 'required|string',
            'jenis' => 'nullable|string',
            'doctor_id' => 'nullable|exists:doctors,id', // validasi dokter
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->desc = $request->desc;
        $service->icon = $request->icon;
        $service->jenis = $request->jenis;
        $service->doctor_id = $request->doctor_id; // simpan dokter jaga
        $service->save();

        return redirect()->back()->with(['success' => 'Service created successfully!']);
    }


    /**
     * Display the specified resource.
     */
    public function allServices(Request $request)
    {
        $services = Service::all();
        if ($request->header('HX-Request')) {
            return view('main.services', compact('services'))->fragment('services');
        } else {
            return view('main.services', compact('services'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'icon' => 'required|string',
            'jenis' => 'nullable|string',
            'doctor_id' => 'nullable|exists:doctors,id',
        ]);

        $service = Service::findOrFail($id);
        $service->name = $request->name;
        $service->desc = $request->desc;
        $service->icon = $request->icon;
        $service->jenis = $request->jenis;
        $service->doctor_id = $request->doctor_id; // update dokter jaga
        $service->save();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->back()->with(['success' => 'Service updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('our-services.index')->with('success', 'Service deleted successfully');
    }

}
