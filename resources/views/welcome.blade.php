<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nagari Guguak</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
     <link rel="icon" type="image/png" href="/logo.png" />

    <!-- FullCalendar CSS -->


</head>

<body class="m-0 p-0 w-full bg-white font-sans">

    @include('layout.navbar')

    <div class="relative h-screen bg-cover bg-center w-full flex items-end" style="background-image: url('/sawah.jpg');">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent w-full h-full z-0"></div>
        <div class="relative z-10 w-full px-4 sm:px-8 md:px-16 pb-16">
            <div class="text-white max-w-3xl">
                <button class="py-3 px-5 bg-white/10 backdrop-blur-sm mb-2 text-white border border-gray-500 rounded-full shadow-[0_0_15px_rgba(255,255,255,0.6)] hover:shadow-[0_0_25px_rgba(255,255,255,0.9)] transition-all duration-300">
                    Kabupaten Sijunjung, Koto VII
                </button>

                <h1 class="text-4xl sm:text-6xl font-bold mb-2">Selamat Datang</h1>
                <h2 class="text-3xl sm:text-5xl">di <span class="text-greenVill font-semibold">Nagari Guguak</span></h2>
                <p class="text-base sm:text-lg mt-4 text-gray-200">
                    Jelajahi keindahan alam, budaya, dan semangat masyarakat kami dalam membangun nagari yang cerdas dan terhubung.
                </p>

                <div class="mt-8">
                    <a href="/profil" class="inline-flex items-center px-2 py-2 text-md font-medium text-center text-greenDark bg-greenVill rounded-full hover:bg-greenDark hover:text-white hover:border-greenDark focus:ring-4 focus:outline-none focus:ring-greenVill dark:bg-blue-600  dark:focus:ring-greenVill">

                                Lihat Tentang
                                <div class="rounded-full border-2 bg-greenDark text-white ml-1 border-greenVill">
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 m-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                                </div>

                            </a>

                </div>
            </div>
        </div>
    </div>

    <section id="profil" class="px-4 sm:px-8 py-12">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                <div class="text-greenDark lg:text-4xl sm:text-3xl font-bold fade-in-left animate-on-scroll">
                    Bersama <span class="bg-greenVill text-greenDark p-1">Nagari Guguak</span>, kita wujudkan masyarakat mandiri, berbudaya, dan berdaya saing.
                </div>
                <div class="text-justify">
                    <p class="text-gray-700 fade-in-right animate-on-scroll">
                        <span class="text-greenDark font-bold">Nagari Guguak</span> adalah salah satu nagari yang berada di wilayah Kabupaten Sijunjung, Sumatera Barat, yang memiliki nilai historis dan budaya yang kuat. Berasal dari pemekaran Nagari Padang Laweh, Nagari Guguak berkembang melalui musyawarah para ninik mamak dan masyarakat adat yang menetapkan kawasan pemukiman di dataran tinggi bernama “Guguak.” Kini, Nagari Guguak berdiri sebagai wilayah administratif yang mandiri, kaya akan tradisi, potensi sumber daya alam, serta semangat gotong royong yang masih terjaga dalam kehidupan masyarakatnya.
                    </p>
                    <a href="/profil" class="text-greenDark font-semibold mt-4 inline-block hover:text-green-700">Tentang Kami →</a>
                </div>
            </div>

            <div class="relative w-full mt-10 overflow-hidden rounded-xl h-[800px] sm:h-[400px]">
                <div id="carousel" class="flex w-full h-full transition-transform duration-1000 ease-in-out">
                    <img src="/sawahGuguk.jpg" alt="Sawah Guguk" class="w-full h-full object-cover flex-shrink-0">
                    <img src="/kerbau.jpg" alt="Kerbau" class="w-full h-full object-cover flex-shrink-0">
                    <img src="/sawahPadanglalang.jpg" alt="Sawah Koto" class="w-full h-full object-cover flex-shrink-0">
                </div>
            </div>
        </div>
    </section>



    <section class="relative py-12 px-4 sm:px-8 bg-cream overflow-hidden before:absolute before:inset-0 before:bg-[radial-gradient(circle,_#d1d5db_1px,_transparent_2px)] before:bg-[size:30px_30px] before:opacity-50 before:z-0">
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="p-4">
                    <div class="text-4xl sm:text-5xl md:text-6xl text-greenDark font-bold">
                        <span class="count-up" data-target="23.90">0</span>H
                    </div>
                    <div class="text-base sm:text-lg mt-2">Luas Wilayah</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl sm:text-5xl md:text-6xl text-greenDark font-bold">
                        <span class="count-up" data-target="3">0</span>
                    </div>
                    <div class="text-base sm:text-lg mt-2">Jorong</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl sm:text-5xl md:text-6xl text-greenDark font-bold">
                        <span class="count-up" data-target="100">0</span>+
                    </div>
                    <div class="text-base sm:text-lg mt-2">Kepala Keluarga</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl sm:text-5xl md:text-6xl text-greenDark font-bold">
                        <span class="count-up" data-target="2.3">0</span>Rb
                    </div>
                    <div class="text-base sm:text-lg mt-2">Penduduk</div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-12 px-4 sm:px-8 ">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8">
                 <h2 class="text-3xl font-bold fade-in-left animate-on-scroll">Berita Pengumuman</h2>
                <div class="h-[3px] w-[20%] bg-greenDark mt-2 mx-auto "></div>
            </div>
            @if ($beritas->isEmpty())
                <div class="text-center mt-8 text-gray-600 text-lg">
                    Belum ada berita yang tersedia.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                    @foreach ($beritas as $berita)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-transform duration-300 hover:-translate-y-1">
                            <a href="#">
                                <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}" onerror="this.onerror=null;this.src='{{ asset('images/default.jpg') }}';" />
                            </a>
                            <div class="p-5">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ $berita->judul }}</h5>
                                <p class="text-sm text-gray-500 mb-2">{{ $berita->created_at->format('d M Y') }}, {{ $berita->created_at->format('H:i') }} WIB</p>
                                <p class="mb-4 text-sm font-semibold text-gray-600">Oleh: {{ $berita->penulis }}</p>
                                <a href="{{ route('landing.showBerita', $berita->id_artikel) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-800 rounded-lg hover:bg-white hover:text-green-800 hover:border-2 hover:border-green-800 transition-colors duration-300">
                                    Read more
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>



    <section id="galeri" class="px-4 sm:px-8 py-12">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold fade-in-left animate-on-scroll">Galeri</h2>
                <div class="h-1 w-16 bg-green-800 mt-2 mx-auto"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 mt-8">
                @foreach ($galeris as $item)
                    @if ($item->foto)
                        <div class="relative group w-full h-[200px] sm:h-[250px] overflow-hidden rounded-lg shadow-md">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->deskripsi ?? 'Foto Galeri' }}" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}';" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 w-full p-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <p class="text-sm sm:text-base font-semibold">{{ $item->deskripsi ?? 'Deskripsi Gambar' }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>



    <section class="py-12 px-4 sm:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold fade-in-left animate-on-scroll">Kalender Agenda</h2>
                <div class="h-1 w-16 bg-green-800 mt-2 mx-auto"></div>
            </div>
            <div id="calendar" class="bg-gray-50 rounded-lg shadow p-2 sm:p-4 mt-8"></div>
        </div>
    </section>



    <section class="py-12 px-4 sm:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold fade-in-left animate-on-scroll">Artikel</h2>
                <div class="h-1 w-16 bg-green-800 mt-2 mx-auto"></div>
            </div>
            @if ($artikels->isEmpty())
                <div class="text-center mt-8 text-gray-600 text-lg">
                    Belum ada artikel yang tersedia.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                    @foreach ($artikels as $artikel)
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-transform duration-300 hover:-translate-y-1">
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ $artikel->judul }}</h5>
                            <p class="text-sm text-gray-500 mb-2">{{ $artikel->created_at->format('d M Y, H:i') }}</p>
                            <p class="mb-4 text-sm font-semibold text-gray-600">Oleh: {{ $artikel->penulis }}</p>
                            <a href="{{ route('landing.showArtikel', $artikel->id_artikel) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-800 rounded-lg hover:bg-white hover:text-green-800 hover:border-2 hover:border-green-800 transition-colors duration-300">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>



    <section class="relative bg-cover bg-center min-h-[30vh] flex items-center" style="background-image: url('/sawah.jpg');">
        <div class="absolute inset-0 bg-black/50 z-0 backdrop-blur-sm"></div>
        <div class="relative z-10 w-full text-white text-center px-4 py-16">
            <h2 class="text-2xl sm:text-4xl font-bold mb-4 fade-in-left animate-on-scroll">Menuju Nagari <span class="text-greenVill">Cerdas & Terhubung</span></h2>
            <p class="text-sm sm:text-xl">Jelajahi keindahan alam, budaya, dan semangat masyarakat kami dalam membangun nagari yang cerdas dan terhubung.</p>
            <div class="mt-8">
                <a href="/profile" class="inline-block py-3 px-6 border-2 border-greenVill font-bold text-greenVill hover:border-white hover:text-white transition-colors duration-300">
                    Lihat Tentang
                </a>
            </div>
        </div>
    </section>


    <section class="py-12 px-4 sm:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold fade-in-left animate-on-scroll">Lokasi</h2>
                <div class="h-1 w-12 bg-green-800 mt-2 mx-auto"></div>
            </div>
            <div class="mt-8">
                <div class="w-full max-w-4xl mx-auto rounded-xl overflow-hidden shadow-lg border-2 border-green-800">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.47055745814!2d100.865463675037!3d-0.7816040992323861!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2b96316719e719%3A0x867a505e61280b2a!2sNagari%20Guguak%2C%20Kec.%20Koto%20VII%2C%20Kabupaten%20Sijunjung%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1723467265851!5m2!1sid!2sid"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    @include('layout.footer')




<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

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

//  document.addEventListener('DOMContentLoaded', function () {
//         var calendarEl = document.getElementById('calendar');

//         var calendar = new FullCalendar.Calendar(calendarEl, {
//             initialView: 'dayGridMonth',
//             events: @json($events),
//             eventDidMount: function (info) {
//                 const title = info.event.title;
//                 const [judul, waktu] = title.split('\n');
//                 info.el.innerHTML = `
//                     <div class="fc-event-title text-sm font-bold">${judul}</div>
//                     <div class="fc-event-time text-xs">${waktu}</div>
//                 `;
//             }
//         });

//         calendar.render();
//     });

    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Tampilan bulan
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            events: @json($events), // data dari controller
            height: 'auto',
            eventColor: '#004225', // Warna hijau
            eventTextColor: '#fff',
            nowIndicator: true,
            dayMaxEvents: true,
        });
        calendar.render();
    });



</script>




</body>
</html>
