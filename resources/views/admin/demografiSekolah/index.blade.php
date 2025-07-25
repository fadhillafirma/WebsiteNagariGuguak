@extends('layout.sidebar')

@section('title', 'Demografi Sekolah')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Demografi Sekolah</h1>
        <a href="{{ route('demografi-sekolah.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Tambah</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-4 py-2">Tahun</th>
                    <th class="px-4 py-2">SD</th>
                    <th class="px-4 py-2">SMP</th>
                    <th class="px-4 py-2">SMA</th>
                    <th class="px-4 py-2">PAUD</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $row->tahun }}</td>
                        <td class="px-4 py-2">{{ $row->jumlah_sd }}</td>
                        <td class="px-4 py-2">{{ $row->jumlah_smp }}</td>
                        <td class="px-4 py-2">{{ $row->jumlah_sma }}</td>
                        <td class="px-4 py-2">{{ $row->jumlah_paud }}</td>
                        <td class="px-4 py-2 text-center flex justify-center gap-2">
                            <a href="{{ route('demografi-sekolah.edit', $row->id_sekolah) }}"
                               class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs">Edit</a>
                            <form action="{{ route('demografi-sekolah.destroy', $row->id_sekolah) }}" method="POST"
                                  onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $data->links() }}</div>
    </div>
</div>
@endsection
