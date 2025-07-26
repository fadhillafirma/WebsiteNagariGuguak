<?php

namespace App\Http\Controllers;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\Jorong;

use App\Models\DemografiSekolah;
use App\Models\DemografiPekerjaan;
use App\Models\DemografiPendudukJorong;
use App\Models\LahanData;






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


    public function demografiPenduduk()
    {
        $data = DemografiPendudukJorong::with('jorong')
            ->orderByDesc('tahun')
            ->paginate(20);

        // Mengambil tahun terbaru dari data yang sudah dipaginasi atau tahun saat ini
        $tahunTerbaru = $data->first()?->tahun ?? date('Y');

        // ======== Bagian Tambahan untuk Grafik =========

        // Mengambil semua tahun unik yang ada dalam data demografi, diurutkan secara menaik
        $labels = DemografiPendudukJorong::select('tahun')
            ->distinct()
            ->orderBy('tahun')
            ->pluck('tahun')
            ->toArray();

        // Mengambil semua jorong yang ada
        $jorongs = Jorong::all();

        // Daftar warna untuk setiap dataset (jorong). Tambah lebih banyak jika perlu.
        $colors = [
            '#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6',
            '#14b8a6', '#ec4899', '#6d28d9', '#ca8a04', '#0891b2'
        ];

        $datasets = [];

        // Pastikan ada labels (tahun) sebelum mencoba membuat datasets
        if (!empty($labels)) {
            foreach ($jorongs as $index => $jorong) {
                $dataPerTahun = [];
                foreach ($labels as $tahun) {
                    // Ambil jumlah laki-laki + perempuan untuk jorong dan tahun tertentu
                    $jumlah = DemografiPendudukJorong::where('jorong_id', $jorong->id_jorong)
                        ->where('tahun', $tahun)
                        ->sum(DemografiPendudukJorong::raw('laki_laki + perempuan'));

                    // Pastikan $jumlah adalah integer. Jika null (tidak ada data), anggap 0.
                    $dataPerTahun[] = (int) $jumlah;
                }

                $datasets[] = [
                    'label' => $jorong->nama_jorong, // Ganti 'nama' menjadi 'label' untuk Chart.js
                    'data' => $dataPerTahun,
                    'borderColor' => $colors[$index % count($colors)],
                    'backgroundColor' => $colors[$index % count($colors)],
                ];
            }
        } else {
            // Jika tidak ada data tahun sama sekali, kirim array kosong untuk labels dan datasets
            $labels = [];
            $datasets = [];
        }

        // ================================================

        return view('demografiPenduduk', compact('data', 'tahunTerbaru', 'labels', 'datasets'));
    }

    public function demografiLahan()
    {
        // Ambil tahun terbaru dari data lahan
        $tahunTerbaru = LahanData::max('tahun'); // <-- PERBAIKAN DI SINI: Ubah dari DemografiLahanData ke LahanData

        // Jika tidak ada tahun terbaru, set ke tahun saat ini atau default
        if (is_null($tahunTerbaru)) {
            $tahunTerbaru = date('Y');
            $dataLahan = collect(); // Kembalikan koleksi kosong jika tidak ada data
        } else {
            // Ambil semua data lahan untuk tahun terbaru, dengan eager loading 'lahanJenis'
            $dataLahan = LahanData::with('lahanJenis') // <-- PERBAIKAN DI SINI: Ubah dari DemografiLahanData ke LahanData
                                 ->where('tahun', $tahunTerbaru)
                                 ->orderBy('lahan_jenis_id') // Urutkan agar konsisten
                                 ->get();
        }

        return view('demografiLahan', compact('dataLahan', 'tahunTerbaru'));
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
