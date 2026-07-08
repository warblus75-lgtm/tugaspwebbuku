@extends('layouts.master')

@section('title', 'Data Buku')

@section('content')

<div class="container">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            📚 Data Buku
        </h2>

        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            + Tambah Buku
        </a>

    </div>

    {{-- Alert --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    {{-- Search --}}
    <div class="row mb-3">

        <div class="col-md-4">

            <form action="{{ route('buku.index') }}" method="GET">

                <div class="input-group">

                    <input
                        type="text"
                        class="form-control"
                        name="keyword"
                        placeholder="Cari Buku..."
                        value="{{ request('keyword') }}">

                    <button class="btn btn-primary">

                        Cari

                    </button>

                </div>

            </form>

        </div>

    </div>

    {{-- Table --}}
    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>No</th>

                            <th>Cover</th>

                            <th>Judul</th>

                            <th>Kategori</th>

                            <th>Penulis</th>

                            <th>Penerbit</th>

                            <th>Tahun</th>

                            <th>Harga</th>

                            <th>Stok</th>

                            <th width="170">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($bukus as $buku)

                        <tr>

                            <td>

                                {{ $bukus->firstItem()+$loop->index }}

                            </td>

                            <td width="90">

                                @if($buku->gambar)

                                    <img
                                        src="{{ asset('storage/'.$buku->gambar) }}"
                                        width="70"
                                        class="img-thumbnail">

                                @else

                                    -

                                @endif

                            </td>

                            <td>

                                {{ $buku->judul }}

                            </td>

                            <td>

                                {{ $buku->kategori->nama_kategori }}

                            </td>

                            <td>

                                {{ $buku->penulis }}

                            </td>

                            <td>

                                {{ $buku->penerbit }}

                            </td>

                            <td>

                                {{ $buku->tahun_terbit }}

                            </td>

                            <td>

                                Rp {{ number_format($buku->harga,0,',','.') }}

                            </td>

                            <td>

                                {{ $buku->stok }}

                            </td>

                            <td>

                                <a
                                    href="{{ route('buku.edit',$buku->id) }}"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('buku.destroy',$buku->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus buku ini?')"
                                        class="btn btn-danger btn-sm">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10" class="text-center">

                                Belum ada data buku.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3 d-flex justify-content-center">

                {{ $bukus->links() }}

            </div>

        </div>

    </div>

</div>

@endsection