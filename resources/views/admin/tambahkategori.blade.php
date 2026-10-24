@extends('layouts.admin-layout')

@section('content')
<div class="container mx-auto">

    <h1 style="font-size: 24px; font-weight: bold; color: #1f2937; margin-bottom: 24px;">
        {{ $title }}
    </h1>

    <div style="background-color: white; padding: 24px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">

        <form
            action="{{ isset($kategori->id_kategori) ? route('kategori.update', $kategori->id_kategori) : route('kategori.store') }}"
            method="POST"
        >
            @csrf

            @if (isset($kategori->id_kategori))
                @method('PUT')
            @endif

            <div style="margin-bottom: 24px;">
                <label for="nama_kategori"
                       style="display: block; color: #374151; font-weight: bold; margin-bottom: 8px;">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    id="nama_kategori"
                    placeholder="Masukkan nama kategori"
                    value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}"
                    required
                    style="display: block; width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; outline-color: #3d68ff;"
                >

                @error('nama_kategori')
                    <p style="color: #dc2626; margin-top: 8px;">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="display: flex; gap: 12px; align-items: center;">

                <button
                    type="submit"
                    style="background-color: #3d68ff; color: white; padding: 12px 24px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">
                    Simpan
                </button>

                <button
                    type="button"
                    onclick="window.location.href='{{ route('kategori.index') }}'"
                    style="background-color: #6b7280; color: white; padding: 12px 24px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">
                    Kembali
                </button>

            </div>
        </form>

    </div>
</div>
@endsection