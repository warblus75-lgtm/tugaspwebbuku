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

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi ke Keranjang
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

    // Relasi ke Detail Transaksi
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}