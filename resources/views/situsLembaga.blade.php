<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Situs Lembaga Nagari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="icon" type="image/png" href="/logo.png" />

    <style>
        .title-animate {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }
        .title-animate.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="m-0 p-0 bg-gray-50">
    @include('layout.navbar')

    <section class="py-20 px-8 max-w-7xl mx-auto min-h-[80vh]">
        <h2 class="font-bold text-greenDark text-4xl underline underline-offset-4 text-center mt-10 title-animate">Situs Lembaga Nagari</h2>
        <p class="text-center text-gray-600 mt-4 max-w-2xl mx-auto title-animate">Kunjungi situs-situs lembaga yang ada di lingkungan pemerintahan Nagari Guguak.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-12">
            @foreach ($situs_lembagas as $situs)
                <div class="bg-white shadow-xl rounded-xl overflow-hidden hover:shadow-2xl transition duration-300 border border-gray-100 flex flex-col h-full">
                    <div class="h-48 flex items-center justify-center bg-gray-50 p-4 border-b border-gray-100">
                        @if ($situs->logo)
                            <img class="w-full h-full object-contain" src="{{ asset('storage/' . $situs->logo) }}" alt="{{ $situs->nama_situs }}" />
                        @else
                            <div class="text-gray-400 flex flex-col items-center">
                                <i data-lucide="globe" class="w-12 h-12 mb-2 text-gray-300"></i>
                                <span class="text-sm">Logo {{ $situs->nama_situs }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900">{{ $situs->nama_situs }}</h5>
                        <p class="text-sm text-gray-600 mb-6 flex-grow">{{ $situs->deskripsi ?? 'Tidak ada deskripsi untuk situs ini.' }}</p>
                        
                        <div class="mt-auto">
                            <a href="{{ $situs->url_situs }}" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-greenDark border-2 border-greenDark rounded-lg hover:bg-white hover:text-greenDark transition-all shadow-md hover:shadow-lg">
                                Kunjungi Situs
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($situs_lembagas->isEmpty())
            <div class="text-center py-20 text-gray-500">
                <i data-lucide="info" class="w-12 h-12 mx-auto text-gray-300 mb-4"></i>
                <p class="text-lg">Belum ada tautan situs lembaga yang ditambahkan.</p>
            </div>
        @endif
    </section>

    <section class="bg-white pt-5 pb-5 bottom-0 left-0 w-full shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] mt-10">
        <div class="max-w-6xl mx-auto text-center justify-content-center text-sm text-gray-600">
            <p>&copy; 2025 Nagari Guguak.</p>
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
                        }
                    });
                },
                { threshold: 0.1 }
            );

            document.querySelectorAll(".title-animate").forEach((title) => {
                observer.observe(title);
            });
        });
    </script>
</body>
</html>
