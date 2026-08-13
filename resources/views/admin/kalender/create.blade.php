@extends('layout.sidebar')

@section('title', 'Tambah Kegiatan Kalender')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Card --}}
    <div class="bg-white rounded-xl shadow-md p-8 mt-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Kegiatan Kalender</h1>
            <a href="{{ route('kalender.index') }}"
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
        <form method="POST" action="{{ route('kalender.store') }}" class="space-y-6">
            @csrf

            {{-- Nama Kegiatan --}}
            <div>
                <label for="nama_kegiatan" class="block mb-2 text-sm font-medium text-gray-700">Nama Kegiatan <span class="text-red-500">*</span></label>
                <input
                    type="text"
                    name="nama_kegiatan"
                    id="nama_kegiatan"
                    value="{{ old('nama_kegiatan') }}"
                    required
                    class="w-full rounded-lg border border-gray-300 p-3 text-sm placeholder-gray-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-400"
                    placeholder="Contoh: Rapat Koordinasi">
            </div>

            {{-- Tanggal --}}
            <div>
                <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-700">Tanggal <span class="text-red-500">*</span></label>
                <input
                    type="date"
                    name="tanggal"
                    id="tanggal"
                    value="{{ old('tanggal') }}"
                    required
                    class="w-full rounded-lg border border-gray-300 p-3 text-sm text-gray-700 focus:border-blue-400 focus:ring-2 focus:ring-blue-400">
            </div>

            {{-- Jam Mulai --}}
            <div>
                <label for="jam_mulai" class="block mb-2 text-sm font-medium text-gray-700">Jam Mulai <span class="text-red-500">*</span></label>
                <input
                    type="time"
                    name="jam_mulai"
                    id="jam_mulai"
                    value="{{ old('jam_mulai') }}"
                    required
                    class="w-full rounded-lg border border-gray-300 p-3 text-sm text-gray-700 focus:border-blue-400 focus:ring-2 focus:ring-blue-400">
            </div>

            {{-- Jam Akhir --}}
            <div>
                <label for="jam_akhir" class="block mb-2 text-sm font-medium text-gray-700">Jam Akhir <span class="text-red-500">*</span></label>
                <input
                    type="time"
                    name="jam_akhir"
                    id="jam_akhir"
                    value="{{ old('jam_akhir') }}"
                    required
                    class="w-full rounded-lg border border-gray-300 p-3 text-sm text-gray-700 focus:border-blue-400 focus:ring-2 focus:ring-blue-400">
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('kalender.index') }}"
                   class="inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
