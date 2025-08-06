@extends('layout.sidebar')

@section('title', 'Tambah Potensi')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Tambah Potensi</h1>

    <form action="{{ route('potensi.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-5 bg-white p-6 rounded-lg shadow">
        @csrf

        <div>
            <label class="block text-gray-700 mb-1">Jenis Potensi</label>
            <select name="jenis_potensi"
                    class="w-full rounded-lg border border-gray-300 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
                <option value="">-- Pilih Jenis --</option>
                @foreach(\App\Models\Potensi::JENIS_POTENSI as $jenis)
                    <option value="{{ $jenis }}" {{ old('jenis_potensi') == $jenis ? 'selected' : '' }}>
                        {{ ucfirst($jenis) }}
                    </option>
                @endforeach
            </select>
            @error('jenis_potensi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}"
                   class="w-full rounded-lg border border-gray-300 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('judul') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full rounded-lg border border-gray-300 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Gambar (Opsional)</label>
            <input type="file" name="gambar"
                   class="w-full rounded-lg border border-gray-300 py-2 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('gambar') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('potensi.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
