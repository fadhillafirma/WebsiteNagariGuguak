@php
    // $jorongList dikirim dari controller: collection id_jorong, nama_jorong
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div class="sm:col-span-2">
        <label class="block text-gray-700 mb-1">Jorong</label>
        <select name="jorong_id"
                class="w-full rounded-lg border border-gray-300 py-2 p-2  focus:ring-blue-500 focus:border-blue-500"
                required>
            <option value="">-- Pilih Jorong --</option>
            @foreach($jorongList as $jor)
                <option value="{{ $jor->id_jorong }}"
                    @selected(old('jorong_id', $row->jorong_id ?? '') == $jor->id_jorong)>
                    {{ $jor->nama_jorong }}
                </option>
            @endforeach
        </select>
        @error('jorong_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="block text-gray-700 mb-1">Tahun</label>
        <input type="number" name="tahun" min="1900" max="{{ date('Y')+1 }}"
               value="{{ old('tahun', $row->tahun ?? '') }}"
               class="w-full rounded-lg border border-gray-300 py-2 p-2  focus:ring-blue-500 focus:border-blue-500" required>
        @error('tahun') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-gray-700 mb-1">KK</label>
        <input type="number" name="kk" min="0"
               value="{{ old('kk', $row->kk ?? 0) }}"
               class="w-full rounded-lg border border-gray-300 py-2 p-2  focus:ring-blue-500 focus:border-blue-500">
        @error('kk') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-gray-700 mb-1">Laki-laki</label>
        <input type="number" name="laki_laki" min="0"
               value="{{ old('laki_laki', $row->laki_laki ?? 0) }}"
               class="w-full rounded-lg border border-gray-300 py-2 p-2  focus:ring-blue-500 focus:border-blue-500">
        @error('laki_laki') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-gray-700 mb-1">Perempuan</label>
        <input type="number" name="perempuan" min="0"
               value="{{ old('perempuan', $row->perempuan ?? 0) }}"
               class="w-full rounded-lg border border-gray-300 py-2 p-2  focus:ring-blue-500 focus:border-blue-500">
        @error('perempuan') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>
</div>
