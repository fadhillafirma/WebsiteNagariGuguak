@extends('layout.sidebar')

@section('title', 'Edit Potensi')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Edit Potensi</h1>

    <form action="{{ route('potensi.update', $potensi->id) }}" method="POST" enctype="multipart/form-data"
        class="space-y-5 bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 mb-1">Nama Potensi</label>
            <input type="text" name="nama_potensi" value="{{ old('nama_potensi', $potensi->nama_potensi) }}"
                class="w-full rounded-lg border border-gray-300 py-2 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                required>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Kategori</label>
            <select name="kategori" class="w-full rounded-lg border border-gray-300 py-2 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                <option value="alam" {{ $potensi->kategori == 'alam' ? 'selected' : '' }}>Alam</option>
                <option value="budaya" {{ $potensi->kategori == 'budaya' ? 'selected' : '' }}>Budaya</option>
                <option value="ekonomi" {{ $potensi->kategori == 'ekonomi' ? 'selected' : '' }}>Ekonomi</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                class="w-full rounded-lg border border-gray-300 py-2 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                required>{{ old('deskripsi', $potensi->deskripsi) }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Foto (Opsional)</label>
            @if($potensi->foto)
                <img src="{{ asset('storage/'.$potensi->foto) }}" class="w-32 h-20 object-cover rounded-md mb-2">
            @endif
            <input type="file" name="foto" class="w-full rounded-lg border border-gray-300 py-2 p-2">
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('potensi.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
