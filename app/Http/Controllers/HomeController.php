<?php

namespace App\Http\Controllers;

use App\Models\{Post, Doctor, User, Faq, Service};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $posts = Post::latest()->paginate(6);
        $title = 'Blog';
        foreach ($posts as $post){
            $post->content = Str::limit($post->content, 40);   
        }
        //sleep(2);
        if ($request->header('HX-Request')) {
            return view('main.blog', compact('posts', 'title'))->fragment('blog');
        }
        return view('main.blog', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        if (Auth::user()->role === 'admin') {
            $doctors = Doctor::all();
            return view('admin.doctor', compact('doctors'));
        } else {
            abort(403, 'Not Permitted');
        }
    }

    //front page
    public function frontPage(Request $request)
    {
        $doctors = Doctor::inRandomOrder()
        ->limit(4)
        ->get();
        $faqs = Faq::inRandomOrder()
        ->limit(6)
        ->get();
        $services = Service::inRandomOrder()
        ->limit(4)
        ->get();
        $posts = Post::latest()->limit(3)->get();
        $title = 'RSUD RS Amanah Husada';
        if ($request->header('HX-Request')) {
            return view('main.index', compact('faqs', 'doctors', 'posts', 'title', 'services'))->fragment('beranda');
        }
        return view('main.index', compact('doctors', 'faqs', 'posts', 'title', 'services'));
    }

    public function doctor(Request $request)
    {
        $doctors = Doctor::inRandomOrder()->limit(8)->get();
        if ($request->header('HX-Request')){
            return view('main.doctors', compact('doctors'))->fragment('doctor');
        }
        return view('main.doctors', compact('doctors'));
    }

    //sp doctor for doctor page for visitors
    public function doctorSpec(Request $request)
    {
        $doctors = Doctor::latest()
        ->where('category', 'spesialis')
        ->get();
        $title = 'Dokter Spesialis';
        if ($request->header('HX-Request')){
            return view('main.doctor-all', compact('doctors'))->fragment('doctor');
        }
        return view('main.doctor-all', compact('doctors'));
    }

    //general doctor for doctor page for visitors
    public function doctorGeneral(Request $request)
    {
        $doctors = Doctor::latest()
        ->where('category', 'umum')
        ->get();
        $title = 'Dokter Umum';
        if ($request->header('HX-Request')){
            return view('main.doctor-all', compact('doctors'))->fragment('doctor');
        }
        return view('main.doctor-all', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage
     * Store doctor data.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'photo'             => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'              => 'required',
            'category'          => 'required',
            'specialization'    => 'required'
        ]);

        //upload image
        $photo = $request->file('photo');
        if ($request->hasFile('photo')) {
            $photo->storeAs('public/doctor', $photo->hashName());

            //create post
            Doctor::create([
                'photo'    => $photo->hashName(),
                'name'     => addslashes($request->name),
                'category' => $request->category,
                'specialization'   => $request->specialization
            ]);
        } else {

            //update without image
            Doctor::create([
                'name'     => addslashes($request->name),
                'category' => $request->category,
                'specialization'   => $request->specialization
            ]);
        }

        //redirect to index
        return redirect()->back()->with(['success' => 'Data saved succesfully']);
    }


    /**
     * Update Doctor data
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function updateDoctor($id, Request $request)
    {

        $this->validate($request, [
            'name'              => 'required',
            'category'          => 'required',
            'specialization'    => 'required'
        ]);

        $doc = Doctor::findOrFail($id);
        //check if image is uploaded
        if ($request->hasFile('photo')) {

            //upload new image
            $image = $request->file('photo');
            $image->storeAs('public/doctor', $image->hashName());

            //delete old image
            Storage::delete('public/doctor'.$doc->photo);

            //update post with new image
            $doc->update([
                'photo'    => $image->hashName(),
                'name'     => addslashes($request->name),
                'category' => $request->category,
                'specialization'   => $request->specialization
            ]);

        } else {

            //update without image
            $doc->update([
                'name'     => addslashes($request->name),
                'category' => $request->category,
                'specialization'   => $request->specialization
            ]);
        }
        return redirect()->back()->with(['success' => 'Data updated succesfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            abort(404);
        }
        $post->increment('view');
        $description = Str::limit($post->content, 40);
        $popularPosts = Post::where('id', '!=', $post->id)
                            ->orderBy('view', 'desc')
                            ->limit(3)
                            ->get();
        $relatedPosts = Post::where('category_id', $post->category_id)
                            ->where('id', '!=', $post->id)
                            ->limit(3)
                            ->get();
        $title = $post->title;
        $ogImage = $post->image;
        $url = $post->slug;
        return view('main.show', compact('post', 'relatedPosts', 'popularPosts', 'description', 'title', 'ogImage', 'url'));
    }

    public function rank()
    { 
        $ranks = User::with('posts')
        ->withCount('posts')
        ->where('status', 'active')
        ->orderByDesc('posts_count')
        ->paginate(8);
        $title = 'Top Author';
        return view ('main.leaderboard', compact('ranks', 'title'));
    }

    public function category($category)
    {

        $posts = Post::whereHas('category', function($q) use($category){
            $q->where('name', $category);
        })->paginate(6);
        $title = $category;
        foreach ($posts as $post){
            $post->content = Str::limit($post->content, 40);   
        }
        return view ('main.blog', compact('posts', 'title'));
    }

    public function postByUser($username)
    {

        $title = 'Sorted by author';
        $posts = Post::whereHas('user', function($q) use($username){
            $q->where('username', $username);
        })->paginate(6);
        foreach ($posts as $post){
            $post->content = Str::limit($post->content, 40);   
        }
        return view ('main.blog', compact('posts', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        if (Auth::user()->role == 'admin') {

            $doc = Doctor::findOrfail($id);
            //delete image
            Storage::delete('public/doctor/'. $doc->photo);

            //delete post
            $doc->delete();

            //redirect to index
            return redirect('doctors')->with(['success' => 'Data deleted succesfully']);
        } else{
            return redirect()->back()->with('error', 'ingatlah dunia hanya sementara');
        }
    }

    public function quran()
    {
        //api alquran
        $response = Http::withoutVerifying()->get('https://equran.id/api/surat');

        //jadikan json
        $data = $response->json();
        // dd($data);
        //tampilkan dan kirim data
        return view('main.quran', compact('data'));
    }

    public function detailSurah(int $surah)
    {
        $response = Http::withoutVerifying()->get('https://equran.id/api/surat/' . $surah);
        $datadetail = $response->json();
        return view('main.surat', compact('datadetail'));
    }

    public function cariSurah(Request $request)
    {

        $this->validate($request, [
            'cari' => 'required'
        ]);
        $cari = $request->cari;


        $ch = curl_init("https://al-quran-8d642.firebaseio.com/data.json?pretty=true");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);

        $find = [];
        $cari = trim(strtolower($cari));
        foreach ($data as $k => $v) {
            $n = strtolower($v["nama"]);
            if (strpos($n, $cari) !== false) {
                $find[] = $v;
            }
        }
        return view('main.search-surah', compact('data', 'find'));
    }

    public function faq()
    {
        $title = 'Frequently Asked Questions';
        $faqs = Faq::inRandomOrder()
        ->get();
        return view('main.faq', compact('faqs', 'title'));
    }
}
