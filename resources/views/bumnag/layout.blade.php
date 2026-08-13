<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BUMNag Nagari Guguak')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|lora:400,500,600,700" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('bumnag.png') }}" />
    <style>
        :root {
            --orange-main: #D04A02;
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
        body {
            font-family: var(--font-sans); color: var(--black-text);
            background: var(--white); line-height: 1.6;
        }

        /* NAVBAR */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            height: 80px; padding: 0 5%;
            display: flex; align-items:center; justify-content:space-between;
            background: var(--white); border-bottom: 1px solid var(--border);
        }
        .nav-brand { display:flex; align-items:center; text-decoration:none; }
        .nav-brand-title {
            font-family: var(--font-sans); font-size: 26px; font-weight: 700;
            color: var(--black-text); letter-spacing: -1px;
        }
        .nav-brand-title em { color: var(--orange-main); font-style: normal; }
        .nav-links { display:flex; gap:35px; list-style:none; margin: 0 auto; }
        .nav-links a { color: var(--black-text); text-decoration:none; font-size:15px; font-weight:600; transition:color 0.2s; }
        .nav-links a:hover, .nav-links a.active { color: var(--orange-main); }
        .nav-btn {
            background: var(--white); color: var(--black-text); padding: 10px 24px;
            border-radius: 4px; font-size:14px; font-weight: 600; border: 1px solid var(--border);
            text-decoration: none; transition: all 0.3s;
        }
        .nav-btn:hover { border-color: var(--black-text); }

        /* HEADER PAGE */
        .page-header {
            padding: 140px 5% 60px; background: var(--gray-light); border-bottom: 1px solid var(--border);
        }
        .page-title {
            font-family: var(--font-serif); font-size: 48px; font-weight: 500;
            color: var(--black-text); margin-bottom: 16px; letter-spacing: -1px;
        }
        .page-desc { font-size: 18px; color: #555; max-width: 800px; }
        
        .main-content { padding: 80px 5%; min-height: 50vh; }

        /* BUTTON */
        .btn-orange {
            display: inline-block; background: var(--orange-main); color: var(--white);
            padding: 14px 32px; font-size: 16px; font-weight: 600; border: none; cursor:pointer;
            text-decoration: none; transition: background 0.3s; border-radius: 0;
        }
        .btn-orange:hover { background: var(--orange-dark); }

        /* FOOTER */
        footer { background: var(--black-text); color: var(--white); padding: 60px 5% 30px; margin-top: 80px; }
        .foot-top { display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 40px; margin-bottom: 30px; }
        .foot-brand { font-size: 24px; font-weight: 700; margin-bottom: 20px; }
        .foot-links { display: flex; gap: 40px; }
        .foot-links a { color: var(--white); text-decoration: none; opacity: 0.8; transition: opacity 0.3s; }
        .foot-links a:hover { opacity: 1; color: var(--orange-main); }
        .foot-bottom { font-size: 13px; opacity: 0.6; display: flex; justify-content: space-between; }

        @media (max-width: 900px) {
            .nav-links { display: none; }
            .page-title { font-size: 36px; }
            .foot-top { flex-direction: column; gap: 30px; }
            .foot-links { flex-direction: column; gap: 15px; }
        }
        @yield('extra_css')
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('lembaga.beranda', ['lembaga' => 'bumnag']) }}" class="nav-brand">
            <img src="{{ asset('bumnag.png') }}" alt="Logo BUMNag" style="height: 48px; width: auto; object-fit: contain;">
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('lembaga.beranda', ['lembaga' => 'bumnag']) }}">Beranda</a></li>
            <li><a href="{{ route('lembaga.tugas.index', ['lembaga' => 'bumnag']) }}" class="{{ request()->routeIs('lembaga.tugas.*') ? 'active' : '' }}">Tujuan</a></li>
            <li><a href="{{ route('lembaga.program.index', ['lembaga' => 'bumnag']) }}" class="{{ request()->routeIs('lembaga.program.*') ? 'active' : '' }}">Program & Layanan</a></li>
            <li><a href="{{ route('lembaga.berita.index', ['lembaga' => 'bumnag']) }}" class="{{ request()->routeIs('lembaga.berita.*') ? 'active' : '' }}">Berita</a></li>
        </ul>
        <div>
            
            <a href="https://nagariguguaksijunjung.id" class="nav-btn">Portal Nagari</a>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="foot-top">
            <div class="foot-brand">BUMNag<em>.</em> Nagari Guguak</div>
            <div class="foot-links">
                <a href="{{ route('lembaga.beranda', ['lembaga' => 'bumnag']) }}">Beranda</a>
                <a href="{{ route('lembaga.tugas.index', ['lembaga' => 'bumnag']) }}">Tujuan</a>
                <a href="{{ route('lembaga.program.index', ['lembaga' => 'bumnag']) }}">Program</a>
                <a href="{{ route('lembaga.berita.index', ['lembaga' => 'bumnag']) }}">Berita</a>
                
            </div>
        </div>
        <div class="foot-bottom">
            <span>&copy; 2026 Badan Usaha Milik Nagari Guguak. Hak Cipta Dilindungi.</span>
            <span>Nagari Guguak, Kabupaten Sijunjung, Sumatera Barat</span>
        </div>
    </footer>
</body>
</html>

