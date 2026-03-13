<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Profile, Doctor, Post, Faq, Service, Standard, Contact};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    public function profil()
    {
        $profiles = Profile::all();
        
        return response()->json([
            'success' => true,
            'data'    => $profiles,
            'message' => 'Data Profil berhasil diambil'
        ], 200);
    }

    public function home()
    {
        $doctors = Doctor::inRandomOrder()->limit(4)->get();
        $faqs = Faq::inRandomOrder()->limit(6)->get();
        $services = Service::inRandomOrder()->limit(4)->get();
        $posts = Post::latest()->limit(3)->get();

        return response()->json([
            'success' => true,
            'data'    => [
                'doctors'  => $doctors,
                'faqs'     => $faqs,
                'services' => $services,
                'posts'    => $posts
            ],
            'message' => 'Data Home berhasil diambil'
        ], 200);
    }

    public function faq()
    {
        $faqs = Faq::inRandomOrder()->get();

        return response()->json([
            'success' => true,
            'data'    => $faqs,
            'message' => 'Data FAQ berhasil diambil'
        ], 200);
    }

    public function standarPelayanan()
    {
        $standards = Standard::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $standards,
            'message' => 'Data Standar Pelayanan berhasil diambil'
        ], 200);
    }

    public function layanan()
    {
        $services = Service::all();

        return response()->json([
            'success' => true,
            'data'    => $services,
            'message' => 'Data Layanan berhasil diambil'
        ], 200);
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'message'   => 'required|min:25',
            'phone'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        Contact::create([
            'name'    => addslashes($request->name),
            'email'   => $request->email,
            'message' => addslashes($request->message),
            'phone'   => $request->phone,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan terkirim'
        ], 201);
    }
}
