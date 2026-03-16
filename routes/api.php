<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PublicationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// existing routes
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::apiResource('publications', PublicationController::class);
});

// V1 Public API Routes
Route::prefix('v1')->group(function () {
    Route::get('/profil', [\App\Http\Controllers\Api\GeneralController::class, 'profil']);
    Route::get('/home', [\App\Http\Controllers\Api\GeneralController::class, 'home']);
    Route::get('/faq', [\App\Http\Controllers\Api\GeneralController::class, 'faq']);
    Route::get('/standar-pelayanan', [\App\Http\Controllers\Api\GeneralController::class, 'standarPelayanan']);
    Route::get('/layanan', [\App\Http\Controllers\Api\GeneralController::class, 'layanan']);
    Route::post('/send/message', [\App\Http\Controllers\Api\GeneralController::class, 'sendMessage']);

    Route::get('/blog', [\App\Http\Controllers\Api\PostController::class, 'index']);
    Route::get('/blog/category/{category}', [\App\Http\Controllers\Api\PostController::class, 'category']);
    Route::get('/blog/{slug}', [\App\Http\Controllers\Api\PostController::class, 'show']);
    Route::get('/from/{username}', [\App\Http\Controllers\Api\PostController::class, 'postByUser']);
    Route::get('/leaderboard', [\App\Http\Controllers\Api\PostController::class, 'leaderboard']);

    Route::get('/dokter', [\App\Http\Controllers\Api\DoctorController::class, 'index']);
    Route::get('/spesialis', [\App\Http\Controllers\Api\DoctorController::class, 'spesialis']);
    Route::get('/dokter-umum', [\App\Http\Controllers\Api\DoctorController::class, 'umum']);

    Route::get('/document', [\App\Http\Controllers\Api\DocumentController::class, 'documents']);
    Route::get('/document/{file}', [\App\Http\Controllers\Api\DocumentController::class, 'documentShow']);
    Route::get('/publikasi', [\App\Http\Controllers\Api\DocumentController::class, 'publications']);
    Route::get('/publikasi/{slug}', [\App\Http\Controllers\Api\DocumentController::class, 'publicationShow']);

    Route::get('/controls/list', [\App\Http\Controllers\Api\ControlController::class, 'list']);
    Route::get('/control-by-date-range/list', [\App\Http\Controllers\Api\ControlController::class, 'getControlByDateRange']);
    Route::get('/jadwal-kontrol/search', [\App\Http\Controllers\Api\ControlController::class, 'search']);
    Route::post('/jadwal-kontrol/update', [\App\Http\Controllers\Api\ControlController::class, 'updateStatus']);

    // Quran routes
    Route::get('/quran', [\App\Http\Controllers\Api\QuranController::class, 'index']);
    Route::get('/quran/surat/{surah}', [\App\Http\Controllers\Api\QuranController::class, 'detailSurah']);
    Route::get('/surat/cari', [\App\Http\Controllers\Api\QuranController::class, 'cariSurah']);

    // Pengaduan masyarakat
    Route::get('/pengaduan-masyarakat', [\App\Http\Controllers\Api\PengaduanController::class, 'index']);
    Route::post('/pengaduan', [\App\Http\Controllers\Api\PengaduanController::class, 'store']);

    // Jadwal Dokter
    Route::get('/jadwal-dokter', [\App\Http\Controllers\Api\ScheduleController::class, 'index']);
    Route::get('/jadwal-dokter/dokter/{id}', [\App\Http\Controllers\Api\ScheduleController::class, 'byDoctor']);
    Route::get('/jadwal-dokter/hari/{day}', [\App\Http\Controllers\Api\ScheduleController::class, 'byDay']);
});