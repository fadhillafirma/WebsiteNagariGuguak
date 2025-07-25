@extends('layout.sidebar')
@section('title', 'Tambah Penduduk Jorong')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Tambah Penduduk per Jorong</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-700 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('demografi-penduduk-jorong.store') }}" method="POST"
          class="bg-white p-6 rounded-lg shadow space-y-5">
        @csrf
        @include('admin.demografiPendudukJorong._fields', ['row' => null, 'jorongList' => $jorongList])
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('demografi-penduduk-jorong.index') }}"
               class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
