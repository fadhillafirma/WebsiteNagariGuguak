<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Swiper CSS -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
/>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

</head>

<body class='m-0 p-0'>

     <section class="bg-white">
              <div class="max-w-6xl mx-auto text-center  justify-content-center p-5">
                <h1 class="font-bold text-greenDark text-4xl underline underline-offset-4 mt-20 title-animate">Sejarah</h1>
                <img src="/profilguguak.jpg" alt="" class="mt-10 mb-5 flex justify-center ml-2 mr-3 rounded-xl border-2 border-gray-200">
                    <p class="text-justify mt-10 lg:text-lg md:text-md sm:text-md">
                    Nagari adalah satu kesatuan masyarakat Hukum Adat yang merupakan himpunan dari beberapa buah suku dan koto yang mempunyai wilayah sendiri dan harta kekayaan Nagari,
                    yang telah diwarisi sejak dahulu kala secara turun temurun semenjak nagari itu berdiri (diparibu), yang bersifat otonom dan independen dibidang adat, sako jo pusako serta tetap diakui dan berdaya guna hingga kini dan masa yang akan datang.
                </p>
                <div class="text-center italic font-bold mt-10 mb-10 text-2xl title-animate">
                    <p >
                        "Ba dusun mako ba taratak
                    </p>
                    <p>
                        Ba koto Mako ba nagari
                    </p>
                    <p>
                        Tasusun makonyo rancak
                    </p>
                    <p>
                        <span class="bg-greenVill text-greenDark">Sakato</span>  mako  <span class="bg-greenVill text-greenDark">manjadi</span>"
                    </p>
                </div>

                <p class="text-justify mt-5 lg:text-lg md:text-md sm:text-md">
                    Nagari Guguak dahulunya satu pucuk pimpinan dengan Nagari Padang Laweh yang disebut dengan angku palo yang sama Wali Nagari saat ini, dengan perkembangan penduduk yang sangat maka sebagian penduduk berjalan mudik batang kuantan yaitu paduan batang sinamar dan batang ombilin dan terus menyebrangi batang ombilin dan membuat pemukiman di taratak polak loweh, dan disitulah disusun jabatan Ninik Mamak seperti Datuak Nan Duo Selo yaitu Dt.Rajo Mudo sebagai Pucuak Adat dan Dt.Sombo Tuah sebagai pucuk syarak kemudian urang tuo ulayat Inyiak Dt.Paduko tuan dan Datuak Nan Barampek yaitu Dt.Perpatih Nan Sabatang penghulu suku caniago, Dt.Pangulu Sati penghulu Suku tobo, Dt.Malakewi Payung Suku Rang Tigo Suku, Dt.Mantiko Salo Penghulu Suku Petopang, Dt.Bandaro penghulu suku Kampai Tolang dan Dt.Panghulu Kayo Penghulu Suku Kampai Tangah, Dt.Paduko Sarindo penghulu suku melayu dan Dt.
                    Gindo Sutan Penghulu Suku Piliang, Dt.Majo Indo Penghulu Suku Melayu.
                </p>
                <p class="text-justify mt-5 lg:text-lg md:text-md sm:text-md">
                    Setelah disusun jabatan Ninik Mamak dan diadakan musyawarah mufakat untuk mendirikan Nagari yang bertempat di pamuntar dengan arti disitulah dipuntar paretongan,
                    sampai saat ini lokasi tersebut bernama pamuntar dan setelah itu dilihatlah dimana tempat yang baik untuk membuat koto, setelah dapat dan tempatnya bertepatan di ketinggian maka diberi nama Guguak.
                </p>

              </div>
        </section>




    <div class="bg-white w-full h-[100vh] content-center pt-10" id="profile">
        <div class="max-w-6xl mx-auto flex ">
            <div class="grid md:grid-cols-2">
                <div class="text-start p-5">
                    <h3 class="text-justify mt-5 lg:text-lg md:text-md sm:text-md ">Seiring dengan perkembangan penduduk semakin pesat maka bedirilah Nagari yang diberi nama Nagari Guguak yang dipimpin oleh seorang Wali Nagari dan berdasarkan undang-undang Nomor 5 Tahun 1979 Tentang Pemerintahan Desa, maka terdapatlah 2 Desa Yaitu Desa Koto Guguak dan Desa Bulu Rotan yaitu selama 22 Tahun. Dan berdasarkan undang-undang Nomor 22 Tahun 1999 yang telah memberi peluang kepada pemerintah Daerah untuk membentuk Sistem Pemerintahan Terendah di Negara Republik Indonesia dan ditetapkan peraturan Daerah Provinsi Sumatera Barat Nomor 2 Tahun 2000 Tentang Ketentuan Pokok Pemerintahan Nagari, dan Peraturan Daerah Kabupaten Sawahlunto/Sijunjung Nomor 22 Tahun 2001 Tentang Pemerintahan Nagari dan Sejak Tahun 2002 maka kembali kesistem Pemerintahan Nagari.</h3>
                </div>
                <div class="flex justify-center p-3">
                    <img src="/sungai.jpg" alt="" class="rounded-xl border-2 border-gray-200">
                </div>
            </div>
        </div>

        <section class="relative bg-cover bg-center bg-fixed min-h-[20vh] mt-20" style="background-image: url('/sawah.jpg');">
            <div class="absolute inset-0 bg-black/50 z-0 backdrop-blur-sm "></div>
            <div class="relative z-10 flex flex-col justify-center items-center text-white text-center px-4 py-16 max-w-6xl mx-auto">
                    <h1 class="font-bold text-white text-4xl underline underline-offset-4 title-animate ">Visi</h1>
                    <h2 class="text-white mt-10 font-semibold text-2xl">"Terwujudnya Pemerintahan Pembangunan yang Profesional Berbasis Pada Nilai-nilai Agama Sosial dan Adat Istiadat"</h2>
            </div>
        </section>



        <section class="bg-white pt-5 pb-5 ">
            <div class="max-w-6xl mx-auto text-center ">
                <h1 class="font-bold text-greenDark text-4xl underline underline-offset-4 mt-10 title-animate ">Misi</h1>
                <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-2    justify-center  gap-8 mt-10 mb-10 ml-10 mr-10">

                        <div class="relative rounded-[22px] max-w-sm p-[2px] bg-gradient-to-r from-green-500 via-emerald-500 to-green-700 hover:from-green-600 hover:to-green-800 transition">
                        <div class="bg-white dark:bg-gray-800 rounded-[20px] p-6 h-full">
                            <div class="flex justify-center">
                            <i data-lucide="house" class="w-8 h-8 text-greenDark text-center m-2"></i>
                            </div>
                            <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 dark:text-white text-wrap hover:text-greenDark">
                            Melaksanakan Pembangunan Disegala Bidang Sesuai Kaidah Pembangunan Nagari dengan Nilai Partisipasi Masyarakat
                            </h5>
                        </div>
                        </div>

                        <div class="relative rounded-[22px] max-w-sm p-[2px] bg-gradient-to-r from-green-500 via-emerald-500 to-green-700 hover:from-green-600 hover:to-green-800 transition">
                        <div class="bg-white dark:bg-gray-800 rounded-[20px] p-6 h-full">
                            <div class="flex justify-center">
                            <i data-lucide="file-check" class="w-8 h-8 text-greenDark text-center m-2"></i>
                            </div>
                            <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 dark:text-white text-wrap">
                            Menjalankan Administrasi Pemerintahan Nagari berdasarkan Prinsip-prinsip Tata Kelola Pemerintahan Nagari yang Baik
                            </h5>
                        </div>
                        </div>
                        <div class="relative rounded-[22px] max-w-sm p-[2px] bg-gradient-to-r from-green-500 via-emerald-500 to-green-700 hover:from-green-600 hover:to-green-800 transition">
                        <div class="bg-white dark:bg-gray-800 rounded-[20px] p-6 h-full">
                            <div class="flex justify-center">
                            <i data-lucide="handshake" class="w-8 h-8 text-greenDark text-center m-2"></i>
                            </div>
                            <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 dark:text-white text-wrap">
                            Mendorong dan Memelihara Komitmen Semua Pihak dalam Rangka Pembangunan Masyarakat Nagari Seutuhnya
                            </h5>
                        </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="relative rounded-[22px] max-w-sm p-[2px] bg-gradient-to-r from-green-500 via-emerald-500 to-green-700 hover:from-green-600 hover:to-green-800 transition">
                        <div class="bg-white dark:bg-gray-800 rounded-[20px] p-6 h-full">
                            <div class="flex justify-center">
                            <i data-lucide="hand-platter" class="w-8 h-8 text-greenDark text-center m-2"></i>
                            </div>
                            <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 dark:text-white text-wrap">
                            Menciptakan Iklim yang Kondusif Pelayanan yang Baik dan Menjamin Kepastian Hukum dalam Menjaga dan Meningkatkan Potensi Nagari
                            </h5>
                        </div>
                        </div>
                </div>
            </div>
        </section>







        <section class="bg-white pt-5 pb-5 mb-5">
              <div class="max-w-6xl mx-auto text-center  justify-content-center">
                <h1 class="font-bold text-greenDark text-4xl underline underline-offset-4 mt-10 title-animate">Struktur Perangkat Nagari</h1>
                <img src="/strukturOrganisasi.jpg" alt="" class="mt-10 mb-5 flex justify-center ml-2 mr-3">

              </div>
        </section>




        {{-- <section id="jorong" class="bg-white pt-5 pb-5">
            <div class="max-w-6xl mx-auto text-center">
                <p class="font-bold text-greenDark text-4xl underline underline-offset-4">Jorong</p>
            </div>
            <div class="gri grid-cols-3 ">
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                        <a href="#">
                            <img class="rounded-t-lg w-full h-48 object-cover"
                                src="/sawahGuguk.jpg" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    Jorong Koto
                                </h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                dipimpin
                            </p>

                           <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-greenVill">

                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
            </div>

        </section> --}}

          <section class="bg-white pt-5 pb-5 bottom-0 left-0 w-full shadow-md ">
                    <div class="max-w-6xl mx-auto text-center  justify-content-center">
                        <p>2025 Nagari Guguak.</p>
                            <p>Powered by KKN Guguak Unand 2025.</p>
                    </div>
        </section>



    </div>

@include('layout.navbar')


     <script>
     lucide.createIcons();

      const swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    centeredSlides: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    breakpoints: {
      640: {
        slidesPerView: 1.2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
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





    </script>

</body>

</html>
