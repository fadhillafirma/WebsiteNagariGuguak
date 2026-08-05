<?php

namespace App\Http\Controllers;

use App\Models\SitusLembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SitusLembagaController extends Controller
{
    public function index()
    {
        $situs_lembagas = SitusLembaga::latest()->get();
        return view('admin.situs_lembaga.index', compact('situs_lembagas'));
    }

    public function create()
    {
        return view('admin.situs_lembaga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_situs' => 'required|string|max:255',
            'url_situs' => 'required|string|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->only(['nama_situs', 'url_situs', 'deskripsi']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logo_situs', 'public');
        }

        SitusLembaga::create($data);

        return redirect()->route('situs-lembaga.index')->with('success', 'Data Situs Lembaga berhasil ditambahkan.');
    }

    public function edit(SitusLembaga $situs_lembaga)
    {
        return view('admin.situs_lembaga.edit', compact('situs_lembaga'));
    }

    public function update(Request $request, SitusLembaga $situs_lembaga)
    {
        $request->validate([
            'nama_situs' => 'required|string|max:255',
            'url_situs' => 'required|string|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->only(['nama_situs', 'url_situs', 'deskripsi']);

        if ($request->hasFile('logo')) {
            if ($situs_lembaga->logo) {
                Storage::disk('public')->delete($situs_lembaga->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo_situs', 'public');
        }

        $situs_lembaga->update($data);

        return redirect()->route('situs-lembaga.index')->with('success', 'Data Situs Lembaga berhasil diperbarui.');
    }

    public function destroy(SitusLembaga $situs_lembaga)
    {
        if ($situs_lembaga->logo) {
            Storage::disk('public')->delete($situs_lembaga->logo);
        }

        $situs_lembaga->delete();

        return redirect()->route('situs-lembaga.index')->with('success', 'Data Situs Lembaga berhasil dihapus.');
    }
}
