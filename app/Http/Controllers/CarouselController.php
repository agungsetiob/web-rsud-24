<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('admin.carousel', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('image')->store('carousels', 'public');

        Carousel::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $path,
        ]);

        return redirect()->back()->with('success', 'Carousel berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);

        if ($carousel->image && Storage::disk('public')->exists($carousel->image)) {
            Storage::disk('public')->delete($carousel->image);
        }

        $carousel->delete();

        return redirect()->back()->with('success', 'Carousel berhasil dihapus');
    }
}
