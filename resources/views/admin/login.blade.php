<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm bg-white rounded-xl shadow-lg  overflow-hidden">

        <!-- Kiri: Form -->
        <div class="p-8 md:p-12 flex flex-col justify-center">
            <div class="w-full max-w-sm mx-auto">
                <div class="flex flex-col items-center mb-8">

                    <h2 class="text-2xl font-bold text-gray-800">Login</h2>
                </div>

                @if ($errors->any())
                    <div class="mb-6 text-red-600 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-3">
                    @csrf
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 ">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            class="block w-full   px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700 ">Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-greenDark focus:outline-none focus:ring-greenVill text-white font-semibold py-2 px-4  rounded-lg hover:bg-blue-700 transition duration-200"
                    >
                        Login
                    </button>
                </form>
            </div>
        </div>


    </div>
</body>
</html>

