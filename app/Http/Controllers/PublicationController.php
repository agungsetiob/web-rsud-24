<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Http;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::latest()->paginate(10);
        return view('publications.index', compact('publications'));
    }

    public function publications(Request $request)
    {
        $title = 'Publikasi';
        //sleep(2);
        $publications = Publication::latest()->paginate(10);
        if ($request->header('HX-Request')) {
            return view('main.publications', compact('title', 'publications'))->fragment('publikasi');
        }
        return view('main.publications', compact('title', 'publications'));
    }
    public function show($slug)
    {
        $title = 'Detail Publikasi';
        $publication = Publication::where('slug', $slug)->firstOrFail();
        $others = Publication::where('id', '!=', $publication->id)
            ->latest()
            ->take(3)
            ->get();

        return view('main.publication-detail', compact('publication', 'others', 'title'));
    }

    public function diskominfo()
    {
        return view('publications.diskominfo');
    }

    public function proxy()
    {
        $response = Http::withoutVerifying()->get('https://satudata.tanahbumbukab.go.id/publikasi/1/fetch-data');
        return $response->json();
    }

}
