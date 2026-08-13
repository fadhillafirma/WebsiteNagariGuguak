@extends('layout.sidebar')

@section('title', 'Detail Lembaga')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6 md:py-10">
    <h1 class="text-2xl font-bold mb-6">Detail Lembaga</h1>

    <div class="bg-white rounded-lg shadow p-6 space-y-5">

        <div>
            <h2 class="text-lg font-semibold text-gray-800">Nama Lembaga</h2>
            <p class="text-gray-600">{{ $lembaga->nama_lembaga }}</p>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-800">Nama Ketua</h2>
            <p class="text-gray-600">{{ $lembaga->nama_ketua }}</p>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-800">Deskripsi</h2>
            <p class="text-gray-600 whitespace-pre-line">{{ $lembaga->deskripsi }}</p>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-800">Struktur Organisasi</h2>
            @if($lembaga->struktur_organisasi)
                <img src="{{ asset('storage/'.$lembaga->struktur_organisasi) }}"
                     alt="Struktur Organisasi"
                     class="mt-2 w-full max-w-md rounded border">
            @else
                <p class="text-gray-400">Tidak ada gambar struktur organisasi.</p>
            @endif
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-800">Foto Lembaga</h2>
            @if($lembaga->foto_lembaga)
                <img src="{{ asset('storage/'.$lembaga->foto_lembaga) }}"
                     alt="Foto Lembaga"
                     class="mt-2 w-full max-w-md rounded border">
            @else
                <p class="text-gray-400">Tidak ada foto lembaga.</p>
            @endif
        </div>

        <div class="pt-4">
            <a href="{{ route('lembaga.index') }}"
               class="inline-block px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded">
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection
