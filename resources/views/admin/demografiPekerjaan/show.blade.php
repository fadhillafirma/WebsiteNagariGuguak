@extends('layout.sidebar')
@section('title', 'Detail Demografi Pekerjaan')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Demografi Pekerjaan Tahun {{ $row->tahun }}</h1>

        <table class="w-full text-sm text-gray-600">
            <tbody>
                <tr><th class="py-2 pr-4 text-gray-700 text-left">Petani</th><td>{{ $row->petani }}</td></tr>
                <tr><th class="py-2 pr-4 text-gray-700 text-left">Pegawai Negeri</th><td>{{ $row->pegawai_negeri }}</td></tr>
                <tr><th class="py-2 pr-4 text-gray-700 text-left">Karyawan Swasta</th><td>{{ $row->karyawan_swasta }}</td></tr>
                <tr><th class="py-2 pr-4 text-gray-700 text-left">Pedagang</th><td>{{ $row->pedagang }}</td></tr>
                <tr><th class="py-2 pr-4 text-gray-700 text-left">TNI</th><td>{{ $row->tni }}</td></tr>
                <tr><th class="py-2 pr-4 text-gray-700 text-left">Pensiunan</th><td>{{ $row->pensiunan }}</td></tr>
                <tr><th class="py-2 pr-4 text-gray-700 text-left">Aparat Pemerintahan</th><td>{{ $row->aparat_pemerintahan }}</td></tr>
                <tr><th class="py-2 pr-4 text-gray-700 text-left">Pekerjaan Lain</th><td>{{ $row->pekerjaan_lain }}</td></tr>
                <tr class="border-t">
                    <th class="py-2 pr-4 text-gray-900 text-left">TOTAL</th>
                    <td class="font-bold text-gray-900">{{ $row->total }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('demografi-pekerjaan.edit', $row->id_pekerjaan) }}"
               class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded">Edit</a>
            <a href="{{ route('demografi-pekerjaan.index') }}"
               class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Kembali</a>
        </div>
    </div>
</div>
@endsection
