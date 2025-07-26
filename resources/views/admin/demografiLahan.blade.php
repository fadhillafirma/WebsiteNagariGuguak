<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Demografi Lahan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Custom styles for the table for better readability if needed */
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9fafb; /* gray-50 */
        }
        .table-striped tbody tr:hover {
            background-color: #f3f4f6; /* gray-100 */
        }
    </style>
</head>
<body>

{{-- Header atau Navbar bisa diletakkan di sini, disesuaikan dengan layout Anda --}}
{{-- Contoh: @include('layout.navbar') --}}

<section class="pt-24 pb-16 px-4">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6">
        <h1 class="text-3xl font-bold text-greenDark text-center underline underline-offset-4 mb-2 mt-10">
            Data Demografi Lahan
        </h1>
        <p class="text-center text-gray-600 text-sm mb-8">
            Tahun: <strong>{{ $tahunTerbaru }}</strong>
        </p>

        <p class="text-gray-700 text-justify mb-6">
            Data demografi lahan di Nagari Guguak untuk tahun {{ $tahunTerbaru }} menyajikan informasi penting mengenai jenis dan pemanfaatan lahan yang ada. Informasi ini mencakup luas lahan produktif dan tidak produktif, serta kategorinya seperti pertanian, permukiman, atau lainnya, yang memberikan gambaran lengkap tentang potensi sumber daya lahan di nagari.
        </p>

        <div class="overflow-x-auto">
            @if($dataLahan->isEmpty())
                <p class="text-center text-gray-500 py-6">Tidak ada data lahan yang tersedia untuk tahun {{ $tahunTerbaru }}.</p>
            @else
                <table class="w-full text-sm text-gray-700 border border-gray-200 rounded-lg table-striped">
                    <thead class="bg-greenDark text-white text-sm">
                        <tr>
                            <th class="px-6 py-3 text-left">Jenis Lahan</th>
                            <th class="px-6 py-3 text-center">Kategori</th>
                            <th class="px-6 py-3 text-center">Produktif (Ha)</th>
                            <th class="px-6 py-3 text-center">Tidak Produktif (Ha)</th>
                            <th class="px-6 py-3 text-center">Total (Ha)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalProduktif = 0;
                            $totalTidakProduktif = 0;
                            $totalKeseluruhan = 0;
                        @endphp
                        @foreach($dataLahan as $item)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-3 text-left">{{ $item->lahanJenis->nama_lahan ?? 'N/A' }}</td>
                                <td class="px-6 py-3 text-center">{{ ucfirst($item->lahanJenis->kategori ?? 'N/A') }}</td>
                                <td class="px-6 py-3 text-center">{{ number_format($item->produktif_ha, 2, ',', '.') }}</td>
                                <td class="px-6 py-3 text-center">{{ number_format($item->tidak_produktif_ha, 2, ',', '.') }}</td>
                                <td class="px-6 py-3 text-center font-semibold">{{ number_format($item->luas_ha, 2, ',', '.') }}</td>
                            </tr>
                            @php
                                $totalProduktif += $item->produktif_ha;
                                $totalTidakProduktif += $item->tidak_produktif_ha;
                                $totalKeseluruhan += $item->luas_ha;
                            @endphp
                        @endforeach
                        <tr class="border-t hover:bg-gray-100 font-bold bg-gray-100">
                            <td class="px-6 py-3 text-left">Total Keseluruhan</td>
                            <td class="px-6 py-3 text-center"></td> {{-- Kolom Kategori Total --}}
                            <td class="px-6 py-3 text-center">{{ number_format($totalProduktif, 2, ',', '.') }}</td>
                            <td class="px-6 py-3 text-center">{{ number_format($totalTidakProduktif, 2, ',', '.') }}</td>
                            <td class="px-6 py-3 text-center">{{ number_format($totalKeseluruhan, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</section>

@include('layout.navbar') {{-- Pastikan navbar Anda di-include di sini jika itu bagian dari layout umum --}}

</body>
</html>
