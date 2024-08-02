<?php

namespace App\Http\Controllers;

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
            $services = Service::all();
            return view ('admin.our-services', compact('services'));
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
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->desc = $request->desc;
        $service->icon = $request->icon;
        $service->save();
        //dd($service);

        return redirect()->back()->with(['success' => 'Service created successfully!']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
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
        ]);

        $service = Service::findOrFail($id);
        $service->name = $request->name;
        $service->desc = $request->desc;
        $service->icon = $request->icon;
        $service->save();

        return redirect()->back()->with(['success' => 'Service updated successfully!']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
