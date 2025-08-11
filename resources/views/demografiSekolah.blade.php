<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="">

    <section class="pt-24 pb-16 px-4">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6">
            <h1 class="text-3xl font-bold text-greenDark text-center underline underline-offset-4 mb-2 mt-10 title-animate">
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
                                <td class="px-6 py-3 text-center text-gray-600">TK</td>

                                <td class="px-6 py-3 font-semibold">{{ $item->jumlah_sma }}</td>
                            </tr>
                            <tr class="bg-gray-100 font-bold border-t-2">
                            <td class="px-6 py-3 text-gray-800 text-center">Total</td>
                            <td class="px-6 py-3 text-green-700">
                                {{ $item->jumlah_paud + $item->jumlah_sd + $item->jumlah_smp + $item->jumlah_sma }}
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-6 text-center text-gray-500">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse


                    </tbody>

                </table>
            </div>

             <div class="mt-12 bg-white p-6 shadow-md rounded-lg">
                <h2 class="text-xl font-semibold mb-4 text-center">Distribusi Total Sekolah per Jenjang</h2>
                <canvas id="sekolahChart" height="150"></canvas>
            </div>
        </div>
    </section>

     <section class="bg-white pt-5 pb-5 bottom-0 left-0 w-full shadow-md ">
                    <div class="max-w-6xl mx-auto text-center  justify-content-center">
                        <p>2025 Nagari Guguak.</p>
                            <p>Powered by KKN Guguak Unand 2025.</p>
                    </div>
        </section>

    @include('layout.navbar')

    @if(count($data) > 0)
<script>
    const ctx = document.getElementById('sekolahChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['PAUD', 'SD', 'SMP', 'TK'],
            datasets: [{
                label: 'Jumlah Sekolah',
                data: [
                    {{ $jumlahPaud }},
                    {{ $jumlahSd }},
                    {{ $jumlahSmp }},
                    {{ $jumlahSma }}
                ],
                backgroundColor: {!! json_encode($warnaChart) !!},
                borderColor: '#22543d',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    font: { size: 18 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
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
@endif




</body>
</html>
