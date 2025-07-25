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
        <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl p-6">
            <h1 class="text-3xl font-bold text-greenDark text-center underline underline-offset-4 mb-2 mt-10">
                Data Demografi Sekolah
            </h1>
            <p class="text-center text-gray-600 text-sm mb-8">
                Tahun: <strong>{{ $tahunTerbaru }}</strong>
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
                    </tbody>

                </table>
            </div>
        </div>
    </section>

    @include('layout.navbar')


</body>
</html>
