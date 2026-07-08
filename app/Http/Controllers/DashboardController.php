<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();

        $totalKategori = Kategori::count();

        $totalCustomer = User::where('role','customer')->count();

        $totalTransaksi = Transaksi::count();

        $totalPendapatan = Transaksi::where('status','Selesai')
                            ->sum('total_harga');

        $transaksiTerbaru = Transaksi::with('user')
                                ->latest()
                                ->take(5)
                                ->get();

        return view('dashboard.index', compact(

            'totalBuku',

            'totalKategori',

            'totalCustomer',

            'totalTransaksi',

            'totalPendapatan',

            'transaksiTerbaru'

        ));
    }
}