<?php

use Illuminate\Support\Facades\Route;
use App\Models\Buku;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| TEST
|--------------------------------------------------------------------------
*/

Route::get('/tes', function () {
    return 'TES BERHASIL';
});

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $bukus = Buku::with('kategori')
        ->latest()
        ->paginate(8);

    return view('welcome', compact('bukus'));

})->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('kategori', KategoriController::class)
        ->except('show');

    Route::resource('buku', BukuController::class)
        ->except('show');

    Route::get('/transaksi', [TransaksiController::class, 'index'])
        ->name('transaksi.index');

    Route::get('/transaksi/{transaksi}', [TransaksiController::class, 'show'])
        ->name('transaksi.show');

    Route::put('/transaksi/{transaksi}/status',
        [TransaksiController::class, 'updateStatus'])
        ->name('transaksi.updateStatus');
});

/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::resource('keranjang', KeranjangController::class)
        ->only(['index', 'store', 'destroy']);

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::get('/riwayat', [TransaksiController::class, 'riwayat'])
        ->name('riwayat.index');

    Route::get('/riwayat/{transaksi}', [TransaksiController::class, 'riwayatDetail'])
        ->name('riwayat.show');
});

/*
|--------------------------------------------------------------------------
| DETAIL BUKU
|--------------------------------------------------------------------------
| Diletakkan paling bawah agar tidak bentrok dengan route resource
*/

Route::get('/buku/{buku}', [BukuController::class, 'show'])
    ->name('buku.show');

require __DIR__.'/auth.php';