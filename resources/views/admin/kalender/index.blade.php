@extends('layout.sidebar')

@section('title', 'Kalender Kegiatan')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kalender Kegiatan</h1>
        <a href="{{ route('kalender.create') }}"
           class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition">
            + Tambah Kegiatan
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
        @if($kalender->count() === 0)
            <p class="p-4 text-gray-500">Belum ada kegiatan dalam kalender.</p>
        @else
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Kegiatan</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Jam Mulai</th>
                    <th class="px-6 py-3">Jam Akhir</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kalender as $index => $kegiatan)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $index + $kalender->firstItem() }}</td>
                        <td class="px-6 py-4 text-gray-700 font-medium">{{ $kegiatan->nama_kegiatan }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($kegiatan->jam_mulai)->format('H:i') }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($kegiatan->jam_akhir)->format('H:i') }}</td>
                        <td class="px-6 py-4 text-center flex justify-center gap-2 flex-wrap">
                            <a href="{{ route('kalender.edit', $kegiatan->id) }}"
                               class="px-3 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-xs">
                                Edit
                            </a>
                            <form action="{{ route('kalender.destroy', $kegiatan->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');">
                                @csrf
                                @method('DELETE')
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
            {{ $kalender->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
