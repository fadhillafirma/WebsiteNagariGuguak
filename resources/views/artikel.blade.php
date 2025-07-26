<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artikel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100">

    @include('layout.navbar')

    <section class="py-20 px-4 max-w-7xl mx-auto">
        <h2 class="font-bold text-greenDark text-4xl underline underline-offset-4 text-center text-center mt-10 mb-10">Artikel</h2>


        @if($artikels->isEmpty())
            <p class="text-gray-600">Tidak ada artikel untuk saat ini.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($artikels as $artikel)
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <a href="#">
                            <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('storage/' . $artikel->foto) }}" alt="{{ $artikel->judul }}" />
                        </a>
                        <div class="p-4">
                            <h2 class="text-lg font-bold text-gray-800 mb-1">{{ $artikel->judul }}</h2>
                            <p class="text-sm text-gray-500 mb-2">{{ $artikel->created_at->format('d M Y, H:i') }}</p>
                            <p class="text-gray-700 text-sm mb-3">{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>
                            <h5 class="mb-2 mt-5 text-sm font-semibold tracking-tight text-gray-600 dark:text-white">
                                Oleh :   {{ $artikel->penulis }}
                            </h5>
                            <a href="{{ route('landing.showArtikel', $artikel->id_artikel) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-greenVill">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div> <!-- Ini penutup div .p-4 -->
                    </div> <!-- Tambahin penutup div card-nya di sini -->
                @endforeach

            </div>
        @endif
    </section>

    <script>lucide.createIcons();</script>
</body>
</html>
