@extends('layout.sidebar')

@section('title', 'Kalender Kegiatan')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kalender Kegiatan</h1>
        <a href="{{ route('kalender.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
            + Tambah Kegiatan
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-800 text-left">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Nama Kegiatan</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Jam Mulai</th>
                    <th class="px-6 py-4">Jam Akhir</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kalender as $index => $kegiatan)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-3">{{ $index + 1 }}</td>
                    <td class="px-6 py-3 font-medium text-gray-900">{{ $kegiatan->nama_kegiatan }}</td>
                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</td>
                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($kegiatan->jam_mulai)->format('H:i') }}</td>
                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($kegiatan->jam_akhir)->format('H:i') }}</td>
                    <td class="px-6 py-3 text-center flex justify-center gap-2">
                        <a href="{{ route('kalender.edit', $kegiatan->id) }}"
                           class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('kalender.destroy', $kegiatan->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada kegiatan dalam kalender.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
