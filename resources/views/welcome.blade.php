@extends('layouts.master')

@section('title','Home')

@section('content')

<div class="container">

    <div class="text-center py-5">

        <h1 class="display-4 fw-bold">

            📚 TugasPWebBuku

        </h1>

        <p class="lead">

            Temukan berbagai koleksi buku terbaik.

        </p>

    </div>

    <div class="row">

        @forelse($bukus as $buku)

        <div class="col-md-3 mb-4">

            <div class="card shadow h-100">

                @if($buku->gambar)

                    <img
                        src="{{ asset('storage/'.$buku->gambar) }}"
                        class="card-img-top"
                        style="height:300px;object-fit:cover;">

                @else

                    <img
                        src="https://placehold.co/300x400?text=No+Cover"
                        class="card-img-top">

                @endif

                <div class="card-body">

                    <h5>

                        {{ $buku->judul }}

                    </h5>

                    <p class="text-muted">

                        {{ $buku->kategori->nama_kategori }}

                    </p>

                    <h5 class="text-primary">

                        Rp {{ number_format($buku->harga,0,',','.') }}

                    </h5>

                </div>

                <div class="card-footer bg-white">

                    <a
    href="{{ route('buku.show',$buku->id) }}"
    class="btn btn-primary w-100">

    Lihat Detail

</a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="alert alert-info">

                Belum ada buku.

            </div>

        </div>

        @endforelse

    </div>

    <div class="mt-4 d-flex justify-content-center">

        {{ $bukus->links() }}

    </div>

</div>

@endsection