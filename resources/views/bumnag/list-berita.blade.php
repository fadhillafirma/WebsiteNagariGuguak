@extends('bumnag.layout')
@section('title', 'Insights - BUMNag Nagari Guguak')
@section('extra_css')
<style>
    .berita-list { display: flex; flex-direction: column; gap: 0; }
    .berita-item {
        display: grid; grid-template-columns: 250px 1fr; gap: 40px;
        padding: 50px 0; border-bottom: 1px solid var(--border);
        align-items: center;
    }
    .berita-item:first-child { padding-top: 0; }
    .berita-date { font-family: var(--font-serif); font-size: 28px; color: var(--orange-main); font-weight: 500; display:flex; flex-direction:column; }
    .berita-date small { font-size: 14px; font-family: var(--font-sans); color: #888; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 8px; }
    .berita-content h3 { font-family: var(--font-serif); font-size: 32px; font-weight: 500; margin-bottom: 16px; line-height: 1.3; }
    .berita-content p { color: #555; font-size: 18px; line-height: 1.6; margin-bottom: 24px; max-width: 800px; }
    .berita-link { color: var(--orange-main); font-weight: 600; text-decoration: none; border-bottom: 1px solid transparent; padding-bottom: 2px; }
    .berita-link:hover { border-color: var(--orange-main); }
    @media(max-width: 900px){ .berita-item { grid-template-columns: 1fr; gap: 16px; padding: 30px 0; } .berita-content h3 { font-size: 24px; } }
</style>
@endsection

@section('content')
<header class="page-header">
    <h1 class="page-title">Warta & Informasi</h1>
    <p class="page-desc">Berita terbaru, laporan mendetail, dan wawasan dari kegiatan terkini serta riset ekonomi kami.</p>
</header>

<div class="main-content">
    <div class="berita-list">
        @forelse($beritas as $berita)
        <div class="berita-item">
            <div class="berita-date">
                <small>{{ $berita->kategori }}</small>
                {{ optional($berita->tanggal_tayang)->format('M d, Y') ?: 'Terbaru' }}
            </div>
            <div class="berita-content">
                <h3>{{ $berita->judul }}</h3>
                <p>{{ Str::limit(strip_tags($berita->isi_berita), 200) }}</p>
                <a href="{{ route('lembaga.berita.show', ['lembaga' => 'bumnag', 'berita' => Str::slug($berita->judul)]) }}" class="berita-link">
                    Baca Selengkapnya &rarr;
                </a>
            </div>
        </div>
        @empty
        <p>Belum ada berita yang dipublikasikan.</p>
        @endforelse
    </div>
</div>
@endsection
