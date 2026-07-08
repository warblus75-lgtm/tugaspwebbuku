@extends('layouts.master')

@section('title', 'Tambah Buku')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📚 Tambah Buku</h4>
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

            <form action="{{ route('buku.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Kategori
                        </label>

                        <select
                            name="kategori_id"
                            class="form-select"
                            required>

                            <option value="">-- Pilih Kategori --</option>

                            @foreach($kategoris as $kategori)

                                <option
                                    value="{{ $kategori->id }}"
                                    {{ old('kategori_id')==$kategori->id?'selected':'' }}>

                                    {{ $kategori->nama_kategori }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Judul Buku
                        </label>

                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            value="{{ old('judul') }}"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Penulis
                        </label>

                        <input
                            type="text"
                            name="penulis"
                            class="form-control"
                            value="{{ old('penulis') }}"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Penerbit
                        </label>

                        <input
                            type="text"
                            name="penerbit"
                            class="form-control"
                            value="{{ old('penerbit') }}"
                            required>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Tahun Terbit
                        </label>

                        <input
                            type="number"
                            name="tahun_terbit"
                            class="form-control"
                            value="{{ old('tahun_terbit') }}"
                            required>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Harga
                        </label>

                        <input
                            type="number"
                            name="harga"
                            class="form-control"
                            value="{{ old('harga') }}"
                            required>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Stok
                        </label>

                        <input
                            type="number"
                            name="stok"
                            class="form-control"
                            value="{{ old('stok') }}"
                            required>

                    </div>

                    <div class="col-md-12 mb-3">

                        <label class="form-label">

                            Cover Buku

                        </label>

                        <input
                            type="file"
                            name="gambar"
                            class="form-control"
                            accept="image/*"
                            onchange="previewImage(event)">

                    </div>

                    <div class="col-md-12 mb-3 text-center">

                        <img
                            id="preview"
                            src="https://placehold.co/180x250?text=No+Image"
                            class="img-thumbnail"
                            width="180">

                    </div>

                    <div class="col-md-12 mb-3">

                        <label class="form-label">

                            Deskripsi

                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="5">{{ old('deskripsi') }}</textarea>

                    </div>

                </div>

                <a
                    href="{{ route('buku.index') }}"
                    class="btn btn-secondary">

                    Kembali

                </a>

                <button
                    type="submit"
                    class="btn btn-success">

                    Simpan Buku

                </button>

            </form>

        </div>

    </div>

</div>

@endsection

@section('js')

<script>

function previewImage(event){

    let reader = new FileReader();

    reader.onload = function(){

        document.getElementById('preview').src = reader.result;

    }

    reader.readAsDataURL(event.target.files[0]);

}

</script>

@endsection