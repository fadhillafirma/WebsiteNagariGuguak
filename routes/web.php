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
use App\Http\Controllers\BpnSubdomainController;

// SETUP SUBDOMAIN BPN (Spesifik)
Route::domain('bpn.localhost')->group(function () {
    Route::get('/', [BpnSubdomainController::class, 'index'])->name('bpn.beranda');
    Route::get('/program', [BpnSubdomainController::class, 'programIndex'])->name('bpn.program.index');
    Route::get('/program/{program}', [BpnSubdomainController::class, 'showProgram'])->name('bpn.program.show');
    Route::get('/berita', [BpnSubdomainController::class, 'beritaIndex'])->name('bpn.berita.index');
    Route::get('/berita/{berita}', [BpnSubdomainController::class, 'showBerita'])->name('bpn.berita.show');
    Route::get('/login', [BpnSubdomainController::class, 'showLogin'])->name('bpn.login');
    Route::post('/login', [BpnSubdomainController::class, 'login'])->name('bpn.login.submit');
    Route::post('/logout', [BpnSubdomainController::class, 'logout'])->name('bpn.logout');
    Route::get('/admin', [BpnSubdomainController::class, 'admin'])->name('bpn.admin');
    Route::post('/admin/program', [BpnSubdomainController::class, 'storeProgram'])->name('bpn.program.store');
    Route::put('/admin/program/{program}', [BpnSubdomainController::class, 'updateProgram'])->name('bpn.program.update');
    Route::delete('/admin/program/{program}', [BpnSubdomainController::class, 'destroyProgram'])->name('bpn.program.destroy');
    Route::post('/admin/berita', [BpnSubdomainController::class, 'storeBerita'])->name('bpn.berita.store');
    Route::put('/admin/berita/{berita}', [BpnSubdomainController::class, 'updateBerita'])->name('bpn.berita.update');
    Route::delete('/admin/berita/{berita}', [BpnSubdomainController::class, 'destroyBerita'])->name('bpn.berita.destroy');
    Route::put('/admin/profil', [BpnSubdomainController::class, 'updateProfil'])->name('bpn.profil.update');
});
// SETUP SUBDOMAIN
Route::domain('{lembaga}.localhost')->group(function () {
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

    // Login & Logout Lembaga Admin
    Route::get('/login', [LembagaSubdomainController::class, 'showLogin'])->name('lembaga.login');
    Route::post('/login', [LembagaSubdomainController::class, 'login'])->name('lembaga.login.submit');
    Route::post('/logout', [LembagaSubdomainController::class, 'logout'])->name('lembaga.logout');

    // Halaman Admin Panel lembaga (dilindungi ownership middleware)
    Route::middleware(['lembaga_owner'])->group(function() {
        Route::get('/admin', [LembagaSubdomainController::class, 'admin'])->name('lembaga.admin');
        Route::post('/admin/tugas', [LembagaSubdomainController::class, 'storeTugas'])->name('lembaga.tugas.store');
        Route::put('/admin/tugas/{tugas}', [LembagaSubdomainController::class, 'updateTugas'])->name('lembaga.tugas.update');
        Route::delete('/admin/tugas/{tugas}', [LembagaSubdomainController::class, 'destroyTugas'])->name('lembaga.tugas.destroy');
        Route::post('/admin/program', [LembagaSubdomainController::class, 'storeProgram'])->name('lembaga.program.store');
        Route::put('/admin/program/{program}', [LembagaSubdomainController::class, 'updateProgram'])->name('lembaga.program.update');
        Route::delete('/admin/program/{program}', [LembagaSubdomainController::class, 'destroyProgram'])->name('lembaga.program.destroy');
        Route::post('/admin/berita', [LembagaSubdomainController::class, 'storeBerita'])->name('lembaga.berita.store');
        Route::put('/admin/berita/{berita}', [LembagaSubdomainController::class, 'updateBerita'])->name('lembaga.berita.update');
        Route::delete('/admin/berita/{berita}', [LembagaSubdomainController::class, 'destroyBerita'])->name('lembaga.berita.destroy');
        Route::put('/admin/profil', [LembagaSubdomainController::class, 'updateProfil'])->name('lembaga.profil.update');
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
Route::get('/32002guguak', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/32002guguak', [AuthController::class, 'login']);
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

