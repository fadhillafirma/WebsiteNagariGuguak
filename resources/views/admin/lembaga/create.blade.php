{{-- resources/views/admin/lembaga/create.blade.php --}}
@extends('layout.sidebar')

@section('title', 'Tambah Lembaga')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Tambah Lembaga</h1>

    <form action="{{ route('lembaga.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-5 bg-white p-6 rounded-lg shadow">
        @csrf

         <div>
            <label class="block text-gray-700 mb-1">Nama Lembaga</label>
            <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga') }}"
                   class="w-full rounded-lg border border-gray-300 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            @error('nama_lembaga') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Nama Ketua</label>
            <input type="text" name="nama_ketua" value="{{ old('nama_ketua') }}"
                   class="w-full rounded-lg border border-gray-300 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            @error('nama_ketua') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full rounded-lg border border-gray-300 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Struktur Organisasi (Gambar)</label>
            <input type="file" name="struktur_organisasi" class="w-full rounded-lg border border-gray-300 py-2 p-2">
            @error('struktur_organisasi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>


        <div>
            <label class="block text-gray-700 mb-1">Foto Lembaga (Opsional)</label>
            <input type="file" name="foto_lembaga" class="w-full rounded-lg border border-gray-300 py-2 p-2">
            @error('foto_lembaga') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('lembaga.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
