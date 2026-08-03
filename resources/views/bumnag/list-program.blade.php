@extends('bumnag.layout')
@section('title', 'Services - BUMNag Nagari Guguak')
@section('extra_css')
<style>
    .prog-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    .prog-card {
        background: var(--gray-light);
        display: flex; flex-direction: column;
        transition: background 0.3s;
        text-decoration: none; color: inherit;
    }
    .prog-card:hover { background: #e0e0e0; }
    .prog-img { height: 240px; width: 100%; background: #ddd; }
    .prog-img img { width: 100%; height: 100%; object-fit: cover; }
    .prog-body { padding: 30px; flex-grow: 1; display: flex; flex-direction: column; }
    .prog-cat { color: var(--black-text); font-size: 13px; font-weight: 700; text-transform: uppercase; margin-bottom: 12px; border-bottom: 2px solid var(--orange-main); display: inline-block; padding-bottom: 4px; align-self: flex-start; }
    .prog-title { font-family: var(--font-serif); font-size: 24px; font-weight: 500; margin-bottom: 16px; line-height: 1.3; }
    .prog-desc { color: #555; font-size: 16px; line-height: 1.6; }
    @media(max-width: 900px){ .prog-grid { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
<header class="page-header">
    <h1 class="page-title">Program & Layanan</h1>
    <p class="page-desc">Jelajahi berbagai program strategis dan layanan unggulan yang dirancang untuk memajukan perekonomian Nagari Guguak.</p>
</header>

<div class="main-content">
    <div class="prog-grid">
        @forelse($programs as $program)
        <a href="{{ route('lembaga.program.show', ['lembaga' => 'bumnag', 'program' => Str::slug($program->nama_program)]) }}" class="prog-card">
            <div class="prog-img">
                @if($program->foto)
                    <img src="{{ asset('storage/'.$program->foto) }}" alt="{{ $program->nama_program }}">
                @else
                    <img src="{{ asset('images/logo.png') }}" style="object-fit:contain; padding:40px; opacity:0.1; background:#fff;" alt="">
                @endif
            </div>
            <div class="prog-body">
                <span class="prog-cat">{{ $program->kategori ?: 'Layanan' }}</span>
                <h3 class="prog-title">{{ $program->nama_program }}</h3>
                <p class="prog-desc">{{ Str::limit($program->deskripsi, 120) }}</p>
            </div>
        </a>
        @empty
        <p style="grid-column: 1/-1;">Belum ada program kerja yang ditambahkan.</p>
        @endforelse
    </div>
</div>
@endsection
