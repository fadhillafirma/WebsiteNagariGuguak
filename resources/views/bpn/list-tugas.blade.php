<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fungsi & Wewenang - {{ $info['nama'] }}</title>
    <meta name="description" content="Daftar fungsi dan wewenang {{ $info['nama'] }} untuk kesejahteraan masyarakat Nagari Guguak.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&family=playfair-display:700" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo_bpd.png') }}" />
    <style>
        :root {
            --maroon-dark: #580F1C;
            --maroon-mid:  #8A1A2B;
            --maroon-light:#a6b14a;
            --gold:       #c9a84c;
            --gold-light: #e8c96a;
            --cream:      #F7F5EE;
            --white:      #ffffff;
            --text-main:  #1c1c1c;
            --text-sub:   #4b4b4b;
            --border:     rgba(88,15,28,0.12);
            --font: 'Inter', ui-sans-serif, system-ui, sans-serif;
            --font-serif: 'Playfair Display', serif;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font); color: var(--text-main); background: var(--white); overflow-x: hidden; }

        /* ====== NAVBAR ====== */
        nav {
            position: fixed; top:0; left:0; right:0; z-index:999;
            height: 70px; padding: 0 6%;
            display: flex; align-items:center; justify-content:space-between;
            background: rgba(88,15,28,0.97); backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            transition: height 0.3s, background 0.3s;
        }
        .nav-brand { display:flex; align-items:center; gap:14px; text-decoration:none; }
        .nav-brand-title { font-size:15px; font-weight:600; color: var(--white); }
        .nav-brand-sub { font-size:11px; color:rgba(255,255,255,0.5); font-weight:400; }
        .nav-links { display:flex; gap:28px; list-style:none; align-items: center; }
        .nav-links a {
            color: rgba(255,255,255,0.75); text-decoration:none; font-size:14px;
            font-weight:500; letter-spacing:0.3px; transition:color 0.2s;
        }
        .nav-links a:hover { color:var(--gold-light); }
        .nav-links a.active { color:var(--gold-light); }

        /* ====== HERO BANNER ====== */
        .page-hero {
            position: relative;
            min-height: 340px;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            background: var(--maroon-dark);
        }
        .page-hero-bg {
            position: absolute; inset: 0;
            background: linear-gradient(135deg,
                rgba(56,9,17,0.95) 0%,
                rgba(107,19,31,0.7) 50%,
                rgba(38,5,11,0.92) 100%);
        }
        .page-hero-pattern {
            position: absolute; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='rgba(201,168,76,0.06)' stroke-width='0.8'%3E%3Crect x='10' y='10' width='40' height='40' transform='rotate(45 30 30)'/%3E%3Crect x='15' y='15' width='30' height='30'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 60px 60px;
        }
        .page-hero-content {
            position: relative; z-index: 2;
            text-align: center;
            padding: 120px 6% 60px;
        }
        .page-hero-kicker {
            display: inline-flex; align-items: center; gap: 10px;
            border: 1px solid rgba(201,168,76,0.4);
            color: var(--gold-light);
            padding: 6px 18px; border-radius: 2px;
            font-size: 11px; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase;
            margin-bottom: 20px;
            animation: fd-up 0.8s ease both;
        }
        .page-hero-kicker::before {
            content:''; width:5px; height:5px; background:var(--gold); border-radius:50%;
        }
        .page-hero h1 {
            font-family: 'Playfair Display', var(--font), serif;
            font-size: clamp(36px, 5vw, 56px);
            font-weight: 700; color: var(--white);
            line-height: 1.15; margin-bottom: 16px;
            animation: fd-up 0.9s 0.1s ease both;
        }
        .page-hero h1 em { font-style: italic; color: var(--gold-light); }
        .page-hero-desc {
            font-size: 17px; color: rgba(255,255,255,0.6);
            max-width: 520px; margin: 0 auto; line-height: 1.8; font-weight: 300;
            animation: fd-up 0.9s 0.2s ease both;
        }

        /* ====== BREADCRUMB ====== */
        .breadcrumb-bar {
            background: var(--cream);
            padding: 16px 6%;
            border-bottom: 1px solid var(--border);
        }
        .breadcrumb {
            max-width: 1200px; margin: 0 auto;
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; color: var(--text-sub);
        }
        .breadcrumb a {
            color: var(--maroon-mid); text-decoration: none; font-weight: 500;
            transition: color 0.2s;
        }
        .breadcrumb a:hover { color: var(--maroon-dark); }
        .breadcrumb svg { width: 14px; height: 14px; stroke: var(--text-sub); fill: none; opacity: 0.5; }
        .breadcrumb .current { font-weight: 600; color: var(--maroon-dark); }

        /* ====== TUGAS LIST ====== */
        .list-section {
            padding: 60px 6% 100px;
            max-width: 1000px; margin: 0 auto;
        }

        .tugas-card {
            display: flex; flex-direction: column; gap: 16px;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.04);
            border: 1px solid var(--border);
            padding: 40px;
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0; transform: translateY(30px);
            animation: card-in 0.6s ease forwards;
        }
        .tugas-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(88,15,28,0.08);
            border-color: var(--gold-light);
        }
        
        .tugas-number {
            font-family: var(--font-serif);
            font-size: 48px;
            font-weight: 700;
            color: var(--gold-light);
            line-height: 1;
            margin-bottom: 8px;
        }

        .tugas-title {
            font-family: var(--font-serif);
            font-size: 26px; font-weight: 700;
            color: var(--maroon-dark); line-height: 1.35;
        }
        .tugas-desc {
            font-size: 16px; color: var(--text-sub);
            line-height: 1.85; font-weight: 400;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center; padding: 100px 20px;
        }
        .empty-state svg {
            width: 80px; height: 80px; stroke: var(--border); fill: none; stroke-width: 1;
            margin-bottom: 20px;
        }
        .empty-state p {
            font-size: 16px; color: var(--text-sub); font-weight: 400;
        }

        /* ====== FOOTER ====== */
        footer {
            background: #2C070E; color: rgba(255,255,255,0.55);
            padding: 60px 6% 28px;
        }
        .foot-grid {
            display: grid; grid-template-columns: 1.2fr 1fr 1fr 1fr; gap: 40px;
            max-width: 1200px; margin: 0 auto;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 24px;
        }
        .foot-brand { font-size: 15px; font-weight: 700; color: var(--white); margin-bottom: 12px; }
        .foot-desc { font-size: 13px; line-height: 1.8; font-weight: 300; }
        .foot-h { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: rgba(255,255,255,0.8); margin-bottom: 16px; }
        .foot-ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .foot-ul a { color: rgba(255,255,255,0.45); text-decoration: none; font-size: 13px; transition: color 0.2s; }
        .foot-ul a:hover { color: var(--gold-light); }
        .foot-bottom {
            max-width: 1200px; margin: 0 auto;
            display: flex; justify-content: space-between;
            font-size: 12px; letter-spacing: 0.3px;
        }
        .foot-bottom span { color: var(--gold-light); }

        /* ====== ANIMATIONS ====== */
        @keyframes fd-up { from{opacity:0;transform:translateY(28px);} to{opacity:1;transform:translateY(0);} }
        @keyframes card-in { to { opacity:1; transform:translateY(0); } }

        /* ====== RESPONSIVE ====== */
        @media (max-width: 900px) {
            .page-hero { min-height: 280px; }
            .page-hero h1 { font-size: 32px; }
            .tugas-card { padding: 30px; }
            .tugas-title { font-size: 22px; }
        }
        @media (max-width: 768px) {
            nav { padding: 15px 5%; height: auto; flex-wrap: wrap; }
            .nav-brand-title { font-size: 14px; }
            .nav-links { display: none; }
            
            .foot-grid { grid-template-columns: 1fr; gap: 30px; text-align: center; }
            .foot-bottom { flex-direction: column; gap: 10px; text-align: center; }
        }
    </style>
