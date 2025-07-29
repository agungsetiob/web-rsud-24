<?php

namespace App\Http\Controllers\Api;

use App\Models\Publication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PublicationResource;
use Illuminate\Support\Str;

class PublicationController extends Controller
{
    protected function authorizeToken(Request $request)
    {
        $token = env('WEBRSUD_TOKEN');

        if ($request->bearerToken() !== $token) {
            abort(403, 'Unauthorized token');
        }
    }
    protected function generateUniqueSlug($nama_dokumen, $ignoreId = null)
    {
        $slug = Str::slug($nama_dokumen);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Publication::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }

    public function index( Request $request)
    {
        $this->authorizeToken($request);
        $publications = Publication::latest()->paginate(10);
        return PublicationResource::collection($publications);
    }

    public function store(Request $request)
    {
        $this->authorizeToken($request);

        $validated = $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'produsen_data' => 'required|string|max:255',
            'rencana_rilis' => 'required|date',
            'tanggal_rilis' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        $tanggal = now()->format('Ymd');

        if ($request->hasFile('image')) {
            $imageName = 'rsud_' . $tanggal . '_' . $request->file('image')->hashName();
            $validated['image'] = $request->file('image')->storeAs(
                'publikasi',
                $imageName, 
                'public'
            );
        }

        if ($request->hasFile('file')) {
            $fileName = 'rsud_' . $tanggal . '_' . $request->file('file')->hashName();
            $validated['file'] = $request->file('file')->storeAs(
                'publikasi',
                $fileName, 
                'public'
            );
        }

        $validated['slug'] = $this->generateUniqueSlug($validated['nama_dokumen']);


        $publication = Publication::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Publikasi berhasil ditambahkan.',
            'data' => new PublicationResource($publication),
        ], 201);
    }

    public function show(Publication $publication)
    {
        return new PublicationResource($publication);
    }

    public function update(Request $request, Publication $publication)
    {
        $this->authorizeToken($request);
        $validated = $request->validate([
            'nama_dokumen' => 'sometimes|string|max:255',
            'produsen_data' => 'sometimes|string|max:255',
            'rencana_rilis' => 'required|date',
            'tanggal_rilis' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        $tanggal = now()->format('Ymd');

        if ($request->hasFile('image')) {
            $imageName = 'rsud_' . $tanggal . '_' . $request->file('image')->hashName();
            $validated['image'] = $request->file('image')->storeAs(
                'publikasi',
                $imageName, 
                'public'
            );
            if ($publication->image) {
                \Storage::delete($publication->image);
            }
        }

        if ($request->hasFile('file')) {
            $fileName = 'rsud_' . $tanggal . '_' . $request->file('file')->hashName();
            $validated['file'] = $request->file('file')->storeAs(
                'publikasi',
                $fileName, 
                'public'
            );
            if ($publication->file) {
                \Storage::delete($publication->file);
            }
        }

        if (!empty($validated['nama_dokumen'])) {
            $validated['slug'] = $this->generateUniqueSlug($validated['nama_dokumen'], $publication->id);
        }


        $publication->update($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Publikasi berhasil diupdate.',
            'data' => new PublicationResource($publication),
        ], 201);
    }


    public function destroy(Publication $publication)
    {
        $this->authorizeToken(request());
        if ($publication->image) {
            \Storage::delete($publication->image);
        }

        if ($publication->file) {
            \Storage::delete($publication->file);
        }

        $publication->delete();

        return response()->json(['message' => 'Publication deleted']);
    }
}
