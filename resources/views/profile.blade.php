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

<body class='m-0 p-0'>
    <div class="bg-gray-100 w-full h-[100vh] content-center pt-10" id="profile">
        <div class="max-w-6xl mx-auto flex mt-20">
            <div class="grid grid-cols-2">
                <div class="text-start p-5">
                    <h2 class="font-bold text-greenDark text-4xl underline underline-offset-4">Sejarah</h2>
                    <h3 class="text-justify mt-10 indent-8"> <span class="font-bold text-greenDark">Nagari Guguak</span>  pada awalnya merupakan bagian dari Nagari Padang Laweh dan dipimpin secara adat oleh para Ninik Mamak dari berbagai suku, seperti Suku Caniago, Tigo Suku, Piliang, dan lainnya. Wilayah ini berkembang seiring dengan arus perantauan dan pemukiman masyarakat di sekitar Batang Sinamar dan Batang Ombilin, yang kemudian bermuara di daerah bernama Polak Loweh. </h3>
                    <h3 class="text-justify mt-5 indent-8">Setelah melalui musyawarah adat, para Ninik Mamak sepakat mendirikan Nagari sendiri yang bertempat di pemuntaran dataran tinggi. Tempat tersebut akhirnya diberi nama Guguak, dan kini menjadi wilayah mandiri.
                    Nagari Guguak resmi berdiri sebagai nagari tersendiri sejak tahun 1979 berdasarkan Undang-Undang Nomor 5 tentang Pemerintahan Desa. Wilayahnya terdiri dari dua desa: Desa Koto Guguak dan Desa Bulu Rotan yang berdiri selama 22 tahun. Seiring perubahan kebijakan pemerintahan, pada tahun 2002 Nagari Guguak kembali menerapkan sistem Pemerintahan Nagari sesuai peraturan daerah dan ketentuan provinsi.</h3>
                </div>
                <div class="flex justify-center p-3">
                    <img src="/sungai.jpg" alt="" class="rounded-xl">
                </div>
            </div>
        </div>

        <section class="relative bg-cover bg-center bg-fixed min-h-[20vh] mt-20" style="background-image: url('/sawah.jpg');">
            <div class="absolute inset-0 bg-black/50 z-0 backdrop-blur-sm "></div>
            <div class="relative z-10 flex flex-col justify-center items-center text-white text-center px-4 py-16 max-w-6xl mx-auto">
                    <h1 class="font-bold text-white text-4xl underline underline-offset-4 ">Visi</h1>
                    <h2 class="text-white mt-10 font-semibold text-2xl">"Mewujudkan masyarakat yang mandiri, sejahtera, berakhlakul karimah, dan berlandaskan adat basandi syarak, syarak basandi kitabullah, serta didukung oleh tata kelola pemerintahan yang baik"</h2>
            </div>
        </section>



        <section class="bg-white pt-5 pb-5 ">
            <div class="max-w-6xl mx-auto text-center ">
                <h1 class="font-bold text-greenDark text-4xl underline underline-offset-4 mt-10">Misi</h1>
                <div class="grid grid-cols-6 gap-3 mt-10 mb-10">

                        <div class="max-w-sm p-6 bg-white border border-greenVill rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                            <div class="flex justify-center">
                               <i data-lucide="map-pin" class="w-8 h-8 text-greenDark text-center m-2"></i>
                            </div>
                            <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 dark:text-white text-wrap">Meningkatkan Kualitas Sumber Daya Manusia (SDM)</h5>
                        </div>
                        <div class="max-w-sm p-6 bg-white border border-greenVill rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                            <div class="flex justify-center">
                               <i data-lucide="map-pin" class="w-8 h-8 text-greenDark text-center m-2"></i>
                            </div>
                            <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 dark:text-white text-wrap">Meningkatkan Kualitas Sumber Daya Manusia (SDM)</h5>
                        </div>
                        <div class="max-w-sm p-6 bg-white border border-greenVill rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                            <div class="flex justify-center">
                               <i data-lucide="map-pin" class="w-8 h-8 text-greenDark text-center m-2"></i>
                            </div>
                            <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 dark:text-white text-wrap">Meningkatkan Kualitas Sumber Daya Manusia (SDM)</h5>
                        </div>
                        <div class="max-w-sm p-6 bg-white border border-greenVill rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                            <div class="flex justify-center">
                               <i data-lucide="map-pin" class="w-8 h-8 text-greenDark text-center m-2"></i>
                            </div>
                            <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 dark:text-white text-wrap">Meningkatkan Kualitas Sumber Daya Manusia (SDM)</h5>
                        </div>
                        <div class="max-w-sm p-6 bg-white border border-greenVill rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                            <div class="flex justify-center">
                               <i data-lucide="map-pin" class="w-8 h-8 text-greenDark text-center m-2"></i>
                            </div>
                            <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 dark:text-white text-wrap">Meningkatkan Kualitas Sumber Daya Manusia (SDM)</h5>
                        </div>
                        <div class="max-w-sm p-6 bg-white border border-greenVill rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                            <div class="flex justify-center">
                               <i data-lucide="map-pin" class="w-8 h-8 text-greenDark text-center m-2"></i>
                            </div>
                            <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 dark:text-white text-wrap">Meningkatkan Kualitas Sumber Daya Manusia (SDM)</h5>
                        </div>
                </div>
            </div>
        </section>


        <section class="bg-white pt-5 pb-5 ">
              <div class="max-w-6xl mx-auto text-center  justify-content-center">
                <h1 class="font-bold text-greenDark text-4xl underline underline-offset-4 mt-10">Struktur Perangkat Nagari</h1>
                <img src="/dummyStruktur.png" alt="" class="mt-10 flex justify-center">

              </div>
        </section>


        <section class="bg-white">
            <div class="max-w-6xl">
                <div class="">
                    test
                </div>

            </div>

        </section>

    </div>

@include('layout.navbar')


     <script>
     lucide.createIcons();
    </script>

</body>

</html>
