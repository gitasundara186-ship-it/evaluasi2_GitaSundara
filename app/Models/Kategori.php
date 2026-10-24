<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori'
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'nama_kategori', 'nama_kategori');
    }
}