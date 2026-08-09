<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PublikasiController extends Controller
{
    /**
     * Tampilkan semua publikasi (list).
     */
    public function index(Request $request)
{
    $query = Publikasi::latest();

    if ($request->filled('jenis')) {
        $query->where('jenis', $request->jenis);
    }

    $publikasi = $query->paginate(10)->withQueryString();

    return view('admin.publikasi.index', compact('publikasi'));
}


    /**
     * Form tambah publikasi.
     */
    public function create()
    {
        return view('admin.publikasi.create');
    }

    /**
     * Simpan publikasi baru.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'nullable|string|max:100',
        'deskripsi' => 'required|string',
        'jenis' => 'required|in:artikel,berita',
        'foto' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('publikasi', 'public');
    }

    $validated['user_id'] = Auth::id();
    $validated['tanggal_update'] = now();

    Publikasi::create($validated);

    return redirect()->route('publikasi.index')->with('success', 'Publikasi berhasil ditambahkan!');
}


    /**
     * Detail publikasi.
     */
    public function show(Publikasi $berita)
    {
        return view('admin.publikasi.show', compact('berita'));
    }

    /**
     * Form edit publikasi.
     */
    public function edit(Publikasi $publikasi)
    {
        return view('admin.publikasi.edit', compact('publikasi'));
    }

    /**
     * Update publikasi.
     */
    public function update(Request $request, Publikasi $publikasi)
        {
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'penulis' => 'nullable|string|max:100',
                'deskripsi' => 'required|string',
                'jenis' => 'required|in:artikel,berita',
                'foto' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                if ($publikasi->foto) {
                    Storage::disk('public')->delete($publikasi->foto);
                }
                $validated['foto'] = $request->file('foto')->store('publikasi', 'public');
            }

            $validated['tanggal_update'] = now();

            $publikasi->update($validated);

            return redirect()->route('publikasi.index')->with('success', 'Publikasi berhasil diperbarui!');
        }


    /**
     * Hapus publikasi.
     */
    public function destroy(Publikasi $publikasi)
    {
        if ($publikasi->foto) {
            Storage::disk('public')->delete($publikasi->foto);
        }

        $publikasi->delete();
        return redirect()->route('publikasi.index')->with('success', 'Publikasi berhasil dihapus!');
    }
}
