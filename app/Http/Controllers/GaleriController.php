<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * List galeri milik user login (atau semua, tergantung kebutuhan).
     */
    public function index()
    {
        // hanya data milik user login:
        $galeri = Galeri::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('admin.galeri.index', compact('galeri'));
    }

    /**
     * Form tambah.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Simpan record baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'deskripsi' => 'nullable|string',
        ]);

        // simpan foto ke storage/app/public/galeri
        $path = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'user_id'   => Auth::id(),
            'foto'      => $path,
            'deskripsi' => $validated['deskripsi'] ?? null,
            'tanggal_post' => now(),
        ]);

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    /**
     * Detail satu foto (opsional dipakai di publik).
     */
    public function show(Galeri $galeri)
    {
        // kalau hanya pemilik yg boleh lihat:
        $this->authorizeOwner($galeri);
        return view('admin.galeri.show', compact('galeri'));
    }

    /**
     * Form edit.
     */
    public function edit(Galeri $galeri)
    {
        $this->authorizeOwner($galeri);
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update record.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $this->authorizeOwner($galeri);

        $validated = $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'deskripsi' => 'nullable|string',
        ]);

        $data = [
            'deskripsi' => $validated['deskripsi'] ?? null,
        ];

        // Kalau upload foto baru, hapus lama
        if ($request->hasFile('foto')) {
            if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    /**
     * Hapus data + file.
     */
    public function destroy(Galeri $galeri)
    {
        $this->authorizeOwner($galeri);

        if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }

    /**
     * Helper: pastikan record milik user login.
     */
    protected function authorizeOwner(Galeri $galeri): void
    {
        if ($galeri->user_id !== Auth::id()) {
            abort(403, 'Tidak diizinkan.');
        }
    }
}
