<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\LembagaBerita;
use App\Models\LembagaProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LembagaSubdomainController extends Controller
{
    public function index($subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->first();

        if (!$lembaga) {
            return response()->view('errors.404', ['message' => "Lembaga '$subdomain' tidak ditemukan."], 404);
        }

        $programs = $lembaga->programs()->aktif()->take(6)->get();
        $beritas = $lembaga->beritas()->tayang()->take(4)->get();

        $info = [
            'nama' => $lembaga->nama_lembaga,
            'deskripsi' => $lembaga->deskripsi,
            'warna' => $subdomain == 'bumnag' ? '#2563eb' : '#16a34a',
        ];

        return view('lembaga.profil-sementara', compact('lembaga', 'info', 'programs', 'beritas', 'subdomain'));
    }

    public function programIndex($subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $programs = $lembaga->programs()->aktif()->get();

        $info = [
            'nama' => $lembaga->nama_lembaga,
            'deskripsi' => $lembaga->deskripsi,
            'warna' => $subdomain == 'bumnag' ? '#2563eb' : '#16a34a',
        ];

        return view('lembaga.list-program', compact('lembaga', 'programs', 'info', 'subdomain'));
    }

    public function beritaIndex($subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();
        $beritas = $lembaga->beritas()->tayang()->get();

        $info = [
            'nama' => $lembaga->nama_lembaga,
            'deskripsi' => $lembaga->deskripsi,
            'warna' => $subdomain == 'bumnag' ? '#2563eb' : '#16a34a',
        ];

        return view('lembaga.list-berita', compact('lembaga', 'beritas', 'info', 'subdomain'));
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

        $info = [
            'nama' => $lembaga->nama_lembaga,
            'deskripsi' => $lembaga->deskripsi,
            'warna' => $subdomain == 'bumnag' ? '#2563eb' : '#16a34a',
        ];

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

        $info = [
            'nama' => $lembaga->nama_lembaga,
            'deskripsi' => $lembaga->deskripsi,
            'warna' => $subdomain == 'bumnag' ? '#2563eb' : '#16a34a',
        ];

        return view('lembaga.detail-berita', compact('lembaga', 'berita', 'info', 'subdomain'));
    }

    // ====== AUTH ======

    public function showLogin($subdomain)
    {
        $lembaga = Lembaga::where('subdomain', $subdomain)->firstOrFail();

        // Jika sudah login dan pemilik lembaga, langsung ke admin
        if (Auth::check() && Auth::user()->id === $lembaga->user_id) {
            return redirect()->route('lembaga.admin', ['lembaga' => $subdomain]);
        }

        return view('lembaga.login-upz', compact('lembaga', 'subdomain'));
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

        // Cek apakah sudah login dan pemilik
        if (!Auth::check() || Auth::user()->id !== $lembaga->user_id) {
            return redirect()->route('lembaga.login', ['lembaga' => $subdomain]);
        }

        $programs = $lembaga->programs()->latest()->get();
        $beritas = $lembaga->beritas()->latest()->get();
        $editProgram = request('edit_program') ? $lembaga->programs()->find(request('edit_program')) : null;
        $editBerita = request('edit_berita') ? $lembaga->beritas()->find(request('edit_berita')) : null;

        return view('lembaga.admin-upz', compact('lembaga', 'programs', 'beritas', 'subdomain', 'editProgram', 'editBerita'));
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
