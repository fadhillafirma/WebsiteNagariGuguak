@extends('layouts.app') {{-- Atau layout sesuai yang kamu pakai --}}

@section('content')
<div class="container py-5">
    <h1 class="mb-3">{{ $data->judul }}</h1>
    <p class="text-muted">{{ $tipe }} | {{ $data->updated_at->format('d M Y') }}</p>

    @if ($data->foto)
        <img src="{{ asset('storage/' . $data->foto) }}" class="img-fluid my-3" alt="{{ $data->judul }}">
    @endif

    <div class="content">
        {!! nl2br(e($data->deskripsi)) !!}
    </div>
</div>
@endsection
