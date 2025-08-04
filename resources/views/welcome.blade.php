<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- FullCalendar CSS -->


</head>

<body class="m-0 p-0">

    <div class="relative min-h-screen bg-cover bg-center bg-fixed" style="background-image: url('/sawah.jpg');">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-transparent w-full h-full z-0"></div>

        <div class="relative z-10 min-h-screen flex items-end justify-start px-16 pb-20">
            <div class="text-white max-w-3xl">
                <button class="py-3 px-5 bg-white/10 backdrop-blur-xsm mb-2 text-white border border-gray-500  rounded-full">
                    Kabupaten Sijunjung, Koto VII
                </button>
            <h1 class="text-6xl md:text-8xl font-bold mb-4 typewriter">Selamat Datang</h1>
            <h2 class="text-4xl md:text-6xl">di <span class="text-greenVill font-semibold">Nagari Guguak</span> </h2>
            <p class="text-lg md:text-xl mt-5 text-gray-200 text-wrap ">
                Jelajahi keindahan alam, budaya, dan semangat masyarakat kami dalam membangun nagari yang cerdas dan terhubung.
            </p>


            <div class="flex flex-wrap gap-4 mt-10">

                <a href="/profile" class="inline-flex items-center px-2 py-2 text-md font-medium text-center text-greenDark bg-greenVill rounded-full hover:bg-greenDark hover:text-white hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600  dark:focus:ring-greenVill">

                                Lihat Tentang
                                <div class="rounded-full border-2 bg-greenDark text-white ml-1 border-greenVill">
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 m-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                                </div>

                            </a>


                {{-- <button class="py-3 px-5 border border-greenVill font-bold text-greenVill hover:border-greenDark hover:text-white  ">
                Lihat Tentang
                </button> --}}
            </div>
            </div>
        </div>
    </div>


    <section id="profil" class="bg-white text-black px-8 py-12 max-w-7xl mx-auto">
    <!-- Grid teks -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mt-10">
        <div class="text-greenDark text-4xl font-bold font-montserrat fade-in-left animate-on-scroll">
            Bersama <span class="bg-greenVill p-1">Nagari Guguak</span>, kita wujudkan masyarakat mandiri, berbudaya, dan berdaya saing.
        </div>
        <div class="text-justify fade-in-right animate-on-scroll">
            <p>
                <span class="text-greenDark font-bold">Nagari Guguak</span> adalah salah satu nagari yang berada di wilayah Kabupaten Sijunjung, Sumatera Barat, yang memiliki nilai historis dan budaya yang kuat. Berasal dari pemekaran Nagari Padang Laweh, Nagari Guguak berkembang melalui musyawarah para ninik mamak dan masyarakat adat yang menetapkan kawasan pemukiman di dataran tinggi bernama “Guguak.” Kini, Nagari Guguak berdiri sebagai wilayah administratif yang mandiri, kaya akan tradisi, potensi sumber daya alam, serta semangat gotong royong yang masih terjaga dalam kehidupan masyarakatnya.
            </p>
            <a href="/profile" class="text-greenDark font-semibold mt-5 inline-block hover:text-green-700">Tentang Kami →</a>
        </div>
    </div>

    <!-- Carousel -->
    <div class="relative w-full mt-10 overflow-hidden rounded-3xl h-[900px]">
        <div id="carousel" class="flex w-full h-full transition-transform duration-1000 ease-in-out">
            <img src="/sawahGuguk.jpg" alt="Sawah Guguk" class="w-full h-full object-cover flex-shrink-0">
            <img src="/kerbau.jpg" alt="Kerbau" class="w-full h-full object-cover flex-shrink-0">
            <img src="/sawahPadanglalang.jpg" alt="Sawah Koto" class="w-full h-full object-cover flex-shrink-0">
        </div>
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
        <span class="count-up" data-target="120">0</span>
        <div class="text-2xl">Kepala Keluarga</div>
      </div>

      <div class="text-8xl text-greenDark text-center font-bold">
        <span class="count-up" data-target="1.5">0</span>
        <div class="text-2xl">Penduduk</div>
      </div>

    </div>
  </div>
