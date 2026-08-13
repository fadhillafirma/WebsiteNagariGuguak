<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $info['nama'] }} – Nagari Guguak</title>
    <meta name="description" content="{{ $info['deskripsi'] }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|playfair-display:600,700,800" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo_bpd.png') }}" />
    <style>
        :root {
            /* Tema Maroon dan Emas Minangkabau */
            --maroon-dark:  #580F1C;
            --maroon-mid:   #8A1A2B;
            --maroon-light: #B3253A;
            --gold:         #c9a84c;
            --gold-light:   #e8c96a;
            --cream:        #Fdfbf7;
            --white:        #ffffff;
            --text-main:    #2b2b2b;
            --text-sub:     #5e5e5e;
            --border:       rgba(88,15,28,0.1);
            --font-sans:    'Inter', sans-serif;
            --font-serif:   'Playfair Display', serif;
        }

        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; background: var(--cream); }
        body {
            font-family: var(--font-sans);
            color: var(--text-main);
            background: var(--cream);
            overflow-x: hidden;
        }

        /* ====== NEW NAVBAR (FORMAL & ANCHORED) ====== */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 999;
            width: 100%;
            height: 80px; padding: 0 5%;
            display: flex; align-items:center; justify-content:space-between;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            border-bottom: 2px solid var(--gold);
            box-shadow: 0 4px 20px rgba(88,15,28,0.03);
            transition: all 0.3s ease;
        }
        nav.scrolled {
            height: 70px;
            background: rgba(255, 255, 255, 0.99);
            box-shadow: 0 8px 30px rgba(88,15,28,0.06);
        }
        .nav-brand {
            display:flex; align-items:center; gap:14px; text-decoration:none;
        }
        .nav-brand img {
            height: 48px; width: auto; object-fit: contain;
            transition: height 0.3s ease;
        }
        nav.scrolled .nav-brand img {
            height: 40px;
        }
        .nav-brand-title {
            font-family: var(--font-sans);
            font-size: 16px; font-weight: 700;
            color: var(--maroon-dark); line-height: 1.2;
        }
        .nav-brand-sub {
            font-family: var(--font-sans);
            font-size: 10px; font-weight: 500;
            color: var(--text-sub);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 2px;
        }
        .nav-links { display:flex; gap:30px; list-style:none; margin-left: auto; margin-right: 30px; }
        .nav-links a {
            color: var(--text-main);
            text-decoration:none; font-size:13px; font-weight:600;
            text-transform: uppercase; letter-spacing:1px;
            transition:color 0.2s;
        }
        .nav-links a:hover { color:var(--maroon-mid); }
        .nav-btn {
            background: var(--maroon-dark); color: var(--white) !important;
            padding: 10px 20px; border-radius: 4px;
            font-size:12px !important; text-transform: uppercase;
            font-weight: 700; letter-spacing: 0.5px;
            transition: background 0.3s !important;
        }
        .nav-btn:hover { background: var(--maroon-mid); }

        /* ====== HERO (SPLIT FULL VIEWPORT) ====== */
        #hero { padding-top: 80px; margin: 0; height: calc(100vh - 80px); min-height: 600px; box-sizing: border-box; }
        .hero-container {
            width: 100%; height: 100%;
            background: var(--maroon-dark);
            position: relative;
            display: flex; align-items: center;
        }
        .hero-pattern {
            position: absolute; left: 0; top: 0; bottom: 0; width: 50%;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='rgba(201,168,76,0.1)' stroke-width='1'%3E%3Cpath d='M30 0l30 30-30 30L0 30z'/%3E%3Ccircle cx='30' cy='30' r='10'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 80px 80px; opacity: 0.8; z-index: 1;
        }
        .hero-content {
            position: relative; z-index: 2;
            width: 100%; height: 100%;
            display: grid; grid-template-columns: 1fr 1fr; gap: 0;
        }
        .hero-text-col {
            padding: 0 10% 0 12%; 
            display: flex; flex-direction: column; justify-content: center;
            align-items: flex-start;
        }
        .hero-text-col h1 {
            font-family: var(--font-serif);
            font-size: clamp(40px, 4.5vw, 68px);
            font-weight: 700; color: var(--gold-light);
            line-height: 1.15; margin-bottom: 24px;
        }
        .hero-text-col p {
            font-size: 18px; color: rgba(255,255,255,0.85);
            line-height: 1.8; font-weight: 300; margin-bottom: 40px;
            max-width: 95%;
        }
        .hero-img-col {
            height: 100%; width: 100%;
            position: relative;
        }
        .hero-img-col::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 150px;
            background: linear-gradient(to right, var(--maroon-dark) 0%, transparent 100%);
            z-index: 1;
        }
        .hero-img-col img {
            width: 100%; height: 100%; object-fit: cover;
            position: absolute; inset: 0;
        }

        
        .btn-primary {
            display: inline-block; background: var(--gold); color: var(--maroon-dark);
            padding: 16px 36px; border-radius: 40px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px; text-decoration: none;
            transition: transform 0.3s, background 0.3s;
        }
        .btn-primary:hover { background: var(--gold-light); transform: translateY(-3px); }

        /* ====== TUGAS FUNGSI (ZIGZAG LAYOUT) ====== */
        .section-padding { padding: 100px 4%; max-width: 1200px; margin: 0 auto; }
        .section-header { text-align: center; margin-bottom: 60px; }
        .kicker {
            color: var(--gold); font-size: 12px; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase; margin-bottom: 12px; display: block;
        }
        .section-title {
            font-family: var(--font-serif); font-size: 40px;
            color: var(--maroon-dark); font-weight: 700;
        }
        .zigzag-row {
            display: flex; align-items: center; gap: 60px; margin-bottom: 40px;
            background: var(--white); padding: 40px; border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid rgba(201,168,76,0.15);
        }
        .zigzag-row:nth-child(even) { flex-direction: row-reverse; }
        .zigzag-icon {
            width: 100px; height: 100px; flex-shrink: 0;
            background: var(--maroon-dark); border-radius: 24px;
            display: flex; align-items: center; justify-content: center;
            transform: rotate(-5deg); transition: transform 0.3s;
        }
        .zigzag-row:hover .zigzag-icon { transform: rotate(0); }
        .zigzag-icon svg { width: 44px; height: 44px; stroke: var(--gold-light); fill: none; stroke-width: 1.5; }
        .zigzag-text h3 {
            font-family: var(--font-serif); font-size: 24px;
            color: var(--maroon-dark); margin-bottom: 12px;
        }
        .zigzag-text p { color: var(--text-sub); line-height: 1.8; font-size: 16px; }

        /* ====== PROGRAM (HORIZONTAL CARDS) ====== */
        #program { background: var(--white); padding-top: 100px; padding-bottom: 100px; }
        .prog-list { display: flex; flex-direction: column; gap: 24px; }
        .prog-item {
            display: flex; gap: 30px; padding: 24px;
            background: var(--cream); border-radius: 20px;
            border: 1px solid var(--border);
            transition: box-shadow 0.3s, transform 0.3s;
        }
        .prog-item:hover { box-shadow: 0 15px 35px rgba(88,15,28,0.06); transform: translateY(-4px); }
        .prog-img {
            width: 240px; height: 180px; flex-shrink: 0;
            border-radius: 12px; overflow: hidden; background: #e9e5db;
        }
        .prog-img img { width: 100%; height: 100%; object-fit: cover; }
        .prog-info { display: flex; flex-direction: column; justify-content: center; flex: 1; }
        .prog-cat { color: var(--maroon-mid); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .prog-title { font-family: var(--font-serif); font-size: 22px; color: var(--maroon-dark); margin-bottom: 12px; font-weight: 700; }
        .prog-desc { color: var(--text-sub); font-size: 15px; line-height: 1.7; margin-bottom: 20px; }
        .prog-link {
            display: inline-flex; align-items: center; gap: 8px;
            color: var(--maroon-dark); font-weight: 600; font-size: 14px; text-decoration: none;
        }
        .prog-link svg { width: 18px; height: 18px; transition: transform 0.2s; }
        .prog-link:hover svg { transform: translateX(5px); }

        /* ====== BERITA (CALENDAR STYLE GRID) ====== */
        .berita-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
        .berita-card {
            background: var(--white); border-radius: 16px; overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.04);
            border: 1px solid var(--border);
        }
        .berita-thumb { height: 200px; width: 100%; background: var(--maroon-dark); position: relative; }
        .berita-thumb img { width: 100%; height: 100%; object-fit: cover; opacity: 0.9; }
        .berita-date-badge {
            position: absolute; bottom: -20px; right: 24px;
            background: var(--gold); color: var(--maroon-dark);
            width: 60px; height: 60px; border-radius: 12px;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(201,168,76,0.4);
        }
        .bd-day { font-size: 22px; font-weight: 800; line-height: 1; }
        .bd-month { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
        .berita-body { padding: 36px 24px 24px; }
        .berita-cat { color: var(--maroon-light); font-size: 11px; font-weight: 700; text-transform: uppercase; margin-bottom: 10px; display: block; }
        .berita-title { font-family: var(--font-serif); font-size: 18px; color: var(--text-main); font-weight: 700; line-height: 1.4; margin-bottom: 16px; }
        .berita-link { color: var(--maroon-dark); font-size: 13px; font-weight: 600; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; }
        .berita-link:hover { color: var(--gold); }

        /* ====== CTA ====== */
        .cta-wrap { margin-top: 60px; padding: 80px 4%; background: var(--maroon-dark); text-align: center; position: relative; overflow: hidden; }
        .cta-wrap::before {
            content: ''; position: absolute; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 0l20 20-20 20L0 20z' fill='none' stroke='rgba(201,168,76,0.08)' stroke-width='1'/%3E%3C/svg%3E");
        }
        .cta-content { position: relative; z-index: 2; max-width: 600px; margin: 0 auto; }
        .cta-content h2 { font-family: var(--font-serif); font-size: 36px; color: var(--gold-light); margin-bottom: 20px; }
        .cta-content p { color: rgba(255,255,255,0.8); font-size: 16px; margin-bottom: 30px; line-height: 1.6; }

        /* ====== FOOTER ====== */
        footer { background: #1c050a; color: rgba(255,255,255,0.5); padding: 80px 6% 30px; text-align: center; }
        .foot-logo { font-family: var(--font-serif); font-size: 24px; color: var(--white); margin-bottom: 16px; font-weight: 700; }
        .foot-logo em { color: var(--gold); font-style: italic; }
        .foot-links { display: flex; justify-content: center; gap: 30px; margin-bottom: 40px; list-style: none; }
        .foot-links a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; }
        .foot-links a:hover { color: var(--gold); }
        .foot-copy { font-size: 13px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 30px; }

        @media (max-width: 900px) {
            #hero { height: auto; min-height: 100vh; padding-top: 100px; }
            .hero-content { grid-template-columns: 1fr; padding: 0; text-align: center; }
            .hero-text-col { padding: 40px 20px; align-items: center; }
            .hero-img-col { min-height: 400px; }
            .hero-img-col::before { top: 0; left: 0; right: 0; bottom: auto; width: 100%; height: 150px; background: linear-gradient(to bottom, var(--maroon-dark) 0%, transparent 100%); }
            .hero-text-col p { margin: 0 auto 30px; }
            .zigzag-row, .zigzag-row:nth-child(even) { flex-direction: column; text-align: center; gap: 24px; padding: 30px 20px; }
            .prog-item { flex-direction: column; }
            .prog-img { width: 100%; height: 200px; }
            .berita-grid { grid-template-columns: 1fr; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav id="site-nav">
        <a href="#" class="nav-brand">
            <img src="{{ asset('logo_bpd.png') }}" alt="Logo BPN">
            <div>
                <div class="nav-brand-title">BPN Nagari Guguak</div>
                <div class="nav-brand-sub">Badan Permusyawaratan Nagari</div>
            </div>
        </a>
        <ul class="nav-links">
            <li><a href="#tugas">Tugas Pokok</a></li>
            <li><a href="#program">Program</a></li>
            <li><a href="#berita">Berita</a></li>
        </ul>
        <a href="https://nagariguguaksijunjung.id" class="nav-btn">Portal Nagari</a>
    </nav>

    {{-- HERO --}}
    <section id="hero">
        <div class="hero-container">
            <div class="hero-pattern"></div>
            <div class="hero-content">
                <div class="hero-text-col">
                    <h1>Badan Permusyawaratan<br><em>Nagari Guguak</em></h1>
                    <p>
                        {{ $lembaga->deskripsi ?: 'Mitra pemerintah nagari dalam merumuskan kebijakan, menampung aspirasi masyarakat, dan mengawasi jalannya roda pemerintahan demi kemajuan bersama.' }}
                    </p>
                    <a href="#tugas" class="btn-primary">Mulai Jelajahi</a>
                </div>
                <div class="hero-img-col">
                    @if($lembaga->foto_lembaga)
                        <img src="{{ asset('storage/'.$lembaga->foto_lembaga) }}" alt="Hero Image">
                    @else
                        <img src="/minangkabau.jpg" alt="Rumah Gadang">
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- TUGAS & FUNGSI (ZIGZAG) --}}
    <section id="tugas" class="section-padding">
        <div class="section-header">
            <span class="kicker">Fungsi & Wewenang</span>
            <h2 class="section-title">Peran Strategis BPN</h2>
        </div>
        
        @forelse($tugas as $index => $t)
        <div class="zigzag-row">
            <div class="zigzag-icon">
                <span style="font-family: var(--font-serif); font-size: 40px; font-weight: 700; color: var(--gold-light);">0{{ $index + 1 }}</span>
            </div>
            <div class="zigzag-text">
                <h3>{{ $t->judul }}</h3>
                <p>{{ $t->deskripsi }}</p>
            </div>
        </div>
        @empty
        <p style="text-align: center; color: var(--text-sub);">Belum ada data fungsi dan wewenang yang dipublikasikan.</p>
        @endforelse

        <div style="text-align:center; margin-top:50px;">
            <a href="{{ route('lembaga.tugas.index', ['lembaga' => 'bpn']) }}" class="btn-primary" style="background:transparent; border:2px solid var(--maroon-dark); color:var(--maroon-dark);">Lihat Semua Fungsi & Wewenang</a>
        </div>
    </section>

    {{-- PROGRAM KERJA (LIST LAYOUT) --}}
    <section id="program">
        <div class="section-padding" style="padding-top:0;">
            <div class="section-header" style="display:flex; justify-content:space-between; align-items:flex-end; text-align:left;">
                <div>
                    <span class="kicker">Agenda & Kegiatan</span>
                    <h2 class="section-title">Program Kerja</h2>
                </div>
                <a href="{{ route('lembaga.program.index', ['lembaga' => 'bpn']) }}" style="color:var(--maroon-dark); font-weight:700; text-transform:uppercase; font-size:14px; text-decoration:none;">Lihat Semua &rarr;</a>
            </div>
            
            <div class="prog-list">
                @forelse($programs as $program)
                <div class="prog-item">
                    <div class="prog-img">
                        @if($program->foto)
                            <img src="{{ asset('storage/'.$program->foto) }}" alt="{{ $program->nama_program }}">
                        @else
                            <img src="{{ asset('images/logo.png') }}" style="object-fit:contain; padding:40px; opacity:0.2;" alt="">
                        @endif
                    </div>
                    <div class="prog-info">
                        <span class="prog-cat">{{ $program->kategori ?: 'Musyawarah' }}</span>
                        <h3 class="prog-title">{{ $program->nama_program }}</h3>
                        <p class="prog-desc">{{ Str::limit($program->deskripsi, 140) }}</p>
                        <a href="{{ route('lembaga.program.show', ['lembaga' => 'bpn', 'program' => Str::slug($program->nama_program)]) }}" class="prog-link">Selengkapnya <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
                    </div>
                </div>
                @empty
                <p style="text-align: center; padding: 40px; color: var(--text-sub);">Belum ada program kerja yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- BERITA (GRID CALENDAR STYLE) --}}
    <section id="berita" class="section-padding">
        <div class="section-header">
            <span class="kicker">Informasi Publik</span>
            <h2 class="section-title">Warta BPN Terbaru</h2>
        </div>
        
        <div class="berita-grid">
            @forelse($beritas as $berita)
            <div class="berita-card">
                <div class="berita-thumb">
                    @if($berita->foto)
                        <img src="{{ asset('storage/'.$berita->foto) }}" alt="{{ $berita->judul }}">
                    @endif
                    <div class="berita-date-badge">
                        <span class="bd-day">{{ optional($berita->tanggal_tayang)->format('d') ?: '??' }}</span>
                        <span class="bd-month">{{ optional($berita->tanggal_tayang)->format('M') ?: '---' }}</span>
                    </div>
                </div>
                <div class="berita-body">
                    <span class="berita-cat">{{ $berita->kategori }}</span>
                    <h3 class="berita-title">{{ Str::limit($berita->judul, 60) }}</h3>
                    <a href="{{ route('lembaga.berita.show', ['lembaga' => 'bpn', 'berita' => Str::slug($berita->judul)]) }}" class="berita-link">Baca Selengkapnya &rarr;</a>
                </div>
            </div>
            @empty
            <p style="grid-column: 1/-1; text-align: center; color: var(--text-sub);">Belum ada warta yang dipublikasikan.</p>
            @endforelse
        </div>
        
        <div style="text-align:center; margin-top:50px;">
            <a href="{{ route('lembaga.berita.index', ['lembaga' => 'bpn']) }}" class="btn-primary" style="background:transparent; border:2px solid var(--maroon-dark); color:var(--maroon-dark);">Indeks Berita</a>
        </div>
    </section>

    {{-- CTA --}}
    <div class="cta-wrap">
        <div class="cta-content">
            <h2>Kawal Pembangunan Nagari</h2>
            <p>Sampaikan aspirasi dan gagasan Anda untuk mewujudkan Nagari Guguak yang lebih sejahtera, transparan, dan berbudaya bersama BPN.</p>
            <a href="https://nagariguguaksijunjung.id/kontak" class="btn-primary" style="background:var(--white); color:var(--maroon-dark);">Hubungi Kami</a>
        </div>
    </div>

    {{-- FOOTER --}}
    <footer>
        <div class="foot-logo">BPN <em>Nagari</em></div>
        <ul class="foot-links">
            <li><a href="#tugas">Tugas Pokok</a></li>
            <li><a href="#program">Agenda BPN</a></li>
            <li><a href="#berita">Warta</a></li>
            <li><a href="{{ route('lembaga.login', ['lembaga' => 'bpn']) }}">Admin Login</a></li>
        </ul>
        <div class="foot-copy">
            &copy; 2026 Badan Permusyawaratan Nagari Guguak. Hak cipta dilindungi undang-undang.
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('site-nav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
