@extends('layout.sidebar')

@section('title', 'Detail Jorong')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6 md:py-10">
    <h1 class="text-2xl font-bold mb-6">Detail Jorong</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Nama Jorong:</h2>
            <p class="text-gray-800">{{ $jorong->nama_jorong }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Kepala Jorong:</h2>
            <p class="text-gray-800">{{ $jorong->kepala_jorong }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Deskripsi:</h2>
            <p class="text-gray-800">{{ $jorong->deskripsi_jorong ?? '-' }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Foto Kepala:</h2>
            @if($jorong->foto_kepala_jorong)
                <img src="{{ asset('storage/' . $jorong->foto_kepala_jorong) }}" class="w-64 rounded border" alt="Foto Kepala">
            @else
                <p class="text-gray-400">Tidak ada foto.</p>
            @endif
        </div>

        <a href="{{ route('jorong.index') }}"
           class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Kembali
        </a>
    </div>
</div>
@endsection
