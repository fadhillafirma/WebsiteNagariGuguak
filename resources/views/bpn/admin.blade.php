<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BPN Nagari Guguak</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            500: '#f43f5e',
                            600: '#8A1A2B', // Marun Mid
                            700: '#580F1C', // Marun Tua
                            800: '#4c0519',
                            900: '#2c070e',
                        },
                        gold: {
                            500: '#e8c96a',
                            600: '#c9a84c',
                        }
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('logo_bpd.png') }}" />
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800 selection:bg-brand-600 selection:text-white">

<div class="flex min-h-screen" x-data="{ 
    activeTab: '{{ request('tab', $editTugas ? 'tugas' : ($editBerita ? 'berita' : ($editProgram ? 'program' : 'dashboard'))) }}',
    showProgramForm: {{ $editProgram ? 'true' : 'false' }},
    showBeritaForm: {{ $editBerita ? 'true' : 'false' }},
    showTugasForm: {{ $editTugas ? 'true' : 'false' }},
    viewProgramModal: null,
    viewBeritaModal: null
}">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col h-screen sticky top-0 z-30 transition-all">
        <div class="p-6 border-b border-slate-100 flex items-center gap-3">
            <div>
                <h1 class="text-sm font-bold text-slate-900 tracking-tight leading-tight uppercase">Admin Panel</h1>
                <p class="text-[11px] font-medium text-slate-500 truncate max-w-[130px]">BPN {{ $lembaga->nama_lembaga }}</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 space-y-0.5">
            <button @click="activeTab = 'dashboard'; showProgramForm = false; showBeritaForm = false" 
               :class="activeTab === 'dashboard' ? 'bg-brand-50 text-brand-700 border-r-4 border-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-r-4 border-transparent'"
               class="w-full flex items-center gap-x-3 py-3 px-6 text-sm transition-all duration-200 text-left group">
                <svg class="w-5 h-5 flex-shrink-0 transition-colors" :class="activeTab === 'dashboard' ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m-4 4h8"/></svg>
                <span>Dashboard Utama</span>
            </button>

            <button @click="activeTab = 'program'; if(!{{ $editProgram ? 'true' : 'false' }}) showProgramForm = false" 
               :class="activeTab === 'program' ? 'bg-brand-50 text-brand-700 border-r-4 border-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-r-4 border-transparent'"
               class="w-full flex items-center gap-x-3 py-3 px-6 text-sm transition-all duration-200 text-left group">
                <svg class="w-5 h-5 flex-shrink-0 transition-colors" :class="activeTab === 'program' ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span>Kelola Program</span>
            </button>

            <button @click="activeTab = 'berita'; if(!{{ $editBerita ? 'true' : 'false' }}) showBeritaForm = false" 
               :class="activeTab === 'berita' ? 'bg-brand-50 text-brand-700 border-r-4 border-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-r-4 border-transparent'"
               class="w-full flex items-center gap-x-3 py-3 px-6 text-sm transition-all duration-200 text-left group">
                <svg class="w-5 h-5 flex-shrink-0 transition-colors" :class="activeTab === 'berita' ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <span>Warta Publikasi</span>
            </button>

            <button @click="activeTab = 'tugas'; if(!{{ $editTugas ? 'true' : 'false' }}) showTugasForm = false" 
               :class="activeTab === 'tugas' ? 'bg-brand-50 text-brand-700 border-r-4 border-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-r-4 border-transparent'"
               class="w-full flex items-center gap-x-3 py-3 px-6 text-sm transition-all duration-200 text-left group">
                <svg class="w-5 h-5 flex-shrink-0 transition-colors" :class="activeTab === 'tugas' ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Fungsi & Wewenang</span>
            </button>

            <button @click="activeTab = 'profil'" 
               :class="activeTab === 'profil' ? 'bg-brand-50 text-brand-700 border-r-4 border-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-r-4 border-transparent'"
               class="w-full flex items-center gap-x-3 py-3 px-6 text-sm transition-all duration-200 text-left group">
                <svg class="w-5 h-5 flex-shrink-0 transition-colors" :class="activeTab === 'profil' ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>Profil Lembaga</span>
            </button>

            <div class="pt-6 pb-2 px-6">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akses Eksternal</p>
            </div>
            <a href="{{ route('lembaga.beranda', ['lembaga' => 'bpn']) }}" target="_blank" class="flex items-center gap-x-3 py-2.5 px-6 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all group">
                <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>Lihat Website BPN</span>
            </a>
        </nav>

        <div class="p-5 border-t border-slate-100 bg-white">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 text-slate-600 flex items-center justify-center font-bold text-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div class="flex-1 truncate">
                    <p class="text-xs font-semibold text-slate-800 truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <p class="text-[10px] text-slate-500 font-medium truncate">{{ Auth::user()->email ?? '' }}</p>
                </div>
                <form method="POST" action="{{ route('lembaga.logout', ['lembaga' => 'bpn']) }}">
                    @csrf
                    <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-700 flex items-center justify-center transition-colors" title="Logout">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 md:p-10 overflow-y-auto">
        <div class="max-w-6xl mx-auto space-y-8">
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
                        <span>Terdapat kesalahan:</span>
                    </div>
                    <ul class="list-disc list-inside pl-7 space-y-1 text-xs text-red-700">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- DASHBOARD -->
            <div x-show="activeTab === 'dashboard'" x-cloak class="space-y-6">
                <div class="relative overflow-hidden bg-gradient-to-br from-brand-900 via-brand-800 to-brand-700 rounded-xl p-8 md:p-12 text-white border border-brand-800 shadow-sm">
                    <div class="relative z-10 space-y-4">
                        <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-white leading-tight">
                            <span class="text-gold-500">BPN</span> Nagari Guguak
                        </h1>
                        <p class="text-slate-200 text-sm md:text-base max-w-2xl leading-relaxed font-light">
                            Platform pengelolaan administrasi Badan Permusyawaratan Nagari untuk mewujudkan tata kelola yang transparan dan partisipatif.
                        </p>
                    </div>
                    <div class="absolute right-0 top-0 w-1/2 h-full opacity-10 pointer-events-none" style="background-image: radial-gradient(#e8c96a 1px, transparent 1px); background-size: 24px 24px;"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Ketua BPN</p>
                        <p class="text-lg font-bold text-slate-900">{{ $lembaga->nama_ketua ?: 'Belum Ditetapkan' }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Program</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $programs->count() }} <span class="text-sm font-normal text-slate-500">Program</span></p>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Publikasi</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $beritas->count() }} <span class="text-sm font-normal text-slate-500">Berita</span></p>
                    </div>
                </div>
            </div>

            <!-- PROGRAM -->
            <div x-show="activeTab === 'program'" x-cloak class="space-y-6">
                <!-- FORM PROGRAM -->
                <div x-show="showProgramForm" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-4xl mx-auto space-y-6">
                    <div class="flex justify-between border-b pb-4">
                        <h2 class="text-xl font-bold">{{ $editProgram ? 'Ubah Data Program' : 'Entri Program Baru' }}</h2>
                        @if($editProgram)
                            <a href="{{ route('lembaga.admin', ['lembaga' => 'bpn']) }}?tab=program" class="px-4 py-2 text-xs font-medium border rounded-lg hover:bg-slate-50">Kembali</a>
                        @else
                            <button @click="showProgramForm = false" class="px-4 py-2 text-xs font-medium border rounded-lg hover:bg-slate-50">Kembali</button>
                        @endif
                    </div>
                    <form action="{{ $editProgram ? route('lembaga.program.update', ['lembaga' => 'bpn', 'program' => $editProgram->id]) : route('lembaga.program.store', ['lembaga' => 'bpn']) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf @if($editProgram) @method('PUT') @endif
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div><label class="block text-xs font-semibold mb-1">Nama Program *</label><input type="text" name="nama_program" value="{{ old('nama_program', $editProgram->nama_program ?? '') }}" required class="w-full border rounded-lg px-3 py-2 text-sm"></div>
                            <div><label class="block text-xs font-semibold mb-1">Kategori</label><input type="text" name="kategori" value="{{ old('kategori', $editProgram->kategori ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
                            <div><label class="block text-xs font-semibold mb-1">Penerima Manfaat</label><input type="text" name="penerima_manfaat" value="{{ old('penerima_manfaat', $editProgram->penerima_manfaat ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
                            <div x-data="{ withDana: {{ old('alokasi_dana', $editProgram->alokasi_dana ?? '') ? 'true' : 'false' }} }">
                                <div class="flex justify-between items-center mb-1">
                                    <label class="block text-xs font-semibold">Alokasi Dana</label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" x-model="withDana" class="sr-only peer">
                                        <div class="relative w-7 h-4 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-brand-700"></div>
                                        <span class="ms-1.5 text-[9px] font-bold text-gray-500 uppercase">Ada Dana?</span>
                                    </label>
                                </div>
                                <input type="hidden" name="alokasi_dana" value="">
                                <input x-show="withDana" x-bind:disabled="!withDana" type="number" name="alokasi_dana" value="{{ old('alokasi_dana', $editProgram->alokasi_dana ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
                            </div>
                            <div><label class="block text-xs font-semibold mb-1">Tanggal</label><input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', optional($editProgram->tanggal_mulai ?? null)->format('Y-m-d')) }}" class="w-full border rounded-lg px-3 py-2 text-sm"></div>
                            <div><label class="block text-xs font-semibold mb-1">Status *</label>
                                <select name="status" class="w-full border rounded-lg px-3 py-2 text-sm bg-white">
                                    <option value="aktif" @selected(old('status', $editProgram->status ?? 'aktif') === 'aktif')>Aktif</option>
                                    <option value="selesai" @selected(old('status', $editProgram->status ?? '') === 'selesai')>Selesai</option>
                                    <option value="draf" @selected(old('status', $editProgram->status ?? '') === 'draf')>Draf</option>
                                </select>
                            </div>
                        </div>
                        <div><label class="block text-xs font-semibold mb-1">Deskripsi</label><textarea name="deskripsi" rows="4" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('deskripsi', $editProgram->deskripsi ?? '') }}</textarea></div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Foto Program</label>
                            @if($editProgram && $editProgram->foto)
                                <img src="{{ asset('storage/'.$editProgram->foto) }}" class="w-28 h-20 object-cover mb-3 rounded border">
                            @endif
                            <input type="file" name="foto" class="w-full text-sm">
                        </div>
                        <div class="text-right pt-4 border-t"><button type="submit" class="px-6 py-2 bg-brand-700 text-white rounded-lg">Simpan</button></div>
                    </form>
                </div>

                <!-- DAFTAR PROGRAM -->
                <div x-show="!showProgramForm" class="space-y-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">Daftar Program BPN</h2>
                        <button @click="showProgramForm = true" class="px-4 py-2 bg-brand-700 text-white rounded-lg text-sm">Entri Program</button>
                    </div>
                    <div class="bg-white border rounded-xl overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50 border-b text-xs uppercase font-semibold">
                                <tr>
                                    <th class="px-6 py-4">Nama Program</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($programs as $program)
                                <tr class="border-b">
                                    <td class="px-6 py-4 font-bold">{{ $program->nama_program }}</td>
                                    <td class="px-6 py-4 uppercase text-xs">{{ $program->status }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('lembaga.admin', ['lembaga' => 'bpn', 'edit_program' => $program->id]) }}?tab=program" class="text-blue-600">Edit</a>
                                        <form action="{{ route('lembaga.program.destroy', ['lembaga' => 'bpn', 'program' => $program->id]) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                            @csrf @method('DELETE') <button class="text-red-600">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- BERITA -->
            <div x-show="activeTab === 'berita'" x-cloak class="space-y-6">
                <div x-show="showBeritaForm" class="bg-white rounded-xl shadow-sm border p-6 max-w-4xl mx-auto space-y-6">
                    <div class="flex justify-between border-b pb-4">
                        <h2 class="text-xl font-bold">{{ $editBerita ? 'Ubah Berita' : 'Entri Berita Baru' }}</h2>
                        @if($editBerita)
                            <a href="{{ route('lembaga.admin', ['lembaga' => 'bpn']) }}?tab=berita" class="px-4 py-2 border rounded hover:bg-slate-50 text-sm">Kembali</a>
                        @else
                            <button @click="showBeritaForm = false" class="px-4 py-2 border rounded hover:bg-slate-50 text-sm">Kembali</button>
                        @endif
                    </div>
                    <form action="{{ $editBerita ? route('lembaga.berita.update', ['lembaga' => 'bpn', 'berita' => $editBerita->id]) : route('lembaga.berita.store', ['lembaga' => 'bpn']) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf @if($editBerita) @method('PUT') @endif
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="col-span-2"><label class="block text-xs font-semibold mb-1">Judul *</label><input type="text" name="judul" value="{{ old('judul', $editBerita->judul ?? '') }}" required class="w-full border rounded px-3 py-2"></div>
                            <div><label class="block text-xs font-semibold mb-1">Kategori *</label><input type="text" name="kategori" value="{{ old('kategori', $editBerita->kategori ?? 'Umum') }}" required class="w-full border rounded px-3 py-2"></div>
                            <div><label class="block text-xs font-semibold mb-1">Status *</label>
                                <select name="status" class="w-full border rounded px-3 py-2 bg-white">
                                    <option value="tayang" @selected(old('status', $editBerita->status ?? 'tayang') === 'tayang')>Tayang</option>
                                    <option value="draf" @selected(old('status', $editBerita->status ?? '') === 'draf')>Draf</option>
                                </select>
                            </div>
                            <div><label class="block text-xs font-semibold mb-1">Penulis</label><input type="text" name="penulis" value="{{ old('penulis', $editBerita->penulis ?? '') }}" class="w-full border rounded px-3 py-2"></div>
                            <div><label class="block text-xs font-semibold mb-1">Tanggal Tayang</label><input type="date" name="tanggal_tayang" value="{{ old('tanggal_tayang', optional($editBerita->tanggal_tayang ?? null)->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2"></div>
                        </div>
                        <div><label class="block text-xs font-semibold mb-1">Konten *</label><textarea name="isi_berita" rows="6" required class="w-full border rounded px-3 py-2">{{ old('isi_berita', $editBerita->isi_berita ?? '') }}</textarea></div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Foto Berita</label>
                            @if($editBerita && $editBerita->foto)
                                <img src="{{ asset('storage/'.$editBerita->foto) }}" class="w-28 h-20 object-cover mb-3 rounded border">
                            @endif
                            <input type="file" name="foto" class="w-full text-sm">
                        </div>
                        <div class="text-right pt-4 border-t"><button type="submit" class="px-6 py-2 bg-brand-700 text-white rounded">Simpan</button></div>
                    </form>
                </div>

                <div x-show="!showBeritaForm" class="space-y-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">Daftar Berita & Warta</h2>
                        <button @click="showBeritaForm = true" class="px-4 py-2 bg-brand-700 text-white rounded text-sm">Entri Berita</button>
                    </div>
                    <div class="bg-white border rounded-xl overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50 border-b text-xs uppercase font-semibold">
                                <tr><th class="px-6 py-4">Judul</th><th class="px-6 py-4">Status</th><th class="px-6 py-4">Opsi</th></tr>
                            </thead>
                            <tbody>
                                @foreach($beritas as $berita)
                                <tr class="border-b">
                                    <td class="px-6 py-4 font-bold">{{ $berita->judul }}</td>
                                    <td class="px-6 py-4 uppercase text-xs">{{ $berita->status }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('lembaga.admin', ['lembaga' => 'bpn', 'edit_berita' => $berita->id]) }}?tab=berita" class="text-blue-600">Edit</a>
                                        <form action="{{ route('lembaga.berita.destroy', ['lembaga' => 'bpn', 'berita' => $berita->id]) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                            @csrf @method('DELETE') <button class="text-red-600">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TUGAS / FUNGSI & WEWENANG -->
            <div x-show="activeTab === 'tugas'" x-cloak class="space-y-6">
                <div x-show="showTugasForm" class="bg-white rounded-xl shadow-sm border p-6 max-w-4xl mx-auto space-y-6">
                    <div class="flex justify-between border-b pb-4">
                        <h2 class="text-xl font-bold">{{ $editTugas ? 'Ubah Fungsi & Wewenang' : 'Entri Fungsi & Wewenang' }}</h2>
                        @if($editTugas)
                            <a href="{{ route('lembaga.admin', ['lembaga' => 'bpn']) }}?tab=tugas" class="px-4 py-2 border rounded hover:bg-slate-50 text-sm">Kembali</a>
                        @else
                            <button @click="showTugasForm = false" class="px-4 py-2 border rounded hover:bg-slate-50 text-sm">Kembali</button>
                        @endif
                    </div>
                    <form action="{{ $editTugas ? route('lembaga.tugas.update', ['lembaga' => 'bpn', 'tugas' => $editTugas->id]) : route('lembaga.tugas.store', ['lembaga' => 'bpn']) }}" method="POST" class="space-y-5">
                        @csrf @if($editTugas) @method('PUT') @endif
                        <div><label class="block text-xs font-semibold mb-1">Judul / Peran *</label><input type="text" name="judul" value="{{ old('judul', $editTugas->judul ?? '') }}" required class="w-full border rounded px-3 py-2"></div>
                        <div><label class="block text-xs font-semibold mb-1">Deskripsi *</label><textarea name="deskripsi" rows="4" required class="w-full border rounded px-3 py-2">{{ old('deskripsi', $editTugas->deskripsi ?? '') }}</textarea></div>
                        <div class="text-right pt-4 border-t"><button type="submit" class="px-6 py-2 bg-brand-700 text-white rounded">Simpan</button></div>
                    </form>
                </div>

                <div x-show="!showTugasForm" class="space-y-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">Daftar Fungsi & Wewenang</h2>
                        <button @click="showTugasForm = true" class="px-4 py-2 bg-brand-700 text-white rounded text-sm">Tambah Data</button>
                    </div>
                    <div class="bg-white border rounded-xl overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50 border-b text-xs uppercase font-semibold">
                                <tr><th class="px-6 py-4">Judul / Peran</th><th class="px-6 py-4">Opsi</th></tr>
                            </thead>
                            <tbody>
                                @foreach($semuaTugas as $tugas)
                                <tr class="border-b">
                                    <td class="px-6 py-4 font-bold">{{ $tugas->judul }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('lembaga.admin', ['lembaga' => 'bpn', 'edit_tugas' => $tugas->id]) }}?tab=tugas" class="text-blue-600">Edit</a>
                                        <form action="{{ route('lembaga.tugas.destroy', ['lembaga' => 'bpn', 'tugas' => $tugas->id]) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                            @csrf @method('DELETE') <button class="text-red-600">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- PROFIL -->
            <div x-show="activeTab === 'profil'" x-cloak class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border p-6 max-w-4xl mx-auto space-y-6">
                    <h2 class="text-xl font-bold border-b pb-4">Pengaturan Profil BPN</h2>
                    <form action="{{ route('lembaga.profil.update', ['lembaga' => 'bpn']) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf @method('PUT')
                        <div><label class="block text-xs font-semibold mb-1">Nama Ketua BPN</label><input type="text" name="nama_ketua" value="{{ old('nama_ketua', $lembaga->nama_ketua ?? '') }}" required class="w-full border rounded px-3 py-2"></div>
                        <div><label class="block text-xs font-semibold mb-1">Deskripsi Lembaga</label><textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2">{{ old('deskripsi', $lembaga->deskripsi ?? '') }}</textarea></div>
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold mb-1">Foto Lembaga</label>
                                @if($lembaga->foto_lembaga) <img src="{{ asset('storage/'.$lembaga->foto_lembaga) }}" class="w-full h-32 object-cover mb-2 border rounded"> @endif
                                <input type="file" name="foto_lembaga" class="w-full text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold mb-1">Struktur Organisasi</label>
                                @if($lembaga->struktur_organisasi) <img src="{{ asset('storage/'.$lembaga->struktur_organisasi) }}" class="w-full h-32 object-contain mb-2 border rounded bg-slate-50"> @endif
                                <input type="file" name="struktur_organisasi" class="w-full text-xs">
                            </div>
                        </div>
                        <div class="text-right pt-4 border-t"><button type="submit" class="px-6 py-2 bg-brand-700 text-white rounded">Simpan Profil</button></div>
                    </form>
                </div>
            </div>

        </div>
    </main>
</div>

</body>
</html>
