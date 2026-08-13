<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jorong</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
     <link rel="icon" type="image/png" href="/logo.png" />

</head>

<body class="m-0 p-0">

    <section class="py-20 px-8 bg-white max-w-7xl mx-auto">
        <h2 class="font-bold text-greenDark text-4xl underline underline-offset-4 text-center mt-10 mb-12 title-animate">Jorong</h2>

        @if ($jorongs->count())
            <div class="space-y-16">
                @foreach ($jorongs as $jorong)
                    <div class="flex flex-col md:flex-row {{ $loop->iteration % 2 == 0 ? 'md:flex-row-reverse' : '' }}
                        items-center gap-8 bg-white shadow-xl rounded-lg p-6
                        border border-transparent
                        transition-all duration-300 ease-out hover:shadow-2xl hover:-translate-y-2">

                        {{-- Gambar --}}
                        <div class="w-full md:w-1/2">
                            @if ($jorong->foto_jorong)
                                <img src="{{ asset('storage/' . $jorong->foto_jorong) }}"
                                    alt="Foto Kepala Jorong"
                                    class="w-full h-80 object-cover rounded-lg border-2 border-greenDark ">
                            @else
                                <div class="w-full h-80 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg">
                                    Tidak Ada Foto
                                </div>
                            @endif
                        </div>

                        {{-- Deskripsi --}}
                        <div class="w-full md:w-1/2">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $jorong->nama_jorong }}</h3>
                            <p class="text-gray-600 mb-2"><strong>Kepala Jorong:</strong> {{ $jorong->kepala_jorong }}</p>
                            <p class="text-gray-700 leading-relaxed text-justify">
                                {{ $jorong->deskripsi_jorong }}
                            </p>

                            <a href="{{ route('landing.jorong.show', $jorong->id_jorong) }}" class="mt-4 inline-block">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-white border-2 bg-greenDark rounded-lg
                                            hover:bg-white hover:text-greenDark hover:border-greenDark transition-all duration-300 ease-out">
                                    Lihat Detail
                                </button>
                            </a>
                        </div>
                    </div>

                @endforeach
            </div>
        @else
            <p class="text-center text-gray-600">Belum ada data jorong yang tersedia.</p>
        @endif
    </section>

     <section class="bg-white pt-5 pb-5 bottom-0 left-0 w-full shadow-md ">
                    <div class="max-w-6xl mx-auto text-center  justify-content-center">
                        <p>2025 Nagari Guguak.</p>
                            <p>Powered by KKN Guguak 2026.</p>
                    </div>
        </section>

    @include('layout.navbar')

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

