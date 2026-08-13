@extends('layout.sidebar')

@section('title', 'Data Jorong')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6 md:py-10">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Jorong</h1>
        <a href="{{ route('jorong.create') }}"
           class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition">
            + Tambah Jorong
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mt-5">
        @if($jorongs->count() === 0)
            <p class="p-4 text-gray-500">Belum ada data jorong.</p>
        @else
        <table class="w-full text-sm text-left text-gray-500 whitespace-nowrap">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Kepala</th>
                    <th class="px-6 py-3">Deskripsi</th>
                    <th class="px-6 py-3">Foto Jorong</th>
                    <th class="px-6 py-3">Foto Kepala Jorong</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jorongs as $jorong)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $jorong->nama_jorong }}</td>
                    <td class="px-6 py-4">{{ $jorong->kepala_jorong }}</td>
                    <td class="px-6 py-4">
                        {{ \Illuminate\Support\Str::words(strip_tags($jorong->deskripsi_jorong), 20, '...') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($jorong->foto_jorong)
                            <img src="{{ asset('storage/' . $jorong->foto_jorong) }}"
                                 class="w-24 h-16 object-cover rounded-md border" alt="Foto Jorong">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($jorong->foto_kepala_jorong)
                            <img src="{{ asset('storage/' . $jorong->foto_kepala_jorong) }}"
                                 class="w-24 h-16 object-cover rounded-md border" alt="Foto Kepala">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 flex gap-2 justify-center">
                        <a href="{{ route('jorong.show', $jorong->id_jorong) }}"
                           class="px-3 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white text-xs">Lihat</a>
                        <a href="{{ route('jorong.edit', $jorong->id_jorong) }}"
                           class="px-3 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-xs">Edit</a>
                        <form action="{{ route('jorong.destroy', $jorong->id_jorong) }}" method="POST"
                              onsubmit="return confirm('Hapus jorong ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 rounded bg-red-500 hover:bg-red-600 text-white text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4">{{ $jorongs->links() }}</div>
        @endif
    </div>
</div>
@endsection
