<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\LembagaBerita;
use App\Models\LembagaProgram;
use App\Models\LembagaTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LembagaSubdomainController extends Controller
{
    public function index($subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();

        $programs = $lembaga->programs()->aktif()->take(6)->get();
        $beritas = $lembaga->beritas()->tayang()->take(4)->get();
        $tugas = $lembaga->tugas()->take(3)->get();

        $info = $this->getThemeInfo($lembaga, $subdomain);

        if (view()->exists("{$subdomain}.profil")) {
            return view("{$subdomain}.profil", compact('lembaga', 'info', 'programs', 'beritas', 'tugas', 'subdomain'));
        }
        return view('lembaga.profil', compact('lembaga', 'info', 'programs', 'beritas', 'subdomain'));
    }

    public function tugasIndex($subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $tugas = $lembaga->tugas()->get();
        $info = $this->getThemeInfo($lembaga, $subdomain);

        if (view()->exists("{$subdomain}.list-tugas")) {
            return view("{$subdomain}.list-tugas", compact('lembaga', 'tugas', 'info', 'subdomain'));
        }
        return abort(404, 'Halaman tugas tidak ditemukan');
    }

    public function programIndex($subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $programs = $lembaga->programs()->aktif()->get();

        $info = $this->getThemeInfo($lembaga, $subdomain);

        if (view()->exists("{$subdomain}.list-program")) {
            return view("{$subdomain}.list-program", compact('lembaga', 'programs', 'info', 'subdomain'));
        }
        return view('lembaga.list-program', compact('lembaga', 'programs', 'info', 'subdomain'));
    }

    public function beritaIndex($subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $beritas = $lembaga->beritas()->tayang()->get();

        $info = $this->getThemeInfo($lembaga, $subdomain);

        if (view()->exists("{$subdomain}.list-berita")) {
            return view("{$subdomain}.list-berita", compact('lembaga', 'beritas', 'info', 'subdomain'));
        }
        return view('lembaga.list-berita', compact('lembaga', 'beritas', 'info', 'subdomain'));
    }

    public function bayarZakat($subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        
        // Hanya untuk upz, jika diperlukan bisa dibatasi
        if ($subdomain !== 'upz') {
            return redirect()->route('lembaga.beranda', ['lembaga' => $subdomain]);
        }

        $info = $this->getThemeInfo($lembaga, $subdomain);
        $rekenings = $lembaga->rekenings()->get();

        if (view()->exists("{$subdomain}.bayar-zakat")) {
            return view("{$subdomain}.bayar-zakat", compact('lembaga', 'info', 'subdomain', 'rekenings'));
        }
        return view('lembaga.bayar-zakat', compact('lembaga', 'info', 'subdomain', 'rekenings'));
    }

    public function showProgram($subdomain, $slug)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $program = $lembaga->programs()->get()->first(function($p) use ($slug) {
            return \Illuminate\Support\Str::slug($p->nama_program) === $slug;
        });

        if (!$program) {
            abort(404);
        }

        $info = $this->getThemeInfo($lembaga, $subdomain);

        if (view()->exists("{$subdomain}.detail-program")) {
            return view("{$subdomain}.detail-program", compact('lembaga', 'program', 'info', 'subdomain'));
        }
        return view('lembaga.detail-program', compact('lembaga', 'program', 'info', 'subdomain'));
    }

    public function showBerita($subdomain, $slug)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $berita = $lembaga->beritas()->get()->first(function($b) use ($slug) {
            return \Illuminate\Support\Str::slug($b->judul) === $slug;
        });

        if (!$berita) {
            abort(404);
        }

        $info = $this->getThemeInfo($lembaga, $subdomain);

        if (view()->exists("{$subdomain}.detail-berita")) {
            return view("{$subdomain}.detail-berita", compact('lembaga', 'berita', 'info', 'subdomain'));
        }
        return view('lembaga.detail-berita', compact('lembaga', 'berita', 'info', 'subdomain'));
    }

    private function getThemeInfo($lembaga, $subdomain)
    {
        $warna = '#16a34a'; // default hijau
        if ($subdomain === 'bumnag') $warna = '#2563eb'; // biru
        if ($subdomain === 'bpn') $warna = '#580F1C'; // merah marun

        return [
            'nama' => $lembaga->nama_lembaga,
            'deskripsi' => $lembaga->deskripsi,
            'warna' => $warna,
        ];
    }

    // ====== AUTH ======

    public function showLogin($subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();

        // Jika sudah login dan pemilik lembaga, langsung ke admin
        if (Auth::check() && Auth::user()->id === $lembaga->user_id) {
            return redirect()->route('lembaga.admin', ['lembaga' => $subdomain]);
        }

        if (view()->exists("{$subdomain}.login")) {
            return view("{$subdomain}.login", compact('lembaga', 'subdomain'));
        }
        return view('lembaga.login', compact('lembaga', 'subdomain'));
    }

    public function login(Request $request, $subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Pastikan user yang login adalah pemilik lembaga ini
            if (Auth::user()->id !== $lembaga->user_id) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun ini tidak memiliki akses ke admin lembaga ini.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            return redirect()->route('lembaga.admin', ['lembaga' => $subdomain]);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request, $subdomain)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('lembaga.beranda', ['lembaga' => $subdomain]);
    }

    // ====== ADMIN PANEL ======

    public function admin($subdomain)
    {
        $lembaga = $this->lembaga($subdomain);
        $info = $this->getThemeInfo($lembaga, $subdomain);

        $programs = $lembaga->programs()->latest()->get();
        $beritas = $lembaga->beritas()->latest()->get();
        $semuaTugas = $lembaga->tugas()->latest()->get();
        $semuaRekening = $lembaga->rekenings()->latest()->get();

        $editProgram = request('edit_program') ? $lembaga->programs()->find(request('edit_program')) : null;
        $editBerita = request('edit_berita') ? $lembaga->beritas()->find(request('edit_berita')) : null;
        $editTugas = request('edit_tugas') ? $lembaga->tugas()->find(request('edit_tugas')) : null;
        $editRekening = request('edit_rekening') ? $lembaga->rekenings()->find(request('edit_rekening')) : null;

        if (view()->exists("{$subdomain}.admin")) {
            return view("{$subdomain}.admin", compact('lembaga', 'info', 'programs', 'beritas', 'semuaTugas', 'semuaRekening', 'subdomain', 'editProgram', 'editBerita', 'editTugas', 'editRekening'));
        }
        return view('lembaga.admin', compact('lembaga', 'info', 'programs', 'beritas', 'semuaTugas', 'semuaRekening', 'subdomain', 'editProgram', 'editBerita', 'editTugas', 'editRekening'));
    }

    public function storeRekening(Request $request, $subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $data = $request->validate([
            'nama_bank' => 'required|string|max:255',
            'nomor_rekening' => 'required|string|max:255',
            'atas_nama' => 'required|string|max:255',
        ]);
        $lembaga->rekenings()->create($data);
        return redirect()->route('lembaga.admin', ['lembaga' => $subdomain, 'tab' => 'rekening'])->with('success', 'Rekening berhasil ditambahkan!');
    }

    public function updateRekening(Request $request, $subdomain, $rekeningId)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $rekening = $lembaga->rekenings()->findOrFail($rekeningId);
        $data = $request->validate([
            'nama_bank' => 'required|string|max:255',
            'nomor_rekening' => 'required|string|max:255',
            'atas_nama' => 'required|string|max:255',
        ]);
        $rekening->update($data);
        return redirect()->route('lembaga.admin', ['lembaga' => $subdomain, 'tab' => 'rekening'])->with('success', 'Rekening berhasil diperbarui!');
    }

    public function destroyRekening($subdomain, $rekeningId)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $rekening = $lembaga->rekenings()->findOrFail($rekeningId);
        $rekening->delete();
        return redirect()->route('lembaga.admin', ['lembaga' => $subdomain, 'tab' => 'rekening'])->with('success', 'Rekening berhasil dihapus!');
    }

    public function storeTugas(Request $request, $subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);
        $lembaga->tugas()->create($data);
        return redirect()->route('lembaga.admin', ['lembaga' => $subdomain, 'tab' => 'tugas'])->with('success', 'Tugas pokok berhasil ditambahkan!');
    }

    public function updateTugas(Request $request, $subdomain, $tugasId)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $tugas = $lembaga->tugas()->findOrFail($tugasId);
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);
        $tugas->update($data);
        return redirect()->route('lembaga.admin', ['lembaga' => $subdomain, 'tab' => 'tugas'])->with('success', 'Tugas pokok berhasil diperbarui!');
    }

    public function destroyTugas($subdomain, $tugasId)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $tugas = $lembaga->tugas()->findOrFail($tugasId);
        $tugas->delete();
        return redirect()->route('lembaga.admin', ['lembaga' => $subdomain, 'tab' => 'tugas'])->with('success', 'Tugas pokok berhasil dihapus!');
    }

    public function storeProgram(Request $request, $subdomain)
    {
        $data = $this->programData($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('lembaga/program', 'public');
        }

        $this->lembaga($subdomain)->programs()->create($data);
        return back()->with('success', 'Program berhasil ditambahkan.');
    }

    public function updateProgram(Request $request, $subdomain, LembagaProgram $program)
    {
        $data = $this->programData($request);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($program->foto && \Storage::disk('public')->exists($program->foto)) {
                \Storage::disk('public')->delete($program->foto);
            }
            $data['foto'] = $request->file('foto')->store('lembaga/program', 'public');
        }

        $this->ownedProgram($subdomain, $program)->update($data);
        return redirect()->route('lembaga.admin', ['lembaga' => $subdomain])->with('success', 'Program berhasil diperbarui.');
    }

    public function destroyProgram($subdomain, LembagaProgram $program)
    {
        $this->ownedProgram($subdomain, $program)->delete();
        return back()->with('success', 'Program berhasil dihapus.');
    }

    public function storeBerita(Request $request, $subdomain)
    {
        $data = $this->beritaData($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('lembaga/berita', 'public');
        }

        $this->lembaga($subdomain)->beritas()->create($data);
        return back()->with('success', 'Berita berhasil ditambahkan.');
    }

    public function updateBerita(Request $request, $subdomain, LembagaBerita $berita)
    {
        $data = $this->beritaData($request);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($berita->foto && \Storage::disk('public')->exists($berita->foto)) {
                \Storage::disk('public')->delete($berita->foto);
            }
            $data['foto'] = $request->file('foto')->store('lembaga/berita', 'public');
        }

        $this->ownedBerita($subdomain, $berita)->update($data);
        return redirect()->route('lembaga.admin', ['lembaga' => $subdomain])->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroyBerita($subdomain, LembagaBerita $berita)
    {
        $this->ownedBerita($subdomain, $berita)->delete();
        return back()->with('success', 'Berita berhasil dihapus.');
    }

    public function updateProfil(Request $request, $subdomain)
    {
        $lembaga = $this->lembaga($subdomain);

        $validated = $request->validate([
            'nama_ketua' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto_lembaga' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'struktur_organisasi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
        ]);

        if ($request->hasFile('foto_lembaga')) {
            $validated['foto_lembaga'] = $request->file('foto_lembaga')->store('lembaga', 'public');
        }

        if ($request->hasFile('struktur_organisasi')) {
            $validated['struktur_organisasi'] = $request->file('struktur_organisasi')->store('lembaga', 'public');
        }

        $lembaga->update($validated);

        return redirect()->route('lembaga.admin', ['lembaga' => $subdomain, 'tab' => 'profil'])->with('success', 'Profil dan struktur organisasi lembaga berhasil diperbarui.');
    }

    private function lembaga($subdomain)
    {
        return Lembaga::where('subdomain', $subdomain)->firstOrFail();
    }

    private function ownedProgram($subdomain, LembagaProgram $program)
    {
        abort_unless($program->lembaga_id === $this->lembaga($subdomain)->id, 404);
        return $program;
    }

    private function ownedBerita($subdomain, LembagaBerita $berita)
    {
        abort_unless($berita->lembaga_id === $this->lembaga($subdomain)->id, 404);
        return $berita;
    }

    private function programData(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
        ]);

        return $request->validate([
            'nama_program' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'penerima_manfaat' => 'nullable|string|max:100',
            'alokasi_dana' => 'nullable|numeric|min:0',
            'status' => 'required|in:aktif,selesai,draf',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
        ]);
    }

    private function beritaData(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
        ]);

        return $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'kategori' => 'required|string|max:100',
            'penulis' => 'nullable|string|max:100',
            'status' => 'required|in:tayang,draf',
            'tanggal_tayang' => 'nullable|date',
        ]);
    }
}
