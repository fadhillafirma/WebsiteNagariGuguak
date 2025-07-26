@extends('layout.sidebar')
@section('title', 'Edit Data Lahan') {{-- Tambahkan section title --}}

@section('content')
<div class="max-w-3xl mx-auto p-6"> {{-- Container utama dengan lebar maksimum dan padding --}}
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Edit Data Lahan: <span class="text-blue-600">{{ $lahanData->lahanJenis->nama_lahan ?? 'N/A' }}</span> (Tahun {{ $lahanData->tahun }})</h2> {{-- Judul halaman --}}

    <form action="{{ route('demografi-lahan.update', $lahanData->id_lahan_data) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow"> {{-- Form dengan styling Tailwind --}}
        @csrf
        @method('PUT')

        {{-- JENIS LAHAN (Dropdown) --}}
        <div> {{-- Mengganti mb-3 dengan div biasa, dan space-y-4 di form akan memberi jarak --}}
            <label for="lahan_jenis_id" class="block text-sm font-medium text-gray-700">Jenis Lahan</label>
            <select name="lahan_jenis_id" id="lahan_jenis_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lahan_jenis_id') border-red-500 @enderror" required>
                <option value="">-- Pilih Jenis Lahan --</option>
                @foreach($lahan_jenis as $lj)
                    <option value="{{ $lj->id_lahan_jenis }}" data-kategori="{{ $lj->kategori }}" {{ old('lahan_jenis_id', $lahanData->lahan_jenis_id) == $lj->id_lahan_jenis ? 'selected' : '' }}>
                        {{ $lj->nama_lahan }}
                    </option>
                @endforeach
            </select>
            @error('lahan_jenis_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p> {{-- Pesan error Tailwind --}}
            @enderror
        </div>

        {{-- KATEGORI (Otomatis Terisi & Readonly) --}}
        <div>
            <label for="kategori_display" class="block text-sm font-medium text-gray-700">Kategori</label>
            <input type="text" name="kategori_display" id="kategori_display" readonly placeholder="Akan terisi otomatis"
                   class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm cursor-not-allowed">
            <input type="hidden" name="kategori" id="kategori"> {{-- Input hidden untuk mengirim nilai kategori --}}
        </div>

        {{-- TAHUN --}}
        <div>
            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
            <input type="number" name="tahun" id="tahun"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tahun') border-red-500 @enderror"
                   value="{{ old('tahun', $lahanData->tahun) }}" required min="1900" max="{{ date('Y') + 5 }}">
            @error('tahun')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- PRODUKTIF (HA) --}}
        <div>
            <label for="produktif_ha" class="block text-sm font-medium text-gray-700">Produktif (Ha)</label>
            <input type="number" step="0.01" name="produktif_ha" id="produktif_ha"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('produktif_ha') border-red-500 @enderror"
                   value="{{ old('produktif_ha', $lahanData->produktif_ha) }}" required min="0">
            @error('produktif_ha')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- TIDAK PRODUKTIF (HA) --}}
        <div>
            <label for="tidak_produktif_ha" class="block text-sm font-medium text-gray-700">Tidak Produktif (Ha)</label>
            <input type="number" step="0.01" name="tidak_produktif_ha" id="tidak_produktif_ha"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tidak_produktif_ha') border-red-500 @enderror"
                   value="{{ old('tidak_produktif_ha', $lahanData->tidak_produktif_ha) }}" required min="0">
            @error('tidak_produktif_ha')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3"> 
            <a href="{{ route('demografi-lahan.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Perbarui Data Lahan</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lahanJenisSelect = document.getElementById('lahan_jenis_id');
        const kategoriDisplayInput = document.getElementById('kategori_display');
        const kategoriHiddenInput = document.getElementById('kategori');

        // Fungsi untuk mengisi kategori
        function updateKategori() {
            const selectedOption = lahanJenisSelect.options[lahanJenisSelect.selectedIndex];
            const kategori = selectedOption && selectedOption.dataset.kategori ? selectedOption.dataset.kategori : '';
            kategoriDisplayInput.value = kategori ? kategori.charAt(0).toUpperCase() + kategori.slice(1) : '';
            kategoriHiddenInput.value = kategori || '';
        }

        updateKategori();

        lahanJenisSelect.addEventListener('change', updateKategori);
    });
</script>
@endpush
@endsection
