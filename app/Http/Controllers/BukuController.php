<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
   public function index(Request $request)
{
    $title = "Daftar Buku";

    $buku = Buku::query();

    // Filter berdasarkan judul buku
    if ($request->filled('s')) {
        $buku->where('judul', 'like', '%' . $request->s . '%');
    }

    // Filter berdasarkan kategori
    if ($request->filled('nama_kategori')) {
        $buku->where('nama_kategori', $request->nama_kategori);
    }

    $buku = $buku->paginate(5)->appends($request->query());

    $kategoris = Kategori::all();

    return view('admin.daftarbuku', compact('title', 'buku', 'kategoris'));
}

public function create()
    {
        $title = "Input Buku";
        $kategoris = Kategori::all();

        return view('admin.inputbuku', compact('title', 'kategoris'));
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'nama_kategori' => 'required',
            'sampul' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            if ($request->hasFile('sampul')) {
                $fileName = time() . '_' . $request->file('sampul')->getClientOriginalName();

                $path = $request->file('sampul')->storeAs(
                    'uploads/bukus',
                    $fileName,
                    'public'
                );

                $validasi['sampul'] = $path;
            }

            Buku::create($validasi);

            return redirect()->route('buku.index')
                ->with('success', 'Data buku berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Data buku gagal ditambahkan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $buku = Buku::findOrFail($id);

        return view('admin.detailbuku', compact('buku'));
    }

    public function edit($id)
    {
        $title = "Edit Buku";
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();

        return view('admin.inputbuku', compact('title', 'buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'nama_kategori' => 'required',
            'sampul' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            $buku = Buku::findOrFail($id);

            if ($request->hasFile('sampul')) {
                $fileName = time() . '_' . $request->file('sampul')->getClientOriginalName();

                $path = $request->file('sampul')->storeAs(
                    'uploads/bukus',
                    $fileName,
                    'public'
                );

                $validasi['sampul'] = $path;
            } else {
                unset($validasi['sampul']);
            }

            $buku->update($validasi);

            return redirect()->route('buku.index')
                ->with('success', 'Data buku berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Data buku gagal diperbarui: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }
}