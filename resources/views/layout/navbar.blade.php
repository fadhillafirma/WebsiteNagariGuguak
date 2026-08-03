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
          <a href="/program" class="menu-link hover:text-black transition md:text-lg sm:text-sm">Program</a>
          <a href="/berita" class="menu-link hover:text-black transition md:text-lg sm:text-sm">Berita</a>
          <a href="/kontak" class="menu-link hover:text-black transition md:text-lg sm:text-sm">About Us</a>
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
      <a href="/program" class="block py-2 hover:text-black menu-link">Program</a>
      <a href="/berita" class="block py-2 hover:text-black menu-link">Berita</a>
      <a href="/kontak" class="block py-2 hover:text-black menu-link">About Us</a>
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
