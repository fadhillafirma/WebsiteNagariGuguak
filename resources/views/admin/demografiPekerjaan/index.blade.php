@extends('layout.sidebar')
@section('title', 'Demografi Pekerjaan')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6 md:py-10">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Demografi Pekerjaan</h1>
        <a href="{{ route('demografi-pekerjaan.create') }}"
           class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition">
            + Tambah Tahun
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        @if($data->count() === 0)
            <p class="p-4 text-gray-500">Belum ada data demografi pekerjaan.</p>
        @else
        <table class="w-full text-sm text-left text-gray-500 whitespace-nowrap">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-4 py-3">Tahun</th>
                    <th class="px-4 py-3">Petani</th>
                    <th class="px-4 py-3">PNS</th>
                    <th class="px-4 py-3">Swasta</th>
                    <th class="px-4 py-3">Pedagang</th>
                    <th class="px-4 py-3">TNI</th>
                    <th class="px-4 py-3">Pensiunan</th>
                    <th class="px-4 py-3">Aparat</th>
                    <th class="px-4 py-3">Lain</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $row->tahun }}</td>
                    <td class="px-4 py-3">{{ $row->petani }}</td>
                    <td class="px-4 py-3">{{ $row->pegawai_negeri }}</td>
                    <td class="px-4 py-3">{{ $row->karyawan_swasta }}</td>
                    <td class="px-4 py-3">{{ $row->pedagang }}</td>
                    <td class="px-4 py-3">{{ $row->tni }}</td>
                    <td class="px-4 py-3">{{ $row->pensiunan }}</td>
                    <td class="px-4 py-3">{{ $row->aparat_pemerintahan }}</td>
                    <td class="px-4 py-3">{{ $row->pekerjaan_lain }}</td>
                    <td class="px-4 py-3 font-semibold text-gray-800">{{ $row->total }}</td>
                    <td class="px-4 py-3 text-center flex justify-center gap-2">
                        <a href="{{ route('demografi-pekerjaan.show', $row->id_pekerjaan) }}"
                           class="px-2 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white text-xs">Lihat</a>
                        <a href="{{ route('demografi-pekerjaan.edit', $row->id_pekerjaan) }}"
                           class="px-2 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-xs">Edit</a>
                        <form action="{{ route('demografi-pekerjaan.destroy', $row->id_pekerjaan) }}" method="POST"
                              onsubmit="return confirm('Hapus data tahun {{ $row->tahun }}?')">
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
