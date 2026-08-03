@extends('bumnag.layout')
@section('title', $berita->judul . ' - BUMNag Nagari Guguak')
@section('extra_css')
<style>
    .article-container { max-width: 900px; margin: 0 auto; padding: 40px 5%; }
    .article-header { margin-bottom: 30px; text-align: center; }
    .article-kategori { display: inline-block; background: var(--orange-main); color: #fff; font-size: 12px; font-weight: 700; padding: 6px 12px; border-radius: 4px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; }
    .article-title { font-family: var(--font-serif); font-size: 42px; font-weight: 700; color: var(--black-text); line-height: 1.3; margin-bottom: 20px; letter-spacing: -1px; }
    .article-meta { display: flex; justify-content: center; align-items: center; gap: 20px; font-size: 14px; color: #666; font-weight: 500; }
    .article-meta span { display: flex; align-items: center; gap: 6px; }
    
    .article-cover { width: 100%; max-height: 550px; object-fit: cover; border-radius: 16px; margin-bottom: 40px; box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
    
    .article-body { max-width: 760px; margin: 0 auto; font-size: 19px; line-height: 1.8; color: #333; }
    .article-body p { margin-bottom: 28px; }
    .article-body h2, .article-body h3 { font-family: var(--font-serif); color: var(--black-text); margin: 50px 0 24px; font-weight: 700; }
    
    /* Global img style inside content (untuk gambar dari summernote) */
    .article-body img { max-width: 100% !important; height: auto !important; border-radius: 8px; margin: 30px auto; display: block; float: none !important; }
    
    .btn-back { display: inline-flex; align-items: center; gap: 8px; color: #666; font-weight: 600; text-decoration: none; margin-bottom: 40px; font-size: 15px; transition: color 0.2s; }
    .btn-back:hover { color: var(--orange-main); }
    
    @media(max-width: 900px){ 
        .article-title { font-size: 32px; }
        .article-cover { max-height: 350px; border-radius: 10px; }
        .article-body { font-size: 17px; }
    }
</style>
@endsection

@section('content')
<div style="background: var(--gray-light); padding-top: 120px; padding-bottom: 60px;">
    <div class="article-container" style="padding-top: 0; padding-bottom: 0;">
        <a href="{{ route('lembaga.berita.index', ['lembaga' => 'bumnag']) }}" class="btn-back">&larr; Kembali ke Daftar Berita</a>
        <div class="article-header">
            <span class="article-kategori">{{ $berita->kategori }}</span>
            <h1 class="article-title">{{ $berita->judul }}</h1>
            <div class="article-meta">
                <span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ optional($berita->tanggal_tayang)->format('d F Y') ?: $berita->created_at->format('d F Y') }}
                </span>
                <span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Oleh {{ $berita->penulis ?: 'Admin BUMNag' }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="main-content" style="padding-top: -40px; margin-top: -60px;">
    <div class="article-container" style="background: #fff; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.05); padding: 40px 6%;">
        @if($berita->foto)
            <img src="{{ asset('storage/'.$berita->foto) }}" alt="{{ $berita->judul }}" class="article-cover">
        @endif
        
        <div class="article-body">
            {!! $berita->isi_berita !!}
        </div>
    </div>
</div>
@endsection
