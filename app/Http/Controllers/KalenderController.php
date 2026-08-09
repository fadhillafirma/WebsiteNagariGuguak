<?php

namespace App\Http\Controllers;

use App\Models\Kalender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KalenderController extends Controller
{
   public function index()
{
    $kalenders = Kalender::orderBy('tanggal', 'desc')->paginate(10);


    return view('admin.kalender.index', [
        'kalender' => $kalenders // Kirim ke view
    ]);
}


    public function create()
{
    // Menampilkan form input untuk membuat kalender baru
    return view('admin.kalender.create'); // pastikan file resources/views/kalender/create.blade.php ada
}

public function store(Request $request)
{
    $request->validate([
        'nama_kegiatan' => 'required|string|max:255',
        'jam_mulai'     => 'required',
        'jam_akhir'     => 'required',
        'tanggal'       => 'required|date',
    ]);

    Kalender::create([
        'user_id'       => Auth::id(), // Ambil user yang sedang login
        'nama_kegiatan' => $request->nama_kegiatan,
        'jam_mulai'     => $request->jam_mulai,
        'jam_akhir'     => $request->jam_akhir,
        'tanggal'       => $request->tanggal,
    ]);

    return redirect()->route('kalender.index')->with('success', 'Kegiatan berhasil ditambahkan');
}


    public function show($id)
    {
        $kalender = Kalender::findOrFail($id);
        return response()->json($kalender);
    }

   public function edit($id)
{
    $kalender = Kalender::findOrFail($id);
    return view('admin.kalender.edit', compact('kalender'));
}

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_kegiatan' => 'required|string|max:255',
        'jam_mulai'     => 'required',
        'jam_akhir'     => 'required',
        'tanggal'       => 'required|date',
    ]);

    $kalender = Kalender::findOrFail($id);
    $kalender->update([
        'nama_kegiatan' => $request->nama_kegiatan,
        'jam_mulai'     => $request->jam_mulai,
        'jam_akhir'     => $request->jam_akhir,
        'tanggal'       => $request->tanggal,
    ]);

    return redirect()->route('kalender.index')->with('success', 'Kegiatan berhasil diperbarui');
}


    public function destroy($id)
    {
        $kalender = Kalender::findOrFail($id);
        $kalender->delete();

        return redirect()->route('kalender.index')->with('success', 'Kegiatan berhasil dihapus');
    }
}
