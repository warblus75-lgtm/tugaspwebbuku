@extends('layouts.master')

@section('title', 'Riwayat Pembelian')

@section('content')

<div class="container">

    <h2 class="mb-4">
        📋 Riwayat Pembelian
    </h2>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if($transaksis->count())

        <div class="card shadow">

            <div class="card-body">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">

                        <tr>

                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($transaksis as $transaksi)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $transaksi->kode_transaksi }}</td>

                            <td>{{ $transaksi->tanggal }}</td>

                            <td>

                                Rp {{ number_format($transaksi->total_harga,0,',','.') }}

                            </td>

                            <td>

                                @if($transaksi->status=='Menunggu Pembayaran')

                                    <span class="badge bg-warning text-dark">

                                        {{ $transaksi->status }}

                                    </span>

                                @elseif($transaksi->status=='Diproses')

                                    <span class="badge bg-info">

                                        {{ $transaksi->status }}

                                    </span>

                                @elseif($transaksi->status=='Selesai')

                                    <span class="badge bg-success">

                                        {{ $transaksi->status }}

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        {{ $transaksi->status }}

                                    </span>

                                @endif

                            </td>

                            <td>

                                <a
                                    href="{{ route('transaksi.show',$transaksi->id) }}"
                                    class="btn btn-primary btn-sm">

                                    Detail

                                </a>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    @else

        <div class="alert alert-warning">

            Anda belum memiliki transaksi.

        </div>

    @endif

</div>

@endsection