<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nagari Guguak</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="m-0 p-0">

<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
    <h1 class="text-2xl font-bold mb-6 text-gray-700">Tambah Artikel / Berita</h1>

    <form method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf {{-- Nanti kalau sudah pakai controller, token CSRF otomatis dipakai --}}

        <!-- Judul -->
        <div>
            <label class="block text-gray-600 font-medium mb-1" for="judul">Judul</label>
            <input type="text" name="judul" id="judul" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block text-gray-600 font-medium mb-1" for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="5" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
        </div>

        <!-- Jenis (Artikel/Berita/Kegiatan) -->
        <div>
            <label class="block text-gray-600 font-medium mb-1" for="jenis">Jenis</label>
            <select name="jenis" id="jenis" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">-- Pilih Jenis --</option>
                <option value="artikel">Artikel</option>
                <option value="berita">Berita</option>
                <option value="kegiatan">Kegiatan</option>
            </select>
        </div>

        <!-- Foto -->
        <div>
            <label class="block text-gray-600 font-medium mb-1" for="foto">Upload Foto</label>
            <input type="file" name="foto" id="foto" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg">Simpan</button>
        </div>
    </form>
</div>


<script>
        lucide.createIcons();
    </script>
</body>
</html>
