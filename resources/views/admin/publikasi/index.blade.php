@extends('layout.sidebar')

@section('title', 'Publikasi')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Publikasi</h1>
        <a href="{{ route('publikasi.create') }}"
           class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition">
            + Tambah Publikasi
        </a>
    </div>

    <form method="GET" action="{{ route('publikasi.index') }}" class="flex items-center gap-3">
        <label for="filter" class="text-sm text-gray-700">Filter Jenis:</label>
        <select name="jenis" id="filter" onchange="this.form.submit()"
            class="border border-gray-300 rounded px-2 py-1 text-sm">
            <option value="">Semua</option>
            <option value="artikel" {{ request('jenis') === 'artikel' ? 'selected' : '' }}>Artikel</option>
            <option value="berita" {{ request('jenis') === 'berita' ? 'selected' : '' }}>Berita</option>
        </select>
    </form>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mt-5">
        @if($publikasi->count() === 0)
            <p class="p-4 text-gray-500">Belum ada publikasi.</p>
        @else
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Foto</th>
                    <th class="px-6 py-3">Judul</th>
                    <th class="px-6 py-3">Jenis</th>
                    <th class="px-6 py-3">Update</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($publikasi as $p)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            @if($p->foto)
                                <img src="{{ asset('storage/'.$p->foto) }}"
                                     class="w-24 h-16 object-cover rounded-md border border-gray-200" alt="foto">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $p->judul }}</td>
                        <td class="px-6 py-4">{{ ucfirst($p->jenis) }}</td>
                        <td class="px-6 py-4">{{ $p->tanggal_update?->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                            <a href="{{ route('publikasi.show', $p->id_artikel) }}"
                               class="px-3 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white text-xs">
                                Lihat
                            </a>
                           <a href="{{ route('publikasi.edit', $p->id_artikel) }}"

                               class="px-3 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-xs">
                                Edit
                            </a>
                            <form action="{{ route('publikasi.destroy', $p->id_artikel) }}" method="POST"
                                  onsubmit="return confirm('Hapus publikasi ini?')">
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
        <div class="p-4">
            {{ $publikasi->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
