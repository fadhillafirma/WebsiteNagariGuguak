<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 h-screen sticky top-0 bg-white border-r border-gray-200 shadow-md">

            <div class="flex flex-col h-full">
                <!-- Header -->
                <div class="p-5 border-b border-gray-200">
                    <h1 class="text-xl font-bold text-gray-800">Admin Panel</h1>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto p-3">
                    <ul class="space-y-1">
                        <!-- Dashboard -->
                        <li>
                            <a href="{{ route('dashboard') }}"
                               class="flex items-center gap-x-3 py-2 px-3 text-sm rounded-lg hover:bg-gray-100
                               {{ request()->routeIs('dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m-4 4h8"></path>
                                </svg>
                                Dashboard
                            </a>
                        </li>

                        <!-- Galeri -->
                        <li>
                            <a href="{{ route('galeri.index') }}"
                               class="flex items-center gap-x-3 py-2 px-3 text-sm rounded-lg hover:bg-gray-100
                               {{ request()->routeIs('galeri.*') ? 'bg-gray-100 font-semibold' : '' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                </svg>
                                Galeri
                            </a>
                        </li>

                        <!-- Publikasi -->
                        <li>
                            <a href="{{ route('publikasi.index') }}"
                               class="flex items-center gap-x-3 py-2 px-3 text-sm rounded-lg hover:bg-gray-100
                               {{ request()->routeIs('publikasi.*') ? 'bg-gray-100 font-semibold' : '' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                Publikasi
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('kalender.index') }}"
                            class="flex items-center gap-x-3 py-2 px-3 text-sm rounded-lg hover:bg-gray-100
                            {{ request()->routeIs('kalender.*') ? 'bg-gray-100 font-semibold' : '' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                Kalender
                            </a>
                        </li>

                        <!-- Potensi -->
                        <li>
                            <a href="{{ route('potensi.index') }}"
                            class="flex items-center gap-x-3 py-2 px-3 text-sm rounded-lg hover:bg-gray-100
                            {{ request()->routeIs('potensi.*') ? 'bg-gray-100 font-semibold' : '' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 2l9 4.5v11L12 22l-9-4.5v-11L12 2z"/>
                                </svg>
                                Potensi
                            </a>
                        </li>


                        <!-- Lembaga -->
                        <li>
                            <a href="{{ route('lembaga.index') }}"
                            class="flex items-center gap-x-3 py-2 px-3 text-sm rounded-lg hover:bg-gray-100
                            {{ request()->routeIs('lembaga.*') ? 'bg-gray-100 font-semibold' : '' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 7v13h18V7l-9-4-9 4z" />
                                    <path d="M13 13h-2v2h2v-2z" />
                                </svg>
                                Lembaga
                            </a>
                        </li>



                        <!-- Demografi (Dropdown) -->
<li x-data="{ open: {{ request()->routeIs('demografi-*') ? 'true' : 'false' }} }">
    <button @click="open = !open"
        class="w-full flex items-center justify-between py-2 px-3 text-sm rounded-lg hover:bg-gray-100
        {{ request()->routeIs('demografi-*') ? 'bg-gray-100 font-semibold' : '' }}">
        <span class="flex items-center gap-x-3">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3 10h4v11H3zM10 3h4v18h-4zM17 14h4v7h-4z" />
            </svg>
            Demografi
        </span>
        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <ul x-show="open" class="pl-6 mt-2 space-y-1" x-cloak>
        <li>
            <a href="{{ route('demografi-pekerjaan.index') }}"
                class="block py-1 px-2 text-sm rounded hover:bg-gray-100
                {{ request()->routeIs('demografi-pekerjaan.*') ? 'bg-gray-200 font-semibold' : '' }}">
                Pekerjaan
            </a>
        </li>
        <li>
            <a href="{{ route('demografi-sekolah.index') }}"
                class="block py-1 px-2 text-sm rounded hover:bg-gray-100
                {{ request()->routeIs('demografi-sekolah.*') ? 'bg-gray-200 font-semibold' : '' }}">
                Sekolah
            </a>
        </li>
        <li>
            <a href="{{ route('demografi-penduduk-jorong.index') }}"
                class="block py-1 px-2 text-sm rounded hover:bg-gray-100
                {{ request()->routeIs('demografi-penduduk-jorong.*') ? 'bg-gray-200 font-semibold' : '' }}">
                Penduduk
            </a>
        </li>
        <li>
            <a href="{{ route('demografi-lahan.index') }}"
                class="block py-1 px-2 text-sm rounded hover:bg-gray-100
                {{ request()->routeIs('demografi-lahan.*') ? 'bg-gray-200 font-semibold' : '' }}">
                Lahan
            </a>
        </li>
    </ul>
</li>




                    </ul>
                </nav>

                <!-- Logout -->
                <div class="p-4 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full flex items-center gap-x-2 px-3 py-2 text-sm text-black rounded-lg hover:bg-red-500 hover:text-white">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>
        <!-- End Sidebar -->

        <!-- Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
