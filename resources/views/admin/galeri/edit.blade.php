<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

<div class="container">
    <h1>Edit Foto Galeri</h1>

    @if ($errors->any())
        <div style="color:red;">
            @foreach ($errors->all() as $e)
                <p>{{ $e }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('galeri.update', $galeri->id_foto) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom:10px;">
            <label>Foto Saat Ini:</label><br>
            @if($galeri->foto)
                <img src="{{ asset('storage/'.$galeri->foto) }}" width="150" alt="thumbnail">
            @else
                <p>(Tidak ada foto)</p>
            @endif
        </div>

        <div style="margin-bottom:10px;">
            <label>Ganti Foto (opsional)</label><br>
            <input type="file" name="foto">
        </div>

        <div style="margin-bottom:10px;">
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" rows="3">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
        </div>

        <button type="submit">Update</button>
        <a href="{{ route('galeri.index') }}">Batal</a>
    </form>
</div>
</body>
</html>
