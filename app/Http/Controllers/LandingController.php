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




class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Galeri, berita, artikel
    $galeris = Galeri::latest()->take(6)->get();
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
            'title' => $item->judul,
            'start' => $item->tanggal,
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
    // Ambil tahun terbaru dari seluruh data (bukan dari hasil paginate)
    $tahunTerbaru = DemografiPendudukJorong::max('tahun');

    // Ambil data hanya untuk tahun terbaru
    $data = DemografiPendudukJorong::with('jorong')
        ->where('tahun', $tahunTerbaru)
        ->paginate(20);

    // Ambil semua jorong
    $jorongs = Jorong::all();

    // Warna grafik
    $colors = [
        '#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6',
        '#14b8a6', '#ec4899', '#6d28d9', '#ca8a04', '#0891b2'
    ];

    $labels = []; // label jorong
    $dataJumlah = []; // data penduduk per jorong

    foreach ($jorongs as $jorong) {
        $jumlah = DemografiPendudukJorong::where('jorong_id', $jorong->id_jorong)
            ->where('tahun', $tahunTerbaru)
            ->sum(DemografiPendudukJorong::raw('laki_laki + perempuan'));

        if ($jumlah > 0) {
            $labels[] = $jorong->nama_jorong;
            $dataJumlah[] = (int) $jumlah;
        }
    }

    $datasets = [
        [
            'label' => 'Jumlah Penduduk Tahun ' . $tahunTerbaru,
            'data' => $dataJumlah,
            'backgroundColor' => array_slice($colors, 0, count($dataJumlah)),
            'borderColor' => array_slice($colors, 0, count($dataJumlah)),
            'borderWidth' => 1,
        ]
    ];

    return view('demografiPenduduk', compact('data', 'tahunTerbaru', 'labels', 'datasets'));
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
