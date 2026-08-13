<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $info['nama'] }} – Nagari Guguak</title>
    <meta name="description" content="{{ $info['deskripsi'] }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,600,700|lora:400,500,600,700" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('bumnag.png') }}" />
    <style>
        :root {
            /* Tema PwC Inspired (Hitam, Putih, Oranye) */
            --orange-main: #D04A02; /* Warna Oranye khas PwC */
            --orange-dark: #A33A02;
            --black-text: #2D2D2D;
            --gray-light: #F2F2F2;
            --white: #FFFFFF;
            --border: #E0E0E0;
            --font-sans: 'Inter', sans-serif;
            --font-serif: 'Lora', serif;
        }

        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        :target { scroll-margin-top: 100px; }
        body {
            font-family: var(--font-sans);
            color: var(--black-text);
            background: var(--white);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ====== NAVBAR ====== */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            height: 80px; padding: 0 5%;
            display: flex; align-items:center; justify-content:space-between;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            transition: all 0.3s ease;
        }
        .nav-brand {
            display:flex; align-items:center; gap:12px; text-decoration:none;
        }
        .nav-brand-title {
            font-family: var(--font-sans);
            font-size: 26px; font-weight: 700;
            color: var(--black-text); letter-spacing: -1px;
        }
        .nav-brand-title em { color: var(--orange-main); font-style: normal; }
        .nav-menu { display: flex; align-items: center; flex-grow: 1; justify-content: space-between; }
        .nav-links { display:flex; gap:35px; list-style:none; margin: 0 auto; }
        .nav-links a {
            color: var(--black-text);
            text-decoration:none; font-size:15px; font-weight:600;
            transition:color 0.2s;
        }
        .nav-links a:hover { color: var(--orange-main); }
        .nav-buttons { display: flex; align-items: center; }
        .nav-btn {
            background: var(--white); color: var(--black-text);
            padding: 10px 24px; border-radius: 4px;
            font-size:14px; font-weight: 600; border: 1px solid var(--border);
            text-decoration: none; transition: all 0.3s;
        }
        .nav-btn:hover { border-color: var(--black-text); }
        .menu-toggle { 
            display: none; background: none; border: none; 
            cursor: pointer; color: var(--black-text); 
            width: 32px; height: 32px; 
        }

        /* ====== HERO ====== */
        #hero { 
            padding-top: 80px; 
            min-height: 90vh; 
            display: flex; flex-direction: column;
        }
        .hero-top {
            padding: 80px 5%;
            background: var(--white);
        }
        .hero-title {
            font-family: var(--font-serif);
            font-size: clamp(48px, 6vw, 84px);
            font-weight: 500; color: var(--black-text);
            line-height: 1.1; margin-bottom: 30px;
            max-width: 900px; letter-spacing: -1px;
        }
        .btn-orange {
            display: inline-block; background: var(--orange-main); color: var(--white);
            padding: 14px 32px; font-size: 16px; font-weight: 600;
            text-decoration: none; transition: background 0.3s;
        }
        .btn-orange:hover { background: var(--orange-dark); }
        .btn-orange svg { width: 20px; height: 20px; vertical-align: middle; margin-left: 8px; transition: transform 0.3s; }
        .btn-orange:hover svg { transform: translateX(5px); }

        .hero-bottom {
            flex-grow: 1;
            width: 100%;
            position: relative;
            min-height: 400px;
        }
        .hero-bottom img {
            width: 100%; height: 100%; object-fit: cover;
            position: absolute; inset: 0;
        }

        /* ====== ABOUT US (TUGAS & FUNGSI) ====== */
        .section-padding { padding: 100px 5%; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start; }
        
        .sec-title {
            font-family: var(--font-serif); font-size: 42px;
            color: var(--black-text); font-weight: 500; margin-bottom: 24px;
            line-height: 1.2; letter-spacing: -0.5px;
        }
        .sec-desc {
            font-size: 18px; color: #555; line-height: 1.8; margin-bottom: 40px;
        }

        .feature-box {
            border-top: 2px solid var(--orange-main);
            padding-top: 24px; margin-bottom: 40px;
        }
        .feature-box h3 { font-size: 20px; margin-bottom: 12px; font-weight: 600; }
        .feature-box p { color: #555; line-height: 1.6; }

        /* ====== PROGRAMS (SERVICES STYLE) ====== */
        #program { background: var(--gray-light); }
        .prog-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-top: 50px; }
        .prog-card {
            background: var(--white);
            display: flex; flex-direction: column;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .prog-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.05); }
        .prog-img { height: 240px; width: 100%; background: #ddd; }
        .prog-img img { width: 100%; height: 100%; object-fit: cover; }
        .prog-body { padding: 30px; flex-grow: 1; display: flex; flex-direction: column; }
        .prog-cat { color: var(--black-text); font-size: 13px; font-weight: 700; text-transform: uppercase; margin-bottom: 12px; }
        .prog-title { font-family: var(--font-serif); font-size: 22px; font-weight: 600; margin-bottom: 16px; line-height: 1.3; }
        .prog-desc { color: #666; font-size: 15px; line-height: 1.6; margin-bottom: 24px; flex-grow: 1; }
        .prog-link {
            color: var(--black-text); font-weight: 600; text-decoration: none; font-size: 14px;
            display: inline-flex; align-items: center; gap: 8px; border-bottom: 1px solid transparent; padding-bottom: 2px;
            align-self: flex-start;
        }
        .prog-link:hover { border-color: var(--orange-main); color: var(--orange-main); }
        .prog-link svg { width: 16px; height: 16px; }

        /* ====== BERITA (INSIGHTS) ====== */
        .berita-list { display: flex; flex-direction: column; gap: 0; margin-top: 40px; border-top: 1px solid var(--border); }
        .berita-item {
            display: grid; grid-template-columns: 200px 1fr; gap: 40px;
            padding: 40px 0; border-bottom: 1px solid var(--border);
            align-items: center;
        }
        .berita-date { font-family: var(--font-serif); font-size: 24px; color: var(--orange-main); font-weight: 500; }
        .berita-content h3 { font-family: var(--font-serif); font-size: 28px; font-weight: 500; margin-bottom: 12px; line-height: 1.3; }
        .berita-content p { color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 16px; }
        .berita-link { color: var(--orange-main); font-weight: 600; text-decoration: none; }

        /* ====== FOOTER ====== */
        footer { background: var(--black-text); color: var(--white); padding: 60px 5% 30px; }
        .foot-top { display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 40px; margin-bottom: 30px; }
        .foot-brand { font-size: 24px; font-weight: 700; margin-bottom: 20px; }
        .foot-links { display: flex; gap: 40px; }
        .foot-links a { color: var(--white); text-decoration: none; opacity: 0.8; transition: opacity 0.3s; }
        .foot-links a:hover { opacity: 1; color: var(--orange-main); }
        .foot-bottom { font-size: 13px; opacity: 0.6; display: flex; justify-content: space-between; }

        @media (max-width: 900px) {
            .nav-menu { 
                position: fixed; top: 80px; left: 0; right: 0; background: var(--white);
                flex-direction: column; padding: 20px 5%; gap: 20px;
                border-bottom: 1px solid var(--border);
                box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
                display: none;
            }
            .nav-menu.active { display: flex; }
            .nav-links { flex-direction: column; gap: 20px; text-align: center; width: 100%; margin: 0; }
            .nav-buttons { flex-direction: column; gap: 10px; width: 100%; }
            .nav-buttons .nav-btn { width: 100%; text-align: center; margin: 0 !important; }
            .menu-toggle { display: block; }
            
            .hero-top { padding-top: 40px; padding-bottom: 40px; padding-left: 20px; padding-right: 20px; text-align: center; align-items: center; width: 100%; }
            .hero-text { width: 100%; display: flex; flex-direction: column; align-items: center; }
            .section-padding { padding: 60px 20px; }
            .grid-2 { grid-template-columns: 1fr; gap: 40px; }
            .prog-grid { grid-template-columns: 1fr; }
            .berita-item { grid-template-columns: 1fr; gap: 16px; padding: 30px 0; }
            .hero-title { font-size: 26px; line-height: 1.3; }
            .hero-bottom { min-height: 250px; }
            .foot-top { flex-direction: column; gap: 30px; }
            .foot-links { flex-direction: column; gap: 15px; }
            .btn-orange { width: 100%; text-align: center; display: block; box-sizing: border-box; }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav>
        <a href="#" class="nav-brand">
            <img src="{{ asset('bumnag.png') }}" alt="Logo BUMNag" style="height: 48px; width: auto; object-fit: contain;">
        </a>
        <div class="nav-menu" id="navMenu">
            <ul class="nav-links">
                <li><a href="#about" onclick="toggleMenu()">Tentang Kami</a></li>
                <li><a href="{{ route('lembaga.tugas.index', ['lembaga' => 'bumnag']) }}">Tujuan</a></li>
                <li><a href="#program" onclick="toggleMenu()">Program</a></li>
                <li><a href="#berita" onclick="toggleMenu()">Berita</a></li>
            </ul>
            <div class="nav-buttons">
                <a href="{{ route('lembaga.login', ['lembaga' => 'bumnag']) }}" class="nav-btn" style="margin-right: 15px; border:none;">Log Masuk</a>
                <a href="https://nagariguguak.id" class="nav-btn">Portal Nagari</a>
            </div>
        </div>
        <button class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle Menu">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 100%; height: 100%;"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </nav>

    {{-- HERO --}}
    <section id="hero">
        <div class="hero-top">
            <h1 class="hero-title">
                Penggerak Utama Perekonomian Nagari Guguak.
            </h1>
            <a href="#about" class="btn-orange">
                Mulai Eksplorasi 
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
        <div class="hero-bottom">
            @if($lembaga->foto_lembaga)
                <img src="{{ asset('storage/'.$lembaga->foto_lembaga) }}" alt="BUMNag">
            @else
                <img src="/sawah.jpg" alt="Pemandangan Nagari">
            @endif
        </div>
    </section>

    {{-- ABOUT US & TUJUAN --}}
    <section id="about" class="section-padding">
        <div class="grid-2">
            <div>
                <h2 class="sec-title">Transformasi Nagari</h2>
                <p class="sec-desc">
                    {{ $lembaga->deskripsi ?: 'BUMNag (Badan Usaha Milik Nagari) Guguak berdedikasi untuk memajukan ekonomi masyarakat melalui inovasi, pengelolaan aset nagari, dan pemberdayaan sumber daya lokal demi kesejahteraan bersama.' }}
                </p>
            </div>
            <div id="tugas">
                @forelse($tugas as $t)
                <div class="feature-box" style="{{ $loop->first ? 'margin-top: 0;' : '' }}">
                    <h3>{{ $t->judul }}</h3>
                    <p>{{ $t->deskripsi }}</p>
                </div>
                @empty
                <p>Belum ada data tujuan.</p>
                @endforelse
                
                @if($tugas->count() > 0)
                <a href="{{ route('lembaga.tugas.index', ['lembaga' => 'bumnag']) }}" class="prog-link" style="margin-top: 10px;">
                    Lihat Semua Tujuan
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                @endif
            </div>
        </div>
    </section>

    {{-- PROGRAM (SERVICES) --}}
    <section id="program" class="section-padding">
        <h2 class="sec-title" style="margin-bottom: 10px;">Program & Layanan</h2>
        <p style="color: #666; font-size: 18px;">Solusi terintegrasi untuk pertumbuhan ekonomi nagari.</p>
        
        <div class="prog-grid">
            @forelse($programs as $program)
            <div class="prog-card">
                <div class="prog-img">
                    @if($program->foto)
                        <img src="{{ asset('storage/'.$program->foto) }}" alt="{{ $program->nama_program }}">
                    @else
                        <img src="{{ asset('bumnag.png') }}" style="object-fit:contain; padding:40px; opacity:0.1; background:#fff;" alt="">
                    @endif
                </div>
                <div class="prog-body">
                    <span class="prog-cat">{{ $program->kategori ?: 'Layanan Utama' }}</span>
                    <h3 class="prog-title">{{ $program->nama_program }}</h3>
                    <p class="prog-desc">{{ Str::limit($program->deskripsi, 100) }}</p>
                    <a href="{{ route('lembaga.program.show', ['lembaga' => 'bumnag', 'program' => Str::slug($program->nama_program)]) }}" class="prog-link">
                        Lihat Selengkapnya
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
            @empty
            <p style="grid-column: 1/-1; padding: 40px; background: var(--white);">Belum ada program kerja yang ditambahkan.</p>
            @endforelse
        </div>
        
        <div style="margin-top: 40px; text-align: center;">
            <a href="{{ route('lembaga.program.index', ['lembaga' => 'bumnag']) }}" class="btn-orange" style="background: var(--white); color: var(--black-text); border: 1px solid var(--black-text);">
                Lihat Semua Program
            </a>
        </div>
    </section>

    {{-- BERITA (INSIGHTS) --}}
    <section id="berita" class="section-padding">
        <h2 class="sec-title">Warta & Informasi</h2>
        <p style="color: #666; font-size: 18px;">Berita terbaru, analisis, dan laporan kegiatan BUMNag.</p>
        
        <div class="berita-list">
            @forelse($beritas as $berita)
            <div class="berita-item">
                <div class="berita-date">
                    {{ optional($berita->tanggal_tayang)->format('M d, Y') ?: 'Terbaru' }}
                </div>
                <div class="berita-content">
                    <span style="display:block; color: #666; font-size: 13px; text-transform: uppercase; margin-bottom: 8px; font-weight: 600;">{{ $berita->kategori }} | {{ $berita->penulis ?: 'Admin' }}</span>
                    <h3>{{ $berita->judul }}</h3>
                    <p>{{ Str::limit(strip_tags($berita->isi_berita), 150) }}</p>
                    <a href="{{ route('lembaga.berita.show', ['lembaga' => 'bumnag', 'berita' => Str::slug($berita->judul)]) }}" class="berita-link">
                        Baca Selengkapnya &rarr;
                    </a>
                </div>
            </div>
            @empty
            <p style="padding: 40px 0;">Belum ada berita yang dipublikasikan.</p>
            @endforelse
        </div>
        
        <div style="margin-top: 40px;">
            <a href="{{ route('lembaga.berita.index', ['lembaga' => 'bumnag']) }}" class="btn-orange">
                Lihat Semua Berita
            </a>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer>
        <div class="foot-top">
            <div class="foot-brand">BUMNag<em>.</em> Nagari Guguak</div>
            <div class="foot-links">
                <a href="#about">Tentang Kami</a>
                <a href="#program">Layanan</a>
                <a href="#berita">Warta</a>
                <a href="{{ route('lembaga.login', ['lembaga' => 'bumnag']) }}">Portal Admin</a>
            </div>
        </div>
        <div class="foot-bottom">
            <span>&copy; 2026 Badan Usaha Milik Nagari Guguak. Hak Cipta Dilindungi.</span>
            <span>Nagari Guguak, Kabupaten Sijunjung, Sumatera Barat</span>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            document.getElementById('navMenu').classList.toggle('active');
        }
    </script>
</body>
</html>
