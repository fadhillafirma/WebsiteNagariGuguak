@extends('layout.sidebar') {{-- ganti kalau layout kamu bernama lain, misal layouts.sidebar --}}

@section('title', 'Tambah Foto Galeri')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Card --}}
    <div class="bg-white rounded-xl shadow-md p-8 mt-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Foto Galeri</h1>
            <a href="{{ route('galeri.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300 transition">
                Batal
            </a>
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4 text-red-700 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('galeri.store') }}" enctype="multipart/form-data" id="galeriForm" class="space-y-6">
            @csrf

            {{-- Upload Foto --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Foto (jpg/png/webp) <span class="text-red-500">*</span>
                </label>
                <input
                    type="file"
                    name="foto"
                    id="fotoInput"
                    accept="image/*"
                    required
                    class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-gray-800 file:text-white hover:file:bg-gray-700 cursor-pointer border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                >
                {{-- Preview --}}
                <div id="previewWrapper" class="mt-4 hidden">
                    <p class="text-xs text-gray-500 mb-1">Preview:</p>
                    <img id="previewImage" src="" alt="Preview Foto" class="max-h-48 rounded-md border border-gray-200 object-cover">
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="4"
                    class="w-full rounded-lg border border-gray-300 p-3 text-sm placeholder-gray-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-400"
                    placeholder="Tulis deskripsi singkat foto...">{{ old('deskripsi') }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('galeri.index') }}"
                   class="inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Preview Script --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('fotoInput');
    const previewWrapper = document.getElementById('previewWrapper');
    const previewImage = document.getElementById('previewImage');

    input.addEventListener('change', function(e){
        const file = e.target.files[0];
        if (!file) {
            previewWrapper.classList.add('hidden');
            previewImage.src = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function(evt){
            previewImage.src = evt.target.result;
            previewWrapper.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush
@endsection
