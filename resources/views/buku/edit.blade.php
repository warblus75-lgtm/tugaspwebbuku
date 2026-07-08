@extends('layouts.master')

@section('title','Edit Buku')

@section('content')

<div class="container">

<div class="card shadow">

<div class="card-header bg-warning">

<h4 class="mb-0">

✏ Edit Buku

</h4>

</div>

<div class="card-body">

@if ($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<form
action="{{ route('buku.update',$buku->id) }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="row">

<div class="col-md-6 mb-3">

<label>Kategori</label>

<select
name="kategori_id"
class="form-select">

@foreach($kategoris as $kategori)

<option
value="{{ $kategori->id }}"
{{ $kategori->id==$buku->kategori_id?'selected':'' }}>

{{ $kategori->nama_kategori }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label>Judul Buku</label>

<input
type="text"
name="judul"
class="form-control"
value="{{ old('judul',$buku->judul) }}">

</div>

<div class="col-md-6 mb-3">

<label>Penulis</label>

<input
type="text"
name="penulis"
class="form-control"
value="{{ old('penulis',$buku->penulis) }}">

</div>

<div class="col-md-6 mb-3">

<label>Penerbit</label>

<input
type="text"
name="penerbit"
class="form-control"
value="{{ old('penerbit',$buku->penerbit) }}">

</div>

<div class="col-md-4 mb-3">

<label>Tahun</label>

<input
type="number"
name="tahun_terbit"
class="form-control"
value="{{ old('tahun_terbit',$buku->tahun_terbit) }}">

</div>

<div class="col-md-4 mb-3">

<label>Harga</label>

<input
type="number"
name="harga"
class="form-control"
value="{{ old('harga',$buku->harga) }}">

</div>

<div class="col-md-4 mb-3">

<label>Stok</label>

<input
type="number"
name="stok"
class="form-control"
value="{{ old('stok',$buku->stok) }}">

</div>

<div class="col-md-12 mb-3">

<label>Ganti Cover</label>

<input
type="file"
name="gambar"
class="form-control"
accept="image/*"
onchange="previewImage(event)">

</div>

@if($buku->gambar)

<div class="text-center mb-3">

<img
id="preview"
src="{{ asset('storage/'.$buku->gambar) }}"
width="180"
class="img-thumbnail">

</div>

@else

<div class="text-center mb-3">

<img
id="preview"
src="https://placehold.co/180x250?text=No+Image"
width="180"
class="img-thumbnail">

</div>

@endif

<div class="col-md-12 mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
rows="5"
class="form-control">{{ old('deskripsi',$buku->deskripsi) }}</textarea>

</div>

</div>

<a
href="{{ route('buku.index') }}"
class="btn btn-secondary">

Kembali

</a>

<button
class="btn btn-success">

Update Buku

</button>

</form>

</div>

</div>

</div>

@endsection

@section('js')

<script>

function previewImage(event){

let reader=new FileReader();

reader.onload=function(){

document.getElementById('preview').src=reader.result;

}

reader.readAsDataURL(event.target.files[0]);

}

</script>

@endsection