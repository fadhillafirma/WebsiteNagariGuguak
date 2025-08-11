<?php

namespace App\Http\Controllers;

use App\Models\Jorong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JorongController extends Controller
{
    public function index()
    {
        $jorongs = Jorong::latest()->paginate(10);
        return view('admin.jorong.index', compact('jorongs'));
    }

    public function create()
    {
        return view('admin.jorong.create');
    }

        public function store(Request $request)
        {
            $request->validate([
                'nama_jorong' => 'required|string|max:255',
                'kepala_jorong' => 'required|string|max:255',
                'deskripsi_jorong' => 'nullable|string',
                'foto_kepala_jorong' => 'nullable|image|max:2048',
                'foto_jorong' => 'nullable|image|max:2048',

            ]);

            $data = $request->only([
                'nama_jorong',
                'kepala_jorong',
                'deskripsi_jorong',
            ]);

            // Tambahkan user_id dari user yang sedang login
            $data['user_id'] = auth()->id();

            if ($request->hasFile('foto_kepala_jorong')) {
                $data['foto_kepala_jorong'] = $request->file('foto_kepala_jorong')->store('foto_jorong', 'public');
            }

             if ($request->hasFile('foto_jorong')) {
                $data['foto_jorong'] = $request->file('foto_jorong')->store('foto_jorong', 'public');
            }

            Jorong::create($data);

            return redirect()->route('jorong.index')->with('success', 'Jorong berhasil ditambahkan!');
        }


    public function show(string $id)
    {
        $jorong = Jorong::findOrFail($id);
        return view('admin.jorong.show', compact('jorong'));
    }

    public function edit(string $id)
    {
        $jorong = Jorong::findOrFail($id);
        return view('admin.jorong.edit', compact('jorong'));
    }

    public function update(Request $request, string $id)
{
    $jorong = Jorong::findOrFail($id);

    $request->validate([
        'nama_jorong' => 'required|string|max:255',
        'kepala_jorong' => 'required|string|max:255',
        'deskripsi_jorong' => 'nullable|string',
        'foto_kepala_jorong' => 'nullable|image|max:2048',
    ]);

    $data = $request->only([
        'nama_jorong',
        'kepala_jorong',
        'deskripsi_jorong',
    ]);

    if ($request->hasFile('foto_kepala_jorong')) {
        // Hapus file lama jika ada
        if ($jorong->foto_kepala_jorong && Storage::disk('public')->exists($jorong->foto_kepala_jorong)) {
            Storage::disk('public')->delete($jorong->foto_kepala_jorong);
        }

        $data['foto_kepala_jorong'] = $request->file('foto_kepala_jorong')->store('foto_jorong', 'public');
    }

    $jorong->update($data);

    return redirect()->route('jorong.index')->with('success', 'Jorong berhasil diperbarui!');
}


    public function destroy(string $id)
    {
        $jorong = Jorong::findOrFail($id);

        if ($jorong->foto_kepala_jorong && Storage::disk('public')->exists($jorong->foto_kepala_jorong)) {
            Storage::disk('public')->delete($jorong->foto_kepala_jorong);
        }

        $jorong->delete();

        return redirect()->route('jorong.index')->with('success', 'Jorong berhasil dihapus!');
    }
}
