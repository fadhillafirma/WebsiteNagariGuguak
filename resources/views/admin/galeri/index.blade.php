@extends('layout.sidebar') {{-- Pastikan layout kamu benar namanya --}}

@section('title', 'Galeri')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6 md:py-10">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Galeri</h1>
        <a href="{{ route('galeri.create') }}"
           class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition">
            + Tambah Foto
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        @if($galeri->count() === 0)
            <p class="p-4 text-gray-500">Belum ada foto.</p>
        @else
        <table class="w-full text-sm text-left text-gray-500 whitespace-nowrap">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Foto</th>
                    <th scope="col" class="px-6 py-3">Judul</th>
                    <th scope="col" class="px-6 py-3">Dibuat</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($galeri as $g)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            @if($g->foto)
                                <img src="{{ asset('storage/'.$g->foto) }}"
                                     class="w-24 h-16 object-cover rounded-md border border-gray-200"
                                     alt="foto">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ $g->deskripsi ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $g->tanggal_post ? $g->tanggal_post->format('d-m-Y') : $g->created_at?->format('d-m-Y') }}
                        </td>
                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                            <a href="{{ route('galeri.edit', $g->id_foto) }}"
                               class="px-3 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-xs">
                                Edit
                            </a>
                            <form action="{{ route('galeri.destroy', $g->id_foto) }}" method="POST"
                                  onsubmit="return confirm('Hapus foto ini?')">
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
            {{ $galeri->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
