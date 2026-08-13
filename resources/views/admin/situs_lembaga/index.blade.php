@extends('layout.sidebar')

@section('title', 'Data Situs Lembaga')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6 md:py-10">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Situs Lembaga</h1>
        <a href="{{ route('situs-lembaga.create') }}"
           class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition">
            + Tambah Situs Lembaga
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mt-5">
        @if($situs_lembagas->count() === 0)
            <p class="p-4 text-gray-500">Belum ada data situs lembaga.</p>
        @else
        <table class="w-full text-sm text-left text-gray-500 whitespace-nowrap">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Nama Situs</th>
                    <th class="px-6 py-3">Logo</th>
                    <th class="px-6 py-3">URL</th>
                    <th class="px-6 py-3">Deskripsi</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($situs_lembagas as $sl)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-700 font-semibold">{{ $sl->nama_situs }}</td>
                        <td class="px-6 py-4">
                            @if($sl->logo)
                                <img src="{{ asset('storage/'.$sl->logo) }}" class="w-20 h-12 object-contain rounded-md border border-gray-200" alt="logo">
                            @else
                                <span class="text-gray-400 text-xs">Tanpa Logo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ $sl->url_situs }}" target="_blank" class="text-blue-600 hover:underline font-semibold">
                                {{ $sl->url_situs }}
                            </a>
                        </td>
                        <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($sl->deskripsi, 30) }}</td>
                        <td class="px-6 py-4 text-center flex justify-center gap-2 flex-wrap">
                            <a href="{{ route('situs-lembaga.edit', $sl->id) }}"
                               class="px-3 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-xs">
                                Edit
                            </a>
                            <form action="{{ route('situs-lembaga.destroy', $sl->id) }}" method="POST" onsubmit="return confirm('Hapus data situs lembaga ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 rounded bg-red-500 hover:bg-red-600 text-white text-xs">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
