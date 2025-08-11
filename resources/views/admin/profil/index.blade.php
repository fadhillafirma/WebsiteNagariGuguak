@extends('layout.sidebar')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h2 class="text-xl font-bold mb-4">Profil Saya</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <a href="{{ route('profile.edit') }}"
       class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
       Edit Profil
    </a>
</div>
@endsection
