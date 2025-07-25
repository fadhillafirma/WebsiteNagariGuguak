<?php

namespace App\Http\Controllers;

use App\Models\DemografiSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemografiSekolahController extends Controller
{
    public function index()
    {
        $data = DemografiSekolah::latest()->paginate(10);
        return view('admin.demografiSekolah.index', compact('data'));
    }

    public function create()
    {
        return view('admin.demografiSekolah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'jumlah_smp' => 'required|integer|min:0',
            'jumlah_sma' => 'required|integer|min:0',
            'jumlah_sd' => 'required|integer|min:0',
            'jumlah_paud' => 'required|integer|min:0',
        ]);

        $validated['user_id'] = Auth::id();

        DemografiSekolah::create($validated);
        return redirect()->route('demografi-sekolah.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(DemografiSekolah $demografiSekolah)
    {
        return view('admin.demografiSekolah.edit', compact('demografiSekolah'));
    }

    public function update(Request $request, DemografiSekolah $demografiSekolah)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'jumlah_smp' => 'required|integer|min:0',
            'jumlah_sma' => 'required|integer|min:0',
            'jumlah_sd' => 'required|integer|min:0',
            'jumlah_paud' => 'required|integer|min:0',
        ]);

        $demografiSekolah->update($validated);
        return redirect()->route('demografi-sekolah.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(DemografiSekolah $demografiSekolah)
    {
        $demografiSekolah->delete();
        return redirect()->route('demografi-sekolah.index')->with('success', 'Data berhasil dihapus!');
    }
}