</section>



        <section class="text-gray-900 py-20 px-8 bg-white max-w-7xl mx-auto">
        <div class="text-center mb-4">
            <h2 class="text-3xl font-bold fade-in-left animate-on-scroll">Berita Pengumuman</h2>
            <div class="h-[3px] w-[20%] bg-greenDark mt-2 mx-auto fade-in-left animate-on-scroll"></div>
        </div>

        @if ($beritas->isEmpty())
            <div class="text-center mt-10 text-gray-600 text-lg">
                Belum ada berita yang tersedia.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-10">
                @foreach ($beritas as $berita)
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                        <a href="#">
                            <img class="rounded-t-lg w-full h-48 object-cover"
                                src="{{ asset('storage/' . $berita->foto) }}"
                                alt="{{ $berita->judul }}"
                                onerror="this.onerror=null;this.src='{{ asset('images/default.jpg') }}';" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $berita->judul }}
                                </h5>
                            </a>
                            <p class="text-sm text-gray-500 mb-2">
                                {{ $berita->created_at->format('d M Y') }}, {{ $berita->created_at->format('H:i') }} WIB
                            </p>
                            <h5 class="mb-2 mt-5 text-sm font-semibold tracking-tight text-gray-600 dark:text-white">
                            Oleh :   {{ $berita->penulis }}
                            </h5>

                            <div class="flex justify-start">
                                 <a href="{{ route('landing.showBerita', $berita->id_artikel) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-greenVill">

                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>




    <section class="max-w-7xl mx-auto py-20 px-8 bg-white">
    <div class="text-center mb-4">
        <h2 class="text-3xl font-bold fade-in-left animate-on-scroll">Galeri</h2>
        <div class="h-[3px] w-[10%] bg-greenDark mt-2 mx-auto fade-in-left animate-on-scroll"></div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-10">
        @foreach ($galeris as $item)
            {{-- Pastikan $item->gambar tidak kosong dan benar-benar ada --}}
            @if ($item->gambar)
                <div class="flex justify-center"> {{-- Tambahkan div untuk centering --}}
                    <img
                        src="{{ asset('storage/' . $item->gambar) }}"
                        alt="{{ $item->judul ?? 'Gambar Galeri' }}"
                        class="max-w-full h-auto w-full max-h-[300px] object-cover rounded-lg shadow-md"
                        onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}';" {{-- Tambahkan fallback gambar --}}
                    />
                </div>
            @endif
        @endforeach
    </div>
</section>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
<section class="max-w-7xl mx-auto py-20 px-8 bg-white">
    <div class="text-center mb-4">
        <h2 class="text-3xl font-bold fade-in-left animate-on-scroll">Kalender Agenda</h2>
        <div class="h-[3px] w-[10%] bg-greenDark mt-2 mx-auto fade-in-left animate-on-scroll"></div>
    </div>
    <div id="calendar" class="bg-white rounded-lg shadow p-4"></div>
</section>




     <section class="text-gray-900 py-20 px-8 bg-white max-w-7xl mx-auto">
    <div class="text-center mb-4">
        <h2 class="text-3xl font-bold fade-in-left animate-on-scroll">Artikel</h2>
        <div class="h-[3px] w-[10%] bg-greenDark mt-2 mx-auto fade-in-left animate-on-scroll"></div>
    </div>

    @if ($artikels->isEmpty())
        <div class="text-center mt-10 text-gray-600 text-lg">
            Belum ada artikel yang tersedia.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-10">
            @foreach ($artikels as $artikel)
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transition delay-150 duration-500 ease-in-out hover:-translate-y-1 hover:scale-110">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $artikel->judul }}
                        </h5>
                    </a>
                    <p class="text-sm text-gray-500 mb-2">{{ $artikel->created_at->format('d M Y, H:i') }}</p>

                    <h5 class="mb-2 mt-5 text-sm font-semibold tracking-tight text-gray-600 dark:text-white">
                         Oleh :   {{ $artikel->penulis }}
                        </h5>

                   <a href="{{ route('landing.showArtikel', $artikel->id_artikel) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white border-2 bg-greenDark rounded-lg hover:bg-white hover:text-greenDark hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-greenVill">

                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                </div>
            @endforeach
        </div>
    @endif
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
                <h2 class="text-3xl font-bold fade-in-left animate-on-scroll">Lokasi</h2>
                <div class="h-[3px] w-[5%] bg-greenDark mt-2 mx-auto fade-in-left animate-on-scroll"></div>
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



<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>

<script>

   const carousel = document.getElementById('carousel');
    const totalSlides = carousel.children.length;
    let index = 0;

    setInterval(() => {
        index = (index + 1) % totalSlides;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    }, 3000);


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

    document.addEventListener('DOMContentLoaded', function() {
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'dayGridMonth',
                events: @json($events),
            });
            calendar.render();
        });




</script>




</body>
</html>
