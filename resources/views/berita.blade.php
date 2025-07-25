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

<body class="m-0 p-0">

            <section class=" py-20 px-8 bg-white max-w-7xl mx-auto">
                        <h1 class="text-3xl text-center font-semibold mb-8 text-gray-900 mt-10 animate-on-scroll">Berita</h1>


                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-10">
                    @foreach ($beritas as $berita)
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                            <a href="#">
                                <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $berita->judul }}
                                    </h5>
                                </a>
                                <p class="text-sm text-gray-500 mb-2">
     {{ $berita->created_at->format('d M Y') }}, {{ $berita->created_at->format('H:i') }} WIB
</p>
<h5 class="mb-2 mt-5 text-sm font-semibold tracking-tight text-gray-600 dark:text-white">
                         Oleh :   {{ $berita->penulis }}
                        </h5>

                                <a href="{{ route('landing.showBerita', $berita->id_artikel) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-greenVill">

                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>



    @include('layout.navbar')

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
