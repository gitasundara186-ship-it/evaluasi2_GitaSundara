<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: Karla, sans-serif;
        }

        .bg-sidebar {
            background: #3d68ff;
        }

        .cta-btn {
            color: #3d68ff;
        }

        .upgrade-btn {
            background: #1947ee;
        }

        .upgrade-btn:hover {
            background: #0038fd;
        }

        .active-nav-link {
            background: #1947ee;
        }

        .nav-item:hover {
            background: #1947ee;
        }

        .account-link:hover {
            background: #3d68ff;
        }
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">

    <!-- Sidebar Desktop -->
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="{{ route('dashboard') }}"
                class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
                Admin
            </a>
        </div>

        <nav class="text-white text-base font-semibold pt-3">

            <!-- Menu Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>

            <!-- Menu Buku -->
            <a href="{{ route('buku.index') }}"
                class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-sticky-note mr-3"></i>
                Buku
            </a>

            <!-- Menu Kategori -->
            <a href="{{ route('kategori.index') }}"
                class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-list mr-3"></i>
                Kategori
            </a>

            <!-- Menu Home -->
            <a href="{{ url('/') }}"
                class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>

        </nav>
    </aside>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">

        <!-- Header Desktop -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>

            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">

                <button
                    @click="isOpen = !isOpen"
                    class="relative z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">

                    <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400" alt="Admin">
                </button>

                <button
                    x-show="isOpen"
                    @click="isOpen = false"
                    class="h-full w-full fixed inset-0 cursor-default">
                </button>

                <div
                    x-show="isOpen"
                    class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">

                    <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 account-link hover:text-white">
                        Account
                    </a>

                    <a href="#"
                        class="block px-4 py-2 account-link hover:text-white">
                        Support
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="block w-full text-left px-4 py-2 account-link hover:text-white">
                            Sign Out
                        </button>
                    </form>

                </div>
            </div>
        </header>

        <!-- Header Mobile -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">

            <div class="flex items-center justify-between">

                <a href="{{ route('dashboard') }}"
                    class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
                    Admin
                </a>

                <button
                    @click="isOpen = !isOpen"
                    class="text-white text-3xl focus:outline-none">

                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>

                </button>
            </div>

            <!-- Navigasi Mobile -->
            <nav :class="isOpen ? 'flex' : 'hidden'" class="flex flex-col pt-4">

                <!-- Menu Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>

                <!-- Menu Buku -->
                <a href="{{ route('buku.index') }}"
                    class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sticky-note mr-3"></i>
                    Buku
                </a>

                <!-- Menu Kategori -->
                <a href="{{ route('kategori.index') }}"
                    class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-list mr-3"></i>
                    Kategori
                </a>

                <!-- Menu Home -->
                <a href="{{ url('/') }}"
                    class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-home mr-3"></i>
                    Home
                </a>

            </nav>
        </header>

        <!-- Konten Halaman -->
        <div class="w-full flex-1 overflow-x-hidden overflow-y-auto border-t">

            <main class="w-full flex-grow p-6">

                @yield('content')

                @isset($slot)
                    {{ $slot }}
                @endisset

            </main>

        </div>

    </div>

</body>
</html>