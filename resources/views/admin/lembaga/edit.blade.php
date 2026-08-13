@extends('layout.sidebar')

@section('title', 'Edit Lembaga')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6 md:py-10">
    <h1 class="text-2xl font-bold mb-6">Edit Data Lembaga</h1>

    <form action="{{ route('lembaga.update', $lembaga->id) }}" method="POST" enctype="multipart/form-data"
          class="space-y-5 bg-white p-4 md:p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 mb-1">Nama Lembaga</label>
            <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga', $lembaga->nama_lembaga) }}"
                   class="w-full rounded-lg border border-gray-300 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            @error('nama_lembaga') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Nama Ketua</label>
            <input type="text" name="nama_ketua" value="{{ old('nama_ketua', $lembaga->nama_ketua) }}"
                   class="w-full rounded-lg border border-gray-300 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            @error('nama_ketua') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full rounded-lg border border-gray-300 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('deskripsi', $lembaga->deskripsi) }}</textarea>
            @error('deskripsi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Struktur Organisasi (Ganti jika ingin mengubah)</label>
            @if($lembaga->struktur_organisasi)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $lembaga->struktur_organisasi) }}" class="w-32 h-20 object-cover rounded border">
                </div>
            @endif
            <input type="file" name="struktur_organisasi" class="w-full rounded-lg border border-gray-300 py-2 p-2">
            @error('struktur_organisasi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Subdomain (Opsional)</label>
            <div class="flex items-center">
                <input type="text" name="subdomain" value="{{ old('subdomain', $lembaga->subdomain) }}" placeholder="contoh: upz"
                       class="w-full rounded-l-lg border border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <span class="bg-gray-100 border border-l-0 border-gray-300 px-3 py-2 rounded-r-lg text-gray-500">.{{ env('APP_DOMAIN', 'localhost') }}</span>
            </div>
            <p class="text-xs text-gray-500 mt-1">Jika diisi, lembaga ini akan memiliki website subdomain mandiri.</p>
            @error('subdomain') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="border-t pt-4 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengaturan Akun Admin Lembaga (Opsional)</h3>
            <p class="text-sm text-gray-500 mb-4">Ubah atau buat akun khusus untuk lembaga ini.</p>

            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 mb-1">Nama Admin</label>
                    <input type="text" name="admin_name" value="{{ old('admin_name', optional($lembaga->user)->role === 'admin_lembaga' ? optional($lembaga->user)->name : '') }}" placeholder="Nama pengelola..."
                           class="w-full rounded-lg border border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('admin_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 mb-1">Email Login</label>
                    <input type="email" name="admin_email" value="{{ old('admin_email', optional($lembaga->user)->role === 'admin_lembaga' ? optional($lembaga->user)->email : '') }}" placeholder="admin.lembaga@guguak.id"
                           class="w-full rounded-lg border border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('admin_email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 mb-1">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="admin_password" placeholder="Minimal 6 karakter"
                           class="w-full rounded-lg border border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('admin_password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8 border-t pt-4">
            <a href="{{ route('lembaga.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
