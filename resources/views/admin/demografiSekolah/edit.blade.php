@extends('layout.sidebar')
@section('title', 'Edit Demografi Sekolah')
@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h2 class="text-xl font-semibold mb-4">Edit Demografi Sekolah</h2>
    <form action="{{ route('demografi-sekolah.update', $demografiSekolah->id_sekolah) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf @method('PUT')
        @include('admin.demografiSekolah._fields', ['row' => $demografiSekolah])
        <div class="flex justify-end gap-3">
            <a href="{{ route('demografi-sekolah.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
