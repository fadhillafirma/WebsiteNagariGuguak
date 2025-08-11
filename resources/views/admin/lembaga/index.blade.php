{{-- resources/views/admin/lembaga/index.blade.php --}}
@extends('layout.sidebar')

@section('title', 'Data Lembaga')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Lembaga</h1>
        <a href="{{ route('lembaga.create') }}"
           class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition">
            + Tambah Lembaga
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mt-5">
        @if($lembagas->count() === 0)
            <p class="p-4 text-gray-500">Belum ada data lembaga.</p>
        @else
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Nama Lembaga</th>
                    <th class="px-6 py-3">Foto</th>
                    <th class="px-6 py-3">Nama Ketua</th>
                    <th class="px-6 py-3">Deskripsi</th>
                    <th class="px-6 py-3">Struktur Organisasi</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lembagas as $l)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-700">{{ $l->nama_lembaga }}</td>

                        <td class="px-6 py-4">
                            @if($l->foto_lembaga)
                                <img src="{{ asset('storage/'.$l->foto_lembaga) }}" class="w-24 h-16 object-cover rounded-md border border-gray-200" alt="foto">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $l->nama_ketua }}</td>
                        <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($l->deskripsi, 20) }}</td>
                        <td class="px-6 py-4">
                            @if($l->struktur_organisasi)
                                <img src="{{ asset('storage/'.$l->struktur_organisasi) }}" class="w-24 h-16 object-cover rounded-md border border-gray-200" alt="struktur">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center flex justify-center gap-2 flex-wrap">
                            <a href="{{ route('lembaga.show', $l->id) }}"
                            class="px-3 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white text-xs">
                                Lihat
                            </a>
                            <a href="{{ route('lembaga.edit', $l->id) }}"
                            class="px-3 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-xs">
                                Edit
                            </a>
                            <form action="{{ route('lembaga.destroy', $l->id) }}" method="POST" onsubmit="return confirm('Hapus data lembaga ini?')">
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
