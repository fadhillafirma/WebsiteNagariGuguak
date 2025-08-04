<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LembagaController extends Controller
{
    public function index()
    {
        $lembagas = Lembaga::with('user')->latest()->get();
        return view('admin.lembaga.index', compact('lembagas'));
    }

    public function create()
    {
        return view('admin.lembaga.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_lembaga' => 'required|string|max:255',
        'foto_lembaga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'deskripsi' => 'required|string',
        'struktur_organisasi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'nama_ketua' => 'required|string|max:255',
    ]);

    $data = $request->only(['nama_lembaga', 'deskripsi', 'nama_ketua']);
    $data['user_id'] = Auth::id();

    if ($request->hasFile('foto_lembaga')) {
        $data['foto_lembaga'] = $request->file('foto_lembaga')->store('foto_lembaga', 'public');
    }

    if ($request->hasFile('struktur_organisasi')) {
        $data['struktur_organisasi'] = $request->file('struktur_organisasi')->store('struktur_organisasi', 'public');
    }

    Lembaga::create($data);

    return redirect()->route('lembaga.index')->with('success', 'Data lembaga berhasil ditambahkan.');
}

    public function show(Lembaga $lembaga)
    {
        return view('admin.lembaga.show', compact('lembaga'));
    }

    public function edit(Lembaga $lembaga)
    {
        return view('admin.lembaga.edit', compact('lembaga'));
    }

    public function update(Request $request, Lembaga $lembaga)
{
    $request->validate([
        'nama_lembaga' => 'required|string|max:255',
        'foto_lembaga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'deskripsi' => 'required|string',
        'struktur_organisasi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'nama_ketua' => 'required|string|max:255',
    ]);

    $data = $request->only(['nama_lembaga', 'deskripsi', 'nama_ketua']);

    if ($request->hasFile('foto_lembaga')) {
        if ($lembaga->foto_lembaga) {
            Storage::disk('public')->delete($lembaga->foto_lembaga);
        }
        $data['foto_lembaga'] = $request->file('foto_lembaga')->store('foto_lembaga', 'public');
    }

    if ($request->hasFile('struktur_organisasi')) {
        if ($lembaga->struktur_organisasi) {
            Storage::disk('public')->delete($lembaga->struktur_organisasi);
        }
        $data['struktur_organisasi'] = $request->file('struktur_organisasi')->store('struktur_organisasi', 'public');
    }

    $lembaga->update($data);

    return redirect()->route('lembaga.index')->with('success', 'Data lembaga berhasil diperbarui.');
}

    public function destroy(Lembaga $lembaga)
    {
        if ($lembaga->foto_lembaga) {
            Storage::disk('public')->delete($lembaga->foto_lembaga);
        }

        if ($lembaga->struktur_organisasi) {
            Storage::disk('public')->delete($lembaga->struktur_organisasi);
        }

        $lembaga->delete();

        return redirect()->route('lembaga.index')->with('success', 'Data lembaga berhasil dihapus.');
    }
}
