<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\DemografiPekerjaanController;
use App\Http\Controllers\DemografiSekolahController;
use App\Http\Controllers\DemografiPendudukJorongController;
use App\Http\Controllers\LahanDataController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\PotensiController;
use App\Http\Controllers\JorongController;
use App\Http\Controllers\ProfileController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


use App\Models\Galeri;

Route::get('/', [LandingController::class, 'index']);


// Halaman publik
// Route::view('/', 'welcome')->name('home');
Route::view('/profil', 'profile')->name('profil');
Route::view('/kontak', 'kontak')->name('kontak');
Route::view('/potensiNagari', 'potensi')->name('potensi');
Route::get('/berita', [LandingController::class, 'berita'])->name('berita');
Route::get('/berita/{id}', [LandingController::class, 'showBerita'])->name('landing.showBerita');
Route::get('/artikel', [LandingController::class, 'artikel'])->name('artikel');
Route::get('/artikel/{id}', [LandingController::class, 'showArtikel'])->name('landing.showArtikel');
Route::get('/demografiSekolah', [LandingController::class, 'demografiSekolah'])->name('demografi.sekolah');

Route::get('/demografiPekerjaan', [LandingController::class, 'demografiPekerjaan'])->name('demografi.pekerjaan');
Route::get('/demografiPenduduk', [LandingController::class, 'demografiPenduduk'])->name('demografi.penduduk');
Route::get('/demografiLahan', [LandingController::class, 'demografiLahan'])->name('demografi.lahan'); // Rute baru
Route::get('/kalender-agenda', [LandingController::class, 'kalenderAgenda'])->name('kalender.agenda');
Route::get('/potensiNagari', [LandingController::class, 'potensi'])->name('landing.potensi');
Route::get('/potensiNagari/{id}', [LandingController::class, 'showPotensi'])->name('landing.potensi.show');
Route::get('/jorongNagari', [LandingController::class, 'jorong'])->name('landing.jorong');
Route::get('/jorongNagari/{id}', [LandingController::class, 'jorongShow'])->name('landing.jorong.show');
Route::get('/lembagaNagari', [LandingController::class, 'lembaga'])->name('landing.lembaga');
Route::get('/lembagaNagari/{id}', [LandingController::class, 'lembagaShow'])->name('landing.lembaga.show');







// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin area (butuh login)
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('/artikel/tambah', 'admin.artikel.tambahArtikel')->name('artikel.tambah');
    Route::resource('publikasi', PublikasiController::class)->names([
        'index' => 'publikasi.index',
        'create' => 'publikasi.create',
        'store' => 'publikasi.store',
        'show' => 'publikasi.show',
        'edit' => 'publikasi.edit',
        'update' => 'publikasi.update',
        'destroy' => 'publikasi.destroy',
    ]);

    // Galeri (CRUD)
    Route::resource('galeri', GaleriController::class)->names([
        'index' => 'galeri.index',
        'create' => 'galeri.create',
        'store' => 'galeri.store',
        'show' => 'galeri.show',
        'edit' => 'galeri.edit',
        'update' => 'galeri.update',
        'destroy' => 'galeri.destroy',
    ]);

    // Demografi Pekerjaan (CRUD)
    Route::resource('demografi-pekerjaan', DemografiPekerjaanController::class)
        ->parameters(['demografi-pekerjaan' => 'demografi_pekerjaan']);

    // Demografi Sekolah (CRUD)
    Route::resource('demografi-sekolah', DemografiSekolahController::class);

    Route::resource('demografi-penduduk-jorong', DemografiPendudukJorongController::class)
        ->parameters(['demografi-penduduk-jorong' => 'demografi_penduduk_jorong'])
        ->middleware('auth');

    Route::resource('demografi-lahan', LahanDataController::class)
        ->parameters(['demografi-lahan' => 'lahan_data'])
        ->middleware('auth');

     Route::resource('kalender', KalenderController::class)
        ->parameters(['kalender' => 'kalender_data'])
        ->middleware('auth');

    Route::resource('lembaga', LembagaController::class)
        ->parameters(['lembaga' => 'lembaga'])
        ->middleware('auth');

    Route::resource('potensi', PotensiController::class)
        ->parameters(['potensi' => 'potensi'])
        ->middleware('auth');

    Route::resource('jorong', JorongController::class)
        ->parameters(['jorong' => 'jorong'])
        ->middleware('auth');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

// Halaman edit profil
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// Update profil
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


});
