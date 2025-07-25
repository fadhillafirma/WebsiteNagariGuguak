<?php

namespace App\Http\Controllers;

use App\Models\LahanData;
use App\Models\LahanJenis;
use Illuminate\Http\Request;

class LahanDataController extends Controller
{
    public function index()
    {
        $data = LahanData::with('lahanJenis')->latest()->get();
        return view('admin.demografiLahan.index', compact('data'));
    }

    public function create()
    {
        $lahan_jenis = LahanJenis::all();
        return view('admin.demografiLahan.create', compact('lahan_jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lahan_jenis_id' => 'required|exists:lahan_jenis,id_lahan_jenis',
            'tahun' => 'required|numeric',
            'produktif_ha' => 'required|numeric',
            'tidak_produktif_ha' => 'required|numeric',
        ]);

        $luas = $request->produktif_ha + $request->tidak_produktif_ha;

        LahanData::create([
            'lahan_jenis_id' => $request->lahan_jenis_id,
            'tahun' => $request->tahun,
            'produktif_ha' => $request->produktif_ha,
            'tidak_produktif_ha' => $request->tidak_produktif_ha,
            'luas_ha' => $luas,
        ]);

        return redirect()->route('lahan_data.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = LahanData::findOrFail($id);
        $lahan_jenis = LahanJenis::all();
        return view('admin.demografiLahan..edit', compact('data', 'lahan_jenis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lahan_jenis_id' => 'required|exists:lahan_jenis,id_lahan_jenis',
            'tahun' => 'required|numeric',
            'produktif_ha' => 'required|numeric',
            'tidak_produktif_ha' => 'required|numeric',
        ]);

        $data = LahanData::findOrFail($id);
        $luas = $request->produktif_ha + $request->tidak_produktif_ha;

        $data->update([
            'lahan_jenis_id' => $request->lahan_jenis_id,
            'tahun' => $request->tahun,
            'produktif_ha' => $request->produktif_ha,
            'tidak_produktif_ha' => $request->tidak_produktif_ha,
            'luas_ha' => $luas,
        ]);

        return redirect()->route('lahan_data.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = LahanData::findOrFail($id);
        $data->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
