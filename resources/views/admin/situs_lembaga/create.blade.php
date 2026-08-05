@extends('layout.sidebar')

@section('title', 'Tambah Situs Lembaga')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="mb-6">
        <a href="{{ route('situs-lembaga.index') }}" class="text-blue-600 hover:underline flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800 mt-4">Tambah Situs Lembaga Baru</h1>
    </div>

    @if($errors->any())
        <div class="mb-4 p-4 rounded-md bg-red-50 text-red-700 text-sm border border-red-200">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('situs-lembaga.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Situs <span class="text-red-500">*</span></label>
            <input type="text" name="nama_situs" value="{{ old('nama_situs') }}" required
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                   placeholder="Misal: BPN Nagari Guguak">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">URL Situs <span class="text-red-500">*</span></label>
            <input type="url" name="url_situs" value="{{ old('url_situs') }}" required
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                   placeholder="Misal: http://bpn.localhost">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Logo / Gambar <span class="text-xs text-gray-400">(Opsional, max 2MB)</span></label>
            <input type="file" name="logo" accept="image/*"
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-xs text-gray-400">(Opsional)</span></label>
            <textarea name="deskripsi" rows="4"
                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                      placeholder="Deskripsi singkat mengenai lembaga ini">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
