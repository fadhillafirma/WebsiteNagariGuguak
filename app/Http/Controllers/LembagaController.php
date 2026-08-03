<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
            'subdomain' => 'nullable|string|max:50|unique:lembagas,subdomain',
            'admin_name' => 'nullable|string|max:255|required_with:admin_email',
            'admin_email' => 'nullable|string|email|max:255|unique:users,email|required_with:admin_name',
            'admin_password' => 'nullable|string|min:6|required_with:admin_email',
        ]);

        $data = $request->only(['nama_lembaga', 'deskripsi', 'nama_ketua', 'subdomain']);
        $data['user_id'] = Auth::id(); // Default to superadmin

        // Create Admin Account if provided
        if ($request->filled('admin_email')) {
            $user = User::create([
                'name' => $request->admin_name,
                'email' => $request->admin_email,
                'password' => Hash::make($request->admin_password),
                'role' => 'admin_lembaga',
            ]);
            $data['user_id'] = $user->id;
        }

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
            'subdomain' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('lembagas')->ignore($lembaga->id),
            ],
            'admin_name' => 'nullable|string|max:255|required_with:admin_email',
            'admin_email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                'required_with:admin_name',
            ],
            'admin_password' => 'nullable|string|min:6',
        ]);

        $data = $request->only(['nama_lembaga', 'deskripsi', 'nama_ketua', 'subdomain']);

        // Manage Admin Account
        if ($request->filled('admin_email')) {
            // Check if email belongs to another user
            $existingUser = User::where('email', $request->admin_email)
                ->where('id', '!=', $lembaga->user_id)
                ->first();

            if ($existingUser) {
                return back()->withErrors(['admin_email' => 'Email ini sudah digunakan oleh akun lain.'])->withInput();
            }

            if ($lembaga->user && $lembaga->user_id !== Auth::id()) {
                // Update existing user
                $lembaga->user->name = $request->admin_name;
                $lembaga->user->email = $request->admin_email;
                if ($request->filled('admin_password')) {
                    $lembaga->user->password = Hash::make($request->admin_password);
                }
                $lembaga->user->save();
            } else {
                // Create new user and assign
                $user = User::create([
                    'name' => $request->admin_name,
                    'email' => $request->admin_email,
                    'password' => Hash::make($request->admin_password ?? 'password'),
                    'role' => 'admin_lembaga',
                ]);
                $data['user_id'] = $user->id;
            }
        }

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
        
        // Optional: Also delete the associated user if it's an admin_lembaga
        if ($lembaga->user && $lembaga->user->role === 'admin_lembaga') {
            // Unlink or delete? Safest is let it remain or just delete if strictly 1-to-1
            // We'll leave the user account intact but the lembaga is deleted
        }

        $lembaga->delete();

        return redirect()->route('lembaga.index')->with('success', 'Data lembaga berhasil dihapus.');
    }
}