</head>
<body>

    <nav id="site-nav">
        <a href="{{ route('lembaga.beranda', ['lembaga' => 'bpn']) }}" class="nav-brand">
            <img src="{{ asset('logo_bpd.png') }}" alt="Logo BPN" style="height: 40px; width: auto; object-fit: contain;">
            <div>
                <div class="nav-brand-title">BPN Nagari Guguak</div>
                <div class="nav-brand-sub">Badan Permusyawaratan Nagari</div>
            </div>
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('lembaga.beranda', ['lembaga' => 'bpn']) }}">Beranda</a></li>
            <li><a href="{{ route('lembaga.program.index', ['lembaga' => 'bpn']) }}">Program</a></li>
            <li><a href="{{ route('lembaga.berita.index', ['lembaga' => 'bpn']) }}">Berita</a></li>
        </ul>
    </nav>

    {{-- HERO BANNER --}}
    <section class="page-hero">
        <div class="page-hero-bg"></div>
        <div class="page-hero-pattern"></div>
        <div class="page-hero-content">
            <h1>Fungsi & <em>Wewenang</em></h1>
            <p class="page-hero-desc">Peran strategis BPN dalam mengawal dan mewujudkan tata kelola nagari yang transparan dan partisipatif.</p>
        </div>
    </section>

    {{-- BREADCRUMB --}}
    <div class="breadcrumb-bar">
        <div class="breadcrumb">
            <a href="{{ route('lembaga.beranda', ['lembaga' => 'bpn']) }}">
                <svg viewBox="0 0 24 24" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </a>
            <svg viewBox="0 0 24 24" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('lembaga.beranda', ['lembaga' => 'bpn']) }}">Beranda</a>
            <svg viewBox="0 0 24 24" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span class="current">Fungsi & Wewenang</span>
        </div>
    </div>

    {{-- TUGAS LIST --}}
    <div class="list-section">
        @forelse($tugas as $index => $t)
        <div class="tugas-card" style="animation-delay: {{ $index * 0.12 }}s;">
            <div class="tugas-number">0{{ $index + 1 }}</div>
            <h2 class="tugas-title">{{ $t->judul }}</h2>
            <p class="tugas-desc">{{ $t->deskripsi }}</p>
        </div>
        @empty
        <div class="empty-state">
            <svg viewBox="0 0 24 24" stroke-width="1"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            <p>Belum ada fungsi dan wewenang yang ditambahkan.</p>
        </div>
        @endforelse
    </div>

    {{-- FOOTER --}}
    <footer>
        <div class="foot-grid">
            <div>
                <div class="foot-brand">BPN Nagari Guguak</div>
                <p class="foot-desc">Badan Permusyawaratan Nagari resmi di bawah naungan Nagari Guguak, Kecamatan Koto VII, Kabupaten Sijunjung, Sumatera Barat.</p>
            </div>
            <div>
                <div class="foot-h">Navigasi</div>
                <ul class="foot-ul">
                    <li><a href="{{ route('lembaga.beranda', ['lembaga' => 'bpn']) }}">Beranda</a></li>
                    <li><a href="{{ route('lembaga.program.index', ['lembaga' => 'bpn']) }}">Program Kerja</a></li>
                    <li><a href="{{ route('lembaga.berita.index', ['lembaga' => 'bpn']) }}">Berita & Kegiatan</a></li>
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
            <div>
                <div class="foot-h">Kontak</div>
                <ul class="foot-ul">
                    <li><a href="#">Guguk, Koto VII, Kabupaten Sijunjung, Sumatera Barat 27563</a></li>
                    <li><a href="mailto:nagariguguak7@gmail.com">nagariguguak7@gmail.com</a></li>
                    <li><a href="tel:085191064962">085191064962</a></li>
                </ul>
            </div>
        </div>
        <div class="foot-bottom">
            <p>&copy; 2026 <span>BPN Nagari Guguak</span>. Bagian dari ekosistem digital Nagari Guguak.</p>
            <p>Dikelola oleh Pemerintah Nagari Guguak. Powered by KKN Guguak 2026.</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('site-nav');
            if (window.scrollY > 60) {
                nav.style.height = '58px';
                nav.style.background = 'rgba(38,5,11,0.99)';
            } else {
                nav.style.height = '70px';
                nav.style.background = 'rgba(88,15,28,0.97)';
            }
        });
    </script>
</body>
</html>




