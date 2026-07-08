<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Menampilkan keranjang.
     */
    public function index()
    {
        $keranjangs = Keranjang::with('buku')
            ->where('user_id', Auth::id())
            ->get();

        return view('keranjang.index', compact('keranjangs'));
    }

    /**
     * Menambahkan buku ke keranjang.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $keranjang = Keranjang::where('user_id', Auth::id())
            ->where('buku_id', $request->buku_id)
            ->first();

        if ($keranjang) {

            $keranjang->increment('jumlah');

        } else {

            Keranjang::create([
                'user_id' => Auth::id(),
                'buku_id' => $request->buku_id,
                'jumlah' => 1,
            ]);

        }

        return redirect()->route('keranjang.index')
            ->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    /**
     * Menghapus item keranjang.
     */
    public function destroy(Keranjang $keranjang)
    {
        if ($keranjang->user_id != Auth::id()) {
            abort(403);
        }

        $keranjang->delete();

        return redirect()->route('keranjang.index')
            ->with('success', 'Buku berhasil dihapus dari keranjang.');
    }
}