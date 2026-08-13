<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lembaga Nagari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="icon" type="image/png" href="/logo.png" />

</head>

<body class="m-0 p-0">
    @include('layout.navbar')

    <section class="py-20 px-8 bg-white max-w-7xl mx-auto">
        <h2 class="font-bold text-greenDark text-4xl underline underline-offset-4 text-center mt-10 title-animate">Lembaga Nagari</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-12">
            @foreach ($lembaga as $item)
                <div class="bg-white shadow-xl rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                    @if ($item->struktur_organisasi)
                        <img class="rounded-t-lg w-full h-60 object-cover p-5 rounded-lg" src="{{ asset('storage/' . $item->struktur_organisasi) }}" alt="{{ $item->nama_lembaga }}" />
                    @else
                        <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tidak Ada Gambar</div>
                    @endif
                    <div class="p-5">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ $item->nama_lembaga }}</h5>
                        <p class="text-sm text-gray-500 mb-3">{{ \Illuminate\Support\Str::limit($item->deskripsi, 100) }}</p>
                        <a href="{{ url('/lembagaNagari/' . $item->id) }}">
                             <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark transition-all">Lihat Detail</button>
                         </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

     <section class="bg-white pt-5 pb-5 bottom-0 left-0 w-full shadow-md ">
                    <div class="max-w-6xl mx-auto text-center  justify-content-center">
                        <p>2025 Nagari Guguak.</p>
                            <p>Powered by KKN Guguak 2026.</p>
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

