@extends('layout.sidebar')

@section('title', 'Demografi Sekolah')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6"> {{-- Flexbox untuk judul dan tombol --}}
        <h1 class="text-2xl font-bold text-gray-800">Data Demografi Sekolah</h1> {{-- Judul dengan gaya yang lebih baik --}}
        <a href="{{ route('demografi-sekolah.create') }}"
           class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition"> {{-- Tombol Tailwind --}}
            + Tambah Data Sekolah
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700 text-sm"> {{-- Alert sukses Tailwind --}}
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 rounded-md bg-red-100 text-red-700 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white"> {{-- Card shadow dan rounded --}}
        @if($data->count() === 0)
            <p class="p-4 text-gray-500">Tidak ada data demografi sekolah yang tersedia.</p> {{-- Pesan jika data kosong --}}
        @else
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3">No.</th>
                    <th scope="col" class="px-4 py-3">Tahun</th>
                    <th scope="col" class="px-4 py-3">SD</th>
                    <th scope="col" class="px-4 py-3">SMP</th>
                    <th scope="col" class="px-4 py-3">TK</th>
                    <th scope="col" class="px-4 py-3">PAUD</th>
                    <th scope="col" class="px-4 py-3 text-center">Aksi</th> {{-- text-center untuk aksi --}}
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $row)
                    <tr class="bg-white border-b hover:bg-gray-50"> {{-- Baris tabel Tailwind --}}
                        <td class="px-4 py-3">{{ $index + $data->firstItem() }}</td> {{-- Menampilkan nomor urut --}}
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $row->tahun }}</td>
                        <td class="px-4 py-3">{{ $row->jumlah_sd }}</td>
                        <td class="px-4 py-3">{{ $row->jumlah_smp }}</td>
                        <td class="px-4 py-3">{{ $row->jumlah_sma }}</td>
                        <td class="px-4 py-3">{{ $row->jumlah_paud }}</td>
                        <td class="px-4 py-3 text-center flex justify-center gap-2"> {{-- Flexbox untuk tombol aksi --}}
                            <a href="{{ route('demografi-sekolah.edit', $row->id_sekolah) }}"
                               class="px-2 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-xs"> {{-- Tombol Edit Tailwind --}}
                                Edit
                            </a>
                            <form action="{{ route('demografi-sekolah.destroy', $row->id_sekolah) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data demografi sekolah tahun {{ $row->tahun }}?')"> {{-- Konfirmasi lebih detail --}}
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-2 py-1 rounded bg-red-500 hover:bg-red-600 text-white text-xs"> {{-- Tombol Hapus Tailwind --}}
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty

                @endforelse
            </tbody>
        </table>

        <div class="p-4">
            {{ $data->links() }} {{-- Pastikan pagination Anda sudah terkonfigurasi untuk Tailwind --}}
        </div>
        @endif
    </div>
</div>
@endsection
