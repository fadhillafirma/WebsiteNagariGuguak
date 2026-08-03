@extends('bumnag.layout')
@section('title', 'Tugas Pokok - BUMNag Nagari Guguak')
@section('extra_css')
<style>
    .tugas-list { display: flex; flex-direction: column; gap: 40px; margin-top: 40px; }
    .tugas-item {
        background: var(--gray-light);
        padding: 40px;
        border-left: 4px solid var(--orange-main);
    }
    .tugas-item h3 { font-family: var(--font-serif); font-size: 28px; font-weight: 500; margin-bottom: 16px; color: var(--black-text); }
    .tugas-item p { color: #444; font-size: 18px; line-height: 1.8; margin-bottom: 0; }
    @media(max-width: 900px){ .tugas-item { padding: 24px; } .tugas-item h3 { font-size: 24px; } }
</style>
@endsection

@section('content')
<header class="page-header">
    <h1 class="page-title">Tugas Pokok</h1>
    <p class="page-desc">Tugas, fungsi, dan peranan utama Badan Usaha Milik Nagari (BUMNag) Guguak dalam memajukan perekonomian desa secara berkelanjutan.</p>
</header>

<div class="main-content">
    <div class="tugas-list">
        @forelse($tugas as $t)
        <div class="tugas-item">
            <h3>{{ $t->judul }}</h3>
            <p>{{ $t->deskripsi }}</p>
        </div>
        @empty
        <p>Belum ada data tugas pokok yang dipublikasikan.</p>
        @endforelse
    </div>
</div>
@endsection
