<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nagari Guguak</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
     <link rel="icon" type="image/png" href="/logo.png" />

</head>

<body class="m-0 p-0">
    <!-- Kontak Section -->
    <section class="bg-white w-full min-h-screen flex items-center justify-center" id="profile">
        <div class="max-w-6xl w-full grid md:grid-cols-2  gap-10 place-items-center mt-10">

            <div class="w-full rounded-xl overflow-hidden shadow-lg border-2 border-greenDark ml-5">
                <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15794.978619402152!2d100.856389!3d-0.578056!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1723273612345!5m2!1sen!2sid&t=k"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <div class="w-full p-5 flex flex-col justify-center">
                <h2 class="font-bold text-greenDark text-4xl underline underline-offset-4 text-center md:text-left">Kontak</h2>
                <div class="grid gap-8 mt-10">
                    <!-- WhatsApp -->
                    <a href="/wa.me/6285191064962">
                         <div class="bg-white border border-gray-200 rounded-lg shadow-md transition duration-300 hover:-translate-y-1 hover:scale-105">
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold text-greenDark">WhatsApp</h5>
                            <p class="text-gray-700">085191064962</p>
                        </div>
                    </div>
                    </a>

                    <!-- Email -->
                    <a href="mailto:nagariguguak7@gmail.com">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md transition duration-300 hover:-translate-y-1 hover:scale-105">
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold text-greenDark">Email</h5>
                            <p class="text-gray-700">nagariguguak7@gmail.com</p>
                        </div>
                    </div>
                    </a>

                    <!-- Lokasi -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md transition duration-300 hover:-translate-y-1 hover:scale-105">
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold text-greenDark">Lokasi</h5>
                            <p class="text-gray-700">Kec.Koto VII, Kab.Sijunjung, Prov.Sumatera Barat</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
     <section class="bg-white pt-5 pb-5 bottom-0 left-0 w-full shadow-md ">
                    <div class="max-w-6xl mx-auto text-center  justify-content-center">
                        <p>2025 Nagari Guguak.</p>
                            <p>Powered by KKN Guguak Unand 2025.</p>
                    </div>
        </section>



    @include('layout.navbar')

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
