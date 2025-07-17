<footer class="bg-cream border-t  text-gray-800">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      {{-- Logo dan Nama --}}
      <div>
        <a href="/" class="flex items-center space-x-3">
          <img src="/logo.png" alt="Logo" class="h-10 w-auto" />
          <span class="text-xl font-bold text-greenDark">Nagari Guguak</span>
        </a>
        <p class="mt-4 text-sm text-gray-600">
          Membangun nagari mandiri, berbudaya dan berdaya saing.
        </p>
      </div>

      {{-- Navigasi --}}
      <div>
        <h3 class="text-sm font-semibold text-greenDark uppercase mb-4">Navigasi</h3>
        <ul class="space-y-2 text-sm">
          <li><a href="/" class="hover:underline">Beranda</a></li>
          <li><a href="/profile" class="hover:underline">Profil</a></li>
          <li><a href="/layanan" class="hover:underline">Layanan</a></li>
          <li><a href="/kontak" class="hover:underline">Kontak</a></li>
        </ul>
      </div>

      {{-- Sosial Media --}}
      <div>
        <h3 class="text-sm font-semibold text-greenDark uppercase mb-4">Sosial Media</h3>
        <ul class="space-y-2 text-sm">
          <li><a href="#" class="hover:underline">Facebook</a></li>
          <li><a href="#" class="hover:underline">Instagram</a></li>
          <li><a href="#" class="hover:underline">YouTube</a></li>
        </ul>
      </div>

      {{-- Informasi Kontak --}}
      <div>
        <h3 class="text-sm font-semibold text-greenDark uppercase mb-4">Kontak</h3>
        <p class="text-sm">Jl. Raya Guguak No.01<br/>Kec. Sijunjung, Sumbar</p>
        <p class="mt-2 text-sm">Email: info@nagariguguak.id</p>
        <p class="text-sm">Telepon: (0751) 123456</p>
      </div>
    </div>

    <hr class="my-8 border-greenDark" />

    <div class="flex flex-col sm:flex-row items-center justify-between text-sm text-gray-500">
      <span>© {{ date('Y') }} Nagari Guguak. All rights reserved.</span>
      <div class="flex space-x-4 mt-4 sm:mt-0">
        <a href="#" class="hover:text-greenDark">Privacy Policy</a>
        <a href="#" class="hover:text-greenDark">Terms</a>
      </div>
    </div>
  </div>
</footer>
