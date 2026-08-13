<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Demografi Lahan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
     <link rel="icon" type="image/png" href="/logo.png" />



</head>
<body>

<section class="pt-24 pb-16 px-4">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6">
        <h1 class="text-3xl font-bold text-greenDark text-center underline underline-offset-4 mb-2 mt-10 title-animate">
            Data Demografi Lahan
        </h1>
        <p class="text-center text-gray-600 text-sm mb-8">
            Tahun: <strong>{{ $tahunTerbaru }}</strong>
        </p>

        <p class="text-gray-700 text-justify mb-6">
            Data demografi lahan di Nagari Guguak pada tahun {{ $tahunTerbaru }} menyajikan informasi mengenai jenis dan pemanfaatan lahan yang ada. Informasi ini mencakup luas total lahan, serta pembagiannya antara lahan produktif dan tidak produktif, memberikan gambaran mengenai potensi agrikultural dan non-agrikultural di nagari.
        </p>

        @php
    $groupedByKategori = $dataLahan->groupBy(fn($d) => $d->lahanJenis->kategori);
@endphp

@foreach ($groupedByKategori as $kategori => $list)
    <div class="mb-12">
        <h2 class="text-md font-semibold text-greenDark mb-3 capitalize">
            Tabel Kategori: {{ $kategori }}
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-gray-700 border border-gray-200 rounded-lg mb-4">
                <thead class="bg-greenDark text-white text-sm">
                    <tr>
                        <th class="px-6 py-3 text-center">Jenis Lahan di koto guguak</th>
                        <th class="px-6 py-3 text-center">Luas (Ha)</th>
                        <th class="px-6 py-3 text-center">Produktif (Ha)</th>
                        <th class="px-6 py-3 text-center">Tidak Produktif (Ha)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalLuas = 0;
                        $totalProduktif = 0;
                        $totalTidakProduktif = 0;
                    @endphp
                    @foreach ($list as $data)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-3 text-center">{{ $data->lahanJenis->nama_lahan }}</td>
                            <td class="px-6 py-3 text-center font-semibold">{{ $data->luas_ha }}</td>
                            <td class="px-6 py-3 text-center font-semibold">{{ $data->produktif_ha }}</td>
                            <td class="px-6 py-3 text-center font-semibold">{{ $data->tidak_produktif_ha }}</td>
                        </tr>
                        @php
                            $totalLuas += $data->luas_ha;
                            $totalProduktif += $data->produktif_ha;
                            $totalTidakProduktif += $data->tidak_produktif_ha;
                        @endphp
                    @endforeach
                    <tr class="bg-gray-100 font-bold border-t">
                        <td class="px-6 py-3 text-center">Total</td>
                        <td class="px-6 py-3 text-center">{{ $totalLuas }}</td>
                        <td class="px-6 py-3 text-center">{{ $totalProduktif }}</td>
                        <td class="px-6 py-3 text-center">{{ $totalTidakProduktif }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endforeach

        <div class="mt-10">
            <h2 class="text-2xl font-bold text-center mb-4 text-greenDark title-animate">Distribusi Lahan Berdasarkan Kategori dan Nama Lahan</h2>
            <div id="lahanPieChart" style="height: 500px; width: 100%;"></div>
        </div>

        <div class="mt-10">
            <h2 class="text-2xl font-bold text-center mb-4 text-greenDark title-animate">Pemetaan Tutupan Lahan</h2>
            <img src="/pemetaanLahan.jpg" alt="">
        </div>

    </div>
</section>

     <section class="bg-white pt-5 pb-5 bottom-0 left-0 w-full shadow-md ">
                    <div class="max-w-6xl mx-auto text-center  justify-content-center">
                        <p>2025 Nagari Guguak.</p>
                            <p>Powered by KKN Guguak 2026.</p>
                    </div>
        </section>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        Highcharts.chart('lahanPieChart', {
            chart: {
                type: 'pie'
            },
            title: {
                text: null
            },
            tooltip: {
                pointFormat: '<b>{point.percentage:.1f}%</b> ({point.y} Ha)'
            },
            accessibility: {
                point: {
                    valueSuffix: 'Ha'
                }
            },
            plotOptions: {
                pie: {
                    shadow: false,
                    center: ['50%', '50%'],
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y} Ha'
                    }
                }
            },
            series: [{
                name: 'Kategori',
                size: '60%',
                data: [
                    @php
                        $kategoriGrouped = $dataLahan->groupBy(fn($d) => $d->lahanJenis->kategori);
                    @endphp
                    @foreach ($kategoriGrouped as $kategori => $group)
                        {
                            name: '{{ ucfirst($kategori) }}',
                            y: {{ $group->sum('luas_ha') }},
                            color: '{{ $kategori === 'sawah' ? '#10b981' : ($kategori === 'perkebunan' ? '#f59e0b' : '#6b7280') }}'
                        }@if(!$loop->last),@endif
                    @endforeach
                ],
                dataLabels: {
                    distance: -30,
                    color: 'black'
                }
            }, {
                name: 'Nama Lahan',
                size: '80%',
                innerSize: '60%',
                data: [
                    @foreach ($dataLahan as $data)
                        {
                            name: '{{ $data->lahanJenis->nama_lahan }}',
                            y: {{ $data->luas_ha }},
                            color: '{{ $data->lahanJenis->kategori === 'sawah' ? '#34d399' : ($data->lahanJenis->kategori === 'perkebunan' ? '#fbbf24' : '#9ca3af') }}'
                        }@if(!$loop->last),@endif
                    @endforeach
                ]
            }]
        });
    });
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


@include('layout.navbar')

</body>
</html>

