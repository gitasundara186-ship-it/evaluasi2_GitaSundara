<!-- memanggil admin template -->
<!-- component layout yang dibuat pada langkah 3 -->
<x-admin-layout>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <!-- menampilkan variabel title yang dikirim dari controller -->
        {{$title}}
    </h2>

    <div>
        <div class="shadow px-6 py-4 bg-white rounded sm:px-1 sm:py-1">
            <div class="grid grid-cols-12">
                <div class="col-span-6 p-4">
                    <!-- menampilkan url untuk menampilkan halaman input buku -->
                    <a href="{{route('buku.create')}}">
                        <button class="px-4 py-1 text-sm rounded text-purple-600 font-semibold border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none">
                            Tambah
                        </button>
                    </a>

                    <button class="px-4 py-1 text-sm rounded text-green-600 font-semibold border border-green-200 hover:text-white hover:bg-green-600 hover:border-transparent focus:outline-none">
                        Publish
                    </button>

                    <button class="px-4 py-1 text-sm rounded text-red-600 font-semibold border border-red-200 hover:text-white hover:bg-red-600 hover:border-transparent focus:outline-none">
                        Delete
                    </button>
                </div>

                <div class="col-span-6 p-4">
                    <!-- FORM PENCARIAN DAN FILTER -->
                    <form action="{{route('buku.index')}}" method="GET"
                        class="flex flex-wrap items-center justify-end gap-2">

                        <!-- Pencarian berdasarkan judul -->
                        <input
                            type="text"
                            name="s"
                            value="{{request('s')}}"
                            placeholder="Cari judul buku..."
                            class="flex-1 min-w-0 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 rounded-md text-sm border-gray-300"
                        >

                        <!-- Filter berdasarkan kategori -->
                        <select
                            name="nama_kategori"
                            onchange="this.form.submit()"
                            class="w-40 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 rounded-md text-sm border-gray-300 bg-white"
                        >
                            <option value="">Semua Kategori</option>

                            @foreach ($kategoris as $kategori)
                                <option
                                    value="{{$kategori->nama_kategori}}"
                                    {{request('nama_kategori') == $kategori->nama_kategori ? 'selected' : ''}}
                                >
                                    {{$kategori->nama_kategori}}
                                </option>
                            @endforeach
                        </select>

                        <!-- Tombol Cari -->
                        <button
                            type="submit"
                            class="shrink-0 rounded-md border px-4 py-2 border-gray-300 bg-blue-600 text-white hover:bg-blue-700"
                        >
                            Cari
                        </button>

                        <!-- Tombol Reset tetap ada -->
                        <a
                            href="{{route('buku.index')}}"
                            class="shrink-0 rounded-md border px-4 py-2 border-gray-300 text-gray-600 hover:bg-gray-100"
                        >
                            Reset
                        </a>

                    </form>
                    <!-- END FORM PENCARIAN DAN FILTER -->
                </div>
            </div>

            <div class="py-2 align-middle inline-block min-w-full sm:px-4 lg:px-4">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul Buku
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Penulis
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori
                                </th>

                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- menampilkan daftar buku -->
                            @forelse ($buku as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="" id="">

                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img
                                                class="h-10 w-10 rounded-full"
                                                src="{{asset($item->sampul)}}"
                                                alt=""
                                            >
                                        </div>

                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$item->judul}}
                                            </div>

                                            <div class="text-sm text-gray-500">
                                                {{$item->tahun_terbit}}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{$item->penulis}}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{$item->penerbit}}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{$item->nama_kategori}}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{route('buku.destroy', $item->id_buku)}}" method="POST">
                                        <!-- Form token CSRF untuk method DELETE -->
                                        @csrf
                                        @method('DELETE')

                                        <!-- Link edit -->
                                        <a href="{{route('buku.edit', $item->id_buku)}}" class="text-indigo-600 hover:text-indigo-900">
                                            Edit
                                        </a>

                                        <!-- Tombol hapus -->
                                        <button
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Anda Yakin ?')"
                                            type="submit"
                                        >
                                            Del
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Data buku tidak ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PAGINATION -->
            <div class="m-4">
                {{$buku->links()}}
            </div>
            <!-- END PAGINATION -->

        </div>
    </div>

</x-admin-layout>