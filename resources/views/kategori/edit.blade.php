@extends('layouts.master')

@section('title', 'Edit Kategori')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-warning">
            <h4 class="mb-0">Edit Kategori</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Nama Kategori
                    </label>

                    <input
                        type="text"
                        name="nama_kategori"
                        class="form-control"
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="4">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>

                </div>

                <a href="{{ route('kategori.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

                <button
                    type="submit"
                    class="btn btn-success">

                    Update

                </button>

            </form>

        </div>

    </div>

</div>

@endsection