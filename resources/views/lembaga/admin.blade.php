<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ $info['nama'] }}</title>
    @if(isset($lembaga) && $lembaga->foto_lembaga)
        <link rel="icon" type="image/png" href="{{ asset('storage/'.$lembaga->foto_lembaga) }}" />
    @elseif(isset($subdomain) && $subdomain === 'upz')
        <link rel="icon" type="image/png" href="{{ asset('baznas.png') }}" />
    @else
        <link rel="icon" type="image/png" href="{{ asset('logo_bpd.png') }}" />
    @endif

    <!-- Tailwind CSS CDN Fallback -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" type="image/png" href="/logo.png" />
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
        /* Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-[#f8fafc] font-sans antialiased text-slate-800 selection:bg-brand-500 selection:text-white">

<div class="flex min-h-screen" x-data="{ 
    activeTab: '{{ request('tab', isset($editRekening) && $editRekening ? 'rekening' : (isset($editTugas) && $editTugas ? 'tugas' : (isset($editBerita) && $editBerita ? 'berita' : (isset($editProgram) && $editProgram ? 'program' : 'dashboard')))) }}',
    showProgramForm: {{ $editProgram ? 'true' : 'false' }},
    showBeritaForm: {{ $editBerita ? 'true' : 'false' }},
    showProfilEditForm: false,
    viewProgramModal: null,
    viewBeritaModal: null
}">

    <!-- SIDEBAR FORMAL & CLEAN -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col h-screen sticky top-0 z-30 transition-all">
        <!-- Sidebar Header -->
        <div class="p-6 border-b border-slate-100 flex items-center gap-3">
            <div>
                <h1 class="text-sm font-bold text-slate-900 tracking-tight leading-tight uppercase">Admin Panel</h1>
                <p class="text-[11px] font-medium text-slate-500 truncate max-w-[130px]" title="{{ $lembaga->nama_lembaga }}">{{ $lembaga->nama_lembaga }}</p>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 space-y-0.5">
            <!-- 1. Dashboard UPZ -->
            <button @click="activeTab = 'dashboard'; showProgramForm = false; showBeritaForm = false" 
               :class="activeTab === 'dashboard' ? 'bg-brand-50/60 text-brand-700 border-r-4 border-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-r-4 border-transparent'"
               class="w-full flex items-center gap-x-3 py-3 px-6 text-sm transition-all duration-200 text-left group">
                <svg class="w-5 h-5 flex-shrink-0 transition-colors" :class="activeTab === 'dashboard' ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m-4 4h8"/>
                </svg>
                <span>Dashboard Utama</span>
            </button>

            <!-- 2. Program UPZ -->
            <button @click="activeTab = 'program'; if(!{{ $editProgram ? 'true' : 'false' }}) showProgramForm = false" 
               :class="activeTab === 'program' ? 'bg-brand-50/60 text-brand-700 border-r-4 border-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-r-4 border-transparent'"
               class="w-full flex items-center gap-x-3 py-3 px-6 text-sm transition-all duration-200 text-left group">
                <svg class="w-5 h-5 flex-shrink-0 transition-colors" :class="activeTab === 'program' ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span>Kelola Program</span>
            </button>

            @if($subdomain === 'upz')
            <!-- Kelola Rekening Tab -->
            <button @click="activeTab = 'rekening'"
               :class="activeTab === 'rekening' ? 'bg-brand-50/60 text-brand-700 border-r-4 border-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-r-4 border-transparent'"
               class="w-full flex items-center gap-x-3 py-3 px-6 text-sm transition-all duration-200 text-left group">
                <svg class="w-5 h-5 flex-shrink-0 transition-colors" :class="activeTab === 'rekening' ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                <span>Kelola Rekening</span>
            </button>
            @endif

            <!-- 3. Berita & Publikasi UPZ -->
            <button @click="activeTab = 'berita'; if(!{{ $editBerita ? 'true' : 'false' }}) showBeritaForm = false" 
               :class="activeTab === 'berita' ? 'bg-brand-50/60 text-brand-700 border-r-4 border-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-r-4 border-transparent'"
               class="w-full flex items-center gap-x-3 py-3 px-6 text-sm transition-all duration-200 text-left group">
                <svg class="w-5 h-5 flex-shrink-0 transition-colors" :class="activeTab === 'berita' ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <span>Warta Publikasi</span>
            </button>

            <!-- 4. Profil UPZ -->
            <button @click="activeTab = 'profil'" 
               :class="activeTab === 'profil' ? 'bg-brand-50/60 text-brand-700 border-r-4 border-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-r-4 border-transparent'"
               class="w-full flex items-center gap-x-3 py-3 px-6 text-sm transition-all duration-200 text-left group">
                <svg class="w-5 h-5 flex-shrink-0 transition-colors" :class="activeTab === 'profil' ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>Profil Lembaga</span>
            </button>

            <div class="pt-6 pb-2 px-6">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akses Eksternal</p>
            </div>

            <!-- Lihat Website UPZ -->
            <a href="/" target="_blank"
               class="flex items-center gap-x-3 py-2.5 px-6 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all group">
                <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span>Lihat Website UPZ</span>
            </a>
        </nav>

        <!-- Sidebar Footer / Admin Info -->
        <div class="p-5 border-t border-slate-100 bg-white">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 text-slate-600 flex items-center justify-center font-bold text-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div class="flex-1 truncate">
                    <p class="text-xs font-semibold text-slate-800 truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <p class="text-[10px] text-slate-500 font-medium truncate">{{ Auth::user()->email ?? '' }}</p>
                </div>
                <form method="POST" action="{{ route('lembaga.logout', ['lembaga' => $subdomain]) }}">
                    @csrf
                    <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-700 flex items-center justify-center transition-colors" title="Logout">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 p-6 md:p-10 overflow-y-auto">
        <div class="max-w-6xl mx-auto space-y-8">

            <!-- Alert Notifications (Refined) -->
            @if(session('success'))
                <div class="p-4 rounded-xl bg-brand-50 border border-brand-200 text-brand-800 text-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
                    <div class="flex items-center gap-2 mb-2 font-semibold">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        <span>Terdapat kesalahan pada input Anda:</span>
                    </div>
                    <ul class="list-disc list-inside pl-7 space-y-1 text-xs text-red-700">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- TAB 1: DASHBOARD OVERVIEW UPZ -->
            <div x-show="activeTab === 'dashboard'" x-cloak class="space-y-6">
                <!-- Premium Formal Hero Banner -->
                <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-brand-900 rounded-xl p-8 md:p-12 text-white border border-slate-800 shadow-sm">
                    <div class="relative z-10 space-y-4">
                      
                        <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-white leading-tight">
                            <br>
                            <span class="text-brand-300">{{ $lembaga->nama_lembaga }}</span>
                        </h1>
                        <p class="text-slate-300 text-sm md:text-base max-w-2xl leading-relaxed font-light">
                            Platform pengelolaan administrasi penyaluran zakat, infak, dan sedekah, serta pusat publikasi transparansi warta lembaga secara profesional dan akuntabel.
                        </p>
                    </div>
                    <!-- Subtle geometric background elements instead of blurry blobs -->
                    <div class="absolute right-0 top-0 w-1/2 h-full opacity-10 pointer-events-none" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 24px 24px;"></div>
                    <div class="absolute -right-20 -bottom-20 w-96 h-96 border-[1px] border-white/5 rounded-full pointer-events-none"></div>
                    <div class="absolute right-10 -bottom-10 w-64 h-64 border-[1px] border-white/10 rounded-full pointer-events-none"></div>
                </div>

                <!-- Stat Cards (Formal & Structured) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 bg-slate-50 text-slate-600 rounded-lg border border-slate-100 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <span class="px-2.5 py-1 bg-green-50 text-green-700 border border-green-200/60 rounded-md text-[10px] font-bold uppercase tracking-wider">Kepengurusan</span>
                        </div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Ketua UPZ</p>
                        <p class="text-lg font-bold text-slate-900">{{ $lembaga->nama_ketua ?: 'Belum Ditetapkan' }}</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 bg-slate-50 text-slate-600 rounded-lg border border-slate-100 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-700 border border-blue-200/60 rounded-md text-[10px] font-bold uppercase tracking-wider">Rekapitulasi</span>
                        </div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Program Bantuan</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $programs->count() }} <span class="text-sm font-normal text-slate-500">Program</span></p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 bg-slate-50 text-slate-600 rounded-lg border border-slate-100 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                            <span class="px-2.5 py-1 bg-purple-50 text-purple-700 border border-purple-200/60 rounded-md text-[10px] font-bold uppercase tracking-wider">Transparansi</span>
                        </div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Warta Publikasi</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $beritas->count() }} <span class="text-sm font-normal text-slate-500">Berita</span></p>
                    </div>
                </div>

                <!-- Quick Action Card (Formal) -->
                <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-5">
                    <div class="space-y-1">
                        <h3 class="text-base font-bold text-slate-900">Aksi Administratif</h3>
                        <p class="text-xs text-slate-500">Kelola entri data baru untuk program penyaluran atau publikasi lembaga.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <button @click="activeTab = 'program'; showProgramForm = true" class="px-4 py-2.5 rounded-lg text-white bg-slate-900 hover:bg-slate-800 font-medium text-xs transition-colors inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Data Program
                        </button>
                        <button @click="activeTab = 'berita'; showBeritaForm = true" class="px-4 py-2.5 rounded-lg text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 font-medium text-xs transition-colors inline-flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Warta Publikasi
                        </button>
                    </div>
                </div>
            </div>

            <!-- TAB 2: DATA PROGRAM UPZ -->
            <div x-show="activeTab === 'program'" x-cloak class="space-y-6">

                <!-- FORM TAMBAH / EDIT PROGRAM -->
                <div x-show="showProgramForm" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8 max-w-4xl mx-auto space-y-6">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">
                                {{ $editProgram ? 'Ubah Data Program' : 'Entri Program Baru' }}
                            </h2>
                            <p class="text-xs text-slate-500 mt-1">Lengkapi formulir di bawah ini dengan data yang valid.</p>
                        </div>
                        @if($editProgram)
                            <a href="{{ route('lembaga.admin', ['lembaga' => $subdomain]) }}?tab=program" class="px-4 py-2 text-xs font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-lg transition inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg> Kembali
                            </a>
                        @else
                            <button type="button" @click="showProgramForm = false" class="px-4 py-2 text-xs font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-lg transition inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg> Kembali
                            </button>
                        @endif
                    </div>

                    <form action="{{ $editProgram ? route('lembaga.program.update', ['lembaga' => $subdomain, 'program' => $editProgram->id]) : route('lembaga.program.store', ['lembaga' => $subdomain]) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @if($editProgram) @method('PUT') @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Program <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_program" value="{{ old('nama_program', $editProgram->nama_program ?? '') }}" required placeholder="Contoh: Bantuan Sembako Fakir Miskin" class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kategori Program</label>
                                <input type="text" name="kategori" value="{{ old('kategori', $editProgram->kategori ?? '') }}" placeholder="Pendidikan / Kesehatan / Ekonomi" class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Penerima Manfaat</label>
                                <input type="text" name="penerima_manfaat" value="{{ old('penerima_manfaat', $editProgram->penerima_manfaat ?? '') }}" placeholder="Contoh: 50 KK" class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">
                            </div>

                            <div x-data="{ withDana: {{ old('alokasi_dana', $editProgram->alokasi_dana ?? '') ? 'true' : 'false' }} }">
                                <div class="flex items-center justify-between mb-1.5">
                                    <label class="block text-xs font-semibold text-slate-700">Alokasi Dana (Rp)</label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" x-model="withDana" class="sr-only peer">
                                        <div class="relative w-8 h-4 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-brand-600"></div>
                                        <span class="ms-2 text-[10px] font-bold text-gray-500 uppercase">Ada Dana?</span>
                                    </label>
                                </div>
                                <input type="hidden" name="alokasi_dana" value="">
                                <input x-show="withDana" x-bind:disabled="!withDana" type="number" name="alokasi_dana" min="0" value="{{ old('alokasi_dana', $editProgram->alokasi_dana ?? '') }}" placeholder="Nominal alokasi (cth: 15000000)" class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Pelaksanaan</label>
                                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', optional($editProgram->tanggal_mulai ?? null)->format('Y-m-d')) }}" class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status Program <span class="text-red-500">*</span></label>
                                <select name="status" required class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 bg-white transition">
                                    @foreach(['aktif' => 'Aktif', 'selesai' => 'Selesai', 'draf' => 'Draf'] as $val => $lbl)
                                        <option value="{{ $val }}" @selected(old('status', $editProgram->status ?? 'aktif') === $val)>{{ $lbl }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Deskripsi Lengkap Program</label>
                            <textarea name="deskripsi" rows="4" placeholder="Jelaskan detail pelaksanaan program secara formal..." class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">{{ old('deskripsi', $editProgram->deskripsi ?? '') }}</textarea>
                        </div>

                        {{-- FOTO UPLOAD PROGRAM --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Dokumentasi Foto Program</label>
                            @if($editProgram && $editProgram->foto)
                                <div class="mb-3 flex items-center gap-4">
                                    <img src="{{ asset('storage/'.$editProgram->foto) }}" alt="Foto Program" class="w-28 h-20 object-cover rounded-lg border border-slate-200 shadow-sm">
                                    <p class="text-xs text-slate-500">Foto saat ini. Upload baru untuk mengganti.</p>
                                </div>
                            @endif
                            <div class="relative">
                                <input type="file" name="foto" accept="image/*" class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition file:mr-4 file:py-1.5 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1.5">Format: JPG, PNG, WEBP. Maksimal 3MB.</p>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                            @if($editProgram)
                                <a href="{{ route('lembaga.admin', ['lembaga' => $subdomain]) }}?tab=program" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-lg transition">
                                    Batal
                                </a>
                            @else
                                <button type="button" @click="showProgramForm = false" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-lg transition">
                                    Batal
                                </button>
                            @endif

                            <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg transition">
                                {{ $editProgram ? 'Simpan Perubahan' : 'Simpan Data Program' }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- TABEL DATA PROGRAM -->
                <div x-show="!showProgramForm" class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Daftar Program</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Seluruh rekaman kegiatan dan program penyaluran UPZ.</p>
                        </div>
                        <button @click="showProgramForm = true" class="px-4 py-2.5 rounded-lg text-white bg-slate-900 hover:bg-slate-800 font-medium text-xs transition-colors inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Entri Program
                        </button>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                        @if($programs->count() === 0)
                            <div class="p-12 text-center">
                                <svg class="w-10 h-10 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                <p class="font-medium text-slate-900 text-sm">Tidak ada data program</p>
                                <p class="text-xs text-slate-500 mt-1">Data program yang ditambahkan akan muncul di tabel ini.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-slate-600">
                                    <thead class="text-[11px] text-slate-500 uppercase bg-slate-50 border-b border-slate-200 font-semibold tracking-wider">
                                        <tr>
                                            <th class="px-6 py-4">Nama Program</th>
                                            <th class="px-6 py-4">Kategori / Sasaran</th>
                                            <th class="px-6 py-4">Alokasi Dana</th>
                                            <th class="px-6 py-4">Status</th>
                                            <th class="px-6 py-4 text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach($programs as $program)
                                            <tr class="hover:bg-slate-50/50 transition-colors">
                                                <td class="px-6 py-4">
                                                    <p class="font-bold text-slate-900">{{ $program->nama_program }}</p>
                                                    @if($program->deskripsi)
                                                        <p class="text-[11px] text-slate-500 mt-0.5 truncate max-w-xs">{{ $program->deskripsi }}</p>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4">
                                                    <p class="font-medium text-slate-800">{{ $program->kategori ?: '-' }}</p>
                                                    <p class="text-[11px] text-slate-500">{{ $program->penerima_manfaat ?: '-' }}</p>
                                                </td>
                                                <td class="px-6 py-4 font-semibold text-slate-800">
                                                    Rp {{ number_format((float)$program->alokasi_dana, 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    @if($program->status === 'aktif')
                                                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-md bg-green-50 text-green-700 border border-green-200/60 uppercase tracking-wider">Aktif</span>
                                                    @elseif($program->status === 'selesai')
                                                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-md bg-blue-50 text-blue-700 border border-blue-200/60 uppercase tracking-wider">Selesai</span>
                                                    @else
                                                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-md bg-slate-100 text-slate-600 border border-slate-200 uppercase tracking-wider">Draf</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <div class="flex items-center justify-center gap-1.5">
                                                        <button @click="viewProgramModal = {{ json_encode($program) }}" class="px-2.5 py-1.5 rounded text-slate-500 hover:text-slate-900 hover:bg-slate-100 text-xs font-medium transition" title="Lihat Detail">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                        </button>
                                                        <a href="{{ route('lembaga.admin', ['lembaga' => $subdomain, 'edit_program' => $program->id]) }}?tab=program" class="px-2.5 py-1.5 rounded text-blue-600 hover:text-blue-900 hover:bg-blue-50 text-xs font-medium transition" title="Edit">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                        </a>
                                                        <form action="{{ route('lembaga.program.destroy', ['lembaga' => $subdomain, 'program' => $program->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini secara permanen?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="px-2.5 py-1.5 rounded text-red-500 hover:text-red-700 hover:bg-red-50 text-xs font-medium transition" title="Hapus">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($subdomain === 'upz')
            <!-- TAB REKENING ZAKAT -->
            <div x-show="activeTab === 'rekening'" x-cloak class="space-y-6">
                <!-- FORM TAMBAH / EDIT REKENING -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8 max-w-4xl mx-auto space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-xl font-bold text-slate-900">
                            {{ isset($editRekening) && $editRekening ? 'Ubah Data Rekening' : 'Entri Rekening Baru' }}
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">Lengkapi formulir di bawah ini untuk mengelola rekening pembayaran zakat.</p>
                    </div>

                    <form action="{{ isset($editRekening) && $editRekening ? route('lembaga.rekening.update', ['lembaga' => $subdomain, 'rekening' => $editRekening->id]) : route('lembaga.rekening.store', ['lembaga' => $subdomain]) }}" method="POST">
                        @csrf
                        @if(isset($editRekening) && $editRekening) @method('PUT') @endif
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Bank</label>
                                <input type="text" name="nama_bank" value="{{ old('nama_bank', $editRekening->nama_bank ?? '') }}" required placeholder="Contoh: Bank Nagari / BRI" class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 text-sm py-2.5 px-3">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nomor Rekening</label>
                                <input type="text" name="nomor_rekening" value="{{ old('nomor_rekening', $editRekening->nomor_rekening ?? '') }}" required placeholder="Contoh: 1234-5678-9012" class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 text-sm py-2.5 px-3 font-mono">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Atas Nama</label>
                                <input type="text" name="atas_nama" value="{{ old('atas_nama', $editRekening->atas_nama ?? '') }}" required placeholder="Contoh: UPZ Nagari Guguak" class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 text-sm py-2.5 px-3">
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3 pt-5 border-t border-slate-100">
                            @if(isset($editRekening) && $editRekening)
                                <a href="{{ route('lembaga.admin', ['lembaga' => $subdomain, 'tab' => 'rekening']) }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition">Batal</a>
                            @endif
                            <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-lg hover:bg-brand-700 shadow-sm transition inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ isset($editRekening) && $editRekening ? 'Simpan Perubahan' : 'Tambah Rekening' }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- DAFTAR REKENING -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mt-8 max-w-4xl mx-auto">
                    <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <h3 class="font-bold text-slate-800">Daftar Rekening Terdaftar</h3>
                        <span class="bg-brand-100 text-brand-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ $semuaRekening->count() }} Rekening</span>
                    </div>
                    
                    <div class="p-0">
                        @if($semuaRekening->isEmpty())
                            <div class="p-12 text-center flex flex-col items-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                </div>
                                <h3 class="text-slate-800 font-bold mb-1">Belum ada rekening</h3>
                                <p class="text-sm text-slate-500 max-w-sm">Anda belum mendaftarkan satupun rekening untuk pembayaran zakat.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-white border-b border-slate-100 text-xs uppercase tracking-wider text-slate-500">
                                            <th class="p-4 font-semibold w-12 text-center">No</th>
                                            <th class="p-4 font-semibold">Detail Rekening</th>
                                            <th class="p-4 font-semibold text-right w-32">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-sm">
                                        @foreach($semuaRekening as $idx => $rek)
                                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                                <td class="p-4 text-center font-medium text-slate-400">{{ $idx + 1 }}</td>
                                                <td class="p-4">
                                                    <div class="font-bold text-slate-800 text-base">{{ $rek->nama_bank }}</div>
                                                    <div class="text-brand-600 font-mono mt-0.5 tracking-wider">{{ $rek->nomor_rekening }}</div>
                                                    <div class="text-xs text-slate-500 mt-1 flex items-center gap-1.5">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                        a.n. {{ $rek->atas_nama }}
                                                    </div>
                                                </td>
                                                <td class="p-4 text-right align-top">
                                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                        <a href="{{ route('lembaga.admin', ['lembaga' => $subdomain, 'tab' => 'rekening', 'edit_rekening' => $rek->id]) }}" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-colors shadow-sm" title="Ubah">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                        </a>
                                                        <form action="{{ route('lembaga.rekening.destroy', ['lembaga' => $subdomain, 'rekening' => $rek->id]) }}" method="POST" onsubmit="return confirm('Hapus rekening {{ $rek->nama_bank }} ini?');" class="inline-block">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white flex items-center justify-center transition-colors shadow-sm" title="Hapus">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- TAB 3: DATA BERITA & PUBLIKASI UPZ -->
            <div x-show="activeTab === 'berita'" x-cloak class="space-y-6">

                <!-- FORM TAMBAH / EDIT PUBLIKASI -->
                <div x-show="showBeritaForm" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8 max-w-4xl mx-auto space-y-6">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">
                                {{ $editBerita ? 'Ubah Data Publikasi' : 'Entri Publikasi Baru' }}
                            </h2>
                            <p class="text-xs text-slate-500 mt-1">Lengkapi formulir di bawah ini untuk menerbitkan warta.</p>
                        </div>
                        @if($editBerita)
                            <a href="{{ route('lembaga.admin', ['lembaga' => $subdomain]) }}?tab=berita" class="px-4 py-2 text-xs font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-lg transition inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg> Kembali
                            </a>
                        @else
                            <button type="button" @click="showBeritaForm = false" class="px-4 py-2 text-xs font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-lg transition inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg> Kembali
                            </button>
                        @endif
                    </div>

                    <form action="{{ $editBerita ? route('lembaga.berita.update', ['lembaga' => $subdomain, 'berita' => $editBerita->id]) : route('lembaga.berita.store', ['lembaga' => $subdomain]) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @if($editBerita) @method('PUT') @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Judul Publikasi <span class="text-red-500">*</span></label>
                                <input type="text" name="judul" value="{{ old('judul', $editBerita->judul ?? '') }}" required placeholder="Judul dokumen, berita, atau warta transparansi" class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kategori Dokumen <span class="text-red-500">*</span></label>
                                <select name="kategori" required class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 bg-white transition">
                                    <option value="" disabled {{ !isset($editBerita) ? 'selected' : '' }}>Pilih Kategori</option>
                                    @foreach(['Program', 'Edukasi', 'Laporan & Transparansi', 'Kegiatan', 'Kisah Inspiratif'] as $kat)
                                        <option value="{{ $kat }}" @selected(old('kategori', $editBerita->kategori ?? '') === $kat)>{{ $kat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Penanggung Jawab (Penulis)</label>
                                <input type="text" name="penulis" value="{{ old('penulis', $editBerita->penulis ?? 'Administrator') }}" placeholder="Nama penulis / pengurus" class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Terbit</label>
                                <input type="date" name="tanggal_tayang" value="{{ old('tanggal_tayang', optional($editBerita->tanggal_tayang ?? null)->format('Y-m-d')) }}" class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status <span class="text-red-500">*</span></label>
                                <select name="status" required class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 bg-white transition">
                                    @foreach(['tayang' => 'Publik (Tayang)', 'draf' => 'Internal (Draf)'] as $val => $lbl)
                                        <option value="{{ $val }}" @selected(old('status', $editBerita->status ?? 'tayang') === $val)>{{ $lbl }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Konten Warta / Laporan <span class="text-red-500">*</span></label>
                            <textarea name="isi_berita" rows="6" required placeholder="Tuliskan isi laporan, pengumuman, atau berita selengkapnya..." class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">{{ old('isi_berita', $editBerita->isi_berita ?? '') }}</textarea>
                        </div>

                        {{-- FOTO UPLOAD BERITA --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Foto Sampul Berita</label>
                            @if($editBerita && $editBerita->foto)
                                <div class="mb-3 flex items-center gap-4">
                                    <img src="{{ asset('storage/'.$editBerita->foto) }}" alt="Foto Berita" class="w-28 h-20 object-cover rounded-lg border border-slate-200 shadow-sm">
                                    <p class="text-xs text-slate-500">Foto saat ini. Upload baru untuk mengganti.</p>
                                </div>
                            @endif
                            <div class="relative">
                                <input type="file" name="foto" accept="image/*" class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition file:mr-4 file:py-1.5 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1.5">Format: JPG, PNG, WEBP. Maksimal 3MB.</p>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                            @if($editBerita)
                                <a href="{{ route('lembaga.admin', ['lembaga' => $subdomain]) }}?tab=berita" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-lg transition">
                                    Batal
                                </a>
                            @else
                                <button type="button" @click="showBeritaForm = false" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-lg transition">
                                    Batal
                                </button>
                            @endif

                            <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg transition">
                                {{ $editBerita ? 'Simpan Perubahan' : 'Terbitkan Dokumen' }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- TABEL DATA PUBLIKASI -->
                <div x-show="!showBeritaForm" class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Arsip Publikasi & Warta</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Manajemen informasi transparansi dan dokumentasi kegiatan lembaga.</p>
                        </div>
                        <button @click="showBeritaForm = true" class="px-4 py-2.5 rounded-lg text-white bg-slate-900 hover:bg-slate-800 font-medium text-xs transition-colors inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Entri Publikasi Baru
                        </button>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                        @if($beritas->count() === 0)
                            <div class="p-12 text-center">
                                <svg class="w-10 h-10 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                <p class="font-medium text-slate-900 text-sm">Arsip publikasi masih kosong</p>
                                <p class="text-xs text-slate-500 mt-1">Dokumen atau berita yang ditambahkan akan terdaftar di sini.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-slate-600">
                                    <thead class="text-[11px] text-slate-500 uppercase bg-slate-50 border-b border-slate-200 font-semibold tracking-wider">
                                        <tr>
                                            <th class="px-6 py-4">Judul Dokumen / Warta</th>
                                            <th class="px-6 py-4">Klasifikasi</th>
                                            <th class="px-6 py-4">Tgl Terbit</th>
                                            <th class="px-6 py-4">Status</th>
                                            <th class="px-6 py-4 text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach($beritas as $berita)
                                            <tr class="hover:bg-slate-50/50 transition-colors">
                                                <td class="px-6 py-4">
                                                    <p class="font-bold text-slate-900">{{ $berita->judul }}</p>
                                                    <p class="text-[11px] text-slate-500 mt-0.5 truncate max-w-[250px]">{{ $berita->isi_berita }}</p>
                                                </td>
                                                <td class="px-6 py-4 font-medium text-slate-800">{{ $berita->kategori }}</td>
                                                <td class="px-6 py-4 text-xs font-medium text-slate-600">{{ optional($berita->tanggal_tayang)->format('d-m-Y') ?: '-' }}</td>
                                                <td class="px-6 py-4">
                                                    @if($berita->status === 'tayang')
                                                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-md bg-green-50 text-green-700 border border-green-200/60 uppercase tracking-wider">Publik</span>
                                                    @else
                                                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-md bg-slate-100 text-slate-600 border border-slate-200 uppercase tracking-wider">Internal</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <div class="flex items-center justify-center gap-1.5">
                                                        <button @click="viewBeritaModal = {{ json_encode($berita) }}" class="px-2.5 py-1.5 rounded text-slate-500 hover:text-slate-900 hover:bg-slate-100 text-xs font-medium transition" title="Detail">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                        </button>
                                                        <a href="{{ route('lembaga.admin', ['lembaga' => $subdomain, 'edit_berita' => $berita->id]) }}?tab=berita" class="px-2.5 py-1.5 rounded text-blue-600 hover:text-blue-900 hover:bg-blue-50 text-xs font-medium transition" title="Edit">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                        </a>
                                                        <form action="{{ route('lembaga.berita.destroy', ['lembaga' => $subdomain, 'berita' => $berita->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="px-2.5 py-1.5 rounded text-red-500 hover:text-red-700 hover:bg-red-50 text-xs font-medium transition" title="Hapus">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- TAB 4: PROFIL & STRUKTUR ORGANISASI UPZ -->
            <div x-show="activeTab === 'profil'" x-cloak class="space-y-6">
                <!-- FORM EDIT PROFIL (FORMAL) -->
                <div x-show="showProfilEditForm" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8 max-w-4xl mx-auto space-y-6">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">
                                Pembaruan Identitas Lembaga
                            </h2>
                            <p class="text-xs text-slate-500 mt-1">Formulir perubahan profil dan bagan organisasi UPZ.</p>
                        </div>
                        <button type="button" @click="showProfilEditForm = false" class="px-4 py-2 text-xs font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 rounded-lg transition inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg> Batal Edit
                        </button>
                    </div>

                    <form action="{{ route('lembaga.profil.update', ['lembaga' => $subdomain]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Penanggung Jawab / Ketua</label>
                                <input type="text" name="nama_ketua" value="{{ old('nama_ketua', $lembaga->nama_ketua) }}" placeholder="Nama pimpinan lembaga" class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Logo / Identitas Visual (Opsional)</label>
                                <input type="file" name="foto_lembaga" accept="image/*" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-600 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                                @if($lembaga->foto_lembaga)
                                    <div class="mt-2 flex items-center gap-2">
                                        <p class="text-[10px] text-slate-500 font-medium uppercase tracking-wider">Logo Saat Ini:</p>
                                        <img src="{{ asset('storage/' . $lembaga->foto_lembaga) }}" class="h-6 object-contain rounded border border-slate-200">
                                    </div>
                                @endif
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Dokumen Bagan Struktur Organisasi</label>
                                <input type="file" name="struktur_organisasi" accept="image/*" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-600 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                                @if($lembaga->struktur_organisasi)
                                    <div class="mt-3 p-3 bg-slate-50 border border-slate-200 rounded-lg inline-block">
                                        <p class="text-[10px] font-bold text-slate-500 mb-2 uppercase tracking-wider">Pratinjau Bagan:</p>
                                        <img src="{{ asset('storage/' . $lembaga->struktur_organisasi) }}" class="h-20 object-contain rounded border border-slate-200 bg-white">
                                    </div>
                                @endif
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Profil & Kebijakan Lembaga</label>
                                <textarea name="deskripsi" rows="4" placeholder="Visi, misi, atau deskripsi formal kelembagaan..." class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-600 transition">{{ old('deskripsi', $lembaga->deskripsi) }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                            <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg transition">
                                Simpan Perubahan Identitas
                            </button>
                        </div>
                    </form>
                </div>

                <!-- TAMPILAN PROFIL -->
                <div x-show="!showProfilEditForm" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8 max-w-4xl mx-auto space-y-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-100 pb-5 gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Informasi Kelembagaan</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Identitas legal dan struktur manajerial administrasi UPZ.</p>
                        </div>
                        <button @click="showProfilEditForm = true" class="px-4 py-2.5 rounded-lg text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 font-medium text-xs transition-colors inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Pembaruan Data
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="border-b border-slate-100 pb-4">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Entitas Lembaga</p>
                            <p class="text-base font-bold text-slate-900">{{ $lembaga->nama_lembaga }}</p>
                        </div>
                        <div class="border-b border-slate-100 pb-4">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Domain Sistem</p>
                            <p class="text-base font-semibold text-brand-600">{{ $subdomain }}.{{ env('APP_DOMAIN', 'localhost') }}</p>
                        </div>
                        <div class="border-b border-slate-100 pb-4">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Penanggung Jawab (Ketua)</p>
                            <p class="text-base font-bold text-slate-900">{{ $lembaga->nama_ketua ?: 'Belum Ditetapkan' }}</p>
                        </div>
                        <div class="border-b border-slate-100 pb-4">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status Lisensi</p>
                            <p class="text-sm font-semibold text-green-700 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span> Lembaga Resmi
                            </p>
                        </div>
                        <div class="md:col-span-2 border-b border-slate-100 pb-4">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Deskripsi Visi Misi</p>
                            <p class="text-sm text-slate-700 leading-relaxed max-w-3xl">{{ $lembaga->deskripsi ?: 'Unit Pengumpul Zakat (UPZ) bertugas menghimpun dan menyalurkan zakat, infak, dan sedekah secara transparan, profesional, dan akuntabel sesuai dengan syariat.' }}</p>
                        </div>
                        
                        <!-- Struktur Organisasi Preview -->
                        <div class="md:col-span-2 pt-2">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Dokumen Bagan Organisasi</p>
                            @if($lembaga->struktur_organisasi)
                                <div class="bg-slate-50 border border-slate-200 rounded-lg p-2 inline-block max-w-full">
                                    <img src="{{ asset('storage/' . $lembaga->struktur_organisasi) }}" class="h-auto max-h-[400px] object-contain rounded" alt="Struktur Organisasi UPZ">
                                </div>
                            @else
                                <div class="bg-slate-50 border border-dashed border-slate-300 rounded-lg p-8 text-center text-slate-500">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <p class="text-xs">Dokumen bagan struktur belum tersedia di sistem.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL DETAIL PROGRAM -->
            <template x-if="viewProgramModal">
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
                    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full p-6 space-y-5 border border-slate-200" @click.outside="viewProgramModal = null">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h3 class="text-lg font-bold text-slate-900">Rincian Program</h3>
                            <button @click="viewProgramModal = null" class="w-8 h-8 rounded bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-slate-800 flex items-center justify-center transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Nama Program</p>
                                <p class="text-base font-bold text-slate-900" x-text="viewProgramModal.nama_program"></p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 bg-slate-50 p-4 rounded-lg border border-slate-100 text-sm">
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Kategori Sasaran</p>
                                    <p class="font-semibold text-slate-800" x-text="viewProgramModal.kategori || '-'"></p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Penerima Manfaat</p>
                                    <p class="font-semibold text-slate-800" x-text="viewProgramModal.penerima_manfaat || '-'"></p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Alokasi Dana</p>
                                    <p class="font-bold text-slate-900">Rp <span x-text="Number(viewProgramModal.alokasi_dana || 0).toLocaleString('id-ID')"></span></p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Status</p>
                                    <span class="capitalize font-bold text-brand-700" x-text="viewProgramModal.status"></span>
                                </div>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Deskripsi Lengkap</p>
                                <div class="text-slate-700 leading-relaxed text-sm" x-text="viewProgramModal.deskripsi || 'Tidak ada uraian.'"></div>
                            </div>
                        </div>
                        <div class="flex justify-end pt-3 border-t border-slate-100">
                            <button @click="viewProgramModal = null" class="px-5 py-2 text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg transition">Tutup</button>
                        </div>
                    </div>
                </div>
            </template>

            <!-- MODAL DETAIL BERITA -->
            <template x-if="viewBeritaModal">
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
                    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 space-y-5 border border-slate-200" @click.outside="viewBeritaModal = null">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h3 class="text-lg font-bold text-slate-900">Dokumen Publikasi</h3>
                            <button @click="viewBeritaModal = null" class="w-8 h-8 rounded bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-slate-800 flex items-center justify-center transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <div class="space-y-5">
                            <div>
                                <h4 class="text-xl font-bold text-slate-900 leading-snug" x-text="viewBeritaModal.judul"></h4>
                                <div class="flex flex-wrap gap-4 text-xs text-slate-500 mt-2">
                                    <span><span class="font-semibold">Klasifikasi:</span> <span x-text="viewBeritaModal.kategori"></span></span>
                                    <span><span class="font-semibold">Oleh:</span> <span x-text="viewBeritaModal.penulis || 'Administrator'"></span></span>
                                    <span><span class="font-semibold">Status:</span> <span class="uppercase tracking-wider font-bold text-green-700" x-text="viewBeritaModal.status"></span></span>
                                </div>
                            </div>
                            <div class="bg-slate-50 p-5 rounded-lg border border-slate-100">
                                <div class="text-slate-700 whitespace-pre-line max-h-72 overflow-y-auto leading-relaxed text-sm font-medium" x-text="viewBeritaModal.isi_berita"></div>
                            </div>
                        </div>
                        <div class="flex justify-end pt-3 border-t border-slate-100">
                            <button @click="viewBeritaModal = null" class="px-5 py-2 text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg transition">Tutup Dokumen</button>
                        </div>
                    </div>
                </div>
            </template>

        </div>
    </main>
</div>

</body>
</html>
