@extends('layouts.master')

@section('title','Detail Transaksi')

@section('content')

<div class="container">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4>

Detail Transaksi

</h4>

</div>

<div class="card-body">

<h5>

Informasi Pembeli

</h5>

<table class="table">

<tr>

<th width="180">

Nama

</th>

<td>

{{ $transaksi->user->name }}

</td>

</tr>

<tr>

<th>

Email

</th>

<td>

{{ $transaksi->user->email }}

</td>

</tr>

<tr>

<th>

Kode

</th>

<td>

{{ $transaksi->kode_transaksi }}

</td>

</tr>

<tr>

<th>

Tanggal

</th>

<td>

{{ $transaksi->tanggal }}

</td>

</tr>

<tr>

    <th>Status</th>

    <td>

        <form action="{{ route('transaksi.updateStatus',$transaksi->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6">

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="Menunggu Pembayaran"
                            {{ $transaksi->status=='Menunggu Pembayaran' ? 'selected' : '' }}>

                            Menunggu Pembayaran

                        </option>

                        <option
                            value="Diproses"
                            {{ $transaksi->status=='Diproses' ? 'selected' : '' }}>

                            Diproses

                        </option>

                        <option
                            value="Selesai"
                            {{ $transaksi->status=='Selesai' ? 'selected' : '' }}>

                            Selesai

                        </option>

                        <option
                            value="Dibatalkan"
                            {{ $transaksi->status=='Dibatalkan' ? 'selected' : '' }}>

                            Dibatalkan

                        </option>

                    </select>

                </div>

                <div class="col-md-3">

                    <button
                        class="btn btn-success">

                        Simpan

                    </button>

                </div>

            </div>

        </form>

    </td>

</tr>

</table>

<hr>

<h5>

Daftar Buku

</h5>

<table class="table table-bordered">

<thead class="table-light">

<tr>

<th>No</th>

<th>Buku</th>

<th>Harga</th>

<th>Jumlah</th>

<th>Subtotal</th>

</tr>

</thead>

<tbody>

@foreach($transaksi->detailTransaksis as $detail)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $detail->buku->judul }}</td>

<td>

Rp {{ number_format($detail->harga,0,',','.') }}

</td>

<td>{{ $detail->jumlah }}</td>

<td>

Rp {{ number_format($detail->subtotal,0,',','.') }}

</td>

</tr>

@endforeach

</tbody>

<tfoot>

<tr>

<th colspan="4">

Total

</th>

<th>

Rp {{ number_format($transaksi->total_harga,0,',','.') }}

</th>

</tr>

</tfoot>

</table>

<a href="{{ route('transaksi.index') }}"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

@endsection