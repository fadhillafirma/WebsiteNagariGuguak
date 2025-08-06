@extends('layout.sidebar')

@section('title', 'Data Potensi')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Potensi</h1>
        <a href="{{ route('potensi.create') }}"
           class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition">
            + Tambah Potensi
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mt-5">
        @if($potensis->count() === 0)
            <p class="p-4 text-gray-500">Belum ada data potensi.</p>
        @else
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Jenis</th>
                    <th class="px-6 py-3">Judul</th>
                    <th class="px-6 py-3">Gambar</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($potensis as $potensi)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 capitalize">{{ $potensi->jenis_potensi }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $potensi->judul }}</td>
                        <td class="px-6 py-4">
                            @if($potensi->gambar)
                                <img src="{{ asset('storage/' . $potensi->gambar) }}"
                                     class="w-24 h-16 object-cover rounded-md border border-gray-200" alt="gambar">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                            <a href="{{ route('potensi.show', $potensi->id) }}"
                               class="px-3 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white text-xs">
                                Lihat
                            </a>
                            <a href="{{ route('potensi.edit', $potensi->id) }}"
                               class="px-3 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-xs">
                                Edit
                            </a>
                            <form action="{{ route('potensi.destroy', $potensi->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus potensi ini?')">
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

        {{-- Pagination (opsional) --}}
        <div class="p-4">
            {{ $potensis->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
