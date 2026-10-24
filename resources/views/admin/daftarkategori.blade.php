@extends('layouts.admin-layout')

@section('content')
<div class="container mx-auto" style="padding: 10px;">

    {{-- Judul dan Tombol Tambah --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; gap: 15px; flex-wrap: wrap;">

        <h1 style="font-size: 24px; font-weight: bold; color: #1f2937; margin: 0;">
            {{ $title }}
        </h1>

        <a href="{{ route('kategori.create') }}"
           style="background-color: #3d68ff; color: white; display: inline-block; padding: 12px 18px; border-radius: 6px; font-weight: bold; text-decoration: none; cursor: pointer;">
            + Tambah Kategori
        </a>

    </div>

    {{-- Pesan Berhasil --}}
    @if (session('success'))
        <div style="background-color: #d1fae5; color: #065f46; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan Error --}}
    @if ($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tabel Kategori --}}
    <div style="background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow-x: auto;">

        <table style="width: 100%; border-collapse: collapse;">

            <thead>
                <tr style="background-color: #f3f4f6; color: #4b5563; text-transform: uppercase; font-size: 14px;">
                    <th style="padding: 18px 24px; text-align: left; border-bottom: 1px solid #e5e7eb;">
                        No
                    </th>

                    <th style="padding: 18px 24px; text-align: left; border-bottom: 1px solid #e5e7eb;">
                        Nama Kategori
                    </th>

                    <th style="padding: 18px 24px; text-align: center; border-bottom: 1px solid #e5e7eb;">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody style="color: #4b5563; font-size: 14px;">

                @forelse ($kategori as $item)
                    <tr>

                        <td style="padding: 18px 24px; border-bottom: 1px solid #e5e7eb;">
                            {{ $loop->iteration }}
                        </td>

                        <td style="padding: 18px 24px; border-bottom: 1px solid #e5e7eb;">
                            {{ $item->nama_kategori }}
                        </td>

                        <td style="padding: 18px 24px; text-align: center; border-bottom: 1px solid #e5e7eb; white-space: nowrap;">

                            <a href="{{ route('kategori.edit', $item->id_kategori) }}"
                               style="background-color: #f59e0b; color: white; display: inline-block; padding: 8px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px;">
                                Edit
                            </a>

                            <form action="{{ route('kategori.destroy', $item->id_kategori) }}"
                                  method="POST"
                                  style="display: inline-block;"
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        style="background-color: #ef4444; color: white; padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer;">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="3" style="padding: 35px 20px; text-align: center; color: #6b7280;">
                            Belum ada data kategori.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection