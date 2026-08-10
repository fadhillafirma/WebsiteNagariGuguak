<style>
  .logo-title-custom {
    font-size: 11px !important;
  }
  .logo-subtitle-custom {
    font-size: 8px !important;
  }
  .navbar-menu-container {
    display: none !important;
  }
  
  /* Styling untuk link dan button menu agar selalu berwarna greenDark (#004225) */
  .navbar-menu-container a, 
  .navbar-menu-container button {
    color: #004225 !important;
    font-weight: 700 !important;
    font-family: inherit;
    transition: color 0.15s ease-in-out;
  }
  .navbar-menu-container a:hover, 
  .navbar-menu-container button:hover {
    color: #000000 !important;
  }
  .navbar-menu-container a.text-black {
    color: #000000 !important;
  }
  
  @media (min-width: 768px) {
    .logo-title-custom {
      font-size: 13px !important;
    }
    .logo-subtitle-custom {
      font-size: 10px !important;
    }
    .navbar-menu-container {
      display: flex !important;
      gap: 12px !important;
      font-size: 12px !important;
    }
  }

  @media (min-width: 1024px) {
    .logo-title-custom {
      font-size: 15px !important;
    }
    .logo-subtitle-custom {
      font-size: 11px !important;
    }
    .navbar-menu-container {
      gap: 18px !important;
      font-size: 14px !important;
    }
  }

  @media (min-width: 1280px) {
    .logo-title-custom {
      font-size: 16px !important;
    }
    .logo-subtitle-custom {
      font-size: 12px !important;
    }
    .navbar-menu-container {
      gap: 24px !important;
      font-size: 15px !important;
    }
  }

  /* Custom background color class to ensure it's always greenVill (#DEE791) */
  .navbar-bg-custom {
    background-color: rgba(222, 231, 145, 0.9) !important;
  }
</style>

<nav class="fixed top-5 left-0 right-0 flex justify-center z-50">
  <div class="w-[90%] navbar-bg-custom backdrop-blur-sm text-greenDark shadow-md rounded-full overflow-visible">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center space-x-2 md:space-x-3">
          <img src="/logo.png" alt="Logo" class="h-8 md:h-10 w-auto object-contain" />
          <div class="flex flex-col justify-center">
            <span class="text-greenDark font-bold whitespace-nowrap marquee-text logo-title-custom">Nagari Guguak</span>
            <h1 class="text-greenDark font-bold whitespace-nowrap logo-subtitle-custom">Koto VII, Sijunjung, Sumbar</h1>
          </div>
        </div>

        <!-- Desktop Menu -->
        <div class="navbar-menu-container font-bold items-center" id="navbar-menu">
          <a href="/" class="menu-link hover:text-black transition">Home</a>
          <a href="/profil" class="menu-link hover:text-black transition">Profile</a>
          <a href="/jorongNagari" class="menu-link hover:text-black transition">Jorong</a>
          <a href="/lembagaNagari" class="menu-link hover:text-black transition">Lembaga</a>
          <a href="/situsLembaga" class="menu-link hover:text-black transition">Situs Lembaga</a>
          <div class="group relative">
            <button class="hover:text-black transition flex items-center h-16">
              Demografis
              <svg class="w-3 h-3 ml-0.5 md:w-4 md:h-4 md:ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div class="absolute hidden group-hover:block pt-1 top-[50px] min-w-[150px]">
              <div class="bg-white text-greenDark py-2 rounded shadow-lg">
                <a href="/demografiSekolah" class="menu-link block px-4 py-2 hover:bg-gray-100">Sekolah</a>
                <a href="/demografiPekerjaan" class="menu-link block px-4 py-2 hover:bg-gray-100">Pekerjaan</a>
                <a href="/demografiPenduduk" class="menu-link block px-4 py-2 hover:bg-gray-100">Penduduk</a>
                <a href="/demografiLahan" class="menu-link block px-4 py-2 hover:bg-gray-100">Lahan</a>
              </div>
            </div>
          </div>
          <a href="/potensiNagari" class="menu-link hover:text-black transition">Potensi</a>
          <div class="group relative">
            <button class="hover:text-black transition flex items-center h-16">
              Publikasi
              <svg class="w-3 h-3 ml-0.5 md:w-4 md:h-4 md:ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div class="absolute hidden group-hover:block pt-1 top-[50px] min-w-[150px]">
              <div class="bg-white text-greenDark py-2 rounded shadow-lg">
                <a href="/artikel" class="menu-link block px-4 py-2 hover:bg-gray-100">Artikel</a>
                <a href="/berita" class="menu-link block px-4 py-2 hover:bg-gray-100">Berita</a>
              </div>
            </div>
          </div>
          <a href="/kontak" class="menu-link hover:text-black transition">Kontak</a>
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
    <div id="mobile-menu" class="md:hidden hidden bg-white/100 backdrop-blur-sm text-greenDark px-6 pb-4 rounded-b-xl transition-all max-h-[80vh] overflow-y-auto">
      <a href="/" class="block py-2 hover:text-black menu-link">Home</a>
      <a href="/profil" class="block py-2 hover:text-black menu-link">Profile</a>
      <a href="/jorongNagari" class="block py-2 hover:text-black menu-link">Jorong</a>
      <a href="/lembagaNagari" class="block py-2 hover:text-black menu-link">Lembaga</a>
      <a href="/situsLembaga" class="block py-2 hover:text-black menu-link">Situs Lembaga</a>
      <div class="block py-2">
        <span class="font-semibold">Demografis</span>
        <div class="pl-4">
          <a href="/demografiSekolah" class="menu-link block py-1 hover:text-black">Sekolah</a>
          <a href="/demografiPekerjaan" class="menu-link block py-1 hover:text-black">Pekerjaan</a>
          <a href="/demografiPenduduk" class="menu-link block py-1 hover:text-black">Penduduk</a>
          <a href="/demografiLahan" class="menu-link block py-1 hover:text-black">Lahan</a>
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
