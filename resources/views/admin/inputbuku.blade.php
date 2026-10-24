<x-admin-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $title }}
    </h2>

    <div class="shadow px-6 py-4 bg-white rounded sm:px-1 sm:py-1">
        <div class="container mx-auto">

            <form
                action="{{ isset($buku) ? route('buku.update', $buku->id_buku) : route('buku.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                @if(isset($buku))
                    @method('PUT')
                @endif

                <div class="px-2 py-8 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        {{-- Judul Buku --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="judul" class="block text-sm font-medium text-gray-700">
                                Judul Buku
                            </label>

                            <input
                                type="text"
                                name="judul"
                                id="judul"
                                placeholder="Masukkan Judul Buku"
                                required
                                value="{{ old('judul', $buku->judul ?? '') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >

                            @error('judul')
                                <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Penulis --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="penulis" class="block text-sm font-medium text-gray-700">
                                Penulis
                            </label>

                            <input
                                type="text"
                                name="penulis"
                                id="penulis"
                                placeholder="Masukkan Nama Penulis"
                                required
                                value="{{ old('penulis', $buku->penulis ?? '') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >

                            @error('penulis')
                                <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Penerbit --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="penerbit" class="block text-sm font-medium text-gray-700">
                                Penerbit
                            </label>

                            <input
                                type="text"
                                name="penerbit"
                                id="penerbit"
                                placeholder="Masukkan Nama Penerbit"
                                required
                                value="{{ old('penerbit', $buku->penerbit ?? '') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >

                            @error('penerbit')
                                <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tahun Terbit --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="tahun_terbit" class="block text-sm font-medium text-gray-700">
                                Tahun Terbit
                            </label>

                            <input
                                type="number"
                                name="tahun_terbit"
                                id="tahun_terbit"
                                placeholder="Masukkan Tahun Terbit"
                                min="1000"
                                max="9999"
                                required
                                value="{{ old('tahun_terbit', $buku->tahun_terbit ?? '') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >

                            @error('tahun_terbit')
                                <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategori Buku --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">
                                Kategori Buku
                            </label>

                            <select
                                name="nama_kategori"
                                id="nama_kategori"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >
                                <option value="">-- Pilih Kategori --</option>

                                @foreach($kategoris as $kategori)
                                    <option
                                        value="{{ $kategori->nama_kategori }}"
                                        {{ old('nama_kategori', $buku->nama_kategori ?? '') == $kategori->nama_kategori ? 'selected' : '' }}
                                    >
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>

                            @error('nama_kategori')
                                <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sampul Buku --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="sampul" class="block text-sm font-medium text-gray-700">
                                Sampul Buku
                            </label>

                            <input
                                type="file"
                                name="sampul"
                                id="sampul"
                                accept=".jpg,.jpeg,.png,.webp"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >

                            @if(isset($buku) && $buku->sampul)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">Sampul saat ini:</p>

                                    <img
                                        src="{{ asset($buku->sampul) }}"
                                        alt="Sampul Buku"
                                        width="100"
                                    >
                                </div>
                            @endif

                            @error('sampul')
                                <div class="text-xs text-red-800">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div style="display: flex; gap: 10px; padding: 20px 0; position: relative; z-index: 9999;">
                    <button
                        type="submit"
                        style="display: inline-block; background: blue; color: white; padding: 12px 20px; border: none; border-radius: 5px; cursor: pointer;"
                    >
                        TAMBAH BUKU
                    </button>

                    <a
                        href="{{ route('buku.index') }}"
                        style="display: inline-block; background: gray; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;"
                    >
                        KEMBALI
                    </a>
                </div>

            </form>

        </div>
    </div>
</x-admin-layout>