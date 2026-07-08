@extends('layouts.master')

@section('title','Dashboard Admin')

@section('content')

<div class="container">

    <h2 class="mb-4">

        📊 Dashboard Admin

    </h2>

    <div class="row">

        <div class="col-md-4 mb-3">

            <div class="card text-white bg-primary shadow">

                <div class="card-body">

                    <h5>Total Buku</h5>

                    <h2>{{ $totalBuku }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card text-white bg-success shadow">

                <div class="card-body">

                    <h5>Total Kategori</h5>

                    <h2>{{ $totalKategori }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card text-white bg-warning shadow">

                <div class="card-body">

                    <h5>Total Customer</h5>

                    <h2>{{ $totalCustomer }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <div class="card text-white bg-info shadow">

                <div class="card-body">

                    <h5>Total Transaksi</h5>

                    <h2>{{ $totalTransaksi }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <div class="card text-white bg-danger shadow">

                <div class="card-body">

                    <h5>Total Pendapatan</h5>

                    <h2>

                        Rp {{ number_format($totalPendapatan,0,',','.') }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow mt-4">

        <div class="card-header bg-dark text-white">

            5 Transaksi Terbaru

        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>Kode</th>

                        <th>Pembeli</th>

                        <th>Total</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($transaksiTerbaru as $transaksi)

                    <tr>

                        <td>{{ $transaksi->kode_transaksi }}</td>

                        <td>{{ $transaksi->user->name }}</td>

                        <td>

                            Rp {{ number_format($transaksi->total_harga,0,',','.') }}

                        </td>

                        <td>{{ $transaksi->status }}</td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">

                            Belum ada transaksi.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection