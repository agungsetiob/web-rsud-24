<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use App\Models\Complain;
use Barryvdh\DomPDF\Facade\PDF;
use Auth;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        if (Auth::user()->role == 'admin') {
            $messages = Contact::all();
            return view('admin.message', compact('messages'));
        }else{
            abort(403, "You don't have permission");
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'message'   => 'required|min:25',
            'phone'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else{
            Contact::create([
            'name'    => addslashes($request->name),
            'email'   => $request->email,
            'message' => addslashes($request->message),
            'phone'   => $request->phone,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Pesan terkirim'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        if (Auth::user()->role == 'admin') {
            $mes = Contact::findOrFail($id);
        //delete post
            $mes->delete();

        //redirect to index
            return redirect('messages')->with(['success' => 'Data deleted succesfully']);
        } else{
            return redirect()->back()->with('error', 'ingatlah dunia hanya sementara');
        }
    }

    /**
     * Cetak laporan messages
     *
     * 
     * 
     */
    public function messagesReport($startdate, $enddate)
    {
        $messages = Contact::whereBetween('created_at',[$startdate, $enddate])->get();
        $total = Contact::all()->count();
        $pdf = PDF::loadview('admin.messages-report',['messages' => $messages, 'total' => $total
        ])->setPaper('A4', 'portrait');
        set_time_limit(300);
        return $pdf->stream('messages.pdf');
    }




    /**
     * Pengaduan masyarakat.
     *
     * 
     * 
     */
    public function pengaduan()
    {
        $complains = Complain::all();
        return view('admin.complains', compact('complains'));
    }

    public function simpanPengaduan(Request $request)
    {
        $this->validate($request, [
            'unit'      => 'required',
            'complain'  => 'required|min:25',
            'name'      => 'required',
            'address'   => 'required',
            'phone'     => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
        ]);

        Complain::create([
            'unit'   => $request->unit,
            'complain'  => addslashes($request->complain),
            'name'      => addslashes($request->name),
            'address'   => addslashes($request->address),
            'phone'     => $request->phone,
            'date'=> date("Y-m-d"),
        ]);

        return redirect('pengaduan-masyarakat')->with(['success' => 'Berhasil kirim pengaduan']);
    }

    public function daftarPengaduan ()
    {
        
        if(Auth::user()->role == 'admin'){
            $complains = Complain::all();
            return view('admin.complains-list', compact('complains'));
        } else{
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapusPengaduan($id): RedirectResponse
    {
        if (Auth::user()->role == 'admin') {
           //do something here

        //redirect to index
            return redirect('messages')->with(['success' => 'Data deleted succesfully']);
        } else{
            return redirect()->back()->with('error', 'ingatlah dunia hanya sementara');
        }
    }

    public function cetakPengaduan($startdate, $enddate)
    {
        $complains = Complain::whereBetween('date',[$startdate, $enddate])->get();
        $total = Complain::all()->count();
        $pdf = PDF::loadview('admin.cetak-pengaduan',['complains' => $complains, 'total' => $total
        ])->setPaper('A4', 'portrait');
        set_time_limit(300);
        return $pdf->stream('pengaduan-masyarakat.pdf');
    }



}
