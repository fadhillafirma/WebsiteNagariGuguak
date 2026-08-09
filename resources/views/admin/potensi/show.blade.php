<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $potensi->judul }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
</head>
<body class="font-sans bg-white text-gray-800 px-4 py-8 max-w-3xl mx-auto shadow-xl">

    <h1 class="text-3xl font-bold mb-2">{{ $potensi->judul }}</h1>
    <div class="text-sm text-greenDark mb-1 font-bold">Jenis: {{ ucfirst($potensi->jenis_potensi) }}</div>
    <div class="text-sm text-gray-500 mb-4">
        Diperbarui pada: {{ $potensi->tanggal_post ? $potensi->tanggal_post->format('d M Y') : $potensi->updated_at->format('d M Y') }}
    </div>

    @if ($potensi->gambar)
        <img src="{{ asset('storage/' . $potensi->gambar) }}" alt="Gambar potensi"
             class="w-full max-h-[400px] object-cover rounded-lg mt-10 mb-6">
    @endif

    <div class="prose prose-lg max-w-none text-justify">
        {!! nl2br(e($potensi->deskripsi)) !!}
    </div>

    <div class="flex justify-center mt-10">
        <a href="{{ route('landing.potensi') }}"
           class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill">
            Kembali
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
    </div>

</body>
</html>
