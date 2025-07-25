@extends('layout.sidebar')

@section('content')
<div class="container">
    <h3>Tambah Data Demografi</h3>
    <form action="{{ route('demografi-lahan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="lahan_jenis_id" class="form-label">Jenis Lahan</label>
            <select name="kategori" class="form-select">
    @foreach (\App\Models\LahanJenis::KATEGORI_ENUM as $kategori)
        <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>
            {{ ucfirst($kategori) }}
        </option>
    @endforeach
</select>

        </div>

        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" class="form-control" name="tahun" required>
        </div>

        <div class="mb-3">
            <label for="produktif_ha" class="form-label">Luas Produktif (Ha)</label>
            <input type="number" class="form-control" name="produktif_ha" required>
        </div>

        <div class="mb-3">
            <label for="tidak_produktif_ha" class="form-label">Luas Tidak Produktif (Ha)</label>
            <input type="number" class="form-control" name="tidak_produktif_ha" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
