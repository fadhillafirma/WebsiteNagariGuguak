<nav class="fixed top-5 left-0 w-full flex justify-center z-50">
  <div class="w-[80%] bg-white/20 backdrop-blur-sm text-GreenDark shadow-md rounded-full overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
          <img src="logo.jpg" alt="Logo" class="h-10 w-auto object-contain">
          <div class="">
            <span class="text-greenDark text-md font-bold whitespace-nowrap">Nagari Guguak</span>
          <h1 class="text-greenDark text-xs font-bold whitespace-nowrap  text-wrap">Kecamatan Koto VII, Kab. Sijunjung, Prov. Sumatera Barat</h1>
          </div>

        </div>

        <!-- Menu Desktop -->
        <div class="hidden md:flex space-x-8 text-lg font-medium" id="navbar-menu">
          <a href="/" class="menu-link hover:text-greenVill transition">Home</a>
          <a href="/profile" class="menu-link hover:text-greenVill transition">Profile</a>
          <a href="/demografis" class="menu-link hover:text-greenVill transition">Demografis</a>
          <a href="/potensi" class="menu-link hover:text-greenVill transition">Potensi</a>
          <a href="/berita" class="menu-link hover:text-greenVill transition">Berita</a>
          <a href="/kontak" class="menu-link hover:text-greenVill transition">Kontak</a>

        </div>

        <!-- Hamburger Icon -->
        <div class="md:hidden">
          <button id="menu-btn" class="focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="md:hidden hidden bg-black/90 text-greenDark px-6 pb-4 rounded-b-xl">
      <a href="/" class="block py-2 hover:text-greenVill">Home</a>
      <a href="/profile" class="block py-2 hover:text-greenVill">Profile</a>
      <a href="/demografis" class="block py-2 hover:text-greenVill">Demografis</a>
      <a href="/potensi" class="block py-2 hover:text-greenVill">Potensi</a>
      <a href="/berita" class="block py-2 hover:text-greenVill">Berita</a>
      <a href="/kontak" class="block py-2 hover:text-greenVill">Kontak</a>

    </div>
  </div>
</nav>

<script>
  // Toggle mobile menu
  const menuBtn = document.getElementById("menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");
  menuBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
  });

  // Aktifkan menu sesuai URL
  const currentPath = window.location.pathname.replace(/\/+$/, '') || '/';
const links = document.querySelectorAll(".menu-link");

links.forEach(link => {
  const rawHref = link.getAttribute("href");
  let linkPath = rawHref.replace(/\/+$/, '') || '/';

  let isActive = false;

  if (linkPath === '/') {
    isActive = currentPath === '/';
  } else {
    isActive = (currentPath === linkPath) || currentPath.startsWith(linkPath + '/');
  }

  if (isActive) {
    link.classList.add("relative", "text-greenVill", "pb-1");
    link.classList.add("border-b-2");
    link.style.setProperty('border-bottom-color', '#004225'); // pakai greenDark
    link.setAttribute("aria-current", "page");
  }
});


</script>
