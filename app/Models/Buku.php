<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'harga',
        'stok',
        'gambar',
        'deskripsi',
    ];

    /**
     * Relasi ke tabel kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi ke keranjang
     */
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

    /**
     * Relasi ke detail transaksi
     */
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}