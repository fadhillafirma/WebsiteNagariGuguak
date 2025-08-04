{{-- KATEGORI --}}
<div class="mb-3">
    <label for="kategori" class="form-label">Kategori</label>
    <select name="kategori" id="kategori" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoriEnum as $kategori)
            <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>
                {{ ucfirst($kategori) }}
            </option>
        @endforeach
    </select>
</div>

{{-- LAHAN --}}
<div class="mb-3">
    <label for="lahan_jenis_id" class="form-label">Jenis Lahan</label>
    <select name="lahan_jenis_id" id="lahan_jenis_id" class="form-control" required>
        <option value="">-- Pilih Jenis Lahan --</option>
        @foreach($lahan_jenis as $lj)
            <option value="{{ $lj->id_lahan_jenis }}" {{ old('lahan_jenis_id') == $lj->id_lahan_jenis ? 'selected' : '' }}>
                {{ $lj->nama_lahan }}
            </option>
        @endforeach
    </select>
</div>



{{-- FORM LAINNYA --}}
<div class="mb-3">
    <label for="tahun" class="form-label">Tahun</label>
    <input type="number" name="tahun" class="form-control"
           value="{{ old('tahun', $lahan_data->tahun ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="luas" class="form-label">Luas (Ha)</label>
    <input type="number" step="0.01" name="luas" class="form-control"
           value="{{ old('luas_ha', $lahan_data->luas_ha ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="produktif" class="form-label">Produktif (Ha)</label>
    <input type="number" step="0.01" name="produktif" class="form-control"
           value="{{ old('produktif_ha', $lahan_data->produktif_ha ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="tidak_produktif" class="form-label">Tidak Produktif (Ha)</label>
    <input type="number" step="0.01" name="tidak_produktif_ha" class="form-control"
           value="{{ old('tidak_produktif_ha', $lahan_data->tidak_produktif_ha ?? '') }}" required>
</div>

{{-- Script: Filter dropdown --}}
@push('scripts')

@endpush
