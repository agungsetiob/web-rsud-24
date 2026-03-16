<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{File, Publication};
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function documents()
    {
        $files = File::latest()->get();

        return response()->json([
            'success' => true,
            'data'    => $files,
            'message' => 'Daftar dokumen berhasil diambil'
        ], 200);
    }

    public function documentShow(File $file)
    {
        return response()->json([
            'success' => true,
            'data'    => $file,
            'message' => 'Detail dokumen berhasil diambil'
        ], 200);
    }

    public function publications()
    {
        $publications = Publication::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $publications,
            'message' => 'Daftar publikasi berhasil diambil'
        ], 200);
    }

    public function publicationShow($slug)
    {
        $publication = Publication::where('slug', $slug)->first();
        if (!$publication) {
            return response()->json([
                'success' => false,
                'message' => 'Publikasi tidak ditemukan',
            ], 404);
        }

        $others = Publication::where('id', '!=', $publication->id)
            ->latest()
            ->take(3)
            ->get();

        return response()->json([
            'success' => true,
            'data'    => [
                'publication' => $publication,
                'others'      => $others
            ],
            'message' => 'Detail publikasi berhasil diambil'
        ], 200);
    }
}
