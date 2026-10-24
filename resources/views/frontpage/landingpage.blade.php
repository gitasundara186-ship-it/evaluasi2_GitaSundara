<x-home-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="flex items-baseline justify-between border-b border-gray-200 pt-2 pb-6">
                            <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                                Daftar Buku
                            </h1>

                            <div class="flex items-center">
                                <div date-rangepicker class="flex items-center">
                                    <div class="relative">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm-2 7h12v7H4V9z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>

                                        <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Tanggal mulai">
                                    </div>

                                    <span class="mx-4 text-gray-500">sampai</span>

                                    <div class="relative">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm-2 7h12v7H4V9z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>

                                        <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Tanggal akhir">
                                    </div>
                                </div>

                                <button type="button" class="inline-block mx-4 px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded-md hover:bg-blue-100 hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                                    Cari
                                </button>
                            </div>
                        </div>

                        <section>
                            @forelse ($buku as $item)
                                <div class="md:flex font-sans pt-8">
                                    <div class="md:shrink-0">
                                        @if (!empty($item->gambar))
                                            <img
                                                src="{{ asset('storage/' . $item->gambar) }}"
                                                alt="{{ $item->judul_buku ?? $item->judul ?? 'Sampul buku' }}"
                                                class="h-48 w-full md:h-full md:w-56 object-cover rounded-lg"
                                                loading="lazy"
                                            />
                                        @else
                                            <div class="h-48 w-full md:h-full md:w-56 flex items-center justify-center bg-gray-100 rounded-lg">
                                                <span class="text-gray-400">Tidak ada gambar</span>
                                            </div>
                                        @endif
                                    </div>

                                    <form class="p-6 flex-1">
                                        <div class="flex flex-wrap">
                                            <h1 class="flex-auto font-medium text-slate-900">
                                                {{ $item->judul_buku ?? $item->judul ?? 'Judul buku' }}
                                            </h1>

                                            <div class="w-full flex-none mt-2 order-1 text-xl font-bold text-violet-600">
                                                Kategori:
                                                {{ $item->kategori->nama_kategori ?? $item->nama_kategori ?? 'Belum ada kategori' }}
                                            </div>

                                            <div class="text-sm font-medium text-slate-400 mt-2">
                                                Tersedia
                                            </div>
                                        </div>

                                        <div class="flex items-baseline mt-4 mb-6 pb-6 border-b border-slate-200">
                                            {{ $item->deskripsi ?? $item->sinopsis ?? 'Informasi buku belum tersedia.' }}
                                        </div>

                                        <div class="flex space-x-4 mb-5 text-sm font-medium">
                                            <div class="flex-auto flex space-x-4">
                                                <a
                                                    href="{{ route('login') }}"
                                                    class="h-10 px-6 flex items-center justify-center font-semibold rounded-full bg-violet-600 text-white"
                                                >
                                                    Lihat Buku
                                                </a>
                                            </div>

                                            <button class="flex-none flex items-center justify-center w-9 h-9 rounded-full text-violet-600 bg-violet-50" type="button" aria-label="Favorit">
                                                <svg width="20" height="20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 015.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                                                </svg>
                                            </button>
                                        </div>

                                        <p class="text-sm text-slate-500">
                                            Koleksi buku untuk menambah wawasan dan pengetahuan.
                                        </p>
                                    </form>
                                </div>
                            @empty
                                <div class="py-12 text-center">
                                    <h2 class="text-xl font-semibold text-gray-700">
                                        Belum Ada Buku
                                    </h2>

                                    <p class="mt-2 text-gray-500">
                                        Data buku belum tersedia.
                                    </p>
                                </div>
                            @endforelse

                            <div class="font-sans pt-8 text-center">
                                @if (method_exists($buku, 'links'))
                                    {{ $buku->links() }}
                                @else
                                    <a href="#" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                        Sebelumnya
                                    </a>

                                    <a href="#" class="inline-flex items-center py-2 px-4 ml-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                        Selanjutnya
                                    </a>
                                @endif
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>