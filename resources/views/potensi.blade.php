<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nagari Guguak</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <script src="https://unpkg.com/lucide@latest"></script>
     <link rel="icon" type="image/png" href="/logo.png" />

</head>

<body class="m-0 p-0 min-h-screen flex flex-col">
    <!-- Konten utama -->
    <main class="flex-grow py-20 px-8 bg-white max-w-7xl mx-auto w-full">
        <h2 class="font-bold text-greenDark text-4xl underline underline-offset-4 text-center mt-10 title-animate">
            Potensi Nagari
        </h2>

        @foreach ($jenisPotensiList as $jenis)
            @if (isset($potensis[$jenis]) && count($potensis[$jenis]))
                <h3 class="text-3xl font-semibold text-gray-800 mt-12 capitalize text-greenDark">{{ $jenis }}</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
                    @foreach ($potensis[$jenis] as $potensi)
                        <a href="{{ route('landing.potensi.show', $potensi->id) }}">
                            <div
                                class="bg-white shadow-xl rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                                @if ($potensi->gambar)
                                    <img class="rounded-t-lg w-full h-48 object-cover p-5 rounded-lg"
                                        src="{{ asset('storage/' . $potensi->gambar) }}" alt="{{ $potensi->judul }}" />
                                @else
                                    <div class="p-5">
                                        <div class="w-full h-48 bg-gray-100 flex flex-col items-center justify-center rounded-lg">
                                            <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-xs text-gray-400">Belum ada gambar</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="p-5">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ $potensi->judul }}</h5>
                                    <p class="text-sm text-gray-500 mb-2">
                                        {{ \Illuminate\Support\Str::limit($potensi->deskripsi, 50) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        @endforeach
    </main>

    <!-- Footer -->
    <footer class="bg-white pt-5 pb-5 shadow-md w-full">
        <div class="max-w-6xl mx-auto text-center">
            <p>2025 Nagari Guguak.</p>
            <p>Powered by KKN Guguak Unand 2025.</p>
        </div>
    </footer>

    @include('layout.navbar')

    <script>
        lucide.createIcons();
        // Animasi css judul title-animate
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
                }, {
                    threshold: 0.3,
                }
            );

            document.querySelectorAll(".title-animate").forEach((title) => {
                observer.observe(title);
            });
        });
    </script>
</body>
</html>
