<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Riwayat transaksi customer.
     */
    public function riwayat()
    {
        $transaksis = Transaksi::with('detailTransaksis.buku')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('transaksi.riwayat', compact('transaksis'));
    }

    /**
     * Detail riwayat transaksi customer.
     */
    public function riwayatDetail(Transaksi $transaksi)
    {
        // Customer hanya boleh melihat transaksinya sendiri
        if ($transaksi->user_id != Auth::id()) {
            abort(403);
        }

        $transaksi->load([
            'detailTransaksis.buku'
        ]);

        return view('transaksi.riwayat-detail', compact('transaksi'));
    }

    /**
     * Daftar seluruh transaksi (Admin).
     */
    public function index()
    {
        $transaksis = Transaksi::with('user')
            ->latest()
            ->get();

        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Detail transaksi (Admin).
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load([
            'user',
            'detailTransaksis.buku'
        ]);

        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Update status transaksi (Admin).
     */
    public function updateStatus(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Pembayaran,Diproses,Selesai,Dibatalkan',
        ]);

        $transaksi->status = $request->status;
        $transaksi->save();

        return redirect()
            ->route('transaksi.show', $transaksi)
            ->with('success', 'Status transaksi berhasil diperbarui.');
    }
}