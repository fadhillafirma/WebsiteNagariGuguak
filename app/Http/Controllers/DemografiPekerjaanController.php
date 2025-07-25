<?php

namespace App\Http\Controllers;

use App\Models\DemografiPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DemografiPekerjaanController extends Controller
{
    /**
     * List data per user login.
     */
    public function index()
    {
        $data = DemografiPekerjaan::where('user_id', Auth::id())
            ->orderByDesc('tahun')
            ->paginate(15);

        return view('admin.demografiPekerjaan.index', compact('data'));
    }

    /**
     * Form create.
     */
    public function create()
    {
        return view('admin.demografiPekerjaan.create');
    }

    /**
     * Store new row.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'tahun' => [
                'required',
                'integer',
                'digits:4',
                'min:1900',
                'max:' . (date('Y') + 1),
                Rule::unique('demografi_pekerjaan', 'tahun')->where(
                    fn ($q) => $q->where('user_id', $userId)
                ),
            ],
            'petani'               => 'nullable|integer|min:0',
            'pegawai_negeri'       => 'nullable|integer|min:0',
            'karyawan_swasta'      => 'nullable|integer|min:0',
            'pedagang'             => 'nullable|integer|min:0',
            'tni'                  => 'nullable|integer|min:0',
            'pensiunan'            => 'nullable|integer|min:0',
            'aparat_pemerintahan'  => 'nullable|integer|min:0',
            'pekerjaan_lain'       => 'nullable|integer|min:0',
        ]);

        $validated['user_id'] = $userId;

        // Pastikan semua kolom numeric ada default 0
        foreach (['petani','pegawai_negeri','karyawan_swasta','pedagang','tni','pensiunan','aparat_pemerintahan','pekerjaan_lain'] as $f) {
            $validated[$f] = $validated[$f] ?? 0;
        }

        DemografiPekerjaan::create($validated);

        return redirect()->route('demografi-pekerjaan.index')
            ->with('success', 'Data demografi pekerjaan berhasil ditambahkan.');
    }

    /**
     * Show detail (opsional).
     */
    public function show(DemografiPekerjaan $demografi_pekerjaan)
    {
        $this->authorizeOwner($demografi_pekerjaan);
        return view('admin.demografiPekerjaan.show', ['row' => $demografi_pekerjaan]);
    }

    /**
     * Form edit.
     */
    public function edit(DemografiPekerjaan $demografi_pekerjaan)
    {
        $this->authorizeOwner($demografi_pekerjaan);
        return view('admin.demografiPekerjaan.edit', ['row' => $demografi_pekerjaan]);
    }

    /**
     * Update row.
     */
    public function update(Request $request, DemografiPekerjaan $demografi_pekerjaan)
    {
        $this->authorizeOwner($demografi_pekerjaan);
        $userId = Auth::id();

        $validated = $request->validate([
            'tahun' => [
                'required',
                'integer',
                'digits:4',
                'min:1900',
                'max:' . (date('Y') + 1),
                Rule::unique('demografi_pekerjaan', 'tahun')
                    ->where(fn ($q) => $q->where('user_id', $userId))
                    ->ignore($demografi_pekerjaan->id_pekerjaan, 'id_pekerjaan'),
            ],
            'petani'               => 'nullable|integer|min:0',
            'pegawai_negeri'       => 'nullable|integer|min:0',
            'karyawan_swasta'      => 'nullable|integer|min:0',
            'pedagang'             => 'nullable|integer|min:0',
            'tni'                  => 'nullable|integer|min:0',
            'pensiunan'            => 'nullable|integer|min:0',
            'aparat_pemerintahan'  => 'nullable|integer|min:0',
            'pekerjaan_lain'       => 'nullable|integer|min:0',
        ]);

        foreach (['petani','pegawai_negeri','karyawan_swasta','pedagang','tni','pensiunan','aparat_pemerintahan','pekerjaan_lain'] as $f) {
            $validated[$f] = $validated[$f] ?? 0;
        }

        $demografi_pekerjaan->update($validated);

        return redirect()->route('demografi-pekerjaan.index')
            ->with('success', 'Data demografi pekerjaan berhasil diperbarui.');
    }

    /**
     * Destroy row.
     */
    public function destroy(DemografiPekerjaan $demografi_pekerjaan)
    {
        $this->authorizeOwner($demografi_pekerjaan);
        $demografi_pekerjaan->delete();

        return redirect()->route('demografi-pekerjaan.index')
            ->with('success', 'Data demografi pekerjaan berhasil dihapus.');
    }

    /**
     * Pastikan data milik user login.
     */
    protected function authorizeOwner(DemografiPekerjaan $row): void
    {
        if ($row->user_id !== Auth::id()) {
            abort(403, 'Tidak diizinkan.');
        }
    }
}
