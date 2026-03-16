<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $complains = Complain::latest()->get();

        return response()->json([
            'success' => true,
            'data'    => $complains,
            'message' => 'Daftar pengaduan berhasil diambil'
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit'    => 'required',
            'complain'=> 'required|min:25',
            'name'    => 'required',
            'address' => 'required',
            'phone'   => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
        ]);

        $complain = Complain::create([
            'unit'    => $request->unit,
            'complain'=> addslashes($request->complain),
            'name'    => addslashes($request->name),
            'address' => addslashes($request->address),
            'phone'   => $request->phone,
            'date'    => date("Y-m-d"),
        ]);

        return response()->json([
            'success' => true,
            'data'    => $complain,
            'message' => 'Pengaduan berhasil dikirim'
        ], 201);
    }
}
