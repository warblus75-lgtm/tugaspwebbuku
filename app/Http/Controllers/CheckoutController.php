<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store()
    {
        $keranjangs = Keranjang::with('buku')
            ->where('user_id', Auth::id())
            ->get();

        if ($keranjangs->isEmpty()) {

            return redirect()->route('keranjang.index')
                ->with('error', 'Keranjang masih kosong.');

        }

        DB::transaction(function () use ($keranjangs) {

            $total = 0;

            foreach ($keranjangs as $item) {

                if ($item->jumlah > $item->buku->stok) {

                    throw new \Exception(
                        "Stok buku {$item->buku->judul} tidak mencukupi."
                    );

                }

                $total += $item->jumlah * $item->buku->harga;
            }

            $kode = 'TRX-' . now()->format('YmdHis');

            $transaksi = Transaksi::create([

                'user_id' => Auth::id(),

                'kode_transaksi' => $kode,

                'tanggal' => now(),

                'total_harga' => $total,

                'status' => 'Menunggu Pembayaran',

            ]);

            foreach ($keranjangs as $item) {

                DetailTransaksi::create([

                    'transaksi_id' => $transaksi->id,

                    'buku_id' => $item->buku_id,

                    'jumlah' => $item->jumlah,

                    'harga' => $item->buku->harga,

                    'subtotal' => $item->jumlah * $item->buku->harga,

                ]);

                $item->buku->decrement('stok', $item->jumlah);

            }

            Keranjang::where('user_id', Auth::id())->delete();

        });

        return redirect()
            ->route('riwayat.index')
            ->with('success', 'Checkout berhasil.');
    }
}