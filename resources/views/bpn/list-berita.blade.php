<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Kegiatan - {{ $info['nama'] }}</title>
    <meta name="description" content="Berita dan kegiatan terbaru dari {{ $info['nama'] }} untuk masyarakat Nagari Guguak.">
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

        /* ====== BERITA LIST ====== */
        .list-section {
            padding: 60px 6% 100px;
            max-width: 1200px; margin: 0 auto;
        }

        /* Horizontal Card (Jorong style) */
        .berita-card {
            display: flex;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.04);
            border: 1px solid var(--border);
            overflow: hidden;
            margin-bottom: 36px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: inherit;
            opacity: 0; transform: translateY(30px);
            animation: card-in 0.6s ease forwards;
        }
        .berita-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(88,15,28,0.08);
        }
        .berita-card:nth-child(even) { flex-direction: row-reverse; }

        .berita-card-image {
            width: 44%; min-height: 320px;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }
        .berita-card-image .img-bg {
            position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--maroon-mid), var(--maroon-dark));
            transition: transform 0.5s ease;
        }
        .berita-card:hover .img-bg { transform: scale(1.05); }
        .berita-card-image .img-bg img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .berita-card-image .card-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(180deg, transparent 40%, rgba(38,5,11,0.5) 100%);
            z-index: 1;
        }
        .berita-card-image .card-date-badge {
            position: absolute; top: 20px; left: 20px; z-index: 2;
            background: var(--gold);
            color: var(--maroon-dark);
            padding: 8px 14px;
            border-radius: 6px;
            text-align: center;
            line-height: 1.2;
        }
        .berita-card:nth-child(even) .card-date-badge {
            left: auto; right: 20px;
        }
        .card-date-badge .date-day {
            font-size: 20px; font-weight: 800; display: block;
        }
        .card-date-badge .date-month {
            font-size: 9px; font-weight: 700; letter-spacing: 1px;
            text-transform: uppercase; display: block;
        }

        .berita-card-body {
            flex: 1;
            padding: 40px 44px;
            display: flex; flex-direction: column; justify-content: center;
        }
        .berita-tag {
            display: inline-block;
            background: var(--gold);
            color: var(--maroon-dark);
            font-size: 10px; font-weight: 700;
            letter-spacing: 1.5px; text-transform: uppercase;
            padding: 5px 14px; margin-bottom: 16px;
            border-radius: 3px;
            align-self: flex-start;
        }
        .berita-card-title {
            font-size: 24px; font-weight: 700;
            color: var(--maroon-dark); line-height: 1.35;
            margin-bottom: 8px;
        }
        .berita-card-meta {
            display: flex; gap: 20px;
            font-size: 12px; color: var(--text-sub); font-weight: 500;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }
        .berita-card-meta span {
            display: inline-flex; align-items: center; gap: 5px;
        }
        .berita-card-meta svg {
            width: 14px; height: 14px; stroke: var(--gold); fill: none; stroke-width: 1.8;
        }
        .berita-card-desc {
            font-size: 15px; color: var(--text-sub);
            line-height: 1.85; font-weight: 300;
            margin-bottom: 28px;
        }
        .btn-detail {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--maroon-dark);
            color: var(--white);
            padding: 12px 28px; border-radius: 5px;
            font-size: 13px; font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: background 0.25s, transform 0.2s;
            align-self: flex-start;
        }
        .btn-detail:hover { background: var(--maroon-mid); transform: translateX(3px); }
        .btn-detail svg { width: 16px; height: 16px; stroke: currentColor; fill: none; transition: transform 0.2s; }
        .btn-detail:hover svg { transform: translateX(4px); }

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
            .berita-card,
            .berita-card:nth-child(even) {
                flex-direction: column;
            }
            .berita-card-image { width: 100%; min-height: 220px; }
            .berita-card-body { padding: 28px 24px; }
            .berita-card:nth-child(even) .card-date-badge { left: 20px; right: auto; }
            .page-hero { min-height: 280px; }
            .page-hero h1 { font-size: 32px; }
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
            <li><a href="{{ route('lembaga.berita.index', ['lembaga' => 'bpn']) }}" class="active">Berita</a></li>
        </ul>
    </nav>

    {{-- HERO BANNER --}}
    <section class="page-hero">
        <div class="page-hero-bg"></div>
        <div class="page-hero-pattern"></div>
        <div class="page-hero-content">
           
            <h1>Berita & <em>Kegiatan</em></h1>
            <p class="page-hero-desc">Informasi terkini seputar kegiatan, penyaluran dana zakat, dan berita penting dari BPN Nagari Guguak.</p>
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
            <span class="current">Berita & Kegiatan</span>
        </div>
    </div>

    {{-- BERITA LIST --}}
    <div class="list-section">
        @forelse($beritas as $index => $berita)
        <div class="berita-card" style="animation-delay: {{ $index * 0.12 }}s;">
            <div class="berita-card-image">
                <div class="img-bg">
                    @if($berita->foto)
                        <img src="{{ asset('storage/'.$berita->foto) }}" alt="{{ $berita->judul }}">
                    @endif
                </div>
                <div class="card-overlay"></div>
                @php
                    $tgl = optional($berita->tanggal_tayang);
                @endphp
                <div class="card-date-badge">
                    <span class="date-day">{{ $tgl->format('d') ?? '--' }}</span>
                    <span class="date-month">{{ $tgl->translatedFormat('M Y') ?? '---' }}</span>
                </div>
            </div>
            <div class="berita-card-body">
                <span class="berita-tag">{{ $berita->kategori ?: 'Berita' }}</span>
                <h2 class="berita-card-title">{{ $berita->judul }}</h2>
                <div class="berita-card-meta">
                    <span>
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ optional($berita->tanggal_tayang)->translatedFormat('d F Y') ?: 'Belum ditentukan' }}
                    </span>
                    <span>
                        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        {{ $berita->penulis ?: 'Administrator' }}
                    </span>
                </div>
                <p class="berita-card-desc">{{ Str::limit($berita->isi_berita, 200) }}</p>
                <a href="{{ route('lembaga.berita.show', ['lembaga' => 'bpn', 'berita' => Str::slug($berita->judul)]) }}" class="btn-detail">
                    Lihat Detail
                    <svg viewBox="0 0 24 24" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <svg viewBox="0 0 24 24" stroke-width="1"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2"/></svg>
            <p>Belum ada berita yang dipublikasikan.</p>
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







