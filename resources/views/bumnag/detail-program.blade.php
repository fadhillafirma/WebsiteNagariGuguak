@extends('bumnag.layout')
@section('title', $program->nama_program . ' - BUMNag Nagari Guguak')
@section('extra_css')
<style>
    .article-container { max-width: 900px; margin: 0 auto; padding: 40px 5%; }
    .article-header { margin-bottom: 30px; text-align: center; }
    .article-kategori { display: inline-block; background: var(--orange-main); color: #fff; font-size: 12px; font-weight: 700; padding: 6px 12px; border-radius: 4px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; }
    .article-title { font-family: var(--font-serif); font-size: 42px; font-weight: 700; color: var(--black-text); line-height: 1.3; margin-bottom: 20px; letter-spacing: -1px; }
    
    .article-cover { width: 100%; max-height: 550px; object-fit: cover; border-radius: 16px; margin-bottom: 40px; box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
    
    .article-body { max-width: 760px; margin: 0 auto; font-size: 19px; line-height: 1.8; color: #333; }
    .article-body p { margin-bottom: 28px; }
    .article-body h2, .article-body h3 { font-family: var(--font-serif); color: var(--black-text); margin: 50px 0 24px; font-weight: 700; }
    
    /* Global img style inside content (untuk gambar dari summernote) */
    .article-body img { max-width: 100% !important; height: auto !important; border-radius: 8px; margin: 30px auto; display: block; float: none !important; }
    
    .btn-back { display: inline-flex; align-items: center; gap: 8px; color: #666; font-weight: 600; text-decoration: none; margin-bottom: 40px; font-size: 15px; transition: color 0.2s; }
    .btn-back:hover { color: var(--orange-main); }
    
    .prog-details { background: var(--gray-light); padding: 35px; border-radius: 16px; margin-top: 50px; border-left: 6px solid var(--orange-main); box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
    .prog-details h3 { margin-top: 0; margin-bottom: 20px; color: var(--black-text); font-family: var(--font-sans); font-size: 20px; }
    
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
        <a href="{{ route('lembaga.program.index', ['lembaga' => 'bumnag']) }}" class="btn-back">&larr; Kembali ke Daftar Program</a>
        <div class="article-header">
            <span class="article-kategori">{{ $program->kategori ?: 'Layanan' }}</span>
            <h1 class="article-title">{{ $program->nama_program }}</h1>
        </div>
    </div>
</div>

<div class="main-content" style="padding-top: -40px; margin-top: -60px;">
    <div class="article-container" style="background: #fff; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.05); padding: 40px 6%;">
        @if($program->foto)
            <img src="{{ asset('storage/'.$program->foto) }}" alt="{{ $program->nama_program }}" class="article-cover">
        @endif
        
        <div class="article-body">
            {!! nl2br(e($program->deskripsi)) !!}
            
            @if($program->penerima_manfaat || $program->alokasi_dana)
            <div class="prog-details">
                <h3>Detail Pelaksanaan Program</h3>
                @if($program->penerima_manfaat)
                <p style="margin-bottom: 15px; font-size: 16px;"><strong>Penerima Manfaat:</strong><br>{{ $program->penerima_manfaat }}</p>
                @endif
                @if($program->alokasi_dana)
                <p style="margin-bottom: 0; font-size: 16px;"><strong>Alokasi Dana:</strong><br>Rp {{ number_format($program->alokasi_dana, 0, ',', '.') }}</p>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
