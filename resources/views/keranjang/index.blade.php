@extends('layouts.master')

@section('title', 'Keranjang Belanja')

@section('content')

<div class="container">

    <h2 class="mb-4">
        🛒 Keranjang Belanja
    </h2>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @php
        $total = 0;
    @endphp

    @if($keranjangs->count())

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered align-middle">

                <thead class="table-primary">

                    <tr>

                        <th width="80">No</th>

                        <th>Cover</th>

                        <th>Judul</th>

                        <th>Harga</th>

                        <th>Jumlah</th>

                        <th>Subtotal</th>

                        <th width="120">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($keranjangs as $item)

                    @php

                        $subtotal = $item->jumlah * $item->buku->harga;

                        $total += $subtotal;

                    @endphp

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            @if($item->buku->gambar)

                                <img
                                    src="{{ asset('storage/'.$item->buku->gambar) }}"
                                    width="70"
                                    class="img-thumbnail">

                            @else

                                <img
                                    src="https://placehold.co/70x100?text=No+Cover"
                                    class="img-thumbnail">

                            @endif

                        </td>

                        <td>

                            {{ $item->buku->judul }}

                        </td>

                        <td>

                            Rp {{ number_format($item->buku->harga,0,',','.') }}

                        </td>

                        <td>

                            {{ $item->jumlah }}

                        </td>

                        <td>

                            Rp {{ number_format($subtotal,0,',','.') }}

                        </td>

                        <td>

                            <form
                                action="{{ route('keranjang.destroy',$item->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus buku ini?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

                </tbody>

                <tfoot>

                    <tr>

                        <th colspan="5" class="text-end">

                            Total

                        </th>

                        <th colspan="2">

                            Rp {{ number_format($total,0,',','.') }}

                        </th>

                    </tr>

                </tfoot>

            </table>

            <div class="d-flex justify-content-between">

                <a
                    href="{{ route('home') }}"
                    class="btn btn-secondary">

                    ← Lanjut Belanja

                </a>

                <form action="{{ route('checkout.store') }}" method="POST">

             @csrf

    <button
        class="btn btn-success">

        Checkout

    </button>

</form>

            </div>

        </div>

    </div>

    @else

        <div class="alert alert-warning">

            Keranjang masih kosong.

        </div>

        <a
            href="{{ route('home') }}"
            class="btn btn-primary">

            Mulai Belanja

        </a>

    @endif

</div>

@endsection