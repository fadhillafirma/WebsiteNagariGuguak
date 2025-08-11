<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $nama_jorong ?? 'Profil Jorong' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="">

    @include('layout.navbar')

    <section class="pt-24 pb-16 px-4">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6">
            <h1 class="text-3xl font-bold text-greenDark text-center underline underline-offset-4 mb-2 mt-10">
               {{ $nama_jorong ?? 'Nama Jorong' }}
            </h1>

            <p class="text-center text-gray-600 text-sm mb-8">
                Tahun: <strong>{{ $tahunTerbaru ?? '-' }}</strong>
            </p>

            @if(!empty($foto_jorong))
                <img src="{{ asset('storage/' . $foto_jorong) }}" alt="Foto Jorong" class="w-full h-auto max-h-96 object-cover rounded-md mb-6 ">
            @endif

            <p class="text-justify text-gray-700 text-base mb-6 leading-relaxed">
                {{ $deskripsi_jorong ?? 'Deskripsi belum tersedia.' }}
            </p>

             <p class="text-center text-lg font-semibold text-gray-800 mb-5">
                Kepala Jorong: {{ $kepala_jorong ?? '-' }}
            </p>

            <div class="flex justify-center">
                 @if(!empty($foto_kepala_jorong))
                    <img src="{{ asset('storage/' . $foto_kepala_jorong) }}" alt="Foto Jorong" class="w-50 h-auto max-h-96 object-cover rounded-md mb-6 ">
                @endif
            </div>
        </div>
    </section>

</body>
</html>
