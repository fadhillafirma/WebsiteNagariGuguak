<nav class="fixed top-5 left-0 w-full flex justify-center z-50">
  <div class="w-[90%] {{ Request::is('/') ? 'bg-white/20 backdrop-blur-sm text-GreenDark' : 'bg-greenVill/70 backdrop-blur-sm text-greenDark' }} shadow-md rounded-full overflow-visible">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
          <img src="/logo.png" alt="Logo" class="h-10 w-auto object-contain" />
          <div>
            <span class="text-greenDark text-md font-bold whitespace-nowrap marquee-text">Nagari Guguak</span>
            <h1 class="text-greenDark text-xs font-bold whitespace-nowrap">Koto VII, Sijunjung, Sumbar</h1>
          </div>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex md:space-x-5 sm:space-x-5 md:text-lg sm:text-sm font-medium items-center" id="navbar-menu">
          <a href="/" class="menu-link hover:text-black transition md:text-lg sm:text-sm">Home</a>
          <a href="/profil" class="menu-link hover:text-black transition md:text-lg sm:text-sm">Profile</a>
          <a href="/jorongNagari" class="menu-link hover:text-black transition md:text-lg sm:text-sm">Jorong</a>
          <a href="/lembagaNagari" class="menu-link hover:text-black transition md:text-lg sm:text-sm">Lembaga</a>
          <a href="/situsLembaga" class="menu-link hover:text-black transition md:text-lg sm:text-sm">Situs Lembaga</a>
          <div class="group relative">
            <button class="hover:text-black transition flex items-center md:text-lg sm:text-sm h-16">
              Demografis
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div class="absolute hidden group-hover:block pt-1 top-[50px] min-w-[150px]">
              <div class="bg-white text-greenDark py-2 rounded shadow-lg">
                <a href="/demografiPekerjaan" class="menu-link block px-4 py-2 hover:bg-gray-100">Pekerjaan</a>
                <a href="/demografiPenduduk" class="menu-link block px-4 py-2 hover:bg-gray-100">Penduduk</a>
              </div>
            </div>
          </div>
          <a href="/potensiNagari" class="menu-link hover:text-black transition md:text-lg sm:text-sm">Potensi</a>
          <div class="group relative">
            <button class="hover:text-black transition flex items-center md:text-lg sm:text-sm h-16">
              Publikasi
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div class="absolute hidden group-hover:block pt-1 top-[50px] min-w-[150px]">
              <div class="bg-white text-greenDark py-2 rounded shadow-lg">
                <a href="/artikel" class="menu-link block px-4 py-2 hover:bg-gray-100">Artikel</a>
                <a href="/berita" class="menu-link block px-4 py-2 hover:bg-gray-100">Berita</a>
              </div>
            </div>
          </div>
          <a href="/kontak" class="menu-link hover:text-black transition md:text-lg sm:text-sm">Kontak</a>
        </div>

        <!-- Mobile Hamburger Button -->
        <div class="md:hidden">
          <button id="menu-btn" class="focus:outline-none">
            <svg class="w-8 h-8 text-greenDark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white/100 backdrop-blur-sm text-greenDark px-6 pb-4 rounded-b-xl transition-all">
      <a href="/" class="block py-2 hover:text-black menu-link">Home</a>
      <a href="/profil" class="block py-2 hover:text-black menu-link">Profile</a>
      <a href="/jorongNagari" class="block py-2 hover:text-black menu-link">Jorong</a>
      <a href="/lembagaNagari" class="block py-2 hover:text-black menu-link">Lembaga</a>
      <a href="/situsLembaga" class="block py-2 hover:text-black menu-link">Situs Lembaga</a>
      <div class="block py-2">
        <span class="font-semibold">Demografis</span>
        <div class="pl-4">
          <a href="/demografiPekerjaan" class="menu-link block py-1 hover:text-black">Pekerjaan</a>
          <a href="/demografiPenduduk" class="menu-link block py-1 hover:text-black">Penduduk</a>
        </div>
      </div>
      <a href="/potensiNagari" class="block py-2 hover:text-black menu-link">Potensi</a>
      <div class="block py-2">
        <span class="font-semibold">Publikasi</span>
        <div class="pl-4">
          <a href="/artikel" class="menu-link block py-1 hover:text-black">Artikel</a>
          <a href="/berita" class="menu-link block py-1 hover:text-black">Berita</a>
        </div>
      </div>
      <a href="/kontak" class="block py-2 hover:text-black menu-link">Kontak</a>
    </div>
  </div>
</nav>

<script>
  const menuBtn = document.getElementById("menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");

  menuBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
  });

  // Highlight menu aktif
  const currentPath = window.location.pathname.replace(/\/+$/, '') || '/';
  const links = document.querySelectorAll(".menu-link");

  links.forEach(link => {
    const rawHref = link.getAttribute("href");
    let linkPath = rawHref ? rawHref.replace(/\/+$/, '') : '';
    let isActive = false;

    if (linkPath === '/') {
      isActive = currentPath === '/';
    } else if (linkPath.length > 1) {
      isActive = (currentPath === linkPath) || currentPath.startsWith(linkPath + '/');
    }

    if (isActive) {
      link.classList.add("text-black", "font-bold");
    } else {
      link.classList.remove("text-greenOlive", "font-semibold");
    }
  });
</script>
