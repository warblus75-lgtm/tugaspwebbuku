@extends('layouts.master')

@section('title', 'Data Kategori')

@section('content')

<div class="container">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            📂 Data Kategori
        </h2>

        <a href="{{ route('kategori.create') }}" class="btn btn-primary">
            + Tambah Kategori
        </a>

    </div>

    {{-- Alert --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    {{-- Form Pencarian --}}
    <div class="row mb-3">

        <div class="col-md-4">

            <form action="{{ route('kategori.index') }}" method="GET">

                <div class="input-group">

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari kategori..."
                        value="{{ request('keyword') }}">

                    <button class="btn btn-primary">

                        Cari

                    </button>

                </div>

            </form>

        </div>

    </div>

    {{-- Tabel --}}
    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="70">No</th>

                            <th>Nama Kategori</th>

                            <th>Deskripsi</th>

                            <th width="180" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($kategoris as $kategori)

                            <tr>

                                <td>

                                    {{ $kategoris->firstItem() + $loop->index }}

                                </td>

                                <td>

                                    {{ $kategori->nama_kategori }}

                                </td>

                                <td>

                                    {{ $kategori->deskripsi }}

                                </td>

                                <td class="text-center">

                                    <a href="{{ route('kategori.edit', $kategori->id) }}"
                                       class="btn btn-warning btn-sm">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('kategori.destroy', $kategori->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus kategori ini?')">

                                            Hapus

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center">

                                    Belum ada data kategori.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-center">

                {{ $kategoris->links() }}

            </div>

        </div>

    </div>

</div>

@endsection