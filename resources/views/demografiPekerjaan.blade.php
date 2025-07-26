<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Demografi Pekerjaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

<section class="pt-24 pb-16 px-4">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6">
        <h1 class="text-3xl font-bold text-greenDark text-center underline underline-offset-4 mb-2 mt-10">
            Data Demografi Pekerjaan
        </h1>
        <p class="text-center text-gray-600 text-sm mb-8">
            Tahun: <strong>{{ $tahunTerbaru }}</strong>
        </p>

        <p class="text-gray-700 text-justify mb-6">
    Data demografi pekerjaan di Nagari Guguak pada tahun 2026 memberikan gambaran tentang ragam mata pencaharian masyarakat. Informasi ini mencerminkan peran berbagai sektor, mulai dari pertanian, pemerintahan, hingga profesi lainnya, dalam mendukung kehidupan ekonomi di nagari. 
</p>


        <div class="overflow-x-auto">
            <table class="w-full text-sm text-gray-700 border border-gray-200 rounded-lg">
                <thead class="bg-greenDark text-white text-sm">
                    <tr>
                        <th class="px-6 py-3 text-center">Pekerjaan</th>
                        <th class="px-6 py-3 text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data)
                        <tr class="border-t hover:bg-gray-50 ">
                            <td class="px-6 py-3 text-center">Petani</td>
                            <td class="px-6 py-3 font-semibold text-center">{{ $data->petani }}</td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3 text-center">Pegawai Negeri</td>
                            <td class="px-6 py-3 font-semibold text-center">{{ $data->pegawai_negeri }}</td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3 text-center">Karyawan Swasta</td>
                            <td class="px-6 py-3 font-semibold text-center">{{ $data->karyawan_swasta }}</td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3 text-center">Pedagang</td>
                            <td class="px-6 py-3 font-semibold text-center">{{ $data->pedagang }}</td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3 text-center">TNI</td>
                            <td class="px-6 py-3 font-semibold text-center">{{ $data->tni }}</td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3 text-center">Pensiunan</td>
                            <td class="px-6 py-3 font-semibold text-center">{{ $data->pensiunan }}</td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3 text-center">Aparat Pemerintahan</td>
                            <td class="px-6 py-3 font-semibold text-center">{{ $data->aparat_pemerintahan }}</td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3 text-center">Pekerjaan Lain</td>
                            <td class="px-6 py-3 font-semibold text-center">{{ $data->pekerjaan_lain }}</td>
                        </tr>
                        <tr class="border-t hover:bg-gray-100 font-bold bg-gray-100">
                            <td class="px-6 py-3 text-center">Total</td>
                            <td class="px-6 py-3 text-center">{{ $data->total }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="2" class="px-6 py-6 text-center text-gray-500">Data tidak ditemukan.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>

@include('layout.navbar')

</body>
</html>
