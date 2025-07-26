<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
    {{-- Pastikan Chart.js dimuat sebelum script chart Anda --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <section class="pt-24 pb-16 px-4">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6">
            <h1 class="text-3xl font-bold text-greenDark text-center underline underline-offset-4 mb-2 mt-10">
                Data Demografi Penduduk
            </h1>
            <p class="text-center text-gray-600 text-sm mb-8">
                Tahun: <strong>{{ $tahunTerbaru }}</strong>
            </p>
            <p class="text-gray-700 text-justify mb-6">
                Nagari Guguak memiliki komposisi penduduk yang tersebar di sejumlah jorong, dengan karakteristik yang beragam. Data berikut menampilkan jumlah penduduk berdasarkan jenis kelamin, jumlah kepala keluarga (KK), serta total penduduk di masing-masing jorong pada tahun tertentu.
            </p>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-700 border border-gray-200 rounded-lg">
                    <thead class="bg-greenDark text-white text-sm">
                        <tr>
                            <th class="px-6 py-3">Jorong</th>
                            <th class="px-6 py-3">Laki-laki</th>
                            <th class="px-6 py-3">Perempuan</th>
                            <th class="px-6 py-3">Jumlah KK</th>
                            <th class="px-6 py-3">Total Penduduk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr class="border-t hover:bg-gray-50 transition text-md">
                                <td class="px-6 py-3 text-gray-600">{{ $item->jorong->nama_jorong ?? '-' }}</td>
                                <td class="px-6 py-3 font-semibold">{{ $item->laki_laki }}</td>
                                <td class="px-6 py-3 font-semibold">{{ $item->perempuan }}</td>
                                <td class="px-6 py-3 font-semibold">{{ $item->kk }}</td>
                                <td class="px-6 py-3 font-bold text-greenDark">{{ $item->laki_laki + $item->perempuan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-gray-500">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                        <tr class="bg-gray-100 font-bold border-t-2">
                            <td class="px-6 py-3 text-gray-800">Total</td>
                            <td class="px-6 py-3 text-green-700">{{ $data->sum('laki_laki') }}</td>
                            <td class="px-6 py-3 text-green-700">{{ $data->sum('perempuan') }}</td>
                            <td class="px-6 py-3 text-green-700">{{ $data->sum('kk') }}</td>
                            <td class="px-6 py-3 text-green-800">{{ $data->sum('laki_laki') + $data->sum('perempuan') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $data->links() }}
            </div>
        </div>

        <div class="max-w-4xl mx-auto bg-white mt-12 shadow-md rounded-xl p-6">
            <h2 class="text-xl font-bold text-center text-gray-800 mb-4">Statistik Pertumbuhan Penduduk per Tahun per Jorong</h2>
            {{-- Tambahkan pesan jika tidak ada data untuk grafik --}}
            @if (empty($labels) || empty($datasets))
                <p class="text-center text-gray-500">Tidak ada data yang tersedia untuk menampilkan grafik.</p>
            @else
                <canvas id="pendudukChart" class="w-full max-h-[400px]"></canvas>
            @endif
        </div>
    </section>

    @include('layout.navbar')

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const labels = {!! json_encode($labels) !!};
        const datasetsRaw = {!! json_encode($datasets) !!};

        // Hanya inisialisasi chart jika ada data
        if (labels.length > 0 && datasetsRaw.length > 0) {
            const data = {
                labels: labels,
                datasets: datasetsRaw.map(item => ({
                    label: item.label, // Menggunakan 'label' sesuai perubahan di controller
                    data: item.data,
                    borderColor: item.borderColor, // Menggunakan 'borderColor' sesuai perubahan di controller
                    backgroundColor: item.backgroundColor, // Menggunakan 'backgroundColor' sesuai perubahan di controller
                    fill: false,
                    tension: 0.3
                }))
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' },
                        title: {
                            display: false,
                            text: 'Grafik Penduduk'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Penduduk'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun'
                            }
                        }
                    }
                }
            };

            const ctx = document.getElementById("pendudukChart");
            // Pastikan elemen canvas ditemukan sebelum mencoba membuat chart
            if (ctx) {
                new Chart(ctx.getContext("2d"), config);
            }
        } else {
            console.warn("Data grafik tidak tersedia. Chart tidak akan digambar.");
        }
    });
    </script>

</body>
</html>
