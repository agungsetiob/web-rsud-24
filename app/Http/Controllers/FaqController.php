<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Auth;
use Illuminate\View\View;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        if (Auth::user()->role == 'admin') {
            $faqs = Faq::all();
        return view ('admin.faq', compact('faqs'));
        } else {
            abort(403, "You don't have permission");
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'question'     => 'required|min:10',
            'answer'   => 'required|min:10'
        ]);

        //create post
        Faq::create([
            'question' => addslashes($request->question),
            'answer'   => addslashes($request->answer)
        ]);

        return redirect()->back()->with(['success' => 'Data saved succesfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $this->validate($request, [
            'question'     => 'required|min:10',
            'answer'   => 'required|min:10'
        ]);

        $faq->update([
            'question' => addslashes($request->question),
            'answer'   => addslashes($request->answer)
        ]);

        return redirect()->back()->with(['success' => 'Data updated succesfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();
        return redirect()->back()->with(['success' => 'Data deleted succesfully']);

    }
}
