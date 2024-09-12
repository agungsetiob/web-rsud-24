<?php

namespace App\Http\Controllers;


use Auth;
use App\Models\Standard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StandarPelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $files = Standard::latest()->get();
            return view ('admin.standar-pelayanan', compact('files'));
        } elseif (Auth::user()->role == 'user') {
            $id = Auth::user()->id;
            $files = Standard::where('user_id', $id)->get();
            return view ('admin.standar-pelayanan', compact('files'));
        }
    }

    public function standarPelayanan()
    {
        $title = 'Standar Pelayanan';
        $standards = Standard::latest()->get();
        return view ('main.standar-pelayanan', compact('standards', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file'   => 'required|mimes:pdf',
            'name'     => 'required',
            'service_name'     => 'required',
        ]);

        //upload file
        $file = $request->file('file');
        $file->storeAs('public/sp', $file->hashName());

        //store to db
        Standard::create([
            'file'     => $file->hashName(),
            'name'     => addslashes($request->name),
            'service_name'   => $request->service_name,
            'user_id'   => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {   

        $file = Standard::findOrFail($id);
        if (Auth::user()->id == $file->user_id) {
            //delete file
            Storage::delete('public/sp/'. $file->file);

            //delete post
            $file->delete();

            //redirect to index
            return redirect()->back()->with(['success' => 'File deleted succesfully']);
        } else{
            return redirect()->back()->with('error', 'ingatlah dunia hanya sementara');
        }
    }
}
