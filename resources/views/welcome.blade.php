<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
</head>

<body class="m-0 p-0">

    <div class="relative min-h-screen bg-cover bg-center bg-fixed" style="background-image: url('/sawah.jpg');">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-transparent w-full h-full z-0"></div>

        <div class="relative z-10 min-h-screen flex items-center justify-start px-16">
            <div class="text-white max-w-4xl">
            <h1 class="text-6xl md:text-8xl font-bold mb-4 typewriter">Selamat Datang</h1>
            <h2 class="text-4xl md:text-6xl">di <span class="text-greenVill font-semibold">Nagari Guguak</span> </h2>
            <p class="text-lg md:text-2xl mt-5 text-gray-200 ">
                Jelajahi keindahan alam, budaya, dan semangat masyarakat kami dalam membangun nagari yang cerdas dan terhubung.
            </p>


            <div class="flex flex-wrap gap-4 mt-10">
                <a href="/profile">
                <button class="py-3 px-5 bg-greenVill text-black font-bold border border-gray-500 hover:border-greenDark hover:text-white hover:bg-greenDark">
                    Lihat Tentang
                </button>
                </a>

                <button class="py-3 px-5 border border-greenVill font-bold text-greenVill hover:border-greenDark hover:text-white  ">
                Lihat Tentang
                </button>
            </div>
            </div>
        </div>
    </div>


    <section id="profil" class="bg-white text-black px-8 py-12 max-w-7xl mx-auto">
        <div class="grid grid-cols-2 gap-10  mx-auto mt-10">
            <div class="text-greenDark text-4xl font-bold font-montserrat fade-in-left animate-on-scroll">
                Bersama <span class='bg-greenVill p-1'>Nagari Guguak</span>, kita wujudkan masyarakat mandiri, berbudaya, dan berdaya saing.
            </div>
            <div class="grid text-justify fade-in-right animate-on-scroll">
                <p>
                    <span class="text-greenDark font-bold">Nagari Guguak</span> adalah salah satu nagari yang berada di wilayah Kabupaten Sijunjung, Sumatera Barat, yang memiliki nilai historis dan budaya yang kuat. Berasal dari pemekaran Nagari Padang Laweh, Nagari Guguak berkembang melalui musyawarah para ninik mamak dan masyarakat adat yang menetapkan kawasan pemukiman di dataran tinggi bernama “Guguak.” Kini, Nagari Guguak berdiri sebagai wilayah administratif yang mandiri, kaya akan tradisi, potensi sumber daya alam, serta semangat gotong royong yang masih terjaga dalam kehidupan masyarakatnya.
                </p>
                <a href="/profile" class="text-greenDark font-semibold mt-5">Tentang Kami →</a>
            </div>


        </div>
        <div class="text-center flex justify-center mt-10">
            <img src="/sawahGuguk.jpg" alt="" class="w-full rounded-3xl">
        </div>

    </section>


   <section class="relative text-gray-900 py-20 px-8 max-w-full mx-auto bg-cream overflow-hidden">
  <div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

      <div class="text-8xl text-greenDark text-center font-bold">
        <span class="count-up" data-target="23.90">0</span>
        <div class="text-2xl">Luas Wilayah</div>
      </div>

      <div class="text-8xl text-greenDark text-center font-bold">
        <span class="count-up" data-target="3">0</span>
        <div class="text-2xl">Jorong</div>
      </div>

      <div class="text-8xl text-greenDark text-center font-bold">
        <span class="count-up" data-target="603">0</span>
        <div class="text-2xl">Kepala Keluarga</div>
      </div>

      <div class="text-8xl text-greenDark text-center font-bold">
        <span class="count-up" data-target="2337">0</span>
        <div class="text-2xl">Penduduk</div>
      </div>

    </div>
  </div>
