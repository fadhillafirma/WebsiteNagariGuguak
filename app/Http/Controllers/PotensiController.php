<?php

namespace App\Http\Controllers;

use App\Models\Potensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PotensiController extends Controller
{
    public function index()
    {
        $potensis = Potensi::with('user')->latest()->paginate(10); // default 10 per halaman
        return view('admin.potensi.index', compact('potensis'));
    }


    public function create()
    {
        return view('admin.potensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_potensi' => 'required|in:pertanian,pariwisata,perekonomian,lainnya',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('potensi', 'public');
        }

        Potensi::create([
            'user_id' => Auth::id(),
            'jenis_potensi' => $request->jenis_potensi,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('potensi.index')->with('success', 'Data potensi berhasil ditambahkan.');
    }

    public function show(Potensi $potensi)
    {
        return view('admin.potensi.show', compact('potensi'));
    }

    public function edit(Potensi $potensi)
    {
        return view('admin.potensi.edit', compact('potensi'));
    }

    public function update(Request $request, Potensi $potensi)
    {
        $request->validate([
            'jenis_potensi' => 'required|in:pertanian,pariwisata,perekonomian,lainnya',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($potensi->gambar) {
                Storage::disk('public')->delete($potensi->gambar);
            }
            $potensi->gambar = $request->file('gambar')->store('potensi', 'public');
        }

        $potensi->update([
            'jenis_potensi' => $request->jenis_potensi,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $potensi->gambar,
        ]);

        return redirect()->route('potensi.index')->with('success', 'Data potensi berhasil diperbarui.');
    }

    public function destroy(Potensi $potensi)
    {
        if ($potensi->gambar) {
            Storage::disk('public')->delete($potensi->gambar);
        }

        $potensi->delete();

        return redirect()->route('potensi.index')->with('success', 'Data potensi berhasil dihapus.');
    }
}
