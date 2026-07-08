@extends('layouts.master')

@section('title', 'Data Transaksi')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            📋 Data Transaksi
        </h2>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-primary">

                    <tr>

                        <th>No</th>

                        <th>Kode</th>

                        <th>Nama Pembeli</th>

                        <th>Email</th>

                        <th>Tanggal</th>

                        <th>Total</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($transaksis as $transaksi)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $transaksi->kode_transaksi }}</td>

                        <td>{{ $transaksi->user->name }}</td>

                        <td>{{ $transaksi->user->email }}</td>

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

                            <a href="{{ route('transaksi.show',$transaksi->id) }}"
                               class="btn btn-primary btn-sm">

                                Detail

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center">

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