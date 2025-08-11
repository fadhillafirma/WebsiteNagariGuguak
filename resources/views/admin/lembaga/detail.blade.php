<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $nama_lembaga ?? 'Profil Lembaga' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="">

    @include('layout.navbar')

    <section class="pt-24 pb-16 px-4">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6">
            <h1 class="text-3xl font-bold text-greenDark text-center underline underline-offset-4 mb-2 mt-10">
                {{ $nama_lembaga ?? 'Nama Lembaga' }}
            </h1>

            <p class="text-center text-gray-600 text-sm mb-8">
                Tahun: <strong>{{ $tahunTerbaru ?? '-' }}</strong>
            </p>

            @if(!empty($foto_lembaga))
            <h1 class="text-3xl font-bold text-greenDark text-center underline underline-offset-4 mb-2 mt-10 mb-8">
               FOto Lembaga
            </h1>
                <img src="{{ asset('storage/' . $struktur_organisasi) }}" alt="Struktur Organisasi" class="w-full h-auto max-h-96 object-cover rounded-md mb-6">
            @endif



            <p class="text-justify text-gray-700 text-base mb-6 leading-relaxed">
                {{ $deskripsi_lembaga ?? 'Deskripsi belum tersedia.' }} . Saat ini {{$nama_lembaga}} dipimpin oleh <strong>{{$nama_ketua}}</strong>.
            </p>

             @if(!empty($struktur_organisasi))
                <p class="text-3xl font-bold text-greenDark text-center underline underline-offset-4 mb-2 mt-10 mb-5">Struktur Organisasi</p>
                <img src="{{ asset('storage/' . $struktur_organisasi) }}" alt="Foto Lembaga" class="w-full h-full object-cover rounded-md mb-6">
            @endif

             <div class="flex justify-center mt-10">
                <a href="{{ route('landing.lembaga') }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill">
                    Kembali
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>






        </div>
    </section>

    @if(isset($data) && count($data) > 0)
    <script>
    </script>
    @endif

</body>
</html>
