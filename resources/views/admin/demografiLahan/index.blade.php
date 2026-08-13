@extends('layout.sidebar') {{-- Asumsikan layout.sidebar Anda sudah mengimpor Tailwind CSS --}}

@section('title', 'Demografi Lahan') {{-- Tambahkan title section jika layout Anda mendukung --}}

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6 md:py-10"> {{-- max-w-7xl mx-auto untuk lebar konten dan centering --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6"> {{-- Flexbox untuk judul dan tombol --}}
        <h1 class="text-2xl font-bold text-gray-800">Data Demografi Lahan</h1>
        <a href="{{ route('demografi-lahan.create') }}"
           class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition"> {{-- Tombol Tailwind --}}
            + Tambah Data Lahan
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700 text-sm"> {{-- Alert sukses Tailwind --}}
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 rounded-md bg-red-100 text-red-700 text-sm"> {{-- Alert error Tailwind --}}
            {{ session('error') }}
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white"> {{-- Card shadow dan rounded --}}
        @if($data->count() === 0)
            <p class="p-4 text-gray-500">Tidak ada data lahan yang tersedia.</p> {{-- Pesan jika data kosong --}}
        @else
        
        <table class="w-full text-sm text-left text-gray-500 whitespace-nowrap"> {{-- Tabel penuh lebar --}}
            <thead class="text-xs text-gray-700 uppercase bg-gray-50"> {{-- Header tabel Tailwind --}}
                <tr>
                    <th class="px-4 py-3">No.</th>
                    <th class="px-4 py-3">Jenis Lahan</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Tahun</th>
                    <th class="px-4 py-3">Produktif (Ha)</th>
                    <th class="px-4 py-3">Tidak Produktif (Ha)</th>
                    <th class="px-4 py-3">Luas Total (Ha)</th>
                    <th class="px-4 py-3 text-center">Aksi</th> {{-- text-center untuk aksi --}}
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $item) {{-- Gunakan @foreach saja jika nomor urut sudah di handle controller/pagination --}}
                <tr class="bg-white border-b hover:bg-gray-50"> {{-- Baris tabel Tailwind --}}
                    <td class="px-4 py-3">{{ $index + $data->firstItem() }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $item->lahanJenis->nama_lahan ?? '-' }}</td>
                    <td class="px-4 py-3">{{ ucfirst($item->lahanJenis->kategori ?? '-') }}</td>
                    <td class="px-4 py-3">{{ $item->tahun }}</td>
                    <td class="px-4 py-3">{{ number_format($item->produktif_ha, 2, ',', '.') }}</td>
                    <td class="px-4 py-3">{{ number_format($item->tidak_produktif_ha, 2, ',', '.') }}</td>
                    <td class="px-4 py-3 font-semibold text-gray-800">{{ number_format($item->luas_ha, 2, ',', '.') }}</td>
                    <td class="px-4 py-3 text-center flex justify-center gap-2"> {{-- Flexbox untuk tombol aksi --}}
                        <a href="{{ route('demografi-lahan.edit', $item->id_lahan_data) }}"
                           class="px-2 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-xs"> {{-- Tombol Edit Tailwind --}}
                            Edit
                        </a>
                        <form action="{{ route('demografi-lahan.destroy', $item->id_lahan_data) }}" method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data lahan tahun {{ $item->tahun }} untuk {{ $item->lahanJenis->nama_lahan ?? '' }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-2 py-1 rounded bg-red-500 hover:bg-red-600 text-white text-xs"> {{-- Tombol Hapus Tailwind --}}
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4"> {{-- Padding untuk pagination --}}
            {{ $data->links() }} {{-- Asumsi Anda sudah mengonfigurasi pagination untuk Tailwind --}}
        </div>
        @endif
    </div>
</div>
@endsection
