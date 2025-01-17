@extends('layout.app')
@section('title', 'Product Detail')
@section('content')
<div class="container-fluid">
    <div class="row d-flex align-items-center justify-content-between">
        <h1 class="">Detail Produk</h1>
        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning align-middle">Edit</a>
    </div>

    <table class="table">
        <tr>
            <th>Kode Produk</th>
            <td>{{ $product->code_product }}</td>
        </tr>
        <tr>
            <th>Nama Produk</th>
            <td>{{ $product->name_product }}</td>
        </tr>
        <tr>
            <th>Customer</th>
            <td>{{ $product->customer }}</td>
        </tr>
        <tr>
            <th>Deadline</th>
            <td>{{ $product->deadline }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>{{ $product->kategoris->name ?? '-' }}</td>
        </tr>
        <tr>
            <th>Ukuran dan Jumlah</th>
            <td>
                <ul>
                    @foreach ($product->sizeUnit as $size)
                        <li>{{ $size->name }}: {{ $size->pivot->qty }} Pcs</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <th>Total Qty</th>
            <td>{{ $totalQty }} Pcs</td>
        </tr>
    </table>
    <a href="{{ route('product.index') }}" class="btn btn-primary">Kembali ke Daftar Produk</a>
</div>
@endsection
