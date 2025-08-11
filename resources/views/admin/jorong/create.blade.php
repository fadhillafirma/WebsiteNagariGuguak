@extends('layout.sidebar')

@section('title', 'Tambah Jorong')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Tambah Jorong</h1>

    <form action="{{ route('jorong.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-5 bg-white p-6 rounded-lg shadow">
        @csrf

        <div>
            <label class="block text-gray-700 mb-1">Nama Jorong</label>
            <input type="text" name="nama_jorong" value="{{ old('nama_jorong') }}"
                   class="w-full rounded-lg border border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('nama_jorong') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Kepala Jorong</label>
            <input type="text" name="kepala_jorong" value="{{ old('kepala_jorong') }}"
                   class="w-full rounded-lg border border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('kepala_jorong') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi_jorong" rows="4"
                      class="w-full rounded-lg border border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi_jorong') }}</textarea>
            @error('deskripsi_jorong') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Foto Kepala Jorong (opsional)</label>
            <input type="file" name="foto_kepala_jorong"
                   class="w-full rounded-lg border border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('foto_kepala_jorong') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Tambahan Foto Jorong --}}
        <div>
            <label class="block text-gray-700 mb-1">Foto Jorong (opsional)</label>
            <input type="file" name="foto_jorong"
                   class="w-full rounded-lg border border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('foto_jorong') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('jorong.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
