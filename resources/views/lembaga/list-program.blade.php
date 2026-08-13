<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Program Kerja â€“ {{ $info['nama'] }}</title>
    <meta name="description" content="Daftar program kerja {{ $info['nama'] }} untuk kesejahteraan masyarakat Nagari Guguak.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&family=playfair-display:700" rel="stylesheet">
    @if(isset($lembaga) && $lembaga->foto_lembaga)
        <link rel="icon" type="image/png" href="{{ asset('storage/'.$lembaga->foto_lembaga) }}" />
    @elseif(isset($subdomain) && $subdomain === 'upz')
        <link rel="icon" type="image/png" href="{{ asset('baznas.png') }}" />
    @else
        <link rel="icon" type="image/png" href="{{ asset('logo_bpd.png') }}" />
    @endif
    <style>
        :root {
            --green-dark: #004225;
            --green-mid:  #006837;
            --green-light:#a6b14a;
            --gold:       #c9a84c;
            --gold-light: #e8c96a;
            --cream:      #F7F5EE;
            --white:      #ffffff;
            --text-main:  #1c1c1c;
            --text-sub:   #4b4b4b;
            --border:     rgba(0,66,37,0.12);
            --font: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font); color: var(--text-main); background: var(--white); overflow-x: hidden; }

        /* ====== NAVBAR ====== */
        nav {
            position: fixed; top:0; left:0; right:0; z-index:999;
            height: 70px;
            padding: 0 6%;
            display: flex; align-items:center; justify-content:space-between;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(0,66,37,0.1);
            transition: height 0.3s, background 0.3s, box-shadow 0.3s;
        }
        .nav-brand { display:flex; align-items:center; gap:14px; text-decoration:none; }
        .nav-brand-title { font-size:15px; font-weight:600; color: var(--white); }
        .nav-brand-sub { font-size:11px; color:rgba(255,255,255,0.5); font-weight:400; }
        .nav-links { display:flex; gap:28px; list-style:none; align-items: center; }
        .nav-links a {
            color: var(--green-dark); text-decoration:none; font-size:14px;
            font-weight:600; letter-spacing:0.3px; transition:color 0.2s;
        }
        .nav-links a:hover { color:var(--green-mid); }
        .nav-links a.active { color:var(--gold-light); }

        /* ====== HERO BANNER ====== */
        .page-hero {
            position: relative;
            min-height: 340px;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            background: var(--green-dark);
        }
        .page-hero-bg {
            position: absolute; inset: 0;
            background: linear-gradient(135deg,
                rgba(0,40,20,0.95) 0%,
                rgba(0,80,40,0.7) 50%,
                rgba(0,30,15,0.92) 100%);
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
            color: var(--green-mid); text-decoration: none; font-weight: 500;
            transition: color 0.2s;
        }
        .breadcrumb a:hover { color: var(--green-dark); }
        .breadcrumb svg { width: 14px; height: 14px; stroke: var(--text-sub); fill: none; opacity: 0.5; }
        .breadcrumb .current { font-weight: 600; color: var(--green-dark); }

        /* ====== PROGRAM LIST ====== */
        .list-section {
            padding: 60px 6% 100px;
            max-width: 1200px; margin: 0 auto;
        }

        /* Horizontal Card (Jorong style) */
        .program-card {
            display: flex;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.04);
            border: 1px solid var(--border);
            overflow: hidden;
            margin-bottom: 36px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0; transform: translateY(30px);
            animation: card-in 0.6s ease forwards;
        }
        .program-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0,66,37,0.08);
        }
        .program-card:nth-child(even) { flex-direction: row-reverse; }

        .program-card-image {
            width: 44%; min-height: 320px;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }
        .program-card-image .img-bg {
            position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--green-mid), var(--green-dark));
            transition: transform 0.5s ease;
        }
        .program-card:hover .img-bg { transform: scale(1.05); }
        .program-card-image .img-bg img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .program-card-image .card-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(180deg, transparent 40%, rgba(0,30,15,0.6) 100%);
            z-index: 1;
        }
        .program-card-image .card-number {
            position: absolute; top: 20px; left: 20px; z-index: 2;
            background: var(--gold);
            color: var(--green-dark);
            width: 42px; height: 42px;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; font-weight: 800;
            letter-spacing: -0.5px;
        }
        .program-card:nth-child(even) .card-number {
            left: auto; right: 20px;
        }

        .program-card-body {
            flex: 1;
            padding: 40px 44px;
            display: flex; flex-direction: column; justify-content: center;
        }
        .prog-tag {
            display: inline-block;
            background: rgba(0,66,37,0.08);
            color: var(--green-mid);
            font-size: 10px; font-weight: 700;
            letter-spacing: 1.5px; text-transform: uppercase;
            padding: 5px 14px; margin-bottom: 16px;
            border-radius: 3px;
            align-self: flex-start;
        }
        .prog-card-title {
            font-size: 24px; font-weight: 700;
            color: var(--green-dark); line-height: 1.35;
            margin-bottom: 8px;
        }
        .prog-card-meta {
            display: flex; gap: 20px;
            font-size: 12px; color: var(--text-sub); font-weight: 500;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }
        .prog-card-meta span {
            display: inline-flex; align-items: center; gap: 5px;
        }
        .prog-card-meta svg {
            width: 14px; height: 14px; stroke: var(--gold); fill: none; stroke-width: 1.8;
        }
        .prog-card-desc {
            font-size: 15px; color: var(--text-sub);
            line-height: 1.85; font-weight: 300;
            margin-bottom: 28px;
        }
        .btn-detail {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green-dark);
            color: var(--white);
            padding: 12px 28px; border-radius: 5px;
            font-size: 13px; font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: background 0.25s, transform 0.2s;
            align-self: flex-start;
        }
        .btn-detail:hover { background: var(--green-mid); transform: translateX(3px); }
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
            background: #001c0e; color: rgba(255,255,255,0.55);
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
            .program-card,
            .program-card:nth-child(even) {
                flex-direction: column;
            }
            .program-card-image { width: 100%; min-height: 220px; }
            .program-card-body { padding: 28px 24px; }
            .program-card:nth-child(even) .card-number { left: 20px; right: auto; }
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
            <li><a href="{{ route('lembaga.program.index', ['lembaga' => $subdomain]) }}" class="active">Program</a></li>
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
        <div class="page-hero-pattern"></div>
        <div class="page-hero-content">

            <h1>Daftar <em>Program</em> Kerja</h1>
            <p class="page-hero-desc">Setiap rupiah zakat disalurkan secara transparan melalui program terstruktur yang terukur dampaknya bagi masyarakat nagari.</p>
        </div>
    </section>

    {{-- BREADCRUMB --}}
    <div class="breadcrumb-bar">
        <div class="breadcrumb">
            <a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}">
                <svg viewBox="0 0 24 24" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </a>
            <svg viewBox="0 0 24 24" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}">Beranda</a>
            <svg viewBox="0 0 24 24" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span class="current">Program Kerja</span>
        </div>
    </div>

    {{-- PROGRAM LIST --}}
    <div class="list-section">
        @forelse($programs as $index => $program)
        <div class="program-card" style="animation-delay: {{ $index * 0.12 }}s;">
            <div class="program-card-image">
                <div class="img-bg">
                    @if($program->foto)
                        <img src="{{ asset('storage/'.$program->foto) }}" alt="{{ $program->nama_program }}">
                    @endif
                </div>
                <div class="card-overlay"></div>
                <div class="card-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="program-card-body">
                <span class="prog-tag">{{ $program->kategori ?: 'Umum' }}</span>
                <h2 class="prog-card-title">{{ $program->nama_program }}</h2>
                <div class="prog-card-meta">
                    <span>
                        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                        {{ $program->penerima_manfaat ?: 'Masyarakat Nagari' }}
                    </span>
                    @if($program->alokasi_dana)
                    <span>
                        <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                        Rp {{ number_format((float)$program->alokasi_dana, 0, ',', '.') }}
                    </span>
                    @endif
                    <span>
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        {{ ucfirst($program->status) }}
                    </span>
                </div>
                <p class="prog-card-desc">{{ Str::limit($program->deskripsi, 200) }}</p>
                <a href="{{ route('lembaga.program.show', ['lembaga' => $subdomain, 'program' => \Illuminate\Support\Str::slug($program->nama_program)]) }}" class="btn-detail">
                    Lihat Detail
                    <svg viewBox="0 0 24 24" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <svg viewBox="0 0 24 24" stroke-width="1"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            <p>Belum ada program kerja yang ditambahkan.</p>
        </div>
        @endforelse
    </div>

    {{-- FOOTER --}}
    <footer>
        <div class="foot-grid">
            <div>
                <div class="foot-brand">UPZ Nagari Guguak</div>
                <p class="foot-desc">Lembaga amil zakat resmi di bawah naungan Nagari Guguak, Kecamatan Koto VII, Kabupaten Sijunjung, Sumatera Barat.</p>
            </div>
            <div>
                <div class="foot-h">Navigasi</div>
                <ul class="foot-ul">
                    <li><a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}">Beranda</a></li>
                    <li><a href="{{ route('lembaga.program.index', ['lembaga' => $subdomain]) }}">Program Kerja</a></li>
                    <li><a href="{{ route('lembaga.berita.index', ['lembaga' => $subdomain]) }}">Berita & Kegiatan</a></li>
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
                    <li><a href="#">Jl. Raya Guguak No.01, Kec. Sijunjung</a></li>
                    <li><a href="mailto:nagariguguak7@gmail.com">nagariguguak7@gmail.com</a></li>
                    <li><a href="tel:085191064962">085191064962</a></li>
                </ul>
            </div>
        </div>
        <div class="foot-bottom">
            <p>&copy; 2025 <span>UPZ Nagari Guguak</span>. Bagian dari ekosistem digital Nagari Guguak.</p>
            <div style="display: flex; align-items: center; gap: 16px;">
                <p>Dikelola oleh Pemerintah Nagari Guguak.</p>
                <a href="{{ route('lembaga.admin', ['lembaga' => $subdomain]) }}" style="padding: 4px 12px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: var(--white); border-radius: 4px; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">Login Admin</a>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('site-nav');
            const logo = document.getElementById('nav-logo-img');
            if (window.scrollY > 60) {
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


