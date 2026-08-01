<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} – {{ $info['nama'] }}</title>
    <meta name="description" content="{{ Str::limit($berita->isi_berita, 150) }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet">
    <style>
        :root {
            --green-dark: #004225;
            --green-mid:  #006837;
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
        body { font-family: var(--font); color: var(--text-main); background: var(--cream); overflow-x: hidden; }
        
        /* NAVBAR */
        nav {
            position: fixed; top:0; left:0; right:0; z-index:999;
            height: 70px; padding: 0 6%;
            display: flex; align-items:center; justify-content:space-between;
            background: rgba(255,255,255,0.98); backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(0,66,37,0.1);
        }
        .nav-brand { display:flex; align-items:center; gap:14px; text-decoration:none; }
        .nav-brand-title { font-size:15px; font-weight:600; color: var(--white); }
        .nav-brand-sub { font-size:11px; color:rgba(255,255,255,0.5); font-weight:400; }
        .nav-links a {
            display:inline-block; background: transparent; border:1px solid var(--green-dark);
            color: var(--green-dark); padding: 8px 18px; border-radius:4px;
            font-size:13px; font-weight:600; text-decoration:none;
            transition: background 0.2s, color 0.2s;
        }
        .nav-links a:hover { background: var(--green-dark); color: var(--white); }

        /* DETAIL CONTENT */
        .detail-wrapper {
            max-width: 900px; margin: 120px auto 100px;
            background: var(--white);
            border-radius: 8px; border: 1px solid var(--border);
            padding: 50px 60px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        }
        .back-link {
            display:inline-flex; align-items:center; gap:8px;
            font-size:13px; font-weight:600; color:var(--green-mid);
            text-decoration:none; margin-bottom:30px;
        }
        .back-link:hover { text-decoration:underline; }
        .back-link svg { width:16px; height:16px; stroke:currentColor; fill:none; }
        
        .d-tag {
            display:inline-block; background:var(--gold); color:var(--green-dark);
            font-size:10px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;
            padding:5px 12px; margin-bottom:20px; border-radius: 2px;
        }
        .d-title {
            font-size: clamp(28px, 4vw, 42px); font-weight: 700; color: var(--green-dark);
            line-height: 1.25; margin-bottom: 24px;
        }
        .d-meta {
            display:flex; flex-wrap:wrap; gap:24px;
            padding:20px 0; border-top:1px solid var(--border); border-bottom:1px solid var(--border);
            margin-bottom: 30px;
        }
        .meta-item { display:flex; flex-direction:column; gap:4px; }
        .meta-lbl { font-size:10px; font-weight:700; color:var(--text-sub); text-transform:uppercase; letter-spacing:1px; }
        .meta-val { font-size:14px; font-weight:600; color:var(--green-dark); }
        
        .d-content {
            font-size:16px; line-height:1.9; color:var(--text-main); font-weight:400;
        }
        .d-foto {
            width:100%; max-height:420px; border-radius:8px; overflow:hidden;
            margin-bottom:30px; border:1px solid var(--border);
        }
        .d-foto img { width:100%; height:100%; object-fit:cover; display:block; }
        
        /* FOOTER */
        footer { background:#001c0e; color:rgba(255,255,255,0.55); padding:40px 6%; text-align:center; font-size:12px; }
        
        @media (max-width:768px){
            nav { padding: 15px 20px; height: auto; flex-wrap: wrap; }
            .nav-brand-title { font-size: 14px; }
            .nav-links { display: none; }
            
            .detail-wrapper { margin: 100px 20px 60px; padding: 30px 20px; }
            .d-title { font-size: 28px; }
            .d-meta { flex-direction:column; gap:15px; }
            .d-foto { max-height: 240px; }
        }
    </style>
</head>
<body>

    <nav id="site-nav">
        <a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}" class="nav-brand">
            <img src="{{ asset('baznas.png') }}" alt="Baznas Logo" style="height: 60px; object-fit: contain;">
        </a>
        <div class="nav-links">
            <a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}#berita">Kembali ke Berita</a>
        </div>
    </nav>

    <div class="detail-wrapper">
        <a href="{{ route('lembaga.berita.index', ['lembaga' => $subdomain]) }}" class="back-link">
            <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar Berita
        </a>
        
        <span class="d-tag">{{ $berita->kategori ?: 'Berita' }}</span>
        <h1 class="d-title">{{ $berita->judul }}</h1>
        
        @if($berita->foto)
        <div class="d-foto">
            <img src="{{ asset('storage/'.$berita->foto) }}" alt="{{ $berita->judul }}">
        </div>
        @endif

        <div class="d-meta">
            <div class="meta-item">
                <span class="meta-lbl">Tanggal Terbit</span>
                <span class="meta-val">{{ optional($berita->tanggal_tayang)->translatedFormat('d F Y') ?: 'Belum ditentukan' }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-lbl">Penulis</span>
                <span class="meta-val">{{ $berita->penulis ?: 'Administrator' }}</span>
            </div>
        </div>

        <div class="d-content">
            {!! nl2br(e($berita->isi_berita)) !!}
        </div>
    </div>

    <footer>
        <p>&copy; 2025 UPZ Nagari Guguak. Dikelola oleh Pemerintah Nagari Guguak.</p>
    </footer>

</body>
</html>
