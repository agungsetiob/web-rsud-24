<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CategoryController, 
                        ContactController, 
                        FaqController, 
                        FileController,
                        BackupController};
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StandarPelayananController;
use App\Models\Profile;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/profil', function (Request $request) {
    $title = 'Profil';
    $profiles = Profile::all();
    //sleep(2);
    if ($request->header('HX-Request')) {
        return view('main.profil', compact('profiles', 'title'))->fragment('profil');
    } else {
        return view('main.profil', compact('title', 'profiles'));
    }
});

//call symlink through symlink.blade.php
Route::get('/sym', function () {
    return view('symlink');
});

//call symlink through artisan
Route::get('/storage', function () {
    Artisan::call('storage:link');
    return 'sukses';
});

Route::get('/', [HomeController::class, 'frontPage']);
Route::get('blog', [HomeController::class, 'index'])->name('blog.index');
Route::get('blog/category/{category}', [HomeController::class, 'category']);
Route::get('blog/{slug}', [HomeController::class, 'show'])->name('blog');
Route::get('our/specialists', [HomeController::class, 'doctor']);
Route::get('our/doctors', [HomeController::class, 'doctorGeneral']);
Route::get('leaderboard', [HomeController::class, 'rank']);
Route::get('from/{username}', [HomeController::class, 'postByUser']);
Route::get('frequently-asked-question', [HomeController::class, 'faq'])->name('frequent.question');

Route::get('standar-pelayanan', [StandarPelayananController::class, 'standarPelayanan']);

Route::post('send/message', [ContactController::class, 'store']);

Route::get('document', [FileController::class, 'document'])->name('docs');
Route::get('document/{file}', [FileController::class, 'show']);


//route group on my own
Route::middleware(['auth'])->group(function () {
    Route::resource('/posts', PostController::class);
    Route::get('user/dashboard', [PostController::class, 'index']);
    Route::get('/dashboard', [PostController::class, 'userPost'])->name('dashboard');
    Route::get('/skm', [PostController::class, 'skm']);


    Route::get('doctors', [HomeController::class, 'create']);
    Route::post('add/doctor', [HomeController::class, 'store']);
    Route::delete('delete/doctor/{id}', [HomeController::class, 'destroy']);
    Route::put('update/doctor/{id}', [HomeController::class, 'updateDoctor']);


    Route::resource('/standards', StandarPelayananController::class);
    Route::get('standar/pelayanan', [StandarPelayananController::class, 'index']);
    Route::post('upload/standar-pelayanan', [StandarPelayananController::class, 'store']);
    Route::delete('delete/standar-pelayanan/{id}', [StandarPelayananController::class, 'destroy']);


    Route::resource('/category', App\Http\Controllers\CategoryController::class);
    Route::get('category/delete/{id}', [CategoryController::class, 'destroy']);
    Route::post('enable/{id}', [CategoryController::class, 'enableCategory']);
    Route::post('disable/{id}', [CategoryController::class, 'disableCategory']);


    Route::get('messages', [ContactController::class, 'index']);
    Route::get('delete/message/{id}', [ContactController::class, 'destroy']);
    Route::get('messages/laporan/{startdate}/{enddate}', [ContactController::class, 'messagesReport']);


    Route::get('setting/profile', [ProfileController::class, 'index']);
    Route::get('setting/profile/create', [ProfileController::class, 'create']);
    Route::get('setting/profile/{id}', [ProfileController::class, 'edit']);
    Route::post('profile/create', [ProfileController::class, 'store']);
    Route::put('profile/update/{id}', [ProfileController::class, 'update']);


    Route::resource('setting/faqs', App\Http\Controllers\FaqController::class);
    Route::get('/faqs/{faq}', [FaqController::class, 'destroy']);
    
    Route::get('pengaduan/list', [ContactController::class, 'daftarPengaduan']);
    Route::get('pengaduan/laporan/{startdate}/{enddate}', [ContactController::class, 'cetakPengaduan']);

    Route::get('upload-file', [FileController::class, 'index']);
    Route::post('upload/file', [FileController::class, 'store']);
    Route::delete('delete/docs/{id}', [FileController::class, 'destroy']);

    Route::get('/backup', [BackupController::class, 'index']);
    Route::get('/backup/only-db', [BackupController::class, 'create']);
    Route::get('/backup/delete/{file_name}', [BackupController::class, 'delete']);

    Route::resource('our-services', ServiceController::class);


});


//route alquran api
Route::get('quran', [HomeController::class, 'quran']);
//route cari surat
Route::get('/surat/cari', [HomeController::class, 'cariSurah']);
//route surat
Route::get('quran/surat/{surah}', [HomeController::class, 'detailsurah'])->name('detail.surah');

Route::get('pengaduan-masyarakat', [ContactController::class, 'pengaduan'])->name('pengaduan');
Route::post('pengaduan', [ContactController::class, 'simpanPengaduan'])->name('aduan');


require __DIR__.'/auth.php';
