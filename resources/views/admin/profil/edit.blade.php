@extends('layout.sidebar')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h2 class="text-xl font-bold mb-4">Edit Profil</h2>

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border rounded p-2">
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border rounded p-2">
            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <hr class="my-4">

        <div class="mb-4">
            <label class="block text-gray-700">Password Baru (Opsional)</label>
            <input type="password" name="password" class="w-full border rounded p-2">
            @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>

        <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
