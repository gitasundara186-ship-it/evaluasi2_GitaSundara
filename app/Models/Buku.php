<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    public $primaryKey = 'id_buku';

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'nama_kategori',
        'sampul'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'nama_kategori', 'nama_kategori');
    }
}