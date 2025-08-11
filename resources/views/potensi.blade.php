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
<section class="py-20 px-8 bg-white max-w-7xl mx-auto">
    <h2 class="font-bold text-greenDark text-4xl underline underline-offset-4 text-center mt-10 title-animate">Potensi Nagari</h2>

    @foreach ($jenisPotensiList as $jenis)
        @if (isset($potensis[$jenis]) && count($potensis[$jenis]))
            <h3 class="text-3xl font-semibold text-gray-800 mt-12 capitalize text-greenDark">{{ $jenis }}</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
                @foreach ($potensis[$jenis] as $potensi)
                    <a href="{{ route('potensi.show', $potensi->id) }}">
                        <div class="bg-white shadow-xl rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                            <img class="rounded-t-lg w-full h-48 object-cover p-5 rounded-lg" src="{{ asset('storage/' . $potensi->gambar) }}" alt="{{ $potensi->judul }}" />
                            <div class="p-5">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ $potensi->judul }}</h5>
                                <p class="text-sm text-gray-500 mb-2">{{ \Illuminate\Support\Str::limit($potensi->deskripsi, 50) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    @endforeach
</section>

         <section class="bg-white pt-5 pb-5 bottom-0 left-0 w-full shadow-md ">
                    <div class="max-w-6xl mx-auto text-center  justify-content-center">
                        <p>2025 Nagari Guguak.</p>
                            <p>Powered by KKN Guguak Unand 2025.</p>
                    </div>
        </section>



    @include('layout.navbar')

    <script>
        lucide.createIcons();
                //animasi css judul title-animate
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
