<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BukuResource;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    // Menampilkan daftar buku, pencarian, dan filter
    public function index(Request $request)
    {
        $query = Buku::query();

        // Pencarian berdasarkan judul atau penulis
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where(
                'nama_kategori',
                $request->kategori
            );
        }

        // Filter berdasarkan tahun terbit
        if ($request->filled('tahun_terbit')) {
            $query->where(
                'tahun_terbit',
                $request->tahun_terbit
            );
        }

        $buku = $query->get();

        return BukuResource::collection($buku);
    }

    // Menambahkan buku baru
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'nama_kategori' => 'required|string',
            'sampul' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('sampul')) {
            $validasi['sampul'] = $request->file('sampul')
                ->store('bukus', 'public');
        }

        $buku = Buku::create($validasi);

        return (new BukuResource($buku))
            ->response()
            ->setStatusCode(201);
    }

    // Menampilkan detail satu buku
    public function show(Buku $buku)
    {
        return new BukuResource($buku);
    }

    // Mengubah data buku
    public function update(Request $request, Buku $buku)
    {
        $validasi = $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'penulis' => 'sometimes|required|string|max:255',
            'penerbit' => 'sometimes|required|string|max:255',
            'tahun_terbit' => 'sometimes|required|integer',
            'nama_kategori' => 'sometimes|required|string',
            'sampul' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('sampul')) {
            if ($buku->sampul) {
                Storage::disk('public')->delete(
                    str_replace('uploads/', '', $buku->sampul)
                );
            }

            $validasi['sampul'] = $request->file('sampul')
                ->store('bukus', 'public');
        }

        $buku->fill($validasi);
        $buku->save();
        $buku->refresh();

        return new BukuResource($buku);
    }

    // Menghapus buku
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return response()->json([
            'message' => 'Data buku berhasil dihapus'
        ]);
    }
}
