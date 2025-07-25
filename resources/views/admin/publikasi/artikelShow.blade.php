<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
</head>

<body class="font-sans bg-white text-gray-800 px-4 py-8 max-w-3xl mx-auto">

    <h1 class="text-3xl font-bold mb-2">{{ $artikel->judul }}</h1>
    <div class="text-sm mb-1 text-greenDark">Penulis: {{ $artikel->penulis }}</div>
    <div class="text-sm text-gray-500 mb-4">
        Dipublikasikan pada: {{ $artikel->tanggal_update?->format('d M Y') }}
    </div>

    @if ($artikel->foto)
        <img src="{{ asset('storage/' . $artikel->foto) }}" alt="Foto artikel"
             class="w-full max-h-[400px] object-cover rounded-lg mb-6">
    @endif

    <div class="prose prose-lg max-w-none text-justify">
        {!! nl2br($artikel->deskripsi) !!}
    </div>

 <div class="flex justify-center mt-10">
    <a href="{{ route('artikel') }}"
        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill">
        Kembali
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a>
    </div>


</body>
</html>
