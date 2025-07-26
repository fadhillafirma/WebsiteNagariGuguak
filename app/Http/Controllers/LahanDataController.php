<?php

namespace App\Http\Controllers;

use App\Models\LahanData;
use App\Models\LahanJenis;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LahanDataController extends Controller
{
    /**
     * Menampilkan daftar semua data lahan tahunan.
     */
    public function index()
    {
        $data = LahanData::with('lahanJenis')
                         ->join('lahan_jenis', 'lahan_data.lahan_jenis_id', '=', 'lahan_jenis.id_lahan_jenis')
                         ->orderBy('lahan_data.tahun', 'desc')
                         ->orderBy('lahan_jenis.nama_lahan', 'asc')
                         ->select('lahan_data.*')
                         ->paginate(10);

        return view('admin.demografiLahan.index', compact('data'));
    }

    /**
     * Menampilkan form untuk membuat data lahan tahunan baru.
     */
    public function create()
    {
        // Ambil semua jenis lahan dari database untuk dropdown
        $lahan_jenis = LahanJenis::orderBy('nama_lahan')->get();
        // Tidak perlu $kategoriEnum karena akan diisi otomatis
        return view('admin.demografiLahan.create', compact('lahan_jenis'));
    }

    /**
     * Menyimpan data lahan tahunan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lahan_jenis_id' => [ // Sekarang kita validasi lahan_jenis_id
                'required',
                'exists:lahan_jenis,id_lahan_jenis', // Pastikan ID jenis lahan ada di tabel lahan_jenis
                // Pastikan kombinasi lahan_jenis_id dan tahun unik
                Rule::unique('lahan_data')->where(function ($query) use ($request) {
                    return $query->where('lahan_jenis_id', $request->lahan_jenis_id)
                                 ->where('tahun', $request->tahun);
                }),
            ],
            'tahun' => 'required|numeric|integer|min:1900|max:' . (date('Y') + 5),
            'produktif_ha' => 'required|numeric|min:0',
            'tidak_produktif_ha' => 'required|numeric|min:0',
        ], [
            'lahan_jenis_id.unique' => 'Data lahan untuk jenis ini dan tahun yang sama sudah ada.',
            'lahan_jenis_id.exists' => 'Jenis lahan tidak valid.',
            'tahun.max' => 'Tahun tidak boleh melebihi tahun saat ini + 5 tahun.',
        ]);

        $luas_ha = $request->produktif_ha + $request->tidak_produktif_ha;

        LahanData::create([
            'lahan_jenis_id' => $request->lahan_jenis_id, // Langsung pakai ID yang dipilih
            'tahun' => $request->tahun,
            'produktif_ha' => $request->produktif_ha,
            'tidak_produktif_ha' => $request->tidak_produktif_ha,
            'luas_ha' => $luas_ha,
        ]);

        return redirect()->route('demografi-lahan.index')->with('success', 'Data Lahan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data lahan tahunan.
     */
    public function edit($id)
    {
        $lahanData = LahanData::with('lahanJenis')->findOrFail($id);
        // Ambil semua jenis lahan untuk dropdown
        $lahan_jenis = LahanJenis::orderBy('nama_lahan')->get();

        return view('admin.demografiLahan.edit', compact('lahanData', 'lahan_jenis'));
    }

    /**
     * Memperbarui data lahan tahunan di database.
     */
    public function update(Request $request, $id)
    {
        $lahanData = LahanData::findOrFail($id);

        $request->validate([
            'lahan_jenis_id' => [ // Sekarang kita validasi lahan_jenis_id
                'required',
                'exists:lahan_jenis,id_lahan_jenis',
                Rule::unique('lahan_data')->ignore($lahanData->id_lahan_data, 'id_lahan_data')->where(function ($query) use ($request) {
                    return $query->where('lahan_jenis_id', $request->lahan_jenis_id)
                                 ->where('tahun', $request->tahun);
                }),
            ],
            'tahun' => 'required|numeric|integer|min:1900|max:' . (date('Y') + 5),
            'produktif_ha' => 'required|numeric|min:0',
            'tidak_produktif_ha' => 'required|numeric|min:0',
        ], [
            'lahan_jenis_id.unique' => 'Data lahan untuk jenis ini dan tahun yang sama sudah ada.',
            'lahan_jenis_id.exists' => 'Jenis lahan tidak valid.',
            'tahun.max' => 'Tahun tidak boleh melebihi tahun saat ini + 5 tahun.',
        ]);

        $luas_ha = $request->produktif_ha + $request->tidak_produktif_ha;

        $lahanData->update([
            'lahan_jenis_id' => $request->lahan_jenis_id, // Langsung pakai ID yang dipilih
            'tahun' => $request->tahun,
            'produktif_ha' => $request->produktif_ha,
            'tidak_produktif_ha' => $request->tidak_produktif_ha,
            'luas_ha' => $luas_ha,
        ]);

        return redirect()->route('demografi-lahan.index')->with('success', 'Data Lahan berhasil diperbarui!');
    }

    /**
     * Menghapus data lahan tahunan dari database.
     */
    public function destroy($id)
    {
        $lahanData = LahanData::findOrFail($id);
        $lahanData->delete();
        return back()->with('success', 'Data Lahan berhasil dihapus!');
    }
}
