@extends('layout.sidebar')

@section('title', 'Edit Foto Galeri')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Card --}}
    <div class="bg-white rounded-xl shadow-md p-8 mt-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Foto Galeri</h1>
            <a href="{{ route('galeri.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300 transition">
                Batal
            </a>
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4 text-red-700 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('galeri.update', $galeri->id_foto) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Foto Saat Ini --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Foto Saat Ini:</label>
                @if($galeri->foto)
                    <img src="{{ asset('storage/'.$galeri->foto) }}" class="w-40 rounded-md shadow" alt="thumbnail">
                @else
                    <p class="text-gray-500 text-sm">(Tidak ada foto)</p>
                @endif
            </div>

            {{-- Ganti Foto --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Ganti Foto (opsional)</label>
                <input
                    type="file"
                    name="foto"
                    class="w-full rounded-lg border border-gray-300 p-2 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-400">
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea
                    name="deskripsi"
                    rows="3"
                    class="w-full rounded-lg border border-gray-300 p-3 text-sm placeholder-gray-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-400"
                >{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('galeri.index') }}"
                   class="inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
