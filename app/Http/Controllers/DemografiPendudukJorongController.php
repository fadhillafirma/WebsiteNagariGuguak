<?php

namespace App\Http\Controllers;

use App\Models\DemografiPendudukJorong;
use App\Models\Jorong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DemografiPendudukJorongController extends Controller
{
    /**
     * List data penduduk jorong milik user login.
     */
   public function index()
{
    $data = DemografiPendudukJorong::with('jorong')
        ->join('jorong', 'jorong.id_jorong', '=', 'demografi_penduduk_jorong.jorong_id')
        ->where('demografi_penduduk_jorong.user_id', Auth::id()) // fix di sini
        ->orderByDesc('demografi_penduduk_jorong.tahun')
        ->orderBy('jorong.nama_jorong')
        ->select('demografi_penduduk_jorong.*')
        ->paginate(20);

    return view('admin.demografiPendudukJorong.index', compact('data'));
}



    /**
     * Form create.
     */
    public function create()
    {
        $jorongList = Jorong::where('user_id', Auth::id())
            ->orderBy('nama_jorong')
            ->get(['id_jorong', 'nama_jorong']);

        return view('admin.demografiPendudukJorong.create', compact('jorongList'));
    }

    /**
     * Store row.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'jorong_id' => [
                'required',
                Rule::exists('jorong', 'id_jorong')->where(fn($q) => $q->where('user_id', $userId)),
            ],
            'tahun' => [
                'required',
                'integer',
                'digits:4',
                'min:1900',
                'max:' . (date('Y') + 1),
                Rule::unique('demografi_penduduk_jorong', 'tahun')
                    ->where(fn($q) => $q->where('user_id', $userId)
                                        ->where('jorong_id', $request->jorong_id)),
            ],
            'kk'         => 'nullable|integer|min:0',
            'laki_laki'  => 'nullable|integer|min:0',
            'perempuan'  => 'nullable|integer|min:0',
        ]);

        $validated['user_id'] = $userId;
        $validated['kk'] = $validated['kk'] ?? 0;
        $validated['laki_laki'] = $validated['laki_laki'] ?? 0;
        $validated['perempuan'] = $validated['perempuan'] ?? 0;

        DemografiPendudukJorong::create($validated);

        return redirect()
            ->route('demografi-penduduk-jorong.index')
            ->with('success', 'Data penduduk per jorong berhasil ditambahkan.');
    }

    /**
     * Show detail row.
     */
    public function show(DemografiPendudukJorong $demografi_penduduk_jorong)
    {
        $this->authorizeOwner($demografi_penduduk_jorong);
        $demografi_penduduk_jorong->load('jorong');
        return view('admin.demografiPendudukJorong.show', [
            'row' => $demografi_penduduk_jorong,
        ]);
    }

    /**
     * Form edit row.
     */
    public function edit(DemografiPendudukJorong $demografi_penduduk_jorong)
    {
        $this->authorizeOwner($demografi_penduduk_jorong);

        $jorongList = Jorong::where('user_id', Auth::id())
            ->orderBy('nama_jorong')
            ->get(['id_jorong', 'nama_jorong']);

        return view('admin.demografiPendudukJorong.edit', [
            'row' => $demografi_penduduk_jorong,
            'jorongList' => $jorongList,
        ]);
    }

    /**
     * Update row.
     */
    public function update(Request $request, DemografiPendudukJorong $demografi_penduduk_jorong)
    {
        $this->authorizeOwner($demografi_penduduk_jorong);

        $userId = Auth::id();

        $validated = $request->validate([
            'jorong_id' => [
                'required',
                Rule::exists('jorong', 'id_jorong')->where(fn($q) => $q->where('user_id', $userId)),
            ],
            'tahun' => [
                'required',
                'integer',
                'digits:4',
                'min:1900',
                'max:' . (date('Y') + 1),
                Rule::unique('demografi_penduduk_jorong', 'tahun')
                    ->where(fn($q) => $q->where('user_id', $userId)
                                        ->where('jorong_id', $request->jorong_id))
                    ->ignore($demografi_penduduk_jorong->id_penduduk_jorong, 'id_penduduk_jorong'),
            ],
            'kk'         => 'nullable|integer|min:0',
            'laki_laki'  => 'nullable|integer|min:0',
            'perempuan'  => 'nullable|integer|min:0',
        ]);

        $validated['kk'] = $validated['kk'] ?? 0;
        $validated['laki_laki'] = $validated['laki_laki'] ?? 0;
        $validated['perempuan'] = $validated['perempuan'] ?? 0;

        $demografi_penduduk_jorong->update($validated);

        return redirect()
            ->route('demografi-penduduk-jorong.index')
            ->with('success', 'Data penduduk per jorong berhasil diperbarui.');
    }

    /**
     * Delete row.
     */
    public function destroy(DemografiPendudukJorong $demografi_penduduk_jorong)
    {
        $this->authorizeOwner($demografi_penduduk_jorong);
        $demografi_penduduk_jorong->delete();

        return redirect()
            ->route('demografi-penduduk-jorong.index')
            ->with('success', 'Data penduduk per jorong berhasil dihapus.');
    }

    /**
     * Pastikan user pemilik data.
     */
    protected function authorizeOwner(DemografiPendudukJorong $row): void
    {
        if ($row->user_id !== Auth::id()) {
            abort(403, 'Tidak diizinkan.');
        }
    }
}
