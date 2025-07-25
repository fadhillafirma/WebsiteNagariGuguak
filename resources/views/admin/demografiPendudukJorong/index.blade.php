@extends('layout.sidebar')
@section('title', 'Demografi Penduduk Jorong')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Demografi Penduduk per Jorong</h1>
        <a href="{{ route('demografi-penduduk-jorong.create') }}"
           class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition">
            + Tambah Data
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        @if($data->count() === 0)
            <p class="p-4 text-gray-500">Belum ada data penduduk per jorong.</p>
        @else
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-4 py-3">Tahun</th>
                    <th class="px-4 py-3">Jorong</th>
                    <th class="px-4 py-3">KK</th>
                    <th class="px-4 py-3">Laki-laki</th>
                    <th class="px-4 py-3">Perempuan</th>
                    <th class="px-4 py-3">Jumlah</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $row->tahun }}</td>
                    <td class="px-4 py-3">{{ $row->jorong?->nama_jorong ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $row->kk }}</td>
                    <td class="px-4 py-3">{{ $row->laki_laki }}</td>
                    <td class="px-4 py-3">{{ $row->perempuan }}</td>
                    <td class="px-4 py-3 font-semibold text-gray-800">{{ $row->jumlah }}</td>
                    <td class="px-4 py-3 text-center flex justify-center gap-2">
                        <a href="{{ route('demografi-penduduk-jorong.show', $row->id_penduduk_jorong) }}"
                           class="px-2 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white text-xs">
                            Lihat
                        </a>
                        <a href="{{ route('demografi-penduduk-jorong.edit', $row->id_penduduk_jorong) }}"
                           class="px-2 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-xs">
                            Edit
                        </a>
                        <form action="{{ route('demografi-penduduk-jorong.destroy', $row->id_penduduk_jorong) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="px-2 py-1 rounded bg-red-500 hover:bg-red-600 text-white text-xs">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4">
            {{ $data->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
