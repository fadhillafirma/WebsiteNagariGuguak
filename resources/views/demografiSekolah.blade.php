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
<body class="">

    <section class="pt-24 pb-16 px-4">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6">
            <h1 class="text-3xl font-bold text-greenDark text-center underline underline-offset-4 mb-2 mt-10">
                Data Demografi Sekolah
            </h1>
            <p class="text-center text-gray-600 text-sm mb-8">
                Tahun: <strong>{{ $tahunTerbaru }}</strong>
            </p>

            <p class="text-justify text-gray-700 text-base mb-6 leading-relaxed">
            Nagari Guguak memiliki sejumlah fasilitas pendidikan yang tersebar di berbagai jorong. Data berikut menggambarkan jumlah satuan pendidikan mulai dari tingkat PAUD hingga SMA pada tahun <strong>{{ $tahunTerbaru }}</strong>. Informasi ini berguna untuk melihat distribusi dan ketersediaan layanan pendidikan bagi masyarakat di wilayah ini.
        </p>


            <div class="overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-700 border border-gray-200 rounded-lg">
                    <thead class="bg-greenDark text-white text-sm">
                        <tr>
                            <th scope="col" class="px-6 py-3">Bangunan</th>
                            <th scope="col" class="px-6 py-3">Jumlah</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr class="border-t hover:bg-gray-50 transition text-md">
                                <td class="px-6 py-3 text-center text-gray-600">PAUD</td>

                                <td class="px-6 py-3 font-semibold">{{ $item->jumlah_paud }}</td>
                            </tr>
                            <tr class="border-t hover:bg-gray-50 transition text-md">
                                <td class="px-6 py-3 text-center text-gray-600">SD</td>

                                <td class="px-6 py-3 font-semibold">{{ $item->jumlah_sd }}</td>
                            </tr>
                            <tr class="border-t hover:bg-gray-50 transition text-md">
                                <td class="px-6 py-3 text-center text-gray-600">SMP</td>

                                <td class="px-6 py-3 font-semibold">{{ $item->jumlah_smp }}</td>
                            </tr>
                            <tr class="border-t hover:bg-gray-50 transition text-md">
                                <td class="px-6 py-3 text-center text-gray-600">SMA</td>

                                <td class="px-6 py-3 font-semibold">{{ $item->jumlah_sma }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-6 text-center text-gray-500">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                        <tr class="bg-gray-100 font-bold border-t-2">
                            <td class="px-6 py-3 text-gray-800 text-center">Total</td>
                            <td class="px-6 py-3 text-green-700">
                                {{ $item->jumlah_paud + $item->jumlah_sd + $item->jumlah_smp + $item->jumlah_sma }}
                            </td>
                        </tr>

                    </tbody>

                </table>
            </div>
        </div>
    </section>

    @include('layout.navbar')


</body>
</html>
