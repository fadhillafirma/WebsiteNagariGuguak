@extends('layout.sidebar')

@section('title', 'Edit Publikasi')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Edit Publikasi</h1>

    <form action="{{ route('publikasi.update', $publikasi->id_artikel) }}" method="POST" enctype="multipart/form-data"
          class="space-y-5 bg-white p-6 rounded-lg shadow">
        @csrf @method('PUT')

        <div>
            <label class="block text-gray-700 mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $publikasi->judul) }}"
                   class="w-full rounded-lg border border-gray-300 py-2 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full rounded-lg border border-gray-300 py-2 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required>{{ old('deskripsi', $publikasi->deskripsi) }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Jenis</label>
            <select name="jenis" class="w-full rounded-lg border border-gray-300 py-2 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                <option value="artikel" {{ $publikasi->jenis == 'artikel' ? 'selected' : '' }}>Artikel</option>
                <option value="berita" {{ $publikasi->jenis == 'berita' ? 'selected' : '' }}>Berita</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="penulis" class="block text-sm font-medium text-gray-700">Penulis</label>
            <input type="text" name="penulis" id="penulis" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('penulis', $publikasi->penulis ?? '') }}">
        </div>




        <div>
            <label class="block text-gray-700 mb-1">Foto (Opsional)</label>
            @if($publikasi->foto)
                <img src="{{ asset('storage/'.$publikasi->foto) }}" class="w-32 h-20 object-cover rounded-md mb-2">
            @endif
            <input type="file" name="foto" class="w-full rounded-lg border border-gray-300 py-2 p-2">
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('publikasi.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
