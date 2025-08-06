<nav class="fixed top-5 left-0 w-full flex justify-center z-50">
  <div class="w-[90%] bg-white/20 backdrop-blur-sm text-GreenDark shadow-md rounded-full overflow-visible">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
          <img src="/logo.jpg" alt="Logo" class="h-10 w-auto object-contain" />
          <div>
            <span class="text-greenDark text-md font-bold whitespace-nowrap">Nagari Guguak</span>
            <h1 class="text-greenDark text-xs font-bold whitespace-nowrap">Koto VII, Sijunjung, Sumbar</h1>
          </div>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex md:space-x-5 sm:space-x-5 md:text-lg sm:text-sm font-medium items-center" id="navbar-menu">
          <a href="/" class="menu-link hover:text-greenOlive transition md:text-lg sm:text-sm">Home</a>
          <a href="/profile" class="menu-link hover:text-greenOlive transition md:text-lg sm:text-sm">Profile</a>

          <!-- Dropdown Demografis -->
          <div class="relative group ">
            <button class="hover:text-greenOlive transition focus:outline-none py-1 md:text-lg sm:text-sm ">Demografis</button>
            <div class="absolute hidden group-hover:block bg-white backdrop-blur-sm shadow-lg rounded-lg pt-2 min-w-[180px] z-50">
              <a href="/demografiSekolah" class="menu-link block px-4 py-2 hover:bg-gray-100 hover:text-greenOlive">Sekolah</a>
              <a href="/demografiPekerjaan" class="menu-link block px-4 py-2 hover:bg-gray-100 hover:text-greenOlive">Pekerjaan</a>
              <a href="/demografiPenduduk" class="menu-link block px-4 py-2 hover:bg-gray-100 hover:text-greenOlive">Penduduk</a>
              <a href="/demografiLahan" class="menu-link block px-4 py-2 hover:bg-gray-100 hover:text-greenOlive">Lahan</a>


            </div>
          </div>

          <a href="/potensiNagari" class="menu-link hover:text-greenOlive transition md:text-lg sm:text-sm">Potensi</a>

          <!-- Dropdown Publikasi -->
          <div class="relative group">
            <button class="hover:text-greenOlive transition focus:outline-none py-1 md:text-lg sm:text-sm">Publikasi</button>
            <div class="absolute hidden group-hover:block bg-white  shadow-lg rounded-lg pt-2 min-w-[150px] z-50">
              <a href="/artikel" class="menu-link block px-4 py-2 hover:bg-gray-100 hover:text-greenOlive">Artikel</a>
              <a href="/berita" class="menu-link block px-4 py-2 hover:bg-gray-100 hover:text-greenOlive">Berita</a>
            </div>
          </div>

          <a href="/kontak" class="menu-link hover:text-greenOlive transition md:text-lg sm:text-sm">Kontak</a>
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
      <a href="/" class="block py-2 hover:text-greenOlive menu-link">Home</a>
      <a href="/profile" class="block py-2 hover:text-greenOlive menu-link">Profile</a>

      <!-- Mobile Dropdown: Demografis -->
      <div class="block py-2">
        <span class="font-semibold">Demografis</span>
        <div class="pl-4">
          <a href="/demografiSekolah" class="block py-1 hover:text-greenOlive menu-link">Sekolah</a>
          <a href="/demografiPekerjaan" class="block py-1 hover:text-greenOlive menu-link">Pekerjaan</a>
          <a href="/demografiPenduduk" class="block py-1 hover:text-greenOlive menu-link">Penduduk</a>
          <a href="/demografiLahan" class="menu-link block py-1 hover:text-greenOlive">Lahan</a>

        </div>
      </div>

      <a href="/potensiNagari" class="block py-2 hover:text-greenOlive menu-link">Potensi</a>

      <!-- Mobile Dropdown: Publikasi -->
      <div class="block py-2">
        <span class="font-semibold">Publikasi</span>
        <div class="pl-4">
          <a href="/artikel" class="block py-1 hover:text-greenOlive menu-link">Artikel</a>
          <a href="/berita" class="block py-1 hover:text-greenOlive menu-link">Berita</a>
        </div>
      </div>

      <a href="/kontak" class="block py-2 hover:text-greenOlive menu-link">Kontak</a>
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
      link.classList.add("text-greenOlive", "font-semibold");
    } else {
      link.classList.remove("text-greenOlive", "font-semibold");
    }
  });
</script>
