<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Zakat - {{ $info['nama'] }}</title>
    <meta name="description" content="Informasi rekening dan layanan pembayaran zakat melalui {{ $info['nama'] }} Nagari Guguak.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&family=playfair-display:700" rel="stylesheet">
    @if(isset($lembaga) && $lembaga->foto_lembaga)
        <link rel="icon" type="image/png" href="{{ asset('storage/'.$lembaga->foto_lembaga) }}" />
    @elseif(isset($subdomain) && $subdomain === 'upz')
        <link rel="icon" type="image/png" href="{{ asset('baznas.png') }}" />
    @else
        <link rel="icon" type="image/png" href="{{ asset('logo_bpd.png') }}" />
    @endif
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        greenDark: '#004225',
                        greenMid: '#006837',
                        gold: '#c9a84c',
                        goldLight: '#e8c96a',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --green-dark: #004225;
            --green-mid:  #006837;
            --gold:       #c9a84c;
            --gold-light: #e8c96a;
            --white:      #ffffff;
            --text-main:  #1c1c1c;
            --text-sub:   #4b4b4b;
        }
        body { font-family: 'Inter', sans-serif; color: var(--text-main); background: #F7F5EE; overflow-x: hidden; margin: 0; }

        /* ====== NAVBAR ====== */
        nav#site-nav {
            position: fixed; top:0; left:0; right:0; z-index:999;
            height: 70px; padding: 0 6%;
            display: flex; align-items:center; justify-content:space-between;
            background: rgba(255,255,255,0.98); backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(0,66,37,0.1);
            transition: height 0.3s, background 0.3s, box-shadow 0.3s;
        }
        .nav-brand { display:flex; align-items:center; gap:14px; text-decoration:none; }
        .nav-brand-title { font-size:15px; font-weight:600; color: var(--green-dark); }
        .nav-links { display:flex; gap:28px; list-style:none; align-items: center; margin: 0; padding: 0; }
        .nav-links li { list-style: none; }
        .nav-links a {
            color: var(--green-dark); text-decoration:none; font-size:14px;
            font-weight:600; letter-spacing:0.3px; transition:color 0.2s;
        }
        .nav-links a:hover { color:var(--green-mid); }
        .nav-links a.active { color:var(--gold-light); }
        .nav-btn {
            background: var(--gold); color: var(--white) !important;
            padding: 8px 18px; border-radius: 4px; font-weight: 700 !important;
            letter-spacing: 0.5px; transition: background 0.2s, transform 0.2s !important;
        }
        .nav-btn:hover { background: var(--gold-light); transform: translateY(-2px); }

        /* ====== HERO ====== */
        .page-hero {
            position: relative;
            min-height: 280px;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            background: var(--green-dark);
            margin-top: 70px;
        }
        .page-hero-bg {
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(0,40,20,0.95) 0%, rgba(0,80,40,0.7) 50%, rgba(0,30,15,0.92) 100%);
        }
        .page-hero-content {
            position: relative; z-index: 2;
            text-align: center;
            padding: 60px 6%;
        }
        .page-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 700; color: var(--white);
            margin-bottom: 12px;
        }
        .page-hero h1 em { font-style: italic; color: var(--gold-light); }
        .page-hero-desc {
            font-size: 16px; color: rgba(255,255,255,0.7);
            max-width: 500px; margin: 0 auto;
        }

        /* ====== FOOTER ====== */
        footer {
            background: #021a0f; color: rgba(255,255,255,0.55);
            padding: 60px 6% 28px;
            margin-top: 60px;
        }
        .foot-grid {
            display: grid; grid-template-columns: 1.2fr 1fr 1fr 1fr; gap: 40px;
            max-width: 1200px; margin: 0 auto;
            padding-bottom: 40px; border-bottom: 1px solid rgba(255,255,255,0.08); margin-bottom: 24px;
        }
        .foot-brand { font-size: 15px; font-weight: 700; color: var(--white); margin-bottom: 12px; }
        .foot-desc { font-size: 13px; line-height: 1.8; font-weight: 300; }
        .foot-h { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: rgba(255,255,255,0.8); margin-bottom: 16px; }
        .foot-ul { list-style: none; display: flex; flex-direction: column; gap: 10px; padding: 0; margin: 0; }
        .foot-ul a { color: rgba(255,255,255,0.45); text-decoration: none; font-size: 13px; transition: color 0.2s; }
        .foot-ul a:hover { color: var(--gold-light); }
        .foot-bottom {
            max-width: 1200px; margin: 0 auto;
            display: flex; justify-content: space-between; align-items: center;
            font-size: 12px; letter-spacing: 0.3px;
        }
        .foot-bottom span { color: var(--gold-light); }

        @media (max-width: 768px) {
            nav#site-nav { padding: 15px 5%; height: auto; flex-wrap: wrap; }
            .nav-links { display: none; }
            .foot-grid { grid-template-columns: 1fr; gap: 30px; text-align: center; }
            .foot-bottom { flex-direction: column; gap: 10px; text-align: center; }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav id="site-nav">
        <a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}" class="nav-brand">
            @if(isset($lembaga) && $lembaga->foto_lembaga)
                <img id="nav-logo-img" src="{{ asset('storage/'.$lembaga->foto_lembaga) }}" alt="Logo {{ $info['nama'] }}" style="height: 60px; object-fit: contain; transition: height 0.3s;">
            @elseif($subdomain === 'upz')
                <img id="nav-logo-img" src="{{ asset('baznas.png') }}" alt="Logo Baznas" style="height: 40px; object-fit: contain; transition: height 0.3s;">
            @else
                <span class="nav-brand-title" style="color: var(--green-dark); font-size: 20px;">{{ $info['nama'] }}</span>
            @endif
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('lembaga.program.index', ['lembaga' => $subdomain]) }}">Program</a></li>
            <li><a href="{{ route('lembaga.berita.index', ['lembaga' => $subdomain]) }}">Berita</a></li>
            @if($subdomain === 'upz')
            <li><a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}#cara">Cara Berzakat</a></li>
            <li><a href="{{ route('lembaga.bayar-zakat', ['lembaga' => $subdomain]) }}" class="nav-btn">Bayar Zakat</a></li>
            @else
            <li><a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}#cta" class="nav-btn">Hubungi Kami</a></li>
            @endif
        </ul>
    </nav>

    {{-- HERO BANNER --}}
    <section class="page-hero">
        <div class="page-hero-bg"></div>
        <div class="page-hero-content">
            <h1>Layanan <em>Pembayaran Zakat</em></h1>
            <p class="page-hero-desc">Tunaikan zakat Anda dengan mudah dan aman melalui saluran resmi {{ $info['nama'] }} Nagari Guguak.</p>
        </div>
    </section>    <!-- Kontak Section Style (Tailwind) -->
    <section class="w-full min-h-[60vh] flex items-center justify-center -mt-10 mb-20 relative z-10 px-4">
        <div class="max-w-5xl w-full grid md:grid-cols-2 gap-12 place-items-start bg-white p-8 md:p-12 rounded-lg shadow border border-gray-100">

            <div class="w-full flex flex-col justify-center h-full space-y-6">
                <div>
                    <h2 class="font-bold text-gray-900 text-3xl tracking-tight border-b-2 border-gold inline-block pb-2">Rekening Zakat</h2>
                    <p class="mt-4 text-gray-600 leading-relaxed text-sm">
                        Salurkan zakat, infaq, dan sedekah Anda melalui rekening resmi Unit Pengumpul Zakat (UPZ) Nagari Guguak. Setiap dana yang masuk akan dikelola secara transparan dan disalurkan kepada yang berhak.
                    </p>
                </div>
                
                <div class="grid gap-4 mt-2">
                    @forelse($rekenings as $rek)
                    <div class="border border-gray-200 rounded-md p-5 flex flex-col justify-center bg-white hover:border-gold transition-colors duration-200">
                        <p class="text-[11px] text-gray-500 uppercase tracking-widest font-semibold mb-1">{{ $rek->nama_bank }}</p>
                        <h5 class="text-xl font-bold text-gray-900 tracking-wider font-mono">{{ $rek->nomor_rekening }}</h5>
                        <p class="text-xs font-medium text-gray-600 mt-1">a.n. <span class="font-bold">{{ $rek->atas_nama }}</span></p>
                    </div>
                    @empty
                    <div class="border border-gray-200 rounded-md p-5 text-center bg-gray-50">
                        <p class="text-sm text-gray-500">Belum ada data rekening zakat.</p>
                    </div>
                    @endforelse
                </div>
                
                <div class="bg-gray-50 border-l-4 border-gold p-4 mt-4 text-sm text-gray-600 rounded-r-md">
                    <strong class="text-gray-900 block mb-1">Konfirmasi Pembayaran:</strong>
                    Setelah melakukan transfer, mohon lakukan konfirmasi dengan mengirimkan bukti transfer melalui WhatsApp resmi kami.
                </div>
            </div>

            <div class="w-full flex flex-col space-y-6">
                <!-- Kontak UPZ -->
                <div class="w-full">
                    <h2 class="font-bold text-gray-900 text-3xl tracking-tight border-b-2 border-gold inline-block pb-2 mb-6">Hubungi Kami</h2>
                    
                    <div class="grid gap-4">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/6285191064962" target="_blank" rel="noopener noreferrer" class="block group">
                            <div class="border border-gray-200 rounded-md p-5 flex items-center gap-5 bg-white group-hover:border-gold transition-colors duration-200">
                                <div class="w-12 h-12 bg-gray-50 text-gray-700 flex items-center justify-center shrink-0 border border-gray-100 rounded">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.964 9.964 0 001.333 4.993L2 22l5.233-1.237a9.994 9.994 0 004.779 1.216h.004c5.505 0 9.988-4.478 9.989-9.984 0-2.669-1.037-5.176-2.922-7.062A9.935 9.935 0 0012.012 2zm5.836 14.394c-.249.702-1.428 1.341-1.996 1.439-.533.092-1.222.146-3.411-.762-2.73-1.134-4.52-3.923-4.66-4.11-.14-.187-1.11-1.477-1.11-2.816 0-1.34.697-2.004.945-2.269.248-.265.539-.331.718-.331.18 0 .359.006.518.014.166.008.388-.063.606.467.27.653.92 2.253.998 2.416.08.163.131.353.033.548-.098.196-.148.314-.294.51-.147.196-.31.422-.44.549-.148.147-.302.308-.135.596.166.287.74 1.224 1.587 1.986 1.096.983 2.023 1.29 2.317 1.438.293.147.466.122.64-.074.175-.196.755-.881.956-1.184.201-.303.402-.253.666-.155.265.098 1.674.79 1.961.937.288.147.48.22.549.343.07.123.07.712-.178 1.414z"/></svg>
                                </div>
                                <div>
                                    <h5 class="text-lg font-bold text-gray-900">WhatsApp</h5>
                                    <p class="text-gray-600 text-sm mt-0.5">085191064962 <span class="text-gray-400 text-xs ml-1">(Admin UPZ)</span></p>
                                </div>
                            </div>
                        </a>

                        <!-- Email -->
                        <a href="mailto:nagariguguak7@gmail.com" class="block group">
                            <div class="border border-gray-200 rounded-md p-5 flex items-center gap-5 bg-white group-hover:border-gold transition-colors duration-200">
                                <div class="w-12 h-12 bg-gray-50 text-gray-700 flex items-center justify-center shrink-0 border border-gray-100 rounded">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <h5 class="text-lg font-bold text-gray-900">Email</h5>
                                    <p class="text-gray-600 text-sm mt-0.5">nagariguguak7@gmail.com</p>
                                </div>
                            </div>
                        </a>

                        <!-- Lokasi -->
                        <div class="border border-gray-200 rounded-md p-5 flex items-start gap-5 bg-white">
                            <div class="w-12 h-12 bg-gray-50 text-gray-700 flex items-center justify-center shrink-0 border border-gray-100 rounded">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h5 class="text-lg font-bold text-gray-900">Kantor UPZ Nagari</h5>
                                <p class="text-gray-600 text-sm leading-relaxed mt-1">Kantor Wali Nagari Guguak<br>Kec. Koto VII, Kab. Sijunjung<br>Prov. Sumatera Barat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>n>

    {{-- FOOTER --}}
    <footer>
        <div class="foot-grid">
            <div>
                <div class="foot-brand">{{ $info['nama'] }}</div>
                <p class="foot-desc">Lembaga resmi di bawah naungan Nagari Guguak, Kecamatan Koto VII, Kabupaten Sijunjung, Sumatera Barat.</p>
            </div>
            <div>
                <div class="foot-h">Navigasi</div>
                <ul class="foot-ul">
                    <li><a href="{{ route('lembaga.program.index', ['lembaga' => $subdomain]) }}">Program Kerja</a></li>
                    <li><a href="{{ route('lembaga.berita.index', ['lembaga' => $subdomain]) }}">Berita Kegiatan</a></li>
                    @if($subdomain === 'upz')
                    <li><a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}#cara">Cara Berzakat</a></li>
                    @endif
                </ul>
            </div>
            <div>
                <div class="foot-h">Informasi</div>
                <ul class="foot-ul">
                    <li><a href="#">Laporan Keuangan</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="https://nagariguguaksijunjung.id">Portal Nagari Guguak</a></li>
                </ul>
            </div>
            <div>1
                <div class="foot-h">Kontak</div>
                <ul class="foot-ul">
                    <li><a href="#">Guguk, Koto VII, Kabupaten Sijunjung, Sumatera Barat 27563</a></li>
                    <li><a href="mailto:nagariguguak7@gmail.com">nagariguguak7@gmail.com</a></li>
                    <li><a href="tel:085191064962">085191064962</a></li>
                </ul>
            </div>
        </div>
        <div class="foot-bottom">
            <p>&copy; 2025 <span>{{ $info['nama'] }} Nagari Guguak</span>. Bagian dari ekosistem digital Nagari Guguak.</p>
            <div style="display: flex; align-items: center; gap: 16px;">
                <p>Dikelola oleh Pemerintah Nagari Guguak. Powered by KKN Guguak 2026.</p>
                
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('site-nav');
            const logo = document.getElementById('nav-logo-img');
            if (window.scrollY > 30) {
                nav.style.height = '58px';
                nav.style.background = 'rgba(255,255,255,1)';
                nav.style.boxShadow = '0 4px 20px rgba(0,0,0,0.05)';
                if(logo) logo.style.height = '46px';
            } else {
                nav.style.height = '70px';
                nav.style.background = 'rgba(255,255,255,0.98)';
                nav.style.boxShadow = 'none';
                if(logo) logo.style.height = '60px';
            }
        });
    </script>
</body>
</html>






