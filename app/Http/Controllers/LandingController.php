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

use App\Models\Kalender;
use Carbon\Carbon;
use App\Models\Potensi;
use App\Models\Lembaga;





class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
            // Galeri, berita, artikel
            $galeris = Galeri::latest('tanggal_post')->take(6)->get();
            $beritas = Publikasi::where('jenis', 'berita')->latest()->take(6)->get();
            $artikels = Publikasi::where('jenis', 'artikel')->latest()->take(6)->get();

            // Kalender kegiatan bulan ini
            $now = Carbon::now();
            $kalender = Kalender::whereMonth('tanggal', $now->month)
                                ->whereYear('tanggal', $now->year)
                                ->get();

            // Format event untuk FullCalendar
            $events = $kalender->map(function ($item) {
                return [
                    'title' => $item->nama_kegiatan,
                    'start' => $item->tanggal . 'T' . $item->jam_mulai,
                    'end' => $item->tanggal . 'T' . $item->jam_akhir,
                ];
            });

            return view('welcome', compact('galeris', 'beritas', 'artikels', 'events'));
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
        ->orderBy('tanggal_update', 'desc')
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

    public function showPotensi($id)
    {
        $potensi = Potensi::findOrFail($id);

        return view('admin.potensi.show', compact('potensi'));
    }



    public function potensi()
    {
        $potensis = Potensi::orderBy('tanggal_post', 'desc')->get()->groupBy('jenis_potensi');
          $jenisPotensiList = $potensis->keys();
        return view('potensi', compact('potensis', 'jenisPotensiList'));
    }



public function demografiSekolah()
{
    $tahunTerbaru = DemografiSekolah::max('tahun');
    $data = DemografiSekolah::where('tahun', $tahunTerbaru)->get();

    $jumlahPaud = $data->sum('jumlah_paud');
    $jumlahSd = $data->sum('jumlah_sd');
    $jumlahSmp = $data->sum('jumlah_smp');
    $jumlahSma = $data->sum('jumlah_sma');

    // Tambahkan warna (opsional bisa dari DB, config, dll)
    $warnaChart = [
        '#004225',
        '#037946',
        '#05cb76ff',
        '#71efb9ff'
    ];


    //  greenDark: '#004225',
    //     green: '#015b34ff',
    //     green1: '#027a46ff',
    //     green2: '#029656ff',
    //     green3: '#02b869ff',





    return view('demografiSekolah', compact(
        'data',
        'tahunTerbaru',
        'jumlahPaud',
        'jumlahSd',
        'jumlahSmp',
        'jumlahSma',
        'warnaChart'
    ));
}


public function demografiPekerjaan ()
    {
        $tahunTerbaru = DemografiPekerjaan::max('tahun');

        $data = DemografiPekerjaan::where('tahun', $tahunTerbaru)->first();

        return view('demografiPekerjaan', compact('data', 'tahunTerbaru'));
    }


  public function demografiPenduduk()
{
    // Ambil daftar tahun yang tersedia
    $tahunList = DemografiPendudukJorong::select('tahun')
        ->distinct()
        ->orderBy('tahun', 'asc')
        ->pluck('tahun');

    // Tahun terbaru
    $tahunTerbaru = $tahunList->last();

    // Data tabel: tampilkan data tahun terbaru
    $data = DemografiPendudukJorong::with('jorong')
        ->when($tahunTerbaru, fn($q) => $q->where('tahun', $tahunTerbaru))
        ->paginate(20);

    // Semua jorong (untuk label sumbu X chart)
    $jorongs = Jorong::all();

    // Warna untuk setiap dataset
    $colors = [
        '#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6',
        '#14b8a6', '#ec4899', '#6d28d9', '#ca8a04', '#0891b2'
    ];

    // Label chart = nama jorong
    $labels = $jorongs->pluck('nama_jorong')->toArray();
    $datasets = [];

    foreach ($tahunList as $index => $tahun) {
        $dataJumlah = [];
        foreach ($jorongs as $jorong) {
            $jumlah = DemografiPendudukJorong::where('jorong_id', $jorong->id_jorong)
                ->where('tahun', $tahun)
                ->sum(\DB::raw('laki_laki + perempuan'));

            $dataJumlah[] = (int) $jumlah;
        }

        $datasets[] = [
            'label' => 'Tahun ' . $tahun,
            'data' => $dataJumlah,
            'borderColor' => $colors[$index % count($colors)],
            'backgroundColor' => null,
            'fill' => false,
            'tension' => 0.1,
        ];
    }

    return view('demografiPenduduk', compact(
        'data',
        'tahunTerbaru',
        'labels',
        'datasets',
        'tahunList'
    ));
}



  public function demografiLahan()
{
    $tahunTerbaru = LahanData::max('tahun');

    if (is_null($tahunTerbaru)) {
        $tahunTerbaru = date('Y');
        $dataLahan = collect();
        $sawah = collect();
        $kebun = collect();
        $lainnya = collect();


    } else {
        $dataLahan = LahanData::with('lahanJenis')
            ->where('tahun', $tahunTerbaru)
            ->orderBy('lahan_jenis_id')
            ->get();

       $sawah = $dataLahan->filter(function ($item) {
            return $item->lahanJenis->kategori === 'sawah';
        });

        $kebun = $dataLahan->filter(function ($item) {
            return $item->lahanJenis->kategori === 'perkebunan';
        });

         $lainnya = $dataLahan->filter(function ($item) {
            return $item->lahanJenis->kategori === 'lainnya';
        });

    }

    $luasSawah = $sawah->sum('luas_ha');
    $luasKebun = $kebun->sum('luas_ha');

    return view('demografiLahan', compact('dataLahan', 'tahunTerbaru', 'luasSawah', 'luasKebun'));
}



public function artikel()
{
    $artikels = Publikasi::where('jenis', 'artikel')
        ->orderBy('tanggal_update', 'desc')
        ->get();

    return view('artikel', compact('artikels'));
}


public function jorong()
{
    $jorongs = Jorong::all();
    return view('jorong', compact('jorongs'));
}


public function jorongShow($id)
{
    $jorong = Jorong::findOrFail($id); // Akan throw 404 kalau tidak ketemu

    return view('admin.jorong.detail', [
        'nama_jorong' => $jorong->nama_jorong,
        'kepala_jorong' => $jorong->kepala_jorong,
        'deskripsi_jorong' => $jorong->deskripsi_jorong,
        'foto_kepala_jorong' => $jorong->foto_kepala_jorong,
        'foto_jorong' => $jorong->foto_jorong,

        'tahunTerbaru' => $jorong->created_at->format('Y'),
    ]);
}


public function lembaga()
{
    $lembaga = Lembaga::all();

    return view('lembaga', [
        'lembaga' => $lembaga,
        'tahunTerbaru' => now()->year,
    ]);
}




public function lembagaShow($id)
{
    $lembaga = Lembaga::findOrFail($id); // Akan 404 kalau tidak ditemukan

    return view('admin.lembaga.detail', [ // Pastikan path view sesuai
        'nama_lembaga' => $lembaga->nama_lembaga,
        'foto_lembaga' => $lembaga->foto_lembaga,
        'deskripsi_lembaga' => $lembaga->deskripsi,
        'nama_ketua' => $lembaga->nama_ketua,

        'struktur_organisasi' => $lembaga->struktur_organisasi,
        'tahunTerbaru' => $lembaga->created_at->format('Y'),
    ]);
}




    public function situsLembaga()
    {
        $situs_lembagas = \App\Models\SitusLembaga::all();
        return view('situsLembaga', compact('situs_lembagas'));
    }

}

