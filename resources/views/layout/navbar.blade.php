<nav class="fixed top-5 left-0 w-full flex justify-center z-40">
  <div class="w-[80%] bg-white/20 backdrop-blur-sm text-GreenDark shadow-md rounded-full overflow-visible">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center space-x-3">
          <img src="logo.jpg" alt="Logo" class="h-10 w-auto object-contain">
          <div>
            <span class="text-greenDark text-md font-bold whitespace-nowrap">Nagari Guguak</span>
            <h1 class="text-greenDark text-xs font-bold whitespace-nowrap">Kecamatan Koto VII, Kab. Sijunjung, Prov. Sumatera Barat</h1>
          </div>
        </div>

        <div class="hidden md:flex space-x-8 text-lg font-medium items-center" id="navbar-menu">
          <a href="/" class="menu-link hover:text-greenVill transition">Home</a>
          <a href="/profile" class="menu-link hover:text-greenVill transition">Profile</a>

          <div class="relative group">
                <button class="hover:text-greenVill transition focus:outline-none py-1">Demografis</button>
                <div class="absolute hidden group-hover:block bg-white/20 backdrop-blur-sm text-GreenDark shadow-lg rounded-lg pt-2 min-w-[180px] z-[9999]">
                <a href="/demografiSekolah" class="menu-link block px-4 py-2 hover:bg-green-50">Sekolah</a>
                <a href="/demografiPekerjaan" class="menu-link block px-4 py-2 hover:bg-green-50">Pekerjaan</a>
                <a href="/demografiPenduduk" class="menu-link block px-4 py-2 hover:bg-green-50">Penduduk</a>
                </div>
            </div>
          <a href="/potensi" class="menu-link hover:text-greenVill transition">Potensi</a>
          <div class="relative group">
            <button class="hover:text-greenVill transition focus:outline-none py-1">Publikasi</button>
            <div class="absolute hidden group-hover:block bg-white/20 backdrop-blur-sm text-GreenDark shadow-lg rounded-lg pt-2 min-w-[150px] z-[9999]">
              <a href="/artikel" class="menu-link block px-4 py-2 hover:bg-green-50">Artikel</a>
              <a href="/berita" class="menu-link block px-4 py-2 hover:bg-green-50">Berita</a>
            </div>
          </div>

          <a href="/kontak" class="menu-link hover:text-greenVill transition">Kontak</a>
        </div>

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

    <div id="mobile-menu" class="md:hidden hidden bg-black/90 text-greenDark px-6 pb-4 rounded-b-xl">
      <a href="/" class="block py-2 hover:text-greenVill">Home</a>
      <a href="/profile" class="block py-2 hover:text-greenVill">Profile</a>
      <div class="block py-2">
    <span class="font-semibold">Demografis</span>
    <div class="pl-4">
      <a href="/demografiSekolah" class="menu-link block py-1 hover:text-greenVill">Sekolah</a>
      <a href="/demografiPekerjaan" class="menu-link block py-1 hover:text-greenVill">Pekerjaan</a>
      <a href="/demografiPenduduk" class="menu-link block py-1 hover:text-greenVill">Penduduk</a>
    </div>
  </div>
      <a href="/potensi" class="block py-2 hover:text-greenVill">Potensi</a>

      <div class="block py-2">
        <span class="font-semibold">Publikasi</span>
        <div class="pl-4">
          <a href="/artikel" class="menu-link block py-1 hover:text-greenVill">Artikel</a>
          <a href="/berita" class="menu-link block py-1 hover:text-greenVill">Berita</a>
        </div>
      </div>

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
  // Ambil semua elemen dengan class 'menu-link'
  const links = document.querySelectorAll(".menu-link");

  // Loop melalui setiap tautan
  links.forEach(link => {
    const rawHref = link.getAttribute("href");
    let linkPath = rawHref ? rawHref.replace(/\/+$/, '') : '';

    let isActive = false;

    // Logika yang lebih spesifik
    if (linkPath === '/') {
      // Home hanya aktif jika path-nya persis '/'
      isActive = currentPath === '/';
    } else if (linkPath.length > 1) { // Hanya proses linkPath yang bukan '/'
      // Untuk link lain, cek kecocokan persis atau awalan
      isActive = (currentPath === linkPath) || currentPath.startsWith(linkPath + '/');
    }

    // Terapkan atau hapus kelas aktif
    if (isActive) {
      link.classList.add("relative", "text-greenVill", "pb-1");
      link.classList.add("border-b-2");
      link.style.setProperty('border-bottom-color', '#004225');
      link.setAttribute("aria-current", "page");
    } else {
      // Hapus semua kelas aktif jika tidak cocok
      link.classList.remove("relative", "text-greenVill", "pb-1", "border-b-2");
      link.style.removeProperty('border-bottom-color');
      link.removeAttribute("aria-current");
    }
  });


  const publikasiDropdownItems = document.querySelectorAll('.group .menu-link');
  let isPublikasiActive = false;
  publikasiDropdownItems.forEach(item => {
    const itemPath = item.getAttribute('href').replace(/\/+$/, '') || '';
    if (currentPath === itemPath || currentPath.startsWith(itemPath + '/')) {
      isPublikasiActive = true;
    }
  });

  const publikasiButton = document.querySelector('.group > button');
  if (publikasiButton) {
    if (isPublikasiActive) {
      publikasiButton.classList.add("text-greenVill"); \
    } else {
      publikasiButton.classList.remove("text-greenVill");

    }
  }

  // Deteksi aktif untuk dropdown "Demografis"
const demografiDropdownItems = document.querySelectorAll('.group .menu-link[href*="demografi-"]');
let isDemografiActive = false;
demografiDropdownItems.forEach(item => {
  const itemPath = item.getAttribute('href').replace(/\/+$/, '') || '';
  if (currentPath === itemPath || currentPath.startsWith(itemPath + '/')) {
    isDemografiActive = true;
  }
});

const demografiButton = [...document.querySelectorAll('.group > button')]
  .find(btn => btn.textContent.includes('Demografis'));

if (demografiButton) {
  if (isDemografiActive) {
    demografiButton.classList.add("text-greenVill");
  } else {
    demografiButton.classList.remove("text-greenVill");
  }
}


</script>
