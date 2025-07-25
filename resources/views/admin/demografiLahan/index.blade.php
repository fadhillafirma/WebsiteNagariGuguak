@extends('layout.sidebar')


@section('content')
<div class="container">
    <h3>Data Demografi</h3>
    <a href="{{ route('demografi-lahan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jenis Lahan</th>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Produktif (Ha)</th>
                <th>Tidak Produktif (Ha)</th>
                <th>Luas Total (Ha)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->lahanJenis->nama_lahan }}</td>
                <td>{{ $item->lahanJenis->kategori }}</td>
                <td>{{ $item->tahun }}</td>
                <td>{{ $item->produktif_ha }}</td>
                <td>{{ $item->tidak_produktif_ha }}</td>
                <td>{{ $item->luas_ha }}</td>
                <td>
                    <a href="{{ route('lahan_data.edit', $item->id_lahan_data) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('lahan_data.destroy', $item->id_lahan_data) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
