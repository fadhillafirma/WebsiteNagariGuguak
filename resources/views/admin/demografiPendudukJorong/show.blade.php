@extends('layout.sidebar')
@section('title', 'Detail Penduduk Jorong')

@section('content')
<div class="max-w-md mx-auto px-4 py-10">
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">
            {{ $row->jorong?->nama_jorong ?? '-' }} ({{ $row->tahun }})
        </h1>
        <table class="w-full text-sm text-gray-600">
            <tbody>
                <tr><th class="py-2 pr-4 text-left text-gray-700">KK</th><td>{{ $row->kk }}</td></tr>
                <tr><th class="py-2 pr-4 text-left text-gray-700">Laki-laki</th><td>{{ $row->laki_laki }}</td></tr>
                <tr><th class="py-2 pr-4 text-left text-gray-700">Perempuan</th><td>{{ $row->perempuan }}</td></tr>
                <tr class="border-t">
                    <th class="py-2 pr-4 text-left text-gray-900">TOTAL</th>
                    <td class="font-bold text-gray-900">{{ $row->jumlah }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('demografi-penduduk-jorong.edit', $row->id_penduduk_jorong) }}"
               class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded">Edit</a>
            <a href="{{ route('demografi-penduduk-jorong.index') }}"
               class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Kembali</a>
        </div>
    </div>
</div>
@endsection
