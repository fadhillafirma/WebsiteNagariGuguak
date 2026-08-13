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

use App\Http\Controllers\LembagaSubdomainController;

// SETUP SUBDOMAIN
Route::domain('{lembaga}.' . env('APP_DOMAIN', 'localhost'))->group(function () {
    // Halaman utama (frontend) lembaga
    Route::get('/', [LembagaSubdomainController::class, 'index'])->name('lembaga.beranda');
    
    // Halaman List & Detail Program
    Route::get('/program', [LembagaSubdomainController::class, 'programIndex'])->name('lembaga.program.index');
    Route::get('/program/{program}', [LembagaSubdomainController::class, 'showProgram'])->name('lembaga.program.show');
    
    // Halaman List Tugas Pokok
    Route::get('/tugas', [LembagaSubdomainController::class, 'tugasIndex'])->name('lembaga.tugas.index');

    // Halaman List & Detail Berita
    Route::get('/berita', [LembagaSubdomainController::class, 'beritaIndex'])->name('lembaga.berita.index');
    Route::get('/berita/{berita}', [LembagaSubdomainController::class, 'showBerita'])->name('lembaga.berita.show');

    // Halaman Bayar Zakat Khusus UPZ
    Route::get('/bayar-zakat', [LembagaSubdomainController::class, 'bayarZakat'])->name('lembaga.bayar-zakat');

    // Login & Logout Lembaga Admin
    Route::get('/guguakadmin/login', [LembagaSubdomainController::class, 'showLogin'])->name('lembaga.login');
    Route::post('/guguakadmin/login', [LembagaSubdomainController::class, 'login'])->name('lembaga.login.submit');
    Route::post('/guguakadmin/logout', [LembagaSubdomainController::class, 'logout'])->name('lembaga.logout');

    // Halaman Admin Panel lembaga (dilindungi ownership middleware)
    Route::middleware(['lembaga_owner'])->group(function() {
        Route::get('/guguakadmin', [LembagaSubdomainController::class, 'admin'])->name('lembaga.admin');
        Route::post('/guguakadmin/tugas', [LembagaSubdomainController::class, 'storeTugas'])->name('lembaga.tugas.store');
        Route::put('/guguakadmin/tugas/{tugas}', [LembagaSubdomainController::class, 'updateTugas'])->name('lembaga.tugas.update');
        Route::delete('/guguakadmin/tugas/{tugas}', [LembagaSubdomainController::class, 'destroyTugas'])->name('lembaga.tugas.destroy');
        Route::post('/guguakadmin/program', [LembagaSubdomainController::class, 'storeProgram'])->name('lembaga.program.store');
        Route::put('/guguakadmin/program/{program}', [LembagaSubdomainController::class, 'updateProgram'])->name('lembaga.program.update');
        Route::delete('/guguakadmin/program/{program}', [LembagaSubdomainController::class, 'destroyProgram'])->name('lembaga.program.destroy');
        Route::post('/guguakadmin/berita', [LembagaSubdomainController::class, 'storeBerita'])->name('lembaga.berita.store');
        Route::put('/guguakadmin/berita/{berita}', [LembagaSubdomainController::class, 'updateBerita'])->name('lembaga.berita.update');
        Route::delete('/guguakadmin/berita/{berita}', [LembagaSubdomainController::class, 'destroyBerita'])->name('lembaga.berita.destroy');
        Route::post('/guguakadmin/rekening', [LembagaSubdomainController::class, 'storeRekening'])->name('lembaga.rekening.store');
        Route::put('/guguakadmin/rekening/{rekening}', [LembagaSubdomainController::class, 'updateRekening'])->name('lembaga.rekening.update');
        Route::delete('/guguakadmin/rekening/{rekening}', [LembagaSubdomainController::class, 'destroyRekening'])->name('lembaga.rekening.destroy');
        Route::put('/guguakadmin/profil', [LembagaSubdomainController::class, 'updateProfil'])->name('lembaga.profil.update');
    });
});

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
Route::get('/situsLembaga', [LandingController::class, 'situsLembaga'])->name('landing.situs_lembaga');

// Login & Logout
Route::get('/guguakadmin', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/guguakadmin', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin area (butuh login)
Route::middleware(['auth', 'superadmin'])->group(function () {
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
        ->parameters(['demografi-penduduk-jorong' => 'demografi_penduduk_jorong']);

    Route::resource('demografi-lahan', LahanDataController::class)
        ->parameters(['demografi-lahan' => 'lahan_data']);

    Route::resource('kalender', KalenderController::class)
        ->parameters(['kalender' => 'kalender_data']);

    Route::resource('lembaga', LembagaController::class)
        ->parameters(['lembaga' => 'lembaga']);

    Route::resource('situs-lembaga', App\Http\Controllers\SitusLembagaController::class)
        ->parameters(['situs-lembaga' => 'situs_lembaga']);

    Route::resource('potensi', PotensiController::class)
        ->parameters(['potensi' => 'potensi']);

    Route::resource('jorong', JorongController::class)
        ->parameters(['jorong' => 'jorong']);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    // Halaman edit profil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update profil
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

