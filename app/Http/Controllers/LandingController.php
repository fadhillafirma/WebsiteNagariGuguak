<?php

namespace App\Http\Controllers;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\DemografiSekolah;
use App\Models\DemografiPekerjaan;



class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Ambil semua data galeri (bisa difilter jika perlu, misal hanya yang aktif/tampil)
    $galeris = Galeri::latest()->take(6)->get(); // ambil 6 galeri
    $beritas = Publikasi::where('jenis', 'berita')->latest()->take(6)->get(); // ambil 6 berita terbaru
    $artikels = Publikasi::where('jenis', 'artikel')->latest()->take(6)->get(); // ambil 6 berita terbaru

    return view('welcome', compact('galeris', 'beritas', 'artikels'));
}


public function showDetail($id)
{
    $data = Publikasi::find($id);

    if ($data) {
        return view('detail', [
            'data' => $data,
            'tipe' => ucfirst($data->jenis) // Akan jadi "Berita" atau "Artikel"
        ]);
    } else {
        abort(404);
    }
}

public function berita()
{
    $beritas = Publikasi::where('jenis', 'berita')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('berita', compact('beritas'));
}


public function showBerita($id)
{
    $berita = Publikasi::where('jenis', 'berita')->findOrFail($id);
    return view('admin.publikasi.show', compact('berita'));
}

public function showArtikel($id)
{
    $artikel = Publikasi::where('jenis', 'artikel')->findOrFail($id);
    return view('admin.publikasi.artikelShow', compact('artikel'));
}


public function demografiSekolah()
{
    // Ambil tahun terbaru
    $tahunTerbaru = DemografiSekolah::max('tahun');

    // Ambil semua data dengan tahun tersebut
    $data = DemografiSekolah::where('tahun', $tahunTerbaru)->get();

    return view('demografiSekolah', compact('data', 'tahunTerbaru'));
}

public function demografiPekerjaan ()
    {
        $tahunTerbaru = DemografiPekerjaan::max('tahun');

        $data = DemografiPekerjaan::where('tahun', $tahunTerbaru)->first();

        return view('demografiPekerjaan', compact('data', 'tahunTerbaru'));
    }




public function artikel()
{
    $artikels = Publikasi::where('jenis', 'artikel')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('artikel', compact('artikels'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
