@extends('layout.sidebar')

@section('title', 'Dashboard')

@section('content')
    <div class="p-6 space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Superadmin</h1>
            <p class="text-gray-500">Selamat datang, {{ auth()->user()->name }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center space-x-4">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Lembaga</p>
                    <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Lembaga::count() }}</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center space-x-4">
                <div class="p-3 bg-green-100 text-green-600 rounded-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3L22 4"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Publikasi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Publikasi::count() }}</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center space-x-4">
                <div class="p-3 bg-yellow-100 text-yellow-600 rounded-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Jorong</p>
                    <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Jorong::count() }}</p>
                </div>
            </div>
            
            <!-- Card 4 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center space-x-4">
                <div class="p-3 bg-purple-100 text-purple-600 rounded-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Galeri Foto</p>
                    <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Galeri::count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Aktivitas Cepat</h2>
            <div class="flex gap-4">
                <a href="{{ route('publikasi.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tulis Berita Baru</a>
                <a href="{{ route('lembaga.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Tambah Lembaga</a>
            </div>
        </div>
    </div>
@endsection
