@extends('layouts.master')

@section('title', $buku->judul)

@section('content')

<div class="container mt-4">

    <div class="card shadow">

        <div class="row g-0">

            <div class="col-md-4 text-center p-4">

                @if($buku->gambar)

                    <img
                        src="{{ asset('storage/'.$buku->gambar) }}"
                        class="img-fluid rounded shadow"
                        style="max-height:450px;">

                @else

                    <img
                        src="https://placehold.co/350x500?text=No+Cover"
                        class="img-fluid rounded shadow">

                @endif

            </div>

            <div class="col-md-8">

                <div class="card-body">

                    <h2 class="fw-bold">

                        {{ $buku->judul }}

                    </h2>

                    <hr>

                    <table class="table">

                        <tr>

                            <th width="180">

                                Kategori

                            </th>

                            <td>

                                {{ $buku->kategori->nama_kategori }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Penulis

                            </th>

                            <td>

                                {{ $buku->penulis }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Penerbit

                            </th>

                            <td>

                                {{ $buku->penerbit }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Tahun Terbit

                            </th>

                            <td>

                                {{ $buku->tahun_terbit }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Harga

                            </th>

                            <td class="text-success fw-bold fs-4">

                                Rp {{ number_format($buku->harga,0,',','.') }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Stok

                            </th>

                            <td>

                                {{ $buku->stok }}

                            </td>

                        </tr>

                    </table>

                    <h5>

                        Deskripsi

                    </h5>

                    <p>

                        {{ $buku->deskripsi }}

                    </p>

                    <div class="mt-4">

                        <a href="{{ route('home') }}"
                            class="btn btn-secondary">

                            ← Kembali

                        </a>

                        @guest

                            <a href="{{ route('login') }}"
                                class="btn btn-primary">

                                Login untuk Membeli

                            </a>

                        @endguest

                        @auth

                            @if(Auth::user()->role == 'customer')

                                @if($buku->stok > 0)

                                    <form
                                        action="{{ route('keranjang.store') }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf

                                        <input
                                            type="hidden"
                                            name="buku_id"
                                            value="{{ $buku->id }}">

                                        <button
                                            type="submit"
                                            class="btn btn-success">

                                            🛒 Tambah ke Keranjang

                                        </button>

                                    </form>

                                @else

                                    <button
                                        class="btn btn-danger"
                                        disabled>

                                        Stok Habis

                                    </button>

                                @endif

                            @endif

                        @endauth

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection