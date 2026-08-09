<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Berita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <script src="https://unpkg.com/lucide@latest"></script>
     <link rel="icon" type="image/png" href="/logo.png" />

</head>
<body class="m-0 p-0 bg-white">

    @include('layout.navbar')

    <section class="py-20 px-8 max-w-7xl mx-auto">
        <h2 class="font-bold text-greenDark text-4xl underline underline-offset-4 text-center mt-10 title-animate">
            Berita
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-10">
            @foreach ($beritas as $berita)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <a href="{{ route('landing.showBerita', $berita->id_artikel) }}">
                        @if($berita->foto)
                            <img
                                class="rounded-t-lg w-full h-48 object-cover p-5 rounded-lg"
                                src="{{ asset('storage/' . $berita->foto) }}"
                                alt="{{ $berita->judul }}"
                            />
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-t-lg">
                                <span class="text-gray-400 text-sm">Tidak ada foto</span>
                            </div>
                        @endif
                    </a>
                    <div class="p-5">
                        <a href="{{ route('landing.showBerita', $berita->id_artikel) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                {{ $berita->judul }}
                            </h5>
                        </a>
                        <p class="text-sm text-gray-500 mb-2">
                            {{ $berita->tanggal_update?->format('d M Y') }}
                        </p>
                        <h5 class="mb-2 mt-5 text-sm font-semibold tracking-tight text-gray-600">
                            Oleh: {{ $berita->penulis }}
                        </h5>

                        <a
                            href="{{ route('landing.showBerita', $berita->id_artikel) }}"
                            class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill"
                        >
                            Read more
                            <svg
                                class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 14 10"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

     <section class="bg-white pt-5 pb-5 bottom-0 left-0 w-full shadow-md ">
                    <div class="max-w-6xl mx-auto text-center  justify-content-center">
                        <p>2025 Nagari Guguak.</p>
                            <p>Powered by KKN Guguak Unand 2025.</p>
                    </div>
        </section>


    <script>
        lucide.createIcons();
        document.addEventListener("DOMContentLoaded", function () {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("show");
                        } else {
                            entry.target.classList.remove("show");
                        }
                    });
                },
                { threshold: 0.3 }
            );
            document.querySelectorAll(".title-animate").forEach((title) => {
                observer.observe(title);
            });
        });
    </script>
</body>
</html>
