<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $files = File::all();
        return view('admin.file', compact('files'));
    }

    /**
     * Show the page of uploade documents.
     *
     */
    public function document(Request $request)
    {
        $title = 'Dokumen Publik';
        $files = File::latest()->get();
        if ($request->header('HX-Request')) {
            return view('main.documents', compact('title', 'files'))->fragment('docs');
        }
        return view('main.documents', compact('title', 'files'));
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
        ]);

        //upload file
        $file = $request->file('file');
        $file->storeAs('public/docs', $file->hashName());

        //create post
        File::create([
            'file'     => $file->hashName(),
            'name'     => addslashes($request->name),
            'user_id'   => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     */
    public function show(File $file)
    {
        $title = $file->name;
        return view ('main.show-document', compact('file', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        if (Auth::user()->id == $file->user_id) {
            //delete file
            Storage::delete('public/docs/'. $file->file);

            //delete record
            $file->delete();

            //redirect to index
            return redirect()->back()->with(['success' => 'File deleted']);
        } else{
            return redirect()->back()->with('error', 'ingatlah dunia hanya sementara');
        }
    }
}
