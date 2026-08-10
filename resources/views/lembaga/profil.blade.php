<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $info['nama'] }} – Nagari Guguak</title>
    <meta name="description" content="{{ $info['deskripsi'] }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    {{-- Font diselaraskan dengan web utama Nagari Guguak (Inter via fonts.bunny.net) --}}
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
        html { scroll-behavior:smooth; }
        body {
            font-family: var(--font);
            color: var(--text-main);
            background: var(--white);
            overflow-x: hidden;
        }

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
        .nav-brand {
            display:flex; align-items:center; gap:14px; text-decoration:none;
        }
        .nav-logo-mark {
            width:40px; height:40px;
            border:2px solid rgba(201,168,76,0.6);
            border-radius:8px;
            display:flex; align-items:center; justify-content:center;
        }
        .nav-logo-mark svg { width:22px; height:22px; stroke: var(--gold-light); fill:none; }
        .nav-brand-title {
            font-family:'Playfair Display', serif;
            font-size:15px; font-weight:600;
            color: var(--white); line-height:1.2;
        }
        .nav-brand-sub {
            font-size:11px; color:rgba(255,255,255,0.5);
            letter-spacing:0.5px; font-weight:400;
        }
        .nav-menu { display: flex; align-items: center; justify-content: flex-end; flex-grow: 1; }
        .menu-toggle { display: none; background: none; border: none; cursor: pointer; color: var(--green-dark); width: 32px; height: 32px; margin-left: auto; }
        .nav-links { display:flex; gap:28px; list-style:none; }
        .nav-links a {
            color: var(--green-dark);
            text-decoration:none; font-size:13px; font-weight:600;
            letter-spacing:0.3px;
            transition:color 0.2s;
        }
        .nav-links a:hover { color:var(--green-mid); }
        .nav-btn {
            display:inline-block;
            background: var(--gold);
            color: var(--green-dark) !important;
            padding: 9px 22px;
            border-radius:4px;
            font-weight:700 !important;
            font-size:13px !important;
            letter-spacing:0.4px;
            text-transform: uppercase;
            transition: background 0.2s !important;
        }
        .nav-btn:hover { background: var(--gold-light) !important; color: var(--green-dark) !important; }

        /* ====== HERO ====== */
        #hero {
            position:relative;
            min-height:90vh;
            display:flex; align-items:center;
            overflow:hidden;
            background:var(--green-dark);
        }
        .hero-bg {
            position:absolute; inset:0;
            @if($lembaga->foto_lembaga)
            background: url('{{ asset('storage/'.$lembaga->foto_lembaga) }}') center/cover no-repeat fixed;
            @elseif($subdomain === 'upz')
            background: url('/cover-upz.jpg') center/cover no-repeat fixed;
            @else
            background: url('/sawah.jpg') center/cover no-repeat fixed;
            @endif
            z-index:1;
        }
        .hero-overlay {
            position:absolute; inset:0;
            background:linear-gradient(135deg, rgba(0,40,20,0.85) 0%, rgba(0,80,40,0.7) 50%, rgba(0,30,15,0.92) 100%);
            z-index:1;
        }
        .hero-geo {
            position:absolute; inset:0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='rgba(201,168,76,0.05)' stroke-width='0.8'%3E%3Crect x='10' y='10' width='40' height='40' transform='rotate(45 30 30)'/%3E%3Crect x='15' y='15' width='30' height='30'/%3E%3C/g%3E%3C/svg%3E");
            background-size:60px 60px;
        }
        .hero-inner {
            position:relative; z-index:2;
            max-width:1240px; margin:0 auto;
            padding:130px 6% 90px;
            display:grid; grid-template-columns:1.1fr 1fr; gap:70px; align-items:center;
        }
        .hero-kicker {
            display:inline-flex; align-items:center; gap:10px;
            border:1px solid rgba(201,168,76,0.4);
            color:var(--gold-light);
            padding:6px 18px;
            border-radius:2px;
            font-size:11px; font-weight:700;
            letter-spacing:2px; text-transform:uppercase;
            margin-bottom:28px;
            animation: fd-up 0.8s ease both;
        }
        .hero-kicker::before {
            content:'';width:5px;height:5px;background:var(--gold);border-radius:50%;
        }
        .hero-title {
            font-family: var(--font);
            font-size:clamp(38px,5vw,64px);
            font-weight:700; line-height:1.12;
            color:var(--white); margin-bottom:22px;
            animation: fd-up 0.9s 0.1s ease both;
        }
        .hero-title em { font-style:italic; color:var(--gold-light); }
        .hero-desc {
            font-size:17px; line-height:1.85;
            color:rgba(255,255,255,0.7);
            max-width:500px; margin-bottom:38px;
            animation: fd-up 0.9s 0.2s ease both;
            font-weight:300;
        }
        .hero-acts { display:flex; gap:14px; animation: fd-up 0.9s 0.3s ease both; }
        .btn-gold {
            display:inline-block;
            background:var(--gold); color:var(--green-dark);
            font-weight:700; font-size:14px; letter-spacing:0.5px;
            padding:13px 30px; border-radius:3px; text-decoration:none;
            text-transform:uppercase; transition:background 0.2s;
        }
        .btn-gold:hover { background:var(--gold-light); }
        .btn-outline {
            display:inline-block;
            background:transparent;
            border:1px solid rgba(255,255,255,0.3);
            color:rgba(255,255,255,0.85);
            font-size:14px; font-weight:500;
            padding:13px 30px; border-radius:3px; text-decoration:none;
            transition:border-color 0.2s, color 0.2s;
        }
        .btn-outline:hover { border-color:rgba(255,255,255,0.6); color:var(--white); }

        /* Stats card - Futuristic Redesign */
        .hero-stats { 
            animation: fd-right 1s 0.3s ease both; 
            position: relative;
        }
        .hero-stats::before {
            content: '';
            position: absolute;
            top: -20px; right: -20px; bottom: -20px; left: -20px;
            background: radial-gradient(circle at 50% 50%, rgba(201,168,76,0.15) 0%, transparent 60%);
            z-index: -1;
            filter: blur(20px);
        }
        .stats-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.04) 0%, rgba(255,255,255,0.01) 100%);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; 
            padding: 30px;
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 16px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.1);
        }
        .stat-cell {
            padding: 30px 20px; 
            text-align: center;
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.03);
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .stat-cell::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,0.5), transparent);
            opacity: 0;
            transition: opacity 0.4s;
        }
        .stat-cell:hover { 
            transform: translateY(-5px);
            background: rgba(255,255,255,0.03);
            border-color: rgba(201,168,76,0.3);
            box-shadow: 0 10px 30px rgba(201,168,76,0.1);
        }
        .stat-cell:hover::before { opacity: 1; }
        .stat-num {
            font-size: 38px; 
            font-weight: 800; 
            margin-bottom: 8px; 
            font-family: var(--font);
            background: linear-gradient(135deg, #fff 0%, var(--gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 4px 20px rgba(201,168,76,0.3);
        }
        .stat-lbl { 
            font-size: 13px; 
            font-weight: 600; 
            color: rgba(255,255,255,0.5); 
            text-transform: uppercase; 
            letter-spacing: 1.5px; 
            transition: color 0.4s;
        }
        .stat-cell:hover .stat-lbl { color: var(--gold-light); }
        .scroll-cue {
            position:absolute; bottom:32px; left:50%; transform:translateX(-50%);
            display:flex; flex-direction:column; align-items:center; gap:8px;
            color:rgba(255,255,255,0.3); font-size:10px; letter-spacing:2px; text-transform:uppercase;
            animation:bob 2.5s ease-in-out infinite;
        }
        .scroll-cue-line { width:1px; height:40px; background:linear-gradient(to bottom, transparent, rgba(255,255,255,0.3)); }
        @keyframes bob { 0%,100%{transform:translateX(-50%) translateY(0);} 50%{transform:translateX(-50%) translateY(8px);} }

        /* ====== DIVIDER ====== */
        .ornament-divider {
            display:flex; align-items:center; gap:20px;
            margin-bottom:20px;
        }
        .ornament-divider::before, .ornament-divider::after {
            content:''; flex:1; height:1px; background:var(--border);
        }
        .ornament-diamond {
            width:8px; height:8px;
            background:var(--gold);
            transform:rotate(45deg);
        }

        /* ====== SECTION BASE ====== */
        section { padding:100px 6%; }
        .sec-inner { max-width:1200px; margin:0 auto; }
        .sec-kicker {
            font-size:11px; font-weight:700; letter-spacing:2.5px;
            text-transform:uppercase; color:var(--green-mid);
            display:flex; align-items:center; gap:12px; margin-bottom:12px;
        }
        .sec-kicker::before { content:''; width:32px; height:2px; background:var(--gold); }
        .sec-title {
            font-family: var(--font);
            font-size:clamp(26px,3.2vw,42px);
            font-weight:700; color:var(--green-dark);
            line-height:1.25; margin-bottom:14px;
        }
        .sec-sub {
            font-size:16px; color:var(--text-sub);
            line-height:1.8; font-weight:300; max-width:560px;
            margin-bottom:56px;
        }

        /* ====== PROGRAM SECTION ====== */
        #program { background:var(--cream); }
        .prog-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
        .prog-card {
            background:var(--white);
            border:1px solid var(--border);
            border-radius: 12px;
            position:relative; overflow:hidden;
            display:flex; flex-direction:column;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .prog-card:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(0,66,37,0.1); }
        .prog-img-wrap {
            position: relative;
            width: 100%; height: 200px;
            overflow: hidden;
            background: #f8f9fa;
        }
        .prog-img { width: 100%; height: 100%; object-fit: cover; }
        .placeholder-img { object-fit: contain; padding: 30px; opacity: 0.2; }
        
        .prog-content { padding: 24px 24px 30px; flex-grow: 1; display: flex; flex-direction: column; }
        .prog-title {
            font-family: var(--font);
            font-size:18px; font-weight:700;
            color:var(--green-dark); margin-bottom:12px;
        }
        .prog-desc {
            font-size:14px; color:var(--text-sub);
            line-height:1.7; font-weight:400; margin-bottom: 24px;
        }
        .prog-link {
            display:inline-flex; align-items:center; gap:8px;
            margin-top:auto; font-size:13px; font-weight:600;
            color:var(--white); background: var(--green-mid);
            padding: 10px 20px; border-radius: 6px;
            text-decoration:none; align-self: flex-start;
            transition:background 0.2s;
        }
        .prog-link:hover { background:var(--green-dark); }
        .prog-link svg { width:16px; height:16px; stroke:currentColor; fill:none; transition:transform 0.2s; stroke-width: 2; }
        .prog-link:hover svg { transform:translateX(4px); }

        /* ====== BERITA SECTION ====== */
        #berita { background:var(--white); }
        .berita-header {
            display:flex; justify-content:space-between;
            align-items:flex-end; margin-bottom:44px;
        }
        .btn-green {
            display:inline-block;
            border:1px solid var(--green-dark);
            color:var(--green-dark);
            padding:10px 24px; border-radius:3px;
            font-size:13px; font-weight:600;
            letter-spacing:0.5px; text-decoration:none;
            text-transform:uppercase; transition:background 0.2s, color 0.2s;
        }
        .btn-green:hover { background:var(--green-dark); color:var(--white); }
        .berita-grid { display:grid; grid-template-columns:1.5fr 1fr; gap:2px; }
        .berita-main {
            position:relative; min-height:440px;
            display:flex; flex-direction:column; justify-content:flex-end;
            background:var(--green-dark); overflow:hidden;
        }
        .berita-main-bg {
            position:absolute; inset:0;
            background:linear-gradient(180deg, rgba(0,66,37,0.2) 0%, rgba(0,30,15,0.95) 80%),
                url('/sawah.jpg') center/cover;
        }
        .berita-main-body { position:relative; z-index:2; padding:36px; }
        .b-tag {
            display:inline-block;
            background:var(--gold); color:var(--green-dark);
            font-size:10px; font-weight:700;
            letter-spacing:1.5px; text-transform:uppercase;
            padding:4px 12px; margin-bottom:14px;
        }
        .berita-main-title {
            font-family: var(--font);
            font-size:22px; font-weight:600;
            color:var(--white); line-height:1.45; margin-bottom:10px;
        }
        .b-meta { font-size:12px; color:rgba(255,255,255,0.5); letter-spacing:0.3px; }
        .berita-side { display:flex; flex-direction:column; gap:2px; }
        .b-item {
            display:flex; gap:18px; align-items:flex-start;
            padding:22px; background:#fafafa;
            border:1px solid var(--border);
            transition:background 0.2s;
        }
        .b-item:hover { background:#f2f5f2; }
        .b-thumb {
            width:76px; height:76px; flex-shrink:0;
            border-radius:2px; overflow:hidden;
            background:linear-gradient(135deg, var(--green-mid), var(--green-dark));
        }
        .b-thumb img { width:100%; height:100%; object-fit:cover; }
        .b-cat {
            font-size:10px; font-weight:700;
            letter-spacing:1.5px; text-transform:uppercase;
            color:var(--green-mid); margin-bottom:5px;
        }
        .b-title {
            font-size:14px; font-weight:600;
            color:var(--text-main); line-height:1.5; margin-bottom:6px;
        }
        .b-date { font-size:12px; color:#999; }

        /* ====== CARA BERZAKAT ====== */
        #cara {
            background:var(--green-dark);
            position:relative; overflow:hidden;
        }
        #cara::before {
            content:''; position:absolute; inset:0;
            background-image:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='rgba(201,168,76,0.06)' stroke-width='0.8'%3E%3Crect x='10' y='10' width='40' height='40' transform='rotate(45 30 30)'/%3E%3Crect x='15' y='15' width='30' height='30'/%3E%3C/g%3E%3C/svg%3E");
            background-size:60px 60px;
        }
        #cara .sec-kicker { color:var(--gold-light); }
        #cara .sec-kicker::before { background:var(--gold); }
        #cara .sec-title { color:var(--white); }
        #cara .sec-sub { color:rgba(255,255,255,0.55); }
        .steps-row {
            display:grid; grid-template-columns:repeat(4,1fr); gap:2px;
            position:relative; z-index:1;
        }
        .step-cell {
            padding:40px 28px;
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.07);
            text-align:center;
            transition: background 0.3s;
        }
        .step-cell:hover { background:rgba(201,168,76,0.07); }
        .step-n {
            font-family: var(--font);
            font-size:52px; font-weight:700;
            color:rgba(201,168,76,0.15); line-height:1;
            margin-bottom:16px;
        }
        .step-ico {
            width:48px; height:48px;
            border:1px solid rgba(201,168,76,0.3);
            border-radius:4px; margin:0 auto 18px;
            display:flex; align-items:center; justify-content:center;
        }
        .step-ico svg { width:22px; height:22px; stroke:var(--gold-light); fill:none; stroke-width:1.5; }
        .step-t {
            font-family: var(--font);
            font-size:16px; font-weight:600;
            color:var(--white); margin-bottom:12px;
        }
        .step-d { font-size:13px; color:rgba(255,255,255,0.5); line-height:1.8; font-weight:300; }

        /* ====== CTA ====== */
        #cta { background:linear-gradient(135deg, #f0f7f2, var(--cream)); text-align:center; }
        .cta-inner { max-width:680px; margin:0 auto; }
        .cta-line { width:60px; height:2px; background:var(--gold); margin:0 auto 28px; }
        .cta-title {
            font-family: var(--font);
            font-size:clamp(26px,3vw,40px);
            font-weight:700; color:var(--green-dark); margin-bottom:16px;
        }
        .cta-desc { font-size:16px; color:var(--text-sub); line-height:1.85; font-weight:300; margin-bottom:36px; }
        .cta-row { display:flex; gap:14px; justify-content:center; }
        .btn-ghost {
            display:inline-block;
            border:1px solid rgba(0,66,37,0.3);
            color:var(--green-dark); padding:13px 28px; border-radius:3px;
            font-size:13px; font-weight:600; letter-spacing:0.4px; text-decoration:none;
            text-transform:uppercase; transition:background 0.2s, border-color 0.2s;
        }
        .btn-ghost:hover { background:rgba(0,66,37,0.06); }

        /* ====== FOOTER ====== */
        footer { background:#001c0e; color:rgba(255,255,255,0.55); padding:60px 6% 28px; }
        .foot-grid {
            display:grid; grid-template-columns:1.2fr 1fr 1fr 1fr; gap:40px;
            max-width:1200px; margin:0 auto;
            padding-bottom:40px;
            border-bottom:1px solid rgba(255,255,255,0.08);
            margin-bottom:24px;
        }
        .foot-brand { font-family: var(--font); font-size:15px; font-weight:700; color:var(--white); margin-bottom:12px; }
        .foot-desc { font-size:13px; line-height:1.8; font-weight:300; }
        .foot-h { font-size:11px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:rgba(255,255,255,0.8); margin-bottom:16px; }
        .foot-ul { list-style:none; display:flex; flex-direction:column; gap:10px; }
        .foot-ul a { color:rgba(255,255,255,0.45); text-decoration:none; font-size:13px; transition:color 0.2s; }
        .foot-ul a:hover { color:var(--gold-light); }
        .foot-bottom {
            max-width:1200px; margin:0 auto;
            display:flex; justify-content:space-between;
            font-size:12px; letter-spacing:0.3px;
        }
        .foot-bottom span { color:var(--gold-light); }

        /* ====== ANIMATIONS ====== */
        @keyframes fd-up { from{opacity:0;transform:translateY(28px);} to{opacity:1;transform:translateY(0);} }
        @keyframes fd-right { from{opacity:0;transform:translateX(36px);} to{opacity:1;transform:translateX(0);} }
        .reveal { opacity:0; transform:translateY(36px); transition:opacity 0.7s ease, transform 0.7s ease; }
        .reveal.visible { opacity:1; transform:translateY(0); }

        /* ====== RESPONSIVE (HP & TABLET) ====== */
        @media (max-width: 900px) {
            .hero-inner { grid-template-columns: 1fr; padding-top: 110px; text-align: center; }
            .hero-kicker { margin: 0 auto 24px; }
            .hero-desc { margin: 0 auto 30px; }
            .hero-acts { justify-content: center; }
            .stats-card { grid-template-columns: 1fr 1fr; padding: 24px; }
            
            .prog-grid { grid-template-columns: 1fr 1fr; }
            .berita-grid { grid-template-columns: 1fr; }
            .steps-row { grid-template-columns: 1fr 1fr; gap: 10px; }
            .step-cell { padding: 30px 20px; }
            
            .foot-grid { grid-template-columns: 1fr 1fr; gap: 30px; }
        }
        @media (max-width: 900px) {
            .nav-menu {
                position: absolute; top: 70px; left: 0; right: 0; background: rgba(255,255,255,0.98);
                backdrop-filter: blur(14px);
                flex-direction: column; padding: 20px 5%; gap: 20px;
                border-bottom: 1px solid rgba(0,66,37,0.1);
                box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
                display: none;
            }
            .nav-menu.active { display: flex; }
            .nav-links { flex-direction: column; gap: 20px; text-align: center; width: 100%; margin: 0; }
            .nav-links a.nav-btn { display: inline-block; width: 100%; text-align: center; }
            .menu-toggle { display: block; color: var(--green-dark); }
        }
        @media (max-width: 600px) {
            nav { padding: 15px 5%; }
            .nav-brand-title { font-size: 14px; }
            
            .hero-title { font-size: 32px; }
            .hero-acts { flex-direction: column; width: 100%; }
            .btn-gold, .btn-outline { width: 100%; text-align: center; }
            
            .stats-card { grid-template-columns: 1fr; gap: 10px; }
            
            .prog-grid { grid-template-columns: 1fr; }
            .steps-row { grid-template-columns: 1fr; }
            
            .b-item a { flex-direction: column; }
            .b-thumb { width: 100%; height: 180px; }
            
            .foot-grid { grid-template-columns: 1fr; text-align: center; }
            .foot-bottom { flex-direction: column; text-align: center; gap: 10px; }
            .cta-row { flex-direction: column; }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav id="site-nav">
        <a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}" class="nav-brand">
            @if($lembaga->foto_lembaga)
                <img id="nav-logo-img" src="{{ asset('storage/'.$lembaga->foto_lembaga) }}" alt="Logo {{ $info['nama'] }}" style="height: 60px; object-fit: contain; transition: height 0.3s;">
            @elseif($subdomain === 'upz')
                <img id="nav-logo-img" src="{{ asset('baznas.png') }}" alt="Logo Baznas" style="height: 40px; object-fit: contain; transition: height 0.3s;">
            @else
                <span class="nav-brand-title" style="color: var(--green-dark); font-size: 20px;">{{ $info['nama'] }}</span>
            @endif
        </a>
        <div class="nav-menu" id="navMenu">
            <ul class="nav-links">
                <li><a href="{{ route('lembaga.program.index', ['lembaga' => $subdomain]) }}" onclick="toggleMenu()">Program</a></li>
                <li><a href="{{ route('lembaga.berita.index', ['lembaga' => $subdomain]) }}" onclick="toggleMenu()">Berita</a></li>
                @if($subdomain === 'upz')
                <li><a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}#cara" onclick="toggleMenu()">Cara Berzakat</a></li>
                <li><a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}#cta" class="nav-btn" onclick="toggleMenu()">Bayar Zakat</a></li>
                @else
                <li><a href="{{ route('lembaga.beranda', ['lembaga' => $subdomain]) }}#cta" class="nav-btn" onclick="toggleMenu()">Hubungi Kami</a></li>
                @endif
            </ul>
        </div>
        <button class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle Menu">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </nav>

    {{-- HERO --}}
    <section id="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-geo"></div>
        <div class="hero-inner">
            <div class="hero-text">
                <h1 class="hero-title">
                    Selamat Datang di<br><em>{{ $info['nama'] }}</em>
                </h1>
                <p class="hero-desc">
                    {{ $info['deskripsi'] ?? 'Pusat informasi dan layanan publik '.$info['nama'].' Nagari Guguak.' }}
                </p>
                <div class="hero-acts">
                    @if($subdomain === 'upz')
                    <a href="#cta" class="btn-gold">Bayar Zakat Sekarang</a>
                    @else
                    <a href="#program" class="btn-gold">Lihat Program Kerja</a>
                    @endif
                    <a href="https://nagariguguak.id" class="btn-outline">Kembali ke Web Nagari</a>
                </div>

                @if(isset($lembaga->rekenings) && $lembaga->rekenings->count() > 0)
                <div class="hero-rekening" style="margin-top: 40px; max-width: 500px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 20px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.2); animation: fd-up 0.9s 0.4s ease both;">
                    <h3 style="font-size: 13px; color: var(--gold-light); margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Penyaluran Zakat / Donasi:</h3>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($lembaga->rekenings as $rek)
                        <div style="display: flex; align-items: center; justify-content: space-between; background: rgba(0,0,0,0.25); padding: 12px 16px; border-radius: 8px;">
                            <div>
                                <div style="font-weight: 700; color: #fff; font-size: 15px; font-family: monospace; letter-spacing: 0.5px;">{{ $rek->nomor_rekening }}</div>
                                <div style="font-size: 12px; color: rgba(255,255,255,0.7); margin-top: 4px;">{{ $rek->nama_bank }} - a.n {{ $rek->atas_nama }}</div>
                            </div>
                            <button onclick="navigator.clipboard.writeText('{{ $rek->nomor_rekening }}'); alert('Nomor rekening {{ $rek->nama_bank }} disalin!');" style="background: var(--gold); color: var(--green-dark); border: none; padding: 6px 14px; border-radius: 4px; font-weight: 700; font-size: 11px; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='var(--gold-light)'" onmouseout="this.style.background='var(--gold)'">SALIN</button>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="scroll-cue">
            <div class="scroll-cue-line"></div>
            <span>Scroll</span>
        </div>
    </section>

    {{-- PROGRAM --}}
    <section id="program">
        <div class="sec-inner">
            <div class="berita-header">
                <div class="reveal">
                    <div class="sec-kicker">Program Kerja</div>
                    <h2 class="sec-title" style="margin-bottom:12px">Zakat Tepat Sasaran,<br>Manfaat Nyata bagi Umat</h2>
                    <p class="sec-sub" style="margin-bottom:0">Setiap rupiah zakat disalurkan secara transparan melalui program terstruktur yang terukur dampaknya bagi masyarakat nagari.</p>
                </div>
                <a href="{{ route('lembaga.program.index', ['lembaga' => $subdomain]) }}" class="btn-green reveal" style="white-space:nowrap;">Lihat Semua Program</a>
            </div>
            <div class="prog-grid">
                @forelse($programs as $index => $program)
                <div class="prog-card reveal">
                    <div class="prog-img-wrap">
                        @if($program->foto)
                            <img src="{{ asset('storage/'.$program->foto) }}" alt="{{ $program->nama_program }}" class="prog-img">
                        @else
                            <img src="{{ asset('images/logo.png') }}" alt="{{ $program->nama_program }}" class="prog-img placeholder-img">
                        @endif
                    </div>
                    <div class="prog-content">
                        <div class="prog-title">{{ $program->nama_program }}</div>
                        <p class="prog-desc">{{ Str::limit($program->deskripsi, 100) }}</p>
                        <a href="{{ route('lembaga.program.show', ['lembaga' => $subdomain, 'program' => \Illuminate\Support\Str::slug($program->nama_program)]) }}" class="prog-link mt-auto">Lihat Selengkapnya <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
                    </div>
                </div>
                @empty
                <p style="grid-column: 1 / -1; text-align: center; color: var(--text-sub);">Belum ada program kerja yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- BERITA --}}
    <section id="berita">
        <div class="sec-inner">
            <div class="berita-header">
                <div class="reveal">
                    <div class="sec-kicker">Berita dan Kegiatan</div>
                    <h2 class="sec-title" style="margin-bottom:0">Informasi Terkini dari {{ $info['nama'] }}</h2>
                </div>
                <a href="{{ route('lembaga.berita.index', ['lembaga' => $subdomain]) }}" class="btn-green reveal">Lihat Semua Berita</a>
            </div>
            <div class="berita-grid">
                @if($beritas->count() > 0)
                    @php $mainBerita = $beritas->first(); @endphp
                    <div class="berita-main reveal">
                        <div class="berita-main-bg" {!! $mainBerita->foto ? 'style="background-image: url('.asset('storage/'.$mainBerita->foto).')"' : '' !!}></div>
                        <div class="berita-main-body">
                            <span class="b-tag">{{ $mainBerita->kategori }}</span>
                            <a href="{{ route('lembaga.berita.show', ['lembaga' => $subdomain, 'berita' => \Illuminate\Support\Str::slug($mainBerita->judul)]) }}" style="text-decoration: none;">
                                <h3 class="berita-main-title hover:underline">{{ $mainBerita->judul }}</h3>
                            </a>
                            <p class="b-meta">{{ optional($mainBerita->tanggal_tayang)->translatedFormat('d F Y') }} &nbsp;&middot;&nbsp; {{ $mainBerita->penulis ?? 'Admin' }}</p>
                        </div>
                    </div>
                    <div class="berita-side">
                        @foreach($beritas->skip(1)->take(3) as $sideBerita)
                        <div class="b-item reveal">
                            <a href="{{ route('lembaga.berita.show', ['lembaga' => $subdomain, 'berita' => \Illuminate\Support\Str::slug($sideBerita->judul)]) }}" class="flex gap-[18px] w-full" style="text-decoration:none;">
                                <div class="b-thumb" style="background:linear-gradient(135deg,#e0f2f1,#4db6ac);">
                                    @if($sideBerita->foto)
                                        <img src="{{ asset('storage/'.$sideBerita->foto) }}" alt="" style="width:100%; height:100%; object-fit:cover;">
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="b-cat">{{ $sideBerita->kategori }}</div>
                                    <div class="b-title hover:underline">{{ $sideBerita->judul }}</div>
                                    <div class="b-date">{{ optional($sideBerita->tanggal_tayang)->translatedFormat('d F Y') ?: 'Belum ditentukan' }}</div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p style="grid-column: 1 / -1; text-align: center; color: var(--text-sub);">Belum ada berita yang dipublikasikan.</p>
                @endif
            </div>
        </div>
    </section>

    {{-- CARA BERZAKAT (KHUSUS UPZ) --}}
    @if($subdomain === 'upz')
    <section id="cara">
        <div class="sec-inner">
            <div class="sec-kicker reveal">Panduan Berzakat</div>
            <h2 class="sec-title reveal">Empat Langkah Mudah<br>Menunaikan Zakat</h2>
            <p class="sec-sub reveal">Proses pembayaran zakat yang cepat, aman, dan transparan. Anda dapat menunaikannya secara langsung maupun melalui petugas kami.</p>
            <div class="steps-row">
                <div class="step-cell reveal">
                    <div class="step-n">01</div>
                    <div class="step-ico">
                        <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                    </div>
                    <div class="step-t">Hitung Zakat Anda</div>
                    <p class="step-d">Gunakan panduan atau kalkulator zakat untuk mengetahui jumlah kewajiban zakat Anda secara tepat.</p>
                </div>
                <div class="step-cell reveal">
                    <div class="step-n">02</div>
                    <div class="step-ico">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <div class="step-t">Isi Formulir Muzakki</div>
                    <p class="step-d">Lengkapi formulir identitas Anda sebagai pemberi zakat untuk keperluan pencatatan dan bukti resmi.</p>
                </div>
                <div class="step-cell reveal">
                    <div class="step-n">03</div>
                    <div class="step-ico">
                        <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                    </div>
                    <div class="step-t">Lakukan Pembayaran</div>
                    <p class="step-d">Transfer ke rekening resmi UPZ atau serahkan langsung kepada petugas amil kami di kantor nagari.</p>
                </div>
                <div class="step-cell reveal">
                    <div class="step-n">04</div>
                    <div class="step-ico">
                        <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="step-t">Terima Bukti Resmi</div>
                    <p class="step-d">Dapatkan tanda bukti penerimaan zakat resmi yang sah sebagai dokumentasi ibadah dan laporan keuangan.</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- CTA --}}
    <section id="cta">
        <div class="cta-inner">
            <div class="cta-line reveal"></div>
            @if($subdomain === 'upz')
            <h2 class="cta-title reveal">Tunaikan Zakatmu,<br>Berkahkan Hartamu</h2>
            <p class="cta-desc reveal">Zakat bukan sekadar kewajiban, melainkan investasi terbaik untuk keberkahan hidup Anda dan kesejahteraan sesama. Percayakan kepada kami.</p>
            <div class="cta-row reveal">
                <a href="{{ route('lembaga.bayar-zakat', ['lembaga' => $subdomain]) }}" class="btn-gold">Bayar Zakat Sekarang</a>
                <a href="https://nagariguguak.id" class="btn-ghost">Kembali ke Portal Nagari</a>
            </div>
            @else
            <h2 class="cta-title reveal">Mari Berkolaborasi Bersama<br>{{ $info['nama'] }}</h2>
            <p class="cta-desc reveal">Hubungi kami untuk informasi lebih lanjut mengenai program kerja dan kegiatan yang sedang berlangsung di Nagari Guguak.</p>
            <div class="cta-row reveal">
                <a href="https://nagariguguak.id/kontak" class="btn-gold">Hubungi Kami</a>
                <a href="https://nagariguguak.id" class="btn-ghost">Kembali ke Portal Nagari</a>
            </div>
            @endif
        </div>
    </section>

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
                    <li><a href="#program">Program Kerja</a></li>
                    <li><a href="#berita">Berita Kegiatan</a></li>
                    @if($subdomain === 'upz')
                    <li><a href="#cara">Cara Berzakat</a></li>
                    @endif
                </ul>
            </div>
            <div>
                <div class="foot-h">Informasi</div>
                <ul class="foot-ul">
                    <li><a href="#">Laporan Keuangan</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="https://nagariguguak.id">Portal Nagari Guguak</a></li>
                </ul>
            </div>
            <div>
                <div class="foot-h">Kontak</div>
                <ul class="foot-ul">
                    <li><a href="#">Nagari Guguak, Kab. Sijunjung</a></li>
                    <li><a href="#">Sumatera Barat, Indonesia</a></li>
                    <li><a href="#">{{ strtolower($subdomain) }}@nagariguguak.id</a></li>
                </ul>
            </div>
        </div>
        <div class="foot-bottom">
            <p>&copy; 2025 <span>{{ $info['nama'] }} Nagari Guguak</span>. Bagian dari ekosistem digital Nagari Guguak.</p>
            <div style="display: flex; align-items: center; gap: 16px;">
                <p>Dikelola oleh Pemerintah Nagari Guguak.</p>
                <a href="{{ route('lembaga.admin', ['lembaga' => $subdomain]) }}" style="padding: 4px 12px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: var(--white); border-radius: 4px; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">Login Admin</a>
            </div>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            document.getElementById('navMenu').classList.toggle('active');
        }

        const reveals = document.querySelectorAll('.reveal');
        const obs = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 75);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });
        reveals.forEach(el => obs.observe(el));

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
