<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\BpnBerita;
use App\Models\BpnProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BpnSubdomainController extends Controller
{
    public function index()
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->first();

        if (!$lembaga) {
            abort(404, "Lembaga 'BPN' tidak ditemukan.");
        }

        $programs = BpnProgram::where('lembaga_id', $lembaga->id)->aktif()->take(6)->get();
        $beritas = BpnBerita::where('lembaga_id', $lembaga->id)->tayang()->take(4)->get();

        $info = [
            'nama' => $lembaga->nama_lembaga,
            'deskripsi' => $lembaga->deskripsi,
            'warna' => '#580F1C', // Tema BPN: Merah Marun
        ];

        return view('bpn.profil', compact('lembaga', 'info', 'programs', 'beritas'));
    }

    public function programIndex()
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();
        $programs = BpnProgram::where('lembaga_id', $lembaga->id)->aktif()->get();

        $info = [
            'nama' => $lembaga->nama_lembaga,
            'deskripsi' => $lembaga->deskripsi,
            'warna' => '#580F1C',
        ];

        return view('bpn.list-program', compact('lembaga', 'programs', 'info'));
    }

    public function beritaIndex()
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();
        $beritas = BpnBerita::where('lembaga_id', $lembaga->id)->tayang()->get();

        $info = [
            'nama' => $lembaga->nama_lembaga,
            'deskripsi' => $lembaga->deskripsi,
            'warna' => '#580F1C',
        ];

        return view('bpn.list-berita', compact('lembaga', 'beritas', 'info'));
    }

    public function showProgram($programId)
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();
        $program = BpnProgram::where('lembaga_id', $lembaga->id)->findOrFail($programId);

        $info = [
            'nama' => $lembaga->nama_lembaga,
            'deskripsi' => $lembaga->deskripsi,
            'warna' => '#580F1C',
        ];

        return view('bpn.detail-program', compact('lembaga', 'program', 'info'));
    }

    public function showBerita($beritaId)
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();
        $berita = BpnBerita::where('lembaga_id', $lembaga->id)->findOrFail($beritaId);

        $info = [
            'nama' => $lembaga->nama_lembaga,
            'deskripsi' => $lembaga->deskripsi,
            'warna' => '#580F1C',
        ];

        return view('bpn.detail-berita', compact('lembaga', 'berita', 'info'));
    }

    // ====== AUTH ======

    public function showLogin()
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();

        // Jika sudah login dan pemilik lembaga, langsung ke admin
        if (Auth::check() && Auth::user()->id === $lembaga->user_id) {
            return redirect()->route('bpn.admin');
        }

        return view('bpn.login', compact('lembaga'));
    }

    public function login(Request $request)
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Pastikan user yang login adalah pemilik lembaga ini
            if (Auth::user()->id !== $lembaga->user_id) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun ini tidak memiliki akses ke admin BPN.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            return redirect()->route('bpn.admin');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('bpn.beranda');
    }

    // ====== ADMIN PANEL ======

    public function admin()
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();

        // Cek apakah sudah login dan pemilik
        if (!Auth::check() || Auth::user()->id !== $lembaga->user_id) {
            return redirect()->route('bpn.login');
        }

        $programs = BpnProgram::where('lembaga_id', $lembaga->id)->latest()->get();
        $beritas = BpnBerita::where('lembaga_id', $lembaga->id)->latest()->get();
        $editProgram = request('edit_program') ? BpnProgram::where('lembaga_id', $lembaga->id)->find(request('edit_program')) : null;
        $editBerita = request('edit_berita') ? BpnBerita::where('lembaga_id', $lembaga->id)->find(request('edit_berita')) : null;

        return view('bpn.admin', compact('lembaga', 'programs', 'beritas', 'editProgram', 'editBerita'));
    }

    public function storeProgram(Request $request)
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();
        $data = $this->programData($request);
        $data['lembaga_id'] = $lembaga->id;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('bpn/program', 'public');
        }

        BpnProgram::create($data);
        return back()->with('success', 'Program berhasil ditambahkan.');
    }

    public function updateProgram(Request $request, BpnProgram $program)
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();
        abort_unless($program->lembaga_id === $lembaga->id, 404);

        $data = $this->programData($request);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($program->foto && \Storage::disk('public')->exists($program->foto)) {
                \Storage::disk('public')->delete($program->foto);
            }
            $data['foto'] = $request->file('foto')->store('bpn/program', 'public');
        }

        $program->update($data);
        return redirect()->route('bpn.admin')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroyProgram(BpnProgram $program)
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();
        abort_unless($program->lembaga_id === $lembaga->id, 404);
        
        $program->delete();
        return back()->with('success', 'Program berhasil dihapus.');
    }

    public function storeBerita(Request $request)
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();
        $data = $this->beritaData($request);
        $data['lembaga_id'] = $lembaga->id;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('bpn/berita', 'public');
        }

        BpnBerita::create($data);
        return back()->with('success', 'Berita berhasil ditambahkan.');
    }

    public function updateBerita(Request $request, BpnBerita $berita)
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();
        abort_unless($berita->lembaga_id === $lembaga->id, 404);

        $data = $this->beritaData($request);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($berita->foto && \Storage::disk('public')->exists($berita->foto)) {
                \Storage::disk('public')->delete($berita->foto);
            }
            $data['foto'] = $request->file('foto')->store('bpn/berita', 'public');
        }

        $berita->update($data);
        return redirect()->route('bpn.admin')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroyBerita(BpnBerita $berita)
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();
        abort_unless($berita->lembaga_id === $lembaga->id, 404);

        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus.');
    }

    public function updateProfil(Request $request)
    {
        $lembaga = Lembaga::where('subdomain', 'bpn')->firstOrFail();

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

        return redirect()->route('bpn.admin', ['tab' => 'profil'])->with('success', 'Profil dan struktur organisasi lembaga berhasil diperbarui.');
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

