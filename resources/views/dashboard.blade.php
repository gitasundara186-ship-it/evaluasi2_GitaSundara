@extends('layouts.admin-layout')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-semibold text-gray-800">
        Dashboard
    </h1>
</div>

<div class="w-full">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">
            Selamat Datang!
        </h2>

        <p class="text-gray-600">
            Selamat datang di halaman Dashboard.
            Silakan pilih menu di sebelah kiri untuk mengelola data buku dan kategori.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

        <!-- Menu Buku -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-book text-2xl"></i>
                </div>

                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Data Buku
                    </h3>

                    <p class="text-sm text-gray-500">
                        Kelola daftar buku.
                    </p>
                </div>
            </div>

            <a href="{{ route('buku.index') }}"
                class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Buka Data Buku
            </a>
        </div>

        <!-- Menu Kategori -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-list text-2xl"></i>
                </div>

                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Data Kategori
                    </h3>

                    <p class="text-sm text-gray-500">
                        Kelola kategori buku.
                    </p>
                </div>
            </div>

            <a href="{{ route('kategori.index') }}"
                class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Buka Data Kategori
            </a>
        </div>

    </div>
</div>

@endsection