</section>



    <section class=" text-gray-900 py-20 px-8 bg-white max-w-7xl mx-auto">
        <div class="text-center mb-4">
            <h2 class="text-3xl font-bold fade-in-left animate-on-scroll">Berita Pengumuman</h2>
            <div class="h-[3px] w-[20%] bg-greenDark mt-2 mx-auto fade-in-left animate-on-scroll"></div>
        </div>
        <div class="grid grid-cols-3 flex justify-content-center mt-10 gap-2">


            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                <a href="#">
                    <img class="rounded-t-lg" src="/sawah.jpg" alt="" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-greenVill">
                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>

             <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                <a href="#">
                    <img class="rounded-t-lg" src="/sawah.jpg" alt="" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-greenVill">

                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
             <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                <a href="#">
                    <img class="rounded-t-lg" src="/sawah.jpg" alt="" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-greenVill">

                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>


        </div>
    </section>


    <section class="max-w-7xl mx-auto py-20 px-8 bg-white">
        <div class="text-center mb-4">
            <h2 class="text-3xl font-bold fade-in-left animate-on-scroll">Galeri</h2>
            <div class="h-[3px] w-[10%] bg-greenDark mt-2 mx-auto fade-in-left animate-on-scroll"></div>
        </div>
        <div class="grid grid-cols-3 gap-4 space-y-2 flex justify-center mt-10">
            <img src="/desa.jpg" alt="" class="max-w-[200px] w-full rounded-lg shadow-md mb-4 ml-14 " />
            <img src="/desa.jpg" alt="" class="max-w-[200px] w-full rounded-lg shadow-md mb-4 ml-14" />
            <img src="/desa.jpg" alt="" class="max-w-[200px] w-full rounded-lg shadow-md mb-4 ml-14" />
            <img src="/desa.jpg" alt="" class="max-w-[200px] w-full rounded-lg shadow-md mb-4 ml-14" />
            <img src="/desa.jpg" alt="" class="max-w-[200px] w-full rounded-lg shadow-md mb-4 ml-14" />
            <img src="/desa.jpg" alt="" class="max-w-[200px] w-full rounded-lg shadow-md mb-4 ml-14" />
        </div>

    </section>



     <section class=" text-gray-900 py-20 px-8 bg-white max-w-7xl mx-auto">
        <div class="text-center mb-4">
            <h2 class="text-3xl font-bold fade-in-left animate-on-scroll">Artikel Terkait</h2>
            <div class="h-[3px] w-[10%] bg-greenDark mt-2 mx-auto fade-in-left animate-on-scroll"></div>
        </div>
        <div class="grid grid-cols-3 gap-2 mt-10">

            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-greenVill">

                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>

             <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-greenVill">

                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>

             <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-greenVill">

                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>

        </div>
    </section>

    <section class="relative bg-cover bg-center bg-fixed min-h-[20vh]" style="background-image: url('/sawah.jpg');">
    <div class="absolute inset-0 bg-black/50 z-0 backdrop-blur-sm "></div>

    <div class="relative z-10 flex flex-col justify-center items-center text-white text-center px-4 py-16">
            <h2 class="text-4xl font-bold mb-4">Menuju Nagari <span class="text-greenVill">Cerdas & Terhubung</span> </h2>
            <p class="text-xl">Jelajahi keindahan alam, budaya, dan semangat masyarakat kami dalam membangun nagari yang cerdas dan terhubung.</p>
    </div>
</section>

<section class=" py-20 px-8 bg-white max-w-7xl mx-auto">
    <div class="text-center mb-4">
            <h2 class="text-3xl font-bold">Lokasi</h2>
            <div class="h-[3px] w-[5%] bg-greenDark mt-2 mx-auto"></div>
            <div class="mt-10">
            <div class="w-full max-w-4xl mx-auto rounded-xl overflow-hidden shadow-lg border-2 border-greenDark">
               <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7383653182793!2d101.0737576!3d-0.6685665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fdc88789c7e07b1%3A0x5fb5a6c9e6972ef2!2sNagari%20Guguak!5e0!3m2!1sen!2sid!4v1721101112345!5m2!1sen!2sid&t=k"
                    width="100%"
                    height="450"
                    style="border:0;"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>


            </div>
        </div>
    </div>
</section>

@include('layout.footer')
@include('layout.navbar')





<script>
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
      } else {
        entry.target.classList.remove('show');
      }
    });
  }, { threshold: 0.2 });

  document.querySelectorAll('.animate-on-scroll').forEach(el => {
    observer.observe(el);
  });

    document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".count-up");

    counters.forEach(counter => {
      counter.dataset.originalTarget = counter.dataset.target;
    });

    const animateCount = (el) => {
      const target = +el.dataset.originalTarget;
      let current = 0;
      const duration = 500;
      const stepTime = Math.max(Math.floor(duration / target), 30);

      const step = () => {
        current += 1;
        el.textContent = current;
        if (current < target) {
          setTimeout(step, stepTime);
        } else {
          el.textContent = target;
        }
      };

      step();
    };

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          const el = entry.target;

          if (entry.isIntersecting) {
            if (!el.classList.contains('counting')) {
              el.classList.add('counting');
              animateCount(el);
            }
          } else {
            el.textContent = '0';
            el.classList.remove('counting');
          }
        });
      },
      {
        threshold: 0.5,
      }
    );

    counters.forEach((counter) => {
      observer.observe(counter);
    });
  });
</script>




</body>
</html>
