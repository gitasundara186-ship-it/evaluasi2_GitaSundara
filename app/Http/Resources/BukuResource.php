<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BukuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_buku'       => $this->id_buku,
            'judul'         => $this->judul,
            'penulis'       => $this->penulis,
            'penerbit'      => $this->penerbit,
            'tahun_terbit'  => $this->tahun_terbit,
            'nama_kategori' => $this->nama_kategori,
            'sampul'        => $this->sampul,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